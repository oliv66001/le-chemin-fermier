<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Repository\PlatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/plat', name: 'app_plat_')]
class PlatController extends AbstractController
{
    #[Route('/', name: 'app_plat')]
    public function index(EntityManagerInterface $entityManager, PlatRepository $platRepository): Response
    {
        $plats = $platRepository->findAll();
        $categories = $entityManager->getRepository(Categorie::class)->findAll();
        return $this->render('plat/index.html.twig', compact('categories','plats'));
    }
}
