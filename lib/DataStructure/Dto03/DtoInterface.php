<?php

namespace DtoStudy\DataStructure\Dto03;

interface DtoInterface
{

    /**
     * @param string $name
     * @return bool
     */
    public function genericIsset($name);

    /**
     * @param string $name
     * @return bool
     */
    public function __isset($name);

    /**
     * @param string $name
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function __get($name);

    /**
     * @return static
     */
    public function __clone();

    /**
     * for serialize()
     * @return array
     */
    public function __sleep();

    /**
     * ArrayAccess::offsetExists()
     * @param string $name
     * @return bool
     */
    public function offsetExists($name);

    /**
     * ArrayAccess::offsetGet()
     * @param string $name
     * @return mixed
     * @throws \InvalidArgumentException
     */
    public function offsetGet($name);

    /**
     * IteratorAggregate::getIterator();
     * @return \ArrayIterator
     */
    public function getIterator();
}
