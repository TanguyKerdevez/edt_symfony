<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\SalleRepository;

#[Route('/api/salles', name: 'api_salles_')]
class SalleController extends AbstractController
{
    #[Route('', name: 'list', methods: ['GET'])]
    public function list(SalleRepository $repository): JsonResponse
    {
        $salles = $repository->findAll();
        return $this->json($salles, Response::HTTP_OK);
    }
}
