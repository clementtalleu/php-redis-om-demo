<?php

namespace App\Command;

use App\Entity\Book;
use App\Entity\User;
use App\Entity\Category;
use Talleu\RedisOm\Om\RedisObjectManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(name: 'app:fixtures:load', description: 'Remplit Redis avec des données de test')]
class FillRedisCommand extends Command
{
    public function __construct(private RedisObjectManagerInterface $om)
    {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        // 1. Créer des Catégories
        $categories = [];
        $catNom = ['Science-Fiction', 'Développement Web', 'Philosophie'];
        foreach ($catNom as $title) {
            $cat = new Category();
            $cat->category = $title;
            $this->om->persist($cat);
            $categories[] = $cat;
        }
        $this->om->flush();

        // 2. Créer des Utilisateurs
        $users = [];
        $names = ['Alice', 'Bob', 'Charlie'];
        foreach ($names as $name) {
            $user = new User();
            $user->name = $name;
            $user->email = strtolower($name) . "@example.com";
            $user->age = rand(20, 50);
            $this->om->persist($user);
            $users[] = $user;
        }
        $this->om->flush();


        // 3. Créer des Livres
        $bookData = [
            ['Symfony & Redis', 'Un guide complet', 29.99],
            ['Le Robot de l\'Aube', 'Chef d\'oeuvre de l\'asimov', 15.50],
            ['Ainsi parlait Zarathoustra', 'Classique', 12.00],
        ];

        foreach ($bookData as $index => $data   ) {
            $book = new Book();
            $book->title = $data[0];
            $book->description = $data[1];
            $book->price = $data[2];
            $book->enabled = true;
            $book->publishedAt = new \DateTimeImmutable();

            // "Relations" manuelles via les IDs
            //$book->author = $users[array_rand($users)];
            //$book->category = $categories[array_rand($categories)];

            $randomUser = $users[array_rand($users)];
            $book->authorId = $randomUser->id;

            $randomCat = $categories[array_rand($categories)];
            $book->categoryId = $randomCat->id;

            $this->om->persist($book);
        }

        $this->om->flush();

        $io->success('Données insérées dans Redis avec succès !');

        return Command::SUCCESS;
    }
}
