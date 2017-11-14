<?php
namespace yiifloruit\swoole;

/**
 * Mailer 类
 * @author  AllenSun
 */
class Mailer
{
    public $transport;
    public $mailer;

    /**
     * 发送邮件
     * @param array $param ['subject'](邮件主题)&['to'](接收邮件的人)&['content'](内容)
     * @return bool $result 发送成功 or 失败
     */
    public function send($param) {
        $to = isset($param['to']) ? $param['to'] : '';
        $subject = isset($param['subject']) ? $param['subject'] : '';
        $content = isset($param['content']) ? $param['content'] : '';

        //构建发送对象
        $this->transport = (new Swift_SmtpTransport('smtp.qq.com', 25))
        ->setEncryption('tls')
        ->setUsername('2439517098')
        ->setPassword('cvkrgyquuxftdhjc');

        //初始化
        $this->mailer = new Swift_Mailer($this->transport);

        //构建消息
        $message = (new Swift_Message($subject))
        ->setFrom(array('2439517098@qq.com' => 'Allen'))
        ->setTo($to)
        ->setBody($content);

        //发送
        $result = $this->mailer->send($message);

        //释放
        $this->destroy();

        return $result;
    }

    /**
     * 释放对象
     * @author  AllenSun
     */
    public function destroy() {
        $this->transport = null;
        $this->mailer = null;
    }
}