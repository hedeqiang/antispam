<?php

namespace Hedeqiang\Antispam;

use Hedeqiang\Antispam\Traits\HasHttpRequest;

class Antispam
{
    use HasHttpRequest;

    protected  $config;

    public function __construct(array $config)
    {
        $this->config = new Config($config);
    }

    /**
     * 文本检测
     * @param array $params 请求参数，建议 是否必选 Y 的都传递，N 可不传
     * @param array $extras 业务扩展参数
     * @return array
     */
    public function textScan(array $params = [],array $extras = []): array
    {
        /*$params = [
            'content' => 'XXX','title' => 'XXX','dataId' => 123
        ];*/

        $params = $this->getTask($params);
        $params = array_merge($params,$extras);
        if (empty($params['version'])){
            $params['version'] = Url::TEXT_VERSION;
        }
        $params = $this->baseParams($params);

        return $this->post($this->buildEndpoint(Url::ENDPOINT_TEXT_URL_VERSION,'text/check'),$params);
    }

    /**
     * 文本批量检测
     * @param array $texts 数组，详情参考 https://support.dun.163.com/documents/2018041901?docId=424382077801385984
     * @param array $extras 业务扩展参数
     * @return array
     */
    public function textBatchScan($texts = [],array $extras = []): array
    {
        /*$texts = [
            ['content' => 'XXX','title' => 'XXX','dataId' => 123],
            ['content' => 'XXX','title' => 'XXX']
        ];*/

        $params['texts'] = json_encode($this->getTask($texts));
        $params = array_merge($params,$extras);
        $params['version'] = Url::TEXT_VERSION;
        $params = $this->baseParams($params);

        return $this->post($this->buildEndpoint(Url::ENDPOINT_TEXT_URL_VERSION,'text/batch-check'),$params);
    }

    /**
     * 文本离线结果获取
     * @return array
     */
    public function textCallback(): array
    {
        $params['version'] = Url::TEXT_VERSION;
        $params = $this->baseParams($params);

        return $this->post($this->buildEndpoint(Url::ENDPOINT_TEXT_URL_VERSION,'text/callback/results'),$params);
    }

    /**
     * 文本机器结果反馈接口
     * @param array $feedbacks String(json数组) 参考：https://support.dun.163.com/documents/2018041901?docId=396075425773023232
     * @return array
     */
    public function textFeedback(array $feedbacks): array
    {
        /*
        $feedback = [
            ['taskId' => 'e8e13a01024345db8e04c0dfaed2ec50','version' => 'v1','level' => 0,'label' => 100]
        ];*/

        $params['feedbacks'] = json_encode($feedbacks);
        $params['version'] = Url::ENDPOINT_TEXT_FEEDBACK_VERSION;
        $params = $this->baseParams($params);

        return $this->post($this->buildEndpoint(Url::ENDPOINT_TEXT_FEEDBACK_URL_VERSION,'text/feedback'),$params);
    }

    /**
     * 自定义文本关键词-添加
     * @param array $params  参考： https://support.dun.163.com/documents/2018041901?docId=424741951897509888
     * @return array
     */
    public function addKeyWorld(array $params): array
    {
        /*$params = [
            'category' => '100',
            'keywords' => 'XXX,XXX,XXX,XXX,XXX,XXX,XXX'
        ];*/

        $params = $this->getTask($params);
        if (empty($params['version'])){
            $params['version'] = Url::ENDPOINT_TEXT_KEYWORD_VERSION;
        }
        $params = $this->baseParams($params);

        return $this->post($this->buildEndpoint(Url::ENDPOINT_TEXT_KEYWORD_URL_VERSION,'keyword/submit'),$params);
    }

    /**
     * 自定义关键词-删除
     * @param array $ids https://support.dun.163.com/documents/2018041901?docId=424742251085602816
     * @return array
     */
    public function delKeyWorld(array $ids): array
    {
        // $ids =['23234140','23234141'];

        $params['ids'] = implode(',',$ids);
        if (empty($params['version'])){
            $params['version'] = Url::ENDPOINT_TEXT_KEYWORD_VERSION;
        }
        $params = $this->baseParams($params);

        return $this->post($this->buildEndpoint(Url::ENDPOINT_TEXT_KEYWORD_URL_VERSION,'keyword/delete'),$params);
    }

    /**
     * 自定义关键词查询接口
     * @param array $params 参考：https://support.dun.163.com/documents/2018041901?docId=428324742066655232
     * @return array
     */
    public function textQuery(array $params = []): array
    {
        /*$params = [
            'id' => '23223254',
            'keyword' => 'XXX',
            'category' => 100,
            'orderType' => 1,
            'pageNum' => 100,
            'pageSize' => 10,
        ];*/

        if (empty($params['version'])){
            $params['version'] = Url::ENDPOINT_TEXT_KEYWORD_VERSION;
        }
        $params = $this->baseParams($params);

        return $this->post($this->buildEndpoint(Url::ENDPOINT_TEXT_KEYWORD_URL_VERSION,'keyword/query'),$params);
    }

    /**
     * 图片在线检测
     * @param array $images 基本参数 String(json数组)
     * @param array $checkLabels String 数组 接口指定过检分类，可多选，过检分类列表：100：色情，110：性感低俗，200：广告，210：二维码，300：暴恐，400：违禁，500：涉政
     * @param array $extras 业务参数
     * @return array
     */
    public function imageScan(array $images,array $checkLabels = [],array $extras = []): array
    {
        $params['version'] = Url::IMAGE_VERSION;
        $params['images'] = json_encode($this->getTask($images));
        $params = array_merge($params,$checkLabels,$extras);
        $params = $this->baseParams($params);

        return $this->post($this->buildEndpoint(Url::ENDPOINT_IMAGE_URL_VERSION,'image/check'),$params);
    }

    /**
     * 图片离线结果获取
     * @return array
     */
    public function imageCallback(): array
    {
        $params['version'] = Url::IMAGE_VERSION;
        $params = $this->baseParams($params);

        return $this->post($this->buildEndpoint(Url::ENDPOINT_TEXT_URL_VERSION,'image/callback/results'),$params);
    }

    /**
     * 图片机器结果反馈接口
     * @param array $feedbacks String(json数组) 参考：https://support.dun.163.com/documents/2018041901?docId=396075425773023232
     * @return array
     */
    public function imageFeedback(array $feedbacks): array
    {
        $params['feedbacks'] = json_encode($feedbacks);
        //return $params;
        $params['version'] = Url::IMAGE_VERSION;
        $params = $this->baseParams($params);

        return $this->post($this->buildEndpoint(Url::ENDPOINT_TEXT_FEEDBACK_URL_VERSION,'image/feedback'),$params);
    }


    /**
     * 将输入数据的编码统一转换成utf8
     * @params 输入的参数
     * @param $params
     * @return array
     */
    protected function toUtf8($params): array
    {
        $utf8s = [];
        foreach ($params as $key => $value) {
            $utf8s[$key] = is_string($value) ? mb_convert_encoding($value, "utf8", Url::INTERNAL_STRING_CHARSET) : $value;
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
    protected function gen_signature($secretKey, $params): string
    {
        ksort($params);
        $buff="";
        foreach($params as $key=>$value){
            if($value !== null) {
                $buff .= $key;
                $buff .= $value;
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
    protected function baseParams(array $params = []): array
    {
        $params["secretId"] = $this->config->get('secretId');
        $params["businessId"] = $this->config->get('businessId');
        $params["timestamp"] = time() * 1000;// time in milliseconds
        $params["nonce"] = sprintf("%d", rand()); // random int
        //$params["dataId"] = uniqid();

        $params = $this->toUtf8($params);
        $params["signature"] = $this->gen_signature($this->config->get('secretKey'), $params);
        return $params;
    }

    /**
     * Build endpoint url.
     *
     * @param $version
     * @param string $url
     * @return string
     */
    protected function buildEndpoint($version,string $url): string
    {
        return \sprintf(Url::ENDPOINT_TEMPLATE,$version, $url);
    }

    /**
     * @param array $texts
     * @return array
     */
    protected function getTask(array $texts)
    {
        $tasks = [];
        foreach ($texts as $k => $v) {
            if (empty($value['dataId'])){
                $arr['dataId'] = uniqid();
            }
            if(is_array($v)){
                foreach ($v as $key => $value) {
                    $arr[$key] = $value;
                }
                $tasks[] = $arr;
            }
            else{
                $arr[$k] = $v;
                $tasks = $arr;
            }

        }
        return $tasks;
    }


}