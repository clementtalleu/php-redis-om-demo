<?php

namespace App\Command;

use App\Entity\Book;
use App\Entity\User;
use App\Entity\Category;
use App\Entity\Comment; // Ne pas oublier l'import !
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

        // Création d'une catégorie
        $category = new Category();
        $category->category='Science-Fiction';
        $this->om->persist($category);

        // Création d'un utilisateur (Auteur)
        $user = new User();
        $user->name='Isaac Asimov';
        $user->email='isaac@example.com';
        $user->age=72;
        $user->createdAt=new \DateTimeImmutable();
        $this->om->persist($user);

        // Création d'un second utilisateur (Lecteur)
        $reader = new User();
        $reader->name='Jean Dupont';
        $reader->email='jean@example.com';
        $reader->age=30;
        $reader->createdAt=new \DateTimeImmutable();
        $this->om->persist($reader);

        // Création du livre
        $book = new Book();
        $book->title='Fondation';
        $book->author=$user;
        $book->category=$category;
        $book->enabled=true;
        $book->description='Un chef-d\'œuvre de la SF sur la chute d\'un empire galactique.';
        $book->price=19.99;
        $book->publishedAt=new \DateTimeImmutable('1951-06-01');
        $this->om->persist($book);

        // Création d'un commentaire
        $comment = new Comment();
        $comment->author=($reader);
        $comment->book=($book);
        $comment->content=('Incroyable vision du futur, à lire absolument !');
        $comment->createdAt=(new \DateTimeImmutable());
        $this->om->persist($comment);

        // Envoi final vers Redis
        $this->om->flush();

        $io->success('Les données de test ont été chargées dans Redis !');

        return Command::SUCCESS;
    }
}
