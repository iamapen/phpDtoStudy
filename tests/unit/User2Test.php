<?php
declare(strict_types=1);

use DtoStudy\User2;

class User2Test extends \PHPUnit\Framework\TestCase
{
    function test_test()
    {
        $user = new User2();
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
}
