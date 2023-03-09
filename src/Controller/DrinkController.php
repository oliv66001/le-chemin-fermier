<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Repository\DrinkRepository;
use App\Repository\WineRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/boisson', name: 'app_drink_')]
class DrinkController extends AbstractController
{
    #[Route('/', name: 'app_drink')]
    public function index(EntityManagerInterface $entityManager, DrinkRepository $drinkRepository): Response
    {
        $drinks = $drinkRepository->findAll();
        $categories = $entityManager->getRepository(Categorie::class)->findAll();
        return $this->render('drink/index.html.twig', compact('categories','drinks'));
    }

    #[Route('/{slug}', name: 'app_drink_show')]
    public function show(Categorie $categorie, DrinkRepository $drinkRepository): Response
    {
        $drinks = $drinkRepository->findBy(['categorie' => $categorie]);
        return $this->render('drink/show.html.twig', compact('drinks'));
    }
}
