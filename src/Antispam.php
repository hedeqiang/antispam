<?php

namespace Hedeqiang\Antispam;

use Hedeqiang\Antispam\Traits\HasHttpRequest;

class Antispam
{
    use HasHttpRequest;

    protected  $config;

    const ENDPOINT_TEMPLATE = 'http://as.dun.163.com/v3/%s';

    const ENDPOINT_VERSION = 'v3.1';

    const ENDPOINT_FORMAT = 'json';

    const INTERNAL_STRING_CHARSET = 'auto';

    public function __construct(array $config)
    {
        $this->config = new Config($config);
    }

    /**
     * 文本检测
     * @param string $content
     * @param array $params 可选值 文档中 请求参数 是否必选 为 N 都可以放到这里
     * @param array $extras
     * @return array
     */
    public function textScan(string $content,array $params = [],array $extras = [])
    {
        $params['content'] = $content;

        $params = array_merge($params,$extras);
        //return $params;
        $params = $this->baseParams($params);
        $params["signature"] = $this->gen_signature($this->config->get('secretKey'), $params);

        return $this->post($this->buildEndpoint('text/check'),$params);
    }

    /**
     * 文本批量检测
     * @param array $texts content 字段 需要检测的内容 ['文本1','文本2']
     * @param array $extras
     * @return array
     */
    public function textBatchScan($texts = [],array $extras = [])
    {
        $params['texts'] = json_encode($this->getTask($texts));
        $params = $this->baseParams($params);
        $params["signature"] = $this->gen_signature($this->config->get('secretKey'), $params);

        return $this->post($this->buildEndpoint('text/batch-check'),$params);
    }


    /**
     * 将输入数据的编码统一转换成utf8
     * @params 输入的参数
     * @param $params
     * @return array
     */
    function toUtf8($params){
        $utf8s = array();
        foreach ($params as $key => $value) {
            $utf8s[$key] = is_string($value) ? mb_convert_encoding($value, "utf8", self::INTERNAL_STRING_CHARSET) : $value;
        }
        return $utf8s;
    }

    /**
     * 计算参数签名
     * $params 请求参数
     * $secretKey secretKey
     * @param $secretKey
     * @param $params
     * @return string
     */
    function gen_signature($secretKey, $params){
        ksort($params);
        $buff="";
        foreach($params as $key=>$value){
            if($value !== null) {
                $buff .=$key;
                $buff .=$value;
            }
        }
        $buff .= $secretKey;
        return md5($buff);
    }

    /**
     * 基础参数
     * @param array $params
     * @return array
     */
    public function baseParams(array $params): array
    {
        $params["secretId"] = $this->config->get('secretId');
        $params["businessId"] = $this->config->get('businessId');
        $params["version"] = self::ENDPOINT_VERSION;
        $params["timestamp"] = time() * 1000;// time in milliseconds
        $params["nonce"] = sprintf("%d", rand()); // random int
        $params["dataId"] = uniqid();

        $params = $this->toUtf8($params);
        return $params;
    }

    /**
     * Build endpoint url.
     *
     * @param string $url
     * @return string
     */
    protected function buildEndpoint(string $url): string
    {
        return \sprintf(self::ENDPOINT_TEMPLATE, $url);
    }

    /**
     * @param array $texts
     * @return array
     */
    public function getTask(array $texts): array
    {
        $tasks = [];
        foreach ($texts as $k => $v) {
            $arr['dataId'] = uniqid();
            $arr['content'] = $v;
            $tasks[] = $arr;
        }
        return $tasks;
    }


}