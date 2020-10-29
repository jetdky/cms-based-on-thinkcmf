<?php


namespace app\index\service;

use app\common\model\TagModel;
use app\common\model\TagContentModel;

class TagService
{
    /** 存储标签
     * @param $tags ,间隔的字符串形式的标签id
     * @param $typeId 分类类型id
     * @param $id 分类id
     * @return boolean
     */
    public function doSave($tags, $typeId, $id)
    {
        $data = [];
        $tag_id = explode(',', $tags);
        foreach ($tag_id as $key => $value) {
            $data[$key]['tag_id'] = $value;
            $data[$key]['type'] = $typeId;
            $data[$key]['content_id'] = $id;
        }
        $tagContentModel = new TagContentModel();
        return $tagContentModel->saveAll($data);
    }

    /**获得标签库，返回所有标签
     * @return array

     */
    public function get()
    {
        $tagModel = new TagModel();
        return $tagModel->field("id, name")->select()->toArray();
    }

    /** 得到该分类下的标签
     * @param $id 分类id
     * @param $typeId 分类类型id
     * @return array 返回该分类绑定标签的id一维数组
     */
    public function read($id, $typeId)
    {
        $tagContentModel = new TagContentModel();
        $tags = $tagContentModel->where('content_id', $id)->where('type', $typeId)->column('tag_id');
        return $tags;
    }

    public function delete($id, $typeId)
    {
        $tagContentModel = new TagContentModel();
        return $tagContentModel->where('content_id', $id)->where('type', $typeId)->delete();
    }
}