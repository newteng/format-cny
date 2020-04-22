<?php

namespace Newteng\FormatCny;


use Newteng\FormatCny\Exceptions\InvalidArgumentException;
use Newteng\FormatCny\Exceptions\InvalidValueException;

class Cny
{
    public function transform($money)
    {
        if (!\is_numeric($money)) {
            throw new InvalidArgumentException('Invalid money: ' . $money);
        }

        if (\strlen(round($money, 2) * 100) > 11) {
            throw new InvalidValueException('The amount is beyond the range of calculation: ' . $money);
        }

        return $this->convert($money);
    }

    private function convert($originMoney)
    {
        $a = '零壹贰叁肆伍陆柒捌玖';
        $b = '分角圆拾佰仟万拾佰仟亿';
        $roundMoney = round($originMoney, 2);
        $money = $roundMoney * 100;
        $i = 0;
        $c = "";
        while (true) {
            if ($i == 0) {
                $n = substr($money, strlen($money) - 1, 1);
            } else {
                $n = $money % 10;
            }
            $p1 = substr($a, 3 * $n, 3);
            $p2 = substr($b, 3 * $i, 3);
            if ($n != '0' || ($n == '0' && ($p2 == '亿' || $p2 == '万' || $p2 == '圆'))) {
                $c = $p1 . $p2 . $c;
            } else {
                $c = $p1 . $c;
            }
            $i = $i + 1;
            $money = $money / 10;
            $money = (int)$money;
            if ($money == 0) {
                break;
            }
        }
        $j = 0;
        $slen = strlen($c);
        while ($j < $slen) {
            $m = substr($c, $j, 6);
            if ($m == '零圆' || $m == '零万' || $m == '零亿' || $m == '零零') {
                $left = substr($c, 0, $j);
                $right = substr($c, $j + 3);
                $c = $left . $right;
                $j = $j - 3;
                $slen = $slen - 3;
            }
            $j = $j + 3;
        }

        if (substr($c, strlen($c) - 3, 3) == '零') {
            $c = substr($c, 0, strlen($c) - 3);
        }
        if (empty($c)) {
            return '零圆整';
        } else {
            return strpos($roundMoney, '.') === false ? $c . '整' : $c;
        }
    }
}