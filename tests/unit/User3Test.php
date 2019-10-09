<?php
declare(strict_types=1);

use DtoStudy\User3;

class User3Test extends \PHPUnit\Framework\TestCase
{
    function test_test()
    {
        $user = User3::newInstance();
        $user->firstName = 'アラレ';
        $user->lastName = '則巻';

        // property like.
        // すべてIDEで補完可能。
        $this->assertSame('アラレ', $user->firstName);
        $this->assertSame('則巻', $user->lastName);
        $this->assertSame(null, $user->age);
        // array like(ArrayAccess)
        $this->assertSame('アラレ', $user['firstName']);
        $this->assertSame('則巻', $user['lastName']);
        $this->assertSame(null, $user['age']);

        $e = null;
        try {
            $user->undef;
        } catch (\Exception $e) {
        }
        $this->assertSame('InvalidArgumentException', get_class($e));

        $e = null;
        try {
            $user->undef = 'hoge';
        } catch (\Exception $e) {
        }
        $this->assertSame('InvalidArgumentException', get_class($e));
    }

    function test_construct()
    {
        $user = User3::newInstance(['firstName' => 'アラレ', 'lastName' => '則巻']);
        $this->assertSame('アラレ', $user->firstName);
        $this->assertSame('則巻', $user->lastName);
        $this->assertSame(null, $user->age);
    }

    function test_construct_未定義キーがある()
    {
        $e = null;
        try {
            $user = User3::newInstance(['firstName' => 'アラレ', 'lastName' => '則巻', 'undef' => 'xxx']);
        } catch (\Exception $e) {
        }
        $this->assertSame('InvalidArgumentException', get_class($e));
    }

    function test_createByWeakArray_未定義キーは無視される()
    {
        $user = User3::createByWeakArray(['firstName' => 'アラレ', 'lastName' => '則巻', 'undef' => 'xxx']);
        $this->assertSame('アラレ', $user->firstName);
        $this->assertSame('則巻', $user->lastName);
        $this->assertSame(null, $user->age);
    }
}
