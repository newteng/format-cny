<?php

namespace Newteng\FormatCny\Tests;


use Newteng\FormatCny\Cny;
use Newteng\FormatCny\Exceptions\InvalidArgumentException;
use Newteng\FormatCny\Exceptions\InvalidValueException;
use PHPUnit\Framework\TestCase;

class CnyTest extends TestCase
{
    public function testTransform()
    {
        $c = new Cny();
        $this->assertSame('壹圆整', $c->transform(1));
        $this->assertSame('叁仟伍佰陆拾捌圆整', $c->transform(3568));
        $this->assertSame('壹仟零贰拾叁圆捌角玖分', $c->transform(1023.89));
        $this->assertSame('壹仟零贰拾叁圆捌角', $c->transform(1023.80));
        $this->assertSame('壹仟零贰拾叁圆整', $c->transform(1023.00));
        $this->assertSame('壹角', $c->transform(0.1023));
        $this->assertSame('玖角伍分', $c->transform(0.9523));
        $this->assertSame('零圆整', $c->transform(0.001));
        $this->assertSame('壹亿贰仟叁佰肆拾伍万陆仟柒佰捌拾玖圆壹角贰分', $c->transform(123456789.12));
    }

    public function testTransformWithInvalidArgs()
    {
        $c = new Cny();

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid money: foo');

        $c->transform('foo');

        $this->fail('Failed to assert transform throw exception with invalid money.');
    }

    public function testTransformWithInvalidValue()
    {
        $c = new Cny();

        $this->expectException(InvalidValueException::class);
        $this->expectExceptionMessage('The amount is beyond the range of calculation: 1234567890.12');

        $c->transform(1234567890.12);

        $this->fail('Failed to assert transform throw exception with the amount is beyond the range of calculation.');
    }
}