<?php


namespace app\admin\controller;

use app\admin\service\TagService;
use cmf\controller\AdminBaseController;


class TagController extends AdminBaseController
{
    public function initTags()
    {
        $tagService = new TagService();
        return json($tagService->get());
    }

    public function readTags($id, $typeId)
    {
        $tagSercice = new TagService();
        return json($tagSercice->read($id, $typeId));
    }
}