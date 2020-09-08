<h1 align="center"> antispam </h1>

<p align="center"> 网易云 易盾 内容安全 PHP SDK </p>


## Installing

```shell
$ composer require hedeqiang/antispam -vvv
```

## Usage

```php
require __DIR__ .'/vendor/autoload.php';
use Hedeqiang\Antispam\Antispam;

$config = [
    'secretId' => '',
    'secretKey' => '',
    'businessId' => '',
];
$antispam = new Antispam($config);
```
## 文本
### 单文本检测
```php
$response = $antispam->textScan(['content' => 'XXX']);

or

$params = [
  'content' => 'XXX','title' => 'XXX','dataId' => 123 ...
]; // 可只传 content 字段。 dataId、version 本 SDK 已经做处理，可传可不传
$extras = [
    'ip' => '10.0.0.1',
    'account' => 'hedeqiang',
    ...
]; // 此参数可不传

$response = $antispam->textScan($params,$extras);
```

### 文本批量检测
```php
$texts = [
    ['content' => 'XXX','title' => 'XXX',...],
    ['content' => 'XXX','title' => 'XXX',...]
];  // 可以只填 Y 的值 。dataId 可不传
$extras = [
    'ip' => '10.0.0.1',
    'account' => 'hedeqiang',
    ...
]; // 此参数可不传

$response = $antispam->textBatchScan($params,$extras);
```

### 文本离线结果获取
```php
$response = $antispam->textCallback();
```

### 文本机器结果反馈接口
```php
$feedback = [
    ['taskId' => 'e8e13a01024345db8e04c0dfaed2ec50','version' => 'v1','level' => 0,'label' => 100]
]; 
$response = $antispam->textFeedback($feedback);
```

### 自定义文本关键词-添加
```php
$params = [
    'category' => '100',
    'keywords' => 'XXX,XXX,XXX,XXX,XXX,XXX,XXX'
];
$response  = $antispam->addKeyWorld($params);
```

### 自定义关键词-删除
```php
$ids =['23234140','23234141'];
$response = $antispam->delKeyWorld($ids);
```

### 自定义关键词查询接口
```php
$response = $antispam->textQuery();

// 也可传入制定参数
$params = [
    'id' => '23223254',
    'keyword' => 'XXX',
    'category' => 100,
    'orderType' => 1,
    'pageNum' => 100,
    'pageSize' => 10,
];

$response = $antispam->textQuery($params);
```

## 图片

### 图片在线检测
```php
$images = [
    ['name' => '','type' => '','data' => '','callbackUrl' => ''],
    ['name' => '','type' => '','data' => '','callbackUrl' => ''],
    ['name' => '','type' => '','data' => '','callbackUrl' => ''],
    ['name' => '','type' => '','data' => '','callbackUrl' => ''],
];
// array $checkLabels = [],array $extras = []
$response = $antispam->imageScan($images);
```

More...


### More...

## 在 Laravel 中使用
#### 发布配置文件
```php
php artisan vendor:publish --tag=antispam
```
##### 编写 .env 文件
```
YIDUN_GREEN_SECRET_ID=
YIDUN_GREEN_SECRET_KEY=
YIDUN_GREEN_BUSINESS_ID=
```

### 方法参数注入
> 参数和上面一样

```php
use Hedeqiang\Antispam\Antispam;

public function index(Antispam $antispam)
{
    $response = $antispam->textScan();
}
```
### 服务名访问
```php
public function index()
{
    $response = app('antispam')->textScan(); 
}
```

### Facades 门面使用(可以提示)
```php
use Hedeqiang\Antispam\Facades\Antispam;
$response = Antispam::green()->textScan();
```



## Contributing

You can contribute in one of three ways:

1. File bug reports using the [issue tracker](https://github.com/hedeqiang/antispam/issues).
2. Answer questions or fix bugs on the [issue tracker](https://github.com/hedeqiang/antispam/issues).
3. Contribute new features or update the wiki.

_The code contribution process is not very formal. You just need to make sure that you follow the PSR-0, PSR-1, and PSR-2 coding guidelines. Any new code contributions must be accompanied by unit tests where applicable._

## License

MIT