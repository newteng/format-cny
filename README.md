# format-cny
一个简单的人民币数字转大写的工具，将`10`、`10.055`、`9.995`、`123456789.01`等数字转换为`壹拾圆整`、`壹拾圆零陆分`、`壹拾圆整`、`壹亿贰仟叁佰肆拾伍万陆仟柒佰捌拾玖圆零壹分`;
四舍五入自动保留`2`位小数，最大转单位到`亿`。

## Installing

```shell
$ composer require newteng/format-cny -vvv
```

## Usage
### Common
```php
<?php

require __DIR__ . '/vendor/autoload.php';

$c = new \Newteng\FormatCny\Cny();
echo $c->transform('1433') . PHP_EOL; //壹仟肆佰叁拾叁圆整
echo $c->transform('0.89') . PHP_EOL; //捌角玖分
echo $c->transform('11343') . PHP_EOL; //壹万壹仟叁佰肆拾叁圆整
echo $c->transform('0.001') . PHP_EOL; //零圆整
```

### Laravel
```php
<?php

namespace App\Http\Controllers;

use Newteng\FormatCny\Cny;

class IndexController extends Controller
{
    public function index(Cny $cny)
    {
//        return $cny->transform(10.055); // 壹拾圆零陆分
//        return $cny->transform(10.0); // 壹拾圆整
//        return $cny->transform(9.995); // 壹拾圆整
//        return $cny->transform(10.011); // 壹拾圆零壹分
        return $cny->transform(123456789.01); // 壹亿贰仟叁佰肆拾伍万陆仟柒佰捌拾玖圆零壹分
    }
}

```

## License
MIT