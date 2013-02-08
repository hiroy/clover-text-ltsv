<?php
namespace Clover\Tests\Text;

use Clover\Text\LTSV;

class LTSVTest extends \PHPUnit_Framework_TestCase
{
    public function testParseLine()
    {
        $ltsv = new LTSV();
        $values = $ltsv->parseLine("hoge:foo\tbar:baz");
        $this->assertSame(array('hoge' => 'foo', 'bar' => 'baz'), $values);
    }

    public function testParseFileException()
    {
        $path = 'nofile.ltsv';
        $ltsv = new LTSV();
        try {
            $values = $ltsv->parseFile($path);
        } catch (\Exception $e) {
            $this->assertInstanceOf('InvalidArgumentException', $e);
            return;
        }
        $this->fail();
    }

    public function testParseFile()
    {
        $path = __DIR__ . '/../../../test.ltsv';
        $ltsv = new LTSV();
        $values = array();
        try {
            $values = $ltsv->parseFile($path);
        } catch (\Exception $e) {
            $this->fail();
        }
        $this->assertSame(array(
            array('hoge' => 'foo', 'bar' => 'baz'),
            array('foo' => 'bar', 'baz' => 'hoge')
        ), $values);
    }

    public function testGetIteratorFromFileException()
    {
        $path = 'nofile.ltsv';
        $ltsv = new LTSV();
        try {
            $it = $ltsv->getIteratorFromFile($path);
        } catch (\Exception $e) {
            $this->assertInstanceOf('InvalidArgumentException', $e);
            return;
        }
        $this->fail();
    }

    public function testGetIteratorFromFile()
    {
        $path = __DIR__ . '/../../../test.ltsv';
        $ltsv = new LTSV();
        $it = null;
        try {
            $it = $ltsv->getIteratorFromFile($path);
        } catch (\Exception $e) {
            $this->fail();
        }
        $this->assertInstanceOf('ArrayIterator', $it);
        foreach ($it as $index => $values) {
            if ($index === 0) {
                $this->assertSame(array('hoge' => 'foo', 'bar' => 'baz'), $values);
            } elseif ($index === 1) {
                $this->assertSame(array('foo' => 'bar', 'baz' => 'hoge'), $values);
            } else {
                $this->fail();
            }
        }
    }

    public function testToString()
    {
        $ltsv = new LTSV(array('hoge' => 'foo', 'bar' => 'baz'));
        $this->assertEquals("hoge:foo\tbar:baz", strval($ltsv));
    }
}
