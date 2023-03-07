<?php

namespace App\DataFixtures;


use App\Entity\Categorie;
use App\Entity\Dessert;
use App\Entity\Drink;
use App\Entity\Entree;
use App\Entity\Plat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;
use Faker;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

class CategorieFixtures extends Fixture
{
    public function __construct(private SluggerInterface $slugger)
    {
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        $categorieIds = [
            1 => "Entrées",
            2 => "Plats",
            3 => "Desserts",
            4 => "Boissons",
        ];

        foreach ($categorieIds as $id => $name) {
            $categorie = (new Categorie())
                ->setName($name)
                ->setImageUrl($faker->imageUrl(640, 480, 'food'))
                ->setSlug($this->slugger->slug($name));
            
            $manager->persist($categorie);
            $manager->flush();
            
            // Maintenant que l'entité Categorie est persistée et sauvegardée en base de données,
            // nous pouvons l'utiliser pour créer des desserts qui y seront associés.
            if ($id === 3) { // on ne crée des desserts que pour la catégorie "Desserts"
                $this->createDesserts($manager, $categorie, $faker);
            } elseif ($id === 4) { // on ne crée des desserts que pour la catégorie "Desserts"
                $this->createDrinks($manager, $categorie, $faker);
            } elseif ($id === 1) { // on ne crée des desserts que pour la catégorie "Desserts"
                $this->createEntrees($manager, $categorie, $faker);
            } elseif ($id === 2) { // on ne crée des desserts que pour la catégorie "Desserts"
                $this->createPlats($manager, $categorie, $faker);
            }
        }
    }

    private function createEntrees(ObjectManager $manager, Categorie $categorie, Faker\Generator $faker)
    {
        for ($i = 0; $i < 3; $i++) {
            $entree = (new Entree())
                ->setName($faker->sentence(3))
                ->setDescription($faker->paragraph())
                ->setPrice($faker->randomFloat(2, 4, 10))
                ->setSlug($this->slugger->slug(Autowire::class))
                ->setCategorie($categorie);
            
            $manager->persist($entree);
        }

        $manager->flush();
    }

    private function createPlats(ObjectManager $manager, Categorie $categorie, Faker\Generator $faker)
    {
        for ($i = 0; $i < 3; $i++) {
            $plat = (new Plat())
                ->setName($faker->sentence(3))
                ->setDescription($faker->paragraph())
                ->setPrice($faker->randomFloat(2, 4, 10))
                ->setSlug($this->slugger->slug(Autowire::class))
                ->setCategorie($categorie);
            
            $manager->persist($plat);
        }

        $manager->flush();
    }

    private function createDesserts(ObjectManager $manager, Categorie $categorie, Faker\Generator $faker)
    {
        for ($i = 0; $i < 3; $i++) {
            $dessert = (new Dessert())
                ->setName($faker->sentence(3))
                ->setDescription($faker->paragraph())
                ->setPrice($faker->randomFloat(2, 4, 10))
                ->setSlug($this->slugger->slug(Autowire::class))
                ->setCategorie($categorie);
            
            $manager->persist($dessert);
        } 
        $manager->flush();
    }
    private function createDrinks(ObjectManager $manager, Categorie $categorie, Faker\Generator $faker)
    {
        for ($i = 0; $i < 10; $i++) {
            $drink = (new Drink())
                ->setName($faker->sentence(3))
                ->setDescription($faker->paragraph())
                ->setPrice($faker->randomFloat(2, 4, 10))
                ->setSlug($this->slugger->slug(Autowire::class))
                ->setCategorie($categorie);
            
            $manager->persist($drink);
        }

        $manager->flush();
    }

}
