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


TODO

## Contributing

You can contribute in one of three ways:

1. File bug reports using the [issue tracker](https://github.com/hedeqiang/antispam/issues).
2. Answer questions or fix bugs on the [issue tracker](https://github.com/hedeqiang/antispam/issues).
3. Contribute new features or update the wiki.

_The code contribution process is not very formal. You just need to make sure that you follow the PSR-0, PSR-1, and PSR-2 coding guidelines. Any new code contributions must be accompanied by unit tests where applicable._

## License

MIT