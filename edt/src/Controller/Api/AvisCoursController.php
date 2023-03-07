<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AvisCoursRepository;
use App\Repository\CoursRepository;
use App\Entity\Cours;

class AvisCoursController extends AbstractController
{
    #[Route('/api/cours/avis', name: 'list')]
    public function list(AvisCoursRepository $repository): JsonResponse
    {
        $avis = $repository->findAll();
        return $this->json($avis, Response::HTTP_OK);
    }

    #[Route('/api/cours/{id}/avis', name: 'list_avis', methods: ['GET'])]
    public function listAvis(?Cours $cours): JsonResponse
    {
        if (is_null($cours)) {
            return $this->json([
                'message' => "Ce cours n'existe pas",
            ], Response::HTTP_NOT_FOUND);
        }

        return $this->json($cours->getAvisCours()->toArray(), Response::HTTP_OK);
    }
}
