<?php
declare(strict_types=1);

namespace DtoStudy;

use DtoStudy\DataStructure\Dto02\DtoBase;

/**
 * public propertyの定義のみのシンプル案
 *
 * Simple is best.
 * o IDEで補完できる
 * o 存在しないkeyにアクセスするとエラー
 * - カプセル化はできない。入れ物としてとらえる。
 */
class User2 extends DtoBase
{
    public $firstName;
    public $lastName;
    public $gender;
    public $age;
}
