<?php

/*
 * This file is part of the 4devs Export Routing package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FDevs\ExportRouting\Tests\Encoder;

use FDevs\ExportRouting\Encoder\JsCallbackEncoder;
use PHPUnit\Framework\TestCase;

class JsCallbackEncoderTest extends TestCase
{
    /**
     * @var JsCallbackEncoder
     */
    private $encoder;

    protected function setUp()
    {
        $this->encoder = new JsCallbackEncoder();
    }

    public function testEncodeScalar()
    {
        $obj = new \stdClass();
        $obj->foo = 'foo';

        $expected = 'init({"foo":"foo"});';

        $this->assertEquals($expected, $this->encoder->encode($obj, 'js', [JsCallbackEncoder::CONTEXT_KEY => 'init']));
    }

    public function testComplexObject()
    {
        $obj = $this->getObject();

        $expected = $this->getJsonSource();

        $this->assertEquals($expected, $this->encoder->encode($obj, 'json', [JsCallbackEncoder::CONTEXT_KEY => 'init']));
    }

    public function testOptions()
    {
        $context = ['json_encode_options' => JSON_NUMERIC_CHECK, JsCallbackEncoder::CONTEXT_KEY => 'init'];

        $arr = [];
        $arr['foo'] = '3';

        $expected = 'init({"foo":3});';

        $this->assertEquals($expected, $this->encoder->encode($arr, 'json', $context));

        $arr = [];
        $arr['foo'] = '3';

        $expected = 'init({"foo":"3"});';

        $this->assertEquals($expected, $this->encoder->encode($arr, 'json', [JsCallbackEncoder::CONTEXT_KEY => 'init']), 'Json context should not be persistent');
    }

    protected function getJsonSource(string $callback = 'init')
    {
        return $callback.'({"foo":"foo","bar":["a","b"],"baz":{"key":"val","key2":"val","A B":"bar","item":[{"title":"title1"},{"title":"title2"}],"Barry":{"FooBar":{"Baz":"Ed","@id":1}}},"qux":"1"});';
    }

    protected function getObject()
    {
        $obj = new \stdClass();
        $obj->foo = 'foo';
        $obj->bar = ['a', 'b'];
        $obj->baz = ['key' => 'val', 'key2' => 'val', 'A B' => 'bar', 'item' => [['title' => 'title1'], ['title' => 'title2']], 'Barry' => ['FooBar' => ['Baz' => 'Ed', '@id' => 1]]];
        $obj->qux = '1';

        return $obj;
    }
}
