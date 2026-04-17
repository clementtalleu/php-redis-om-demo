<?php

namespace App\Entity;

use Talleu\RedisOm\Om\Mapping as RedisOm;

#[RedisOm\Entity]
class Category
{
    #[RedisOm\Id]
    #[RedisOm\Property(index: true)]
    public ?int $id = null;

    #[RedisOm\Property]
    public string $category;
}
