<?php
declare(strict_types=1);

namespace DtoStudy;

use DtoStudy\DataStructure\Dto01\DtoBase;

/**
 * public property もしくは private/proteced propert + accessor method
 *
 * o IDEで補完できる (public memberは)
 * o 存在しないkeyにアクセスするとエラー
 * o カプセル化もできる
 */
class User1 extends DtoBase
{
    public $firstName;
    private $lastName;
    public $gender;
    public $age;

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }
}
