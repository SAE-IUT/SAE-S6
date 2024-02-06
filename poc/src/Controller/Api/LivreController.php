<?php

namespace App\Controller\Api;

use App\Entity\Livre;
use App\Repository\CategorieRepository;
use App\Repository\LivreRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LivreController extends AbstractController
{
    #[Route('/api/livres', name: 'app_api_livre')]
    public function index(LivreRepository $livreRepository): JsonResponse
    {
        $livres = $livreRepository->findAll();
        // return $this->json($livres);
        return $this->json($livres, 200, [], ['groups' => 'livre:read']);
    }

    #[Route('/api/livre', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);

        $livre = new Livre();

        $livre->setTitre($data['titre']);
        $livre->setLangue($data['langue']);
        $livre->setPhotoCouverture($data['photoCouverture']);

        // $livre->setDateSortie($data['dateSortie']);
        if (isset($data['dateSortie'])) {
            $livre->setDateSortie(new \DateTime($data['dateSortie']));
        } else {
            $livre->setDateSortie(new \DateTime());
        }

        $entityManager->persist($livre);
        $entityManager->flush();

        // return $this->json($livre, JsonResponse::HTTP_CREATED);
        return $this->json($livre, JsonResponse::HTTP_CREATED, [], ['groups' => 'livre:read']);
    }
}
