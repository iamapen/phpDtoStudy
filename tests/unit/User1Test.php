<?php
declare(strict_types=1);

use DtoStudy\User1;

class User1Test extends \PHPUnit\Framework\TestCase
{
    function test_test()
    {
        $user = new User1();
        $user->firstName = 'アラレ';
        // __set()
        $user->lastName = '則巻';

        // property like.
        // public property についてはIDEでの補完が可能。
        $this->assertSame('アラレ', $user->firstName);
        $this->assertSame('則巻', $user->lastName, '__set()');
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
}
