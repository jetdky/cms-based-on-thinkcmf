<?php

namespace app\index\service;

use app\common\model\ImgModel;
use app\common\model\ImgContentModel;
use think\facade\Env;
use think\Image;

class ImgService
{
    /**
     * 存储图片到数据库
     *
     * @param array $isCover 图片类型数组
     * @param array $imgList 图片名数组
     * @param int $typeId 图片类型名
     * @param int $id 图片对应
     * @return bool
     */
    public function doSave($imgList, $typeId, $id, $isCover = [])
    {
        $imgRes = true;
        $imgContentRes = true;
        $i = 0;
        // $order = cal_array_order_num($imgList, 'Img', $typeId);
        // for ($i = 0; $i < count($imgList); $i++) {
        //     if (!isset($isCover[$i])) {
        //         $isCover[$i] = 0;
        //     }
        // }
        foreach ($imgList as $value) {
            //存储图片
            // $imgArrayData['order_num'] = $order[$i];
            // $imgArrayData['is_cover'] = $isCover[$i];
            $imgArrayData['origi_img'] = $value;
            $imgNameBeforeLastSlash = substr($value, 0, strrpos($value, "/") + 1);
            $thumbName = str_replace("/", "t_", strrchr($value, "/"));
            $originDir = Env::get('root_path') . 'public/upload/';
            $image = Image::open($originDir . $value);
            $image->thumb(150, 150)->save($originDir . $imgNameBeforeLastSlash . $thumbName);
            $imgArrayData['thumb_img'] = $imgNameBeforeLastSlash . $thumbName;
            $imgArrayData['show_time'] = time();
            $ImgModel = new ImgModel();
            $imgRes = $ImgModel->save($imgArrayData);
            $imgId = $ImgModel->id;

            //存储内容图片关联
            $ImgContentModel = new ImgContentModel();
            $imgContentArrayData['img_id'] = $imgId;
            $imgContentArrayData['type'] = $typeId;
            $imgContentArrayData['content_id'] = $id;
            $imgContentRes = $ImgContentModel->save($imgContentArrayData);
            $i++;
        }
        if ($i == count($imgList)) {
            return true;
        } else {
            return false;
        }
    }

    /**读取分类已关联图片
     * @param $id
     * @param $typeId
     * @return mixed
     */
    public function read($id, $typeId)
    {
        $where = [];
        $imgContentModel = new ImgContentModel();
        $imgsId = $imgContentModel->where('content_id', $id)->where('type', $typeId)->column('img_id');
        if ($imgsId) {
            $imgModel = new ImgModel();
            foreach ($imgsId as $key => $value) {
                $where[$key] = ['id', '=', $value];
            }
            return $imgModel->whereOr($where)->select()->toArray();
        } else {
            return '';
        }
    }

    public function delete($id, $typeId)
    {
        $imgContentModel = new ImgContentModel();
        $imgsId = $imgContentModel->where('content_id', $id)->where('type', $typeId)->column('img_id');
        ImgModel::destroy($imgsId);
        return $imgContentModel->where('content_id', $id)->where('type', $typeId)->delete();
    }

    public function deleteImgByName($imgId, $contentId, $type)
    {
        //删除对应关系即可
        $imgContentModel = new ImgContentModel();
        //存在关联关系
        if ($imgId) {
            $bool = $imgContentModel->where('img_id', $imgId)
                ->where('type', $type)
                ->where('content_id', $contentId)
                ->delete();
        } else {
            //不存在关联关系
            $bool = true;
        }
        return $bool;
    }
}
