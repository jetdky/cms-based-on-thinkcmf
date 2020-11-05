<?php
/**
 *created by dengkunyao
 */

namespace app\index\controller;


use app\index\service\PacontentService;

class MessageController extends BaseController
{
    public function index(PacontentService $pacontentService)
    {
        $content['content'] = $pacontentService->getPacontentByPageName('留言反馈');
        $content['messageContent'] = $pacontentService->getPacontentByPageName('联系方式');

        return view('', $content);

    }

    public function add()
    {
        $data = $this->request->param();
        if (!$data['name'] || !$data['username'] || !$data['phone'] || !$data['email'] || !$data['content']) {
            $this->error('填写项不能为空');
        } else {
            $name = $data['name'];
            $content = '姓名：' . $data['username'] . '<br>' . '手机号码：' . $data['phone'] . '<br>' . '邮箱：' . $data['email'] . '<br><br>' . '内容：' . $data['content'];

            $res = model('message')->save(['name' => $name, 'content' => $content]);
            if ($res) {
                $this->success('留言成功！');
            } else {
                $this->error('留言失败，请联系管理员！');

            }
        }
    }
}