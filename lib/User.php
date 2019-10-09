<?php
declare(strict_types=1);
namespace Dto01;

use Dto01\DataStructure\Dto\DtoBase;

class User extends DtoBase {
    public $firstName;
    public $lastName;
    public $gender;
    public $age;
}
