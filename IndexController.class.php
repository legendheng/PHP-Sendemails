<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        echo '欢迎了解tp3.2的邮件发送功能';
    }
    public function sendemails(){
        send_email('你的邮箱','你的授权码','你的公司名称','收件人邮箱','标题','内容');
    }
}