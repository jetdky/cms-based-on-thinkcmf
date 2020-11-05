<?php


namespace app\index\service;


use app\common\model\ClassModel;
use app\index\controller\BaseController;
use think\Exception;


class ClassService
{


    /**
     *created by dengkunyao
     * @param mixed $id
     * 根据type和name获得分类，默认获得所有分类
     */
    public function getCategory($categoryName, $id = '', $order = 'asc')
    {
        //分类，产品模型只是拿type_id，传入模型名即可
        $modelName = '\app\common\model\\' . ucfirst($categoryName) . 'Model';
        $type = (new $modelName)->categoryType;
        $classModel = new ClassModel();
        $whereType['type'] = $type;

        $objOfType = $classModel->field("id, name, parent_id")->where('status', 1)->where($whereType)->with(['classSeo.seo', 'classTag.tags', 'classImg.imgs']);
        if ($id) {
            $allClass = $objOfType->order('order_num ' . $order)->select()->toArray();
            $category =  build_category_tree($allClass, $id);
        } else {
            $category = $objOfType->order('order_num ' . $order)->select()->toArray();
        }

        //调整输出格式
        $siteInfo = cmf_get_option('site_info');
        foreach ($category as $key => $value) {
            //如果seo为空
            if (!reset($value['class_seo'])) {
                $category[$key]['class_seo']['title'] = $value['name'] . '-' . $siteInfo['site_name'];
                $category[$key]['class_seo']['keywords'] = $value['name'] . '-' . $siteInfo['site_name'];
                $category[$key]['class_seo']['description'] = '';
            } else {
                //TODO::未知BUG，貌似会让if已经处理过的seo再进入else...暂时这样判断
                if (!array_key_exists('title', $value['class_seo'])) {
                    $category[$key]['class_seo'] = $value['class_seo'][0]['seo'];
                }
            }
            //如果标签不为空
            if (reset($value['class_tag'])) {
                $category[$key]['class_tag'] = $value['class_tag'][0]['tags']['id'];

            }
        }
//        echo "<pre>";
//        print_r($id);
//        print_r($category);
//        echo "</pre>";
        return $category;
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
            $classData['class_seo']['description'] = "";
        }
        return $classData;
    }
}