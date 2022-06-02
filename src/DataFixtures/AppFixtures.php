<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Category;
use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        //création d'une variable qui va contenir
        $faker = Faker\Factory::create('fr_FR');
            //Tableau vide qui va stocker les utilisateurs que l’on génère
            $users = [];
            //Boucle qui va itérer 50 utilisateurs factices
                for($i=0; $i<50; $i++){
                $user = new User();
                //génération d'un utilisateur factice
                $user->setName($faker->name());
                $user->setFirstName($faker->firstname());
                $user->setMail($faker->email());
                $user->setPassword($faker->password());
                $user->setCreatedAt(new \DateTimeImmutable());
                //stockage dans le manager
                $manager->persist($user);
                $users[] = $user;
                }
             //Boucle qui va itérer 50 catégorie factices
             $cats = [];
             for($i=0; $i<50; $i++){
                 $cat = new Category();
                 //génération d'un utilisateur factice
                //  $cat->setArticle(null);
                 $cat->setTitle($faker->text(50));
                 $cat->setDescription($faker->text(200));
                 $cat->setImage($faker->imageUrl(640, 480, 'animals', true));
                 $cat->setCreatedAt(new \DateTimeImmutable());
                 //stockage dans le manager
                 $manager->persist($cat);
                 $cats[] = $cat;
                 }
                //Boucle qui va itérer 100 articles factices
            $arts = [];
            for($i=0; $i<200; $i++){
                $art = new Article();
                //génération d'un utilisateur factice
                $art->setTitle($faker->text(100));
                $art->setImage($faker->imageUrl(640, 480, 'animals', true));
                $art->setContenu($faker->text(50));
                $art->setCreatedAt(new \DateTimeImmutable());
                $art->setUpdatedAt(new \DateTimeImmutable());
                $art->setWriteBy($users[$faker->numberBetween(0, 49)]);
                $art->addCategory($cats[rand(0, 49)]);
                //stockage dans le manager
                $manager->persist($art);
                $arts[] = $art;
                }
                $manager->flush();
    }
}
