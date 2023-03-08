<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Repository\EntreeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/entree', name: 'app_entree_')]
class EntreeController extends AbstractController
{
    #[Route('/', name: 'app_entree')]
    public function index(EntityManagerInterface $entityManager, EntreeRepository $entreeRepository): Response
    {
        $entrees = $entreeRepository->findAll();
        $categories = $entityManager->getRepository(Categorie::class)->findAll();
        return $this->render('entree/index.html.twig', compact('categories','entrees'));
    }

    #[Route('/{slug}', name: 'app_entree_show')]
    public function show(Categorie $categorie, EntreeRepository $entreeRepository): Response
    {
        $entrees = $entreeRepository->findBy(['categorie' => $categorie]);
        return $this->render('entree/show.html.twig', compact('entrees'));
    }
}
