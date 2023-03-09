<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Repository\WineRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/vin', name: 'app_wine_')]
class WineController extends AbstractController
{
    #[Route('/', name: 'app_wine')]
    public function index2(EntityManagerInterface $entityManager, WineRepository $wineRepository): Response
    {
        $wines = $wineRepository->findAll();
        $categories = $entityManager->getRepository(Categorie::class)->findAll();
        return $this->render('wine/index.html.twig', compact('categories','wines'));
    }

    #[Route('/{slug}', name: 'app_wine_show')]
    public function show2(Categorie $categorie, WineRepository $wineRepository): Response
    {
        $wines = $wineRepository->findBy(['categorie' => $categorie]);
        return $this->render('wine/show.html.twig', compact('wines'));
    }
}
