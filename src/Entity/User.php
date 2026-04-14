<?php
namespace App\Entity;

use Symfony\Component\Validator\Constraints\Date;
use Talleu\RedisOm\Om\Mapping as RedisOm;

#[RedisOm\Entity]
class User{

    #[RedisOm\Id]
    #[RedisOm\Property]
    public int $id;

    #[RedisOm\Property]
    public string $name;

    #[RedisOm\Property]
    public string $email;

    #[RedisOm\Property]
    public int $age;

    #[RedisOm\Property]
    public Date $createdAt;

}
