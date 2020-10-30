<?php


namespace app\index\service;


use app\common\model\ClassModel;
use app\index\controller\BaseController;
use think\Db;

class ClassService extends BaseController
{


    /**
     *created by dengkunyao
     * @return array|array[]|\array[][]
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 获得所有分类
     */
    public function getAllCategory()
    {
        return (new ClassModel())->field("id, name, parent_id")->where('status', 1)->order('order_num')->select()->toArray();
    }

    public function getSeoAndTagOfClassByName($name)
    {
        $classModel = new ClassModel();
        $classData = $classModel->where(['name' => $name, 'parent_id' => 0])->with(['classSeo.seo','classTag.tags'])->find()->toArray();
        @$classData['class_seo'] = $classData['class_seo'][0]['seo'];
        //TODO：多标签关联
        @$classData['class_tag'] = $classData['class_tag'][0]['tags'];

        $siteInfo =  cmf_get_option('site_info');
        //seo 如果有则读取，没有则自动生成（当前页面分类名-公司名）
        if(@$classData['class_seo']['id'] == ''){
            //如果是首页，title没有前缀，不是首页
            if(strpos($classData['name'], '首页')){
                $classData['class_seo']['title'] = $siteInfo['site_name'];
            }else{
                $classData['class_seo']['title'] = $classData['name'] . '-' . $siteInfo['site_name'];
            }
            $classData['class_seo']['keywords'] = $classData['class_seo']['title'];
            $classData['class_seo']['description'] = $classData['class_seo']['title'];
        }
        return $classData;
    }
}