<?php


namespace app\index\controller;


use app\common\model\ClassModel;
use app\common\model\PacontentModel;
use app\index\service\ClassService;
class PacontentController extends BaseController
{
    /**
     *created by dengkunyao
     * @param $name
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     * 根据页面名称获得页面的标签/seo 和数据内容
     */
    public function getPacontentByPageName($name)
    {

        $classService = new ClassService();
        $pacontentModel = new PacontentModel();
        $classData = $classService->getSeoAndTagOfCategoryByNameAndType($name, $pacontentModel->categoryType);
        $pageId = $classData['id'];
        $subCategory = build_category_tree($classService->getPacontentCategory(), $pageId);
        //找到该页面下所有末端分类，只有末端分类有内容
        foreach ($subCategory as $key => $value){
            if(is_have_son($subCategory, $value['id'])){
                unset($subCategory[$key]);
            }
        }
        //顺序读取末端分类内容，内容中加上该所属分类名便于标识
        foreach ($subCategory as $key => $value){
            $pacontentData[$key]['data'] = $pacontentModel->where('cid', $value['id'])->with('pacontentImg.imgs')->order('order_num')->select()->toArray();
            $pacontentData[$key]['CategoryName'] = $value['name'];
            $pacontentData[$key]['CategoryId'] = $value['id'];
        }
        return ['pageInfo' => $classData, 'pageData' => $pacontentData];
    }
//TODO：：更改当前类为Page类，根据使用的不存在的函数来实例化，得到不同的数据
//    public function __call($name, $args)
//    {
//        $arr = preg_split("/(?=[A-Z])/", $name);
//        $modelName = '\app\common\model\\' . strtolower($arr[1]) . 'Model';
//        //自动实例化对象
//        $type = (new $modelName)->categoryType;
//        return $this->getSeoAndTagOfCategoryByNameAndType($args[0], $type);
//    }

}