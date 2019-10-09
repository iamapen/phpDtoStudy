<?php
declare(strict_types=1);

use DtoStudy\DtoImpl1;

class DtoImpl1Test extends \PHPUnit\Framework\TestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    function test_isset()
    {
        // 通常の値
        $obj = new DtoImpl1(100);
        $this->assertSame(true, isset($obj->publicProp1));
        $this->assertSame(true, isset($obj['publicProp1']));
        $this->assertSame(true, $obj->genericIsset('publicProp1'));
        $this->assertSame(false, empty($obj->publicProp1));
        $this->assertSame(false, empty($obj['publicProp1']));
        // zero
        $obj = new DtoImpl1(0);
        $this->assertSame(true, isset($obj->publicProp1));
        $this->assertSame(true, isset($obj['publicProp1']));
        $this->assertSame(true, $obj->genericIsset('publicProp1'));
        $this->assertSame(true, empty($obj->publicProp1));
        $this->assertSame(true, empty($obj['publicProp1']));
        // 空文字
        $obj = new DtoImpl1('');
        $this->assertSame(true, isset($obj->publicProp1));
        $this->assertSame(true, isset($obj['publicProp1']));
        $this->assertSame(true, $obj->genericIsset('publicProp1'));
        $this->assertSame(true, empty($obj->publicProp1));
        $this->assertSame(true, empty($obj['publicProp1']));
        // null
        $obj = new DtoImpl1(null);
        $this->assertSame(false, isset($obj->publicProp1));
        $this->assertSame(true, isset($obj['publicProp1']));   // ArrayAccessの場合はnullでもtrueとなるのがPHPの仕様..なのだが...
        $this->assertSame(false, $obj->genericIsset('publicProp1'));
        $this->assertSame(true, empty($obj->publicProp1));
        $this->assertSame(true, empty($obj['publicProp1']));
        // 未定義
        $this->assertSame(false, isset($obj->undef));
        $this->assertSame(false, isset($obj['undef']));
        $this->assertSame(false, $obj->genericIsset('undef'));
        $this->assertSame(true, empty($obj->undef));
        $this->assertSame(true, empty($obj['undef']));
    }

    function test_offsetExists()
    {
        // 通常の値
        $obj = new DtoImpl1(100);
        $this->assertSame(false, empty($obj['publicProp1']));

        // null
        $obj = new DtoImpl1(null);
        $this->assertSame(true, empty($obj['publicProp1']));

        // 未定義
        $obj = new DtoImpl1(100);
        $this->assertSame(true, empty($obj['undef']));
    }

    function test_get()
    {
        // 通常
        $obj = new DtoImpl1(100);
        $this->assertSame(100, $obj->publicProp1);

        // null
        $obj = new DtoImpl1(null);
        $this->assertSame(null, $obj->publicProp1);

        // 未定義
        $e = null;
        try {
            $obj->undef;
        } catch (\Exception $e) {
        }
        $this->assertSame('InvalidArgumentException', get_class($e));
        $this->assertSame('The field "undef" does not exists.', $e->getMessage());

        // getter
        $obj = new DtoImpl1(100, 200);
        $this->assertSame(200, $obj->privateProp1);
    }

    function test_clone()
    {
        $obj1 = new DtoImpl1(100);
        $cloned1 = clone $obj1;
        $this->assertTrue($obj1 == $cloned1);
        $this->assertFalse($obj1 === $cloned1);

        $obj2 = new DtoImpl1(200);
        $obj2->publicProp1 = $obj1;
        $cloned2 = clone $obj2;
        $this->assertTrue($obj2 == $cloned2);
        $this->assertFalse($obj2 === $cloned2);
        $this->assertTrue($obj1 == $cloned2->publicProp1);
        $this->assertFalse($obj1 === $cloned2->publicProp1);
    }

    function test_sleep()
    {
        $obj = new DtoImpl1(100);
        $serialized = serialize($obj);
        $this->assertSame('O:17:"DtoStudy\DtoImpl1":1:{s:11:"publicProp1";i:100;}', $serialized);
    }

    function test_var_export()
    {
        $obj = new DtoImpl1(100);
        $str = var_export($obj, true);
        $ex = <<<EOF
DtoStudy\DtoImpl1::__set_state(array(
   'publicProp1' => 100,
   'privateProp1' => NULL,
))
EOF;
        $this->assertSame($ex, $str);
    }

    function test_offsetGet()
    {
        // 通常
        $obj = new DtoImpl1(100);
        $this->assertSame(100, $obj['publicProp1']);

        // null
        $obj = new DtoImpl1(null);
        $this->assertSame(null, $obj['publicProp1']);

        // 未定義
        $e = null;
        try {
            $obj['undef'];
        } catch (\Exception $e) {
        }
        $this->assertSame('InvalidArgumentException', get_class($e));
        $this->assertSame('The field "undef" does not exists.', $e->getMessage());
    }

    function test_set()
    {
        $obj = new DtoImpl1(100);

        // private with setter
        $obj->privateProp1 = 200;
        $this->assertSame(200, $obj->privateProp1);
        $this->assertSame(200, $obj['privateProp1']);

        $e = null;
        try {
            $obj->undef = 9999;
        } catch (\Exception $e) {
        }
        $this->assertSame('InvalidArgumentException', get_class($e));
        $this->assertSame('The field "undef" does not exists.', $e->getMessage());
    }

    function test_offsetSet()
    {
        $obj = new DtoImpl1(100);

        // public
        $obj['publicProp1'] = 101;
        $this->assertSame(101, $obj['publicProp1']);
        $this->assertSame(101, $obj->publicProp1);

        // private with setter
        $obj['privateProp1'] = 102;
        $this->assertSame(102, $obj['privateProp1']);
        $this->assertSame(102, $obj->privateProp1);

        $e = null;
        try {
            $obj['undef'] = 9999;
        } catch (\Exception $e) {
        }
        $this->assertSame('LogicException', get_class($e));
        $this->assertSame('The field "undef" could not set.', $e->getMessage());
    }

    function test_unset()
    {
        $obj = new DtoImpl1(100);

        $e = null;
        try {
            unset($obj->privateProp1);
        } catch (\Exception $e) {
        }
        $this->assertSame('LogicException', get_class($e));
        $this->assertSame('The field "privateProp1" could not unset.', $e->getMessage());

        $e = null;
        try {
            unset($obj->undef);
        } catch (\Exception $e) {
        }
        $this->assertSame('LogicException', get_class($e));
        $this->assertSame('The field "undef" could not unset.', $e->getMessage());
    }

    function test_offsetUnset()
    {
        $obj = new DtoImpl1(100);

        $e = null;
        try {
            unset($obj['publicProp1']);
        } catch (\Exception $e) {
        }
        $this->assertSame('LogicException', get_class($e));
        $this->assertSame('The field "publicProp1" could not unset.', $e->getMessage());

        $e = null;
        try {
            unset($obj['undef']);
        } catch (\Exception $e) {
        }
        $this->assertSame('LogicException', get_class($e));
        $this->assertSame('The field "undef" could not unset.', $e->getMessage());
    }

    function test_getIterator()
    {
        $obj = new DtoImpl1(100);
        $it = $obj->getIterator();

        $this->assertSame('publicProp1', $it->key());
        $this->assertSame(100, $it->current());
    }
}
