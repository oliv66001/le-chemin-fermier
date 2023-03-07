<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Dessert;
use App\Entity\Drink;
use App\Entity\Entree;
use App\Entity\Plat;
use App\Repository\DessertRepository;
use App\Repository\DrinkRepository;
use App\Repository\EntreeRepository;
use App\Repository\PlatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/carte', name: 'app_carte_')]
class CarteController extends AbstractController
{
    #[Route('/', name: 'app_carte')]

 
    public function index(
    EntityManagerInterface $entityManager,
    EntreeRepository $entreeRepository,
    PlatRepository $platRepository,
    DessertRepository $dessertRepository,
    DrinkRepository $boissonRepository,
    ) : Response
    {
        $entrees = $entreeRepository->findAll();
        $plats = $platRepository->findAll();
        $desserts = $dessertRepository->findAll();
        $boissons = $boissonRepository->findAll();
        $categories = $entityManager->getRepository(Categorie::class)->findAll();
        
        return $this->render('carte/index.html.twig', compact(
            'categories', 'entrees', 'plats', 'desserts', 'boissons'));
    }

}
