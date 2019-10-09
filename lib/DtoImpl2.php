<?php
declare(strict_types=1);
namespace DtoStudy;
use DtoStudy\DataStructure\Dto02\DtoBase;

class DtoImpl2 extends DtoBase
{
    public $publicProp1;

    public function __construct($publicProp1)
    {
        $this->publicProp1 = $publicProp1;
    }
}
