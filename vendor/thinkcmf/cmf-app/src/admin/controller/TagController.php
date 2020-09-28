<?php


namespace app\admin\controller;

use app\admin\service\TagService;
use cmf\controller\AdminBaseController;


class TagController extends AdminBaseController
{
    public function initTags()
    {
        $tagService = new TagService();
        return json(['data' => $tagService->get(), 'status' => []]);
    }

    public function readTags($id, $typeId)
    {
        $tagService = new TagService();
        return json(['data' => $tagService->get(), 'status' => $tagService->read($id, $typeId)]);
    }
}