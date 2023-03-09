<?php

namespace App\Controller;

use App\Entity\Plat;
use App\Entity\Drink;
use App\Entity\Entree;
use App\Entity\Dessert;
use App\Entity\Categorie;
use App\Repository\PlatRepository;
use App\Repository\WineRepository;
use App\Repository\DrinkRepository;
use App\Repository\EntreeRepository;
use App\Repository\DessertRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
    WineRepository $vinRepository
    ) : Response
    {
        $entrees = $entreeRepository->findAll();
        $plats = $platRepository->findAll();
        $desserts = $dessertRepository->findAll();
        $boissons = $boissonRepository->findAll();
        $vins = $vinRepository->findAll();
        $categories = $entityManager->getRepository(Categorie::class)->findAll();
        
        return $this->render('carte/index.html.twig', compact(
            'categories', 'entrees', 'plats', 'desserts', 'boissons', 'vins'));
    }

}
