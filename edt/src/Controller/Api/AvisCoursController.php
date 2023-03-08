<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Repository\AvisCoursRepository;
use App\Repository\CoursRepository;
use App\Entity\Cours;
use App\Entity\AvisCours;

#[Route('/api/cours', name: 'api_cours_')]
class AvisCoursController extends AbstractController
{
    #[Route('/avis', name: 'list')]
    public function list(AvisCoursRepository $repository): JsonResponse
    {
        $avis = $repository->findAll();
        return $this->json($avis, Response::HTTP_OK);
    }

    #[Route('/{id}/avis', name: 'list_avis', methods: ['GET'])]
    public function listAvis(?Cours $cours): JsonResponse
    {
        if (is_null($cours)) {
            return $this->json([
                'message' => "Ce cours n'existe pas",
            ], Response::HTTP_NOT_FOUND);
        }

        return $this->json($cours->getAvisCours()->toArray(), Response::HTTP_OK);
    }

    #[Route('/{id}/avis', name: 'create_avis', methods: ['POST'])]
    public function createAvis(Request $request, ?Cours $cours, AvisCoursRepository $repository, ValidatorInterface $validator): JsonResponse
    {
        if (is_null($cours)) {
            return $this->json([
                'message' => 'Ce cours est introuvable',
            ], Response::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);

        if (is_null($data)) {
            return $this->json([
                'message' => 'Requête mal formattée',
            ], Response::HTTP_BAD_REQUEST);
        }

        $avis = (new AvisCours)
            ->fromArray($data)
            ->setCours($cours);

        $errors = $validator->validate($avis);

        if ($errors->count() > 0) {
            $messages = [];
            foreach ($errors as $error) {
                $messages[$error->getPropertyPath()] = $error->getMessage();
            }
            return $this->json($messages, Response::HTTP_BAD_REQUEST);
        }

        $repository->save($avis, true);

        return $this->json($avis, Response::HTTP_CREATED);
    }
}