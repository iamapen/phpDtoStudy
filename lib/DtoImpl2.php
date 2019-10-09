<?php
declare(strict_types=1);
namespace Dto01;
use Dto01\DataStructure\Dto\DtoBase;

class DtoImpl2 extends DtoBase
{
    public $publicProp1;
    private $privateProp1;

    public function __construct($publicProp1, $privateProp1 = null)
    {
        $this->publicProp1 = $publicProp1;
        $this->privateProp1 = $privateProp1;
    }

    public function getPrivateProp1()
    {
        return $this->privateProp1;
    }

    public function setPrivateProp1($privateProp1)
    {
        $this->privateProp1 = $privateProp1;
    }
}
