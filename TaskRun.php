<?php
namespace yiifloruit\swoole;

use yiifloruit\swoole\Mailer;

/**
 * 任务运行
 * @author AllenSun
 *
 */
class TaskRun
{
    public function receive($serv, $fd, $fromId, $data)
    {
    }
    public function task($serv, $taskId, $fromId, $data)
    {
        try {
            switch ($data['event']) {
                case TaskClient::EVENT_TYPE_SEND_MAIL:
                    $mailer = new Mailer();
                    $result = $mailer->send($data);
                    break;
                default:
                    break;
            }
 
            return $result;
 
        } catch (\Exception $e) {
            throw new \Exception('task exception :' . $e->getMessage());
        }
    }
    
    public function finish($serv, $taskId, $data)
    {
        return true;
    }
}
