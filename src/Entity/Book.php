<?php

namespace App\Entity;

use Talleu\RedisOm\Om\Mapping as RedisOm;


#[RedisOm\Entity]
class Book{

    #[RedisOm\Id]
    #[RedisOm\Property]
    public ?int $id = null;

    #[RedisOm\Property(index: true)]
    public string $title;

    #[RedisOm\Property(index: true)]
    public string $authorId;

    #[RedisOm\Property]
    public string $description;

    #[RedisOm\Property(index: true)]
    public bool $enabled;

    #[RedisOm\Property(index: true)]
    public string $categoryId;

    #[RedisOm\Property(index: true)]
    public float $price;

    #[RedisOm\Property(index: true)]
    public \DateTimeImmutable $publishedAt;

}
