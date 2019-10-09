<?php
declare(strict_types=1);

namespace DtoStudy\DataStructure\Dto03;

/**
 * DTOの基底
 *
 * フィールドはすべてpublicで定義すること。
 *
 * o IDEで補完できる
 * o 存在しないkeyにアクセスするとエラー
 * - カプセル化はできない。入れ物としてとらえる。
 * o 配列表現からインスタンスを作れる
 * o 配列のようにアクセスできる(ArrayAccess)
 */
abstract class DtoBase implements DtoInterface, \ArrayAccess
{
    use DtoTrait;

    private function __construct()
    {
    }

    /**
     * 配列からインスタンスを作成して返す。不正keyはエラー。
     * @param array $spec
     * @return static
     */
    public static function newInstance(array $spec = [])
    {
        $instance = new static();
        foreach ($spec as $name => $val) {
            $instance->{$name} = $val;
        }
        return $instance;
    }

    /**
     * 配列からインスタンスを作成して返す。不正keyは無視。
     * @param array $spec
     * @return static
     */
    public static function createByWeakArray(array $spec = [])
    {
        $instance = new static();
        foreach ($spec as $name => $val) {
            if (!property_exists($instance, $name)) {
                continue;
            }
            $instance->{$name} = $val;
        }
        return $instance;
    }
}
