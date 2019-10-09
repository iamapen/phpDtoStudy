<?php
declare(strict_types=1);

namespace DtoStudy;

use DtoStudy\DataStructure\Dto03\DtoBase;

/**
 * 02 + ファクトリメソッド
 *
 * o IDEで補完できる
 * o 存在しないkeyにアクセスするとエラー
 * - カプセル化はできない。入れ物としてとらえる。
 * o 配列表現からインスタンスを作れる
 */
class User3 extends DtoBase
{
    public $firstName;
    public $lastName;
    public $gender;
    public $age;
}
