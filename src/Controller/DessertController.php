<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Repository\DessertRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/dessert', name: 'app_dessert_')]
class DessertController extends AbstractController
{
    #[Route('/', name: 'app_dessert')]
    public function index(EntityManagerInterface $entityManager, DessertRepository $dessertRepository): Response
    {
        $desserts = $dessertRepository->findAll();
        $categories = $entityManager->getRepository(Categorie::class)->findAll();
        return $this->render('dessert/index.html.twig', compact('categories','desserts'));
    }

    #[Route('/{slug}', name: 'app_dessert_show')]
    public function show(Categorie $categorie, DessertRepository $dessertRepository): Response
    {
        $desserts = $dessertRepository->findBy(['categorie' => $categorie]);
        return $this->render('dessert/show.html.twig', compact('desserts'));
    }
}
