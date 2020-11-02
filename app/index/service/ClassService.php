<?php


namespace app\index\service;


use app\common\model\ClassModel;
use app\index\controller\BaseController;
use think\Exception;


class ClassService extends BaseController
{


    /**
     *created by dengkunyao
     * @param string $type
     * @param string $name
     * @param $classModel
     * 根据type和name获得分类，默认获得所有分类
     */
    private function getCategory($classModel, $type = '', $name = '', $order = 'asc')
    {
        $whereType = [];
        if ($type) {
            $whereType['type'] =  $type;
        }
        $objOfType = $classModel->field("id, name, parent_id")->where('status', 1)->where($whereType)->with(['classSeo.seo', 'classTag.tags', 'classImg.imgs']);
        if ($name) {
            $classId = $objOfType->where('name', $name)->value('id');
            $objOfType->removeOption('where');
            $allClass = $objOfType->order('order_num ' . $order)->select()->toArray();
            return build_category_tree($allClass, $classId);
        } else {
            return $objOfType->order('order_num ' . $order)->select()->toArray();
        }

    }

    public function getSeoAndTagOfCategoryByNameAndType($name, $type)
    {
        $classModel = new ClassModel();
        $classData = $classModel->where(['name' => $name, 'type' => $type, 'parent_id' => 0])->with(['classSeo.seo', 'classTag.tags'])->find()->toArray();
        @$classData['class_seo'] = $classData['class_seo'][0]['seo'];
        //TODO：多标签关联
        @$classData['class_tag'] = $classData['class_tag'][0]['tags']['id'];

        $siteInfo = cmf_get_option('site_info');
        //seo 如果有则读取，没有则自动生成（当前页面分类名-公司名）
        if (@$classData['class_seo']['id'] == '') {
            //如果是首页，title没有前缀，不是首页
            if (strpos($classData['name'], '首页')) {
                $classData['class_seo']['title'] = $siteInfo['site_name'];
            } else {
                $classData['class_seo']['title'] = $classData['name'] . '-' . $siteInfo['site_name'];
            }
            $classData['class_seo']['keywords'] = $classData['class_seo']['title'];
            $classData['class_seo']['description'] = $classData['class_seo']['title'];
        }
        return $classData;
    }

    //实现按名称读取分类，以及分类的seo，tag，img，
    //getProductCategory('产业集团') 读取的是产品下的“产业集团” 分类
    public function __call($name, $args)
    {
        $arr = preg_split("/(?=[A-Z])/", $name);
        $modelName = '\app\common\model\\' . $arr[1] . 'Model';
        if ($arr[2] != 'Category') {
            throw new Exception('函数不存在，函数名请带Category');
        }
        //自动实例化对象
        $type = (new $modelName)->categoryType;
        if (!isset($args[0]) || $args[0] == '') {
            $args[0] = '';
        }
        if (!isset($args[1]) || $args[1] == '') {
            $args[1] = 'asc';
        }
        $category = $this->getCategory(new ClassModel(), $type, $args[0], $args[1]);
        $siteInfo = cmf_get_option('site_info');

        //调整输出格式
        foreach ($category as $key => $value) {
            //如果seo为空
            if(!reset($value['class_seo'])){
                $category[$key]['class_seo']['title'] = $value['name'] . '-' . $siteInfo['site_name'];
                $category[$key]['class_seo']['keywords'] = $value['name'] . '-' . $siteInfo['site_name'];
                $category[$key]['class_seo']['description'] = '';
            }else{
                $category[$key]['class_seo'] = $value['class_seo'][0]['seo'];
            }
            //如果标签不为空
            if(reset($value['class_tag'])){
                $category[$key]['class_tag'] = $value['class_tag'][0]['tags']['id'];
            }
        }
        return $category;
    }
}