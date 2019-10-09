<?php
declare(strict_types=1);

class UserTest extends \PHPUnit\Framework\TestCase
{
    function test_test() {
        $user = new \Dto01\User();
        $user->firstName = 'アラレ';
        $user->lastName = '則巻';

        // publicプロパティアクセス。IDEでの補完が可能。
        $this->assertSame('アラレ', $user->firstName);
        $this->assertSame('則巻', $user->lastName);
        $this->assertSame(null, $user->age);
        // ArrayAccess
        $this->assertSame('アラレ', $user['firstName']);
        $this->assertSame('則巻', $user['lastName']);
        $this->assertSame(null, $user['age']);

        // これをエラーにできないんだよね。。
        // 定義されちゃうから __get() / __set() に来ない。
        $e = null;
        try {
            $this->undef;
        } catch(\Exception $e) {
        }
        $this->assertSame('PHPUnit\Framework\Error\Notice', get_class($e));
    }
}