<?php

namespace App\DataFixtures;

use App\Entity\Book;
use App\Entity\Category;
use App\Entity\User;
use Talleu\RedisOm\Om\RedisObjectManagerInterface;

class AppFixtures
{
    public function __construct(private RedisObjectManagerInterface $objectManager) {
        $this->objectManager->getRedisClient()->createPersistentConnection();
    }

    public function createSampleData()
    {
        $author = new User();
        $author->name="Victor Hugo";
        $author->email="victor@hugo.fr";
        $author->age=50;

        $category = new Category();
        $category->category="Classique";

        $book = new Book();
        $book->title="Les Misérables";
        $book->author=$author;
        $book->enabled=true;
        $book->category=$category;
        $book->price=19.99;
        $book->publishedAt=(new \DateTimeImmutable('1862-01-01'));

        // 3. Persistance
        $this->objectManager->persist($author);
        $this->objectManager->persist($book);

        // Envoi vers Redis
        $this->objectManager->flush();
    }
}
