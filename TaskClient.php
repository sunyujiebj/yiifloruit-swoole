<?php
namespace yiifloruit\swoole;

/**
 * 异步任务客户端
 * @author  AllenSun
 */
class TaskClient extends \yii\base\Widget
{   
    /**
     * 消息事件类型
     * @var string
     */
    const EVENT_TYPE_SEND_MAIL = 'send-mail';   
    
    /**
     * 服务地址
     * @var string
     */
    public $hostname = '127.0.0.1';
    
    /**
     * 服务端口
     * @var int
     */
    public $port = 9501;
    
    /**
     * 客户端对象
     * @var unknown
     */
    private $client;
    
    public function __construct () {
        $this->client = new Swoole\Client(SWOOLE_SOCK_TCP);
    
        if (!$this->client->connect($this->hostname, $this->port)) {
            $msg = 'swoole client connect failed.';
            throw new \Exception("Error: {$msg}.");
        }
    }
    
    /**
     * @param $data Array
     * send data
     */
    public function sendData ($data)
    {
        $data = $this->togetherDataByEof($data);
        return $this->client->send($data);
    }
    
    /**
     * 数据末尾拼接EOF标记
     * @param Array $data 要处理的数据
     * @return String json_encode($data) . EOF
     */
    public function togetherDataByEof($data)
    {
        if (!is_array($data)) {
            return false;
        }
    
        return json_encode($data) . "\r\n";
    }
}