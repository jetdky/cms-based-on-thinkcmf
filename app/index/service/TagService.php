<?php
/**
 *created by dengkunyao
 */

namespace app\index\service;


use app\common\model\TagContentModel;

class TagService
{
    public function read($id, $typeId)
    {
        $tagContentModel = new TagContentModel();
        $tags = $tagContentModel->where('content_id', $id)->where('type', $typeId)->value('tag_id');
        return $tags;
    }

    /**
     *created by dengkunyao
     * @param $model :Model 被查询字段的模型类型
     * @param $tagId :int 要查询的标签id
     * @return :array 返回该标签关联的内容id数组
     */
    public function getRelationContent($model, $tagId)
    {
        //根据模型获得当前操作的表
        $class = strtolower(str_replace('Model', '', substr(get_class($model), strrpos(get_class($model), '\\') + 1)));
        $allData = $model->where('status', 1)->with($class . 'Tag.tags')->select();
        $ids = [];
        foreach ($allData as $key => $value) {
            if(@$value[$class.'_tag'][0]['tags']['id'] == $tagId){
                $ids[] = $value['id'];
            }
        }
        return $ids;
    }
}