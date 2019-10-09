<?php
declare(strict_types=1);

namespace DtoStudy\DataStructure\Dto02;

/**
 * DTOの基底
 *
 * 配列のようにアクセス可能になる。
 * フィールドはすべてpublicで定義すること。
 *
 * DtoInterface, \ArrayAccess の implement と、
 * DtoTrait の mixin のためだけに継承関係をつぶしてもよいものか悩んでいる。
 * とはいえ毎回書くのは面倒だしなぁ。
 */
abstract class DtoBase implements DtoInterface, \ArrayAccess
{
    use DtoTrait;
}
