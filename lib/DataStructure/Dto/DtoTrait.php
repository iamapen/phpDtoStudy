<?php

namespace Dto01\DataStructure\Dto;

/**
 * DTOの基礎部分の実装
 * @see DtoInterface
 */
trait DtoTrait
{

    /**
     * @param $name
     * @return bool
     */
    public function __isset($name)
    {
        return property_exists($this, $name);
    }

    /**
     * フィールドが存在、かつnullでない場合にtrueを返す
     *
     * isset(ArrayAccess[key]) が null の場合でも true となってしまう問題の解決策。
     * これは由々しき問題。。
     * @param string $name
     * @return bool
     */
    public function genericIsset($name)
    {
        $fields = get_object_vars($this);
        return array_key_exists($name, $fields) && !is_null($fields[$name]);
    }

    /**
     * @param string $name
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function __get($name)
    {
        if (method_exists($this, 'get' . $name)) {
            return $this->{'get' . $name}();
        }
        if (!property_exists($this, $name)) {
            throw new \InvalidArgumentException(
                sprintf('The field "%s" does not exists.', $name)
            );
        }
        return $this->{$name};
    }

    public function __clone()
    {
        $fields = get_object_vars($this);
        foreach ($fields as $name => $value) {
            if (is_object($value)) {
                $this->{$name} = clone $value;
            }
        }
    }

    public function __sleep()
    {
        return array_keys(get_object_vars($this));
    }

    /**
     * ArrayAccess::offsetExists() implements
     * @param string $name
     * @return bool
     */
    public function offsetExists($name)
    {
        $fields = get_object_vars($this);
        return array_key_exists($name, $fields);
    }

    /**
     * ArrayAccess::offsetGet() implements
     * @param string $name
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function offsetGet($name)
    {
        return $this->__get($name);
    }

    /**
     * IteratorAggregator::getIterator() implements
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator(get_object_vars($this));
    }

    /**
     * @param string $name
     * @param mixed $value
     * @throws \LogicException
     */
    final public function __set($name, $value)
    {
        if (method_exists($this, 'set' . $name)) {
            $this->{'set' . $name}($value);
        }
        if (!property_exists($this, $name)) {
            throw new \InvalidArgumentException(
                sprintf('The field "%s" does not exists.', $name)
            );
        }
    }

    /**
     * @param string $name
     * @throws \LogicException
     */
    final public function __unset($name)
    {
        throw new \LogicException(
            sprintf('The field "%s" could not unset.', $name)
        );
    }

    /**
     * ArrayAccess::offsetSet() implements
     * @param $name
     * @param $value
     * @throws \LogicException
     */
    public function offsetSet($name, $value)
    {
        if (method_exists($this, 'set' . $name)) {
            $this->{'set' . $name}($value);
            return;
        }
        if ($this->offsetExists($name)) {
            $this->$name = $value;
            return;
        }
        throw new \LogicException(
            sprintf('The field "%s" could not set.', $name)
        );
    }

    /**
     * ArrayAccess::offsetUnset() implements
     * @param string $name
     * @throws \LogicException
     */
    public function offsetUnset($name)
    {
        throw new \LogicException(
            sprintf('The field "%s" could not unset.', $name)
        );
    }
}
