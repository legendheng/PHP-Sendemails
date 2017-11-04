# Thinkphp3.2-sendemails
thinkphp3.2实现邮件发送功能
### 第一步：修改命名
    把class.phpmailer.php文件名改成Phpmailer.class.php
    把class.smtp.php文件名改成Smtp.class.php
### 第二步：把文件放在ThinkPHP\Library\Org\Util下,并且添加命名空间
    namespace Org\Util;
### 第三步：更改继承目录
    把Phpmailer.class.php的3913行从class phpmailerException extends Exception改成class phpmailerException extends \Think\Exception
### 第四步：在Application目录下的common新建function.php文件
    用于存放所有个人的编写的函数，可以在控制器之间调用
```php
<?php
function send_email($from,$frompwd,$fromname,$toemail,$title,$content){
    /**
     *$from是发件人称呼
     *$frompwd是发件人邮箱的授权码（126和163邮箱都是用授权码）
     *$fromname是发件人的称呼
     *$toemail是收件人的邮箱（不限制）
     *$title是标题
     *$content是内容
     */
    import("Org.Util.Phpmailer");
    import("Org.Util.Smtp");
    $mail = new \Org\Util\PHPMailer();          //实例PHPMailer对象
    $mail->CharSet="utf-8";
    $mail->Encoding = "base64";
    $mail->isSMTP();
    $mail->SMTPDebug=2;
    $mail->CharSet="utf-8";
    $mail->Encoding = "base64";
    $mail->Debugoutput='html';
    $mail->Port       = 25;                     // 设置SMTP的服务端口（如果发件人邮箱是qq，则端口为465）
    $mail->SMTPAuth   = true;                   // 设置SMTP的身份验证
    $mail->Host       = "smtp.126.com";         // 设置SMTP服务
    $mail->Username   = $from;                  // 设置发件人称呼
    $mail->Password   = $frompwd;               // 设置发件人邮箱的授权码

    $mail->SetFrom($from, $fromname);
    $mail->addAddress($toemail);
    $mail->Subject  = $title;
    $mail->msgHTML($content);
    if (!$mail->Send()){
        echo "发送错误：".$mail->ErrorInfo;
    }else{
        echo "发送成功";
    }
}
```
### 第五步：直接在控制器的sendemails方法调用
```php
    public function sendemails(){
        send_email('你的邮箱','你的授权码','你的公司名称','收件人邮箱','标题','内容');
    }
```
