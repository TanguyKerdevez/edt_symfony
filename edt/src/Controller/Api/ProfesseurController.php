<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Repository\ProfesseurRepository;
use App\Repository\AvisRepository;
use App\Entity\Professeur;
use App\Entity\Avis;

#[Route('/api/professeurs', name: 'api_professeurs_')]
class ProfesseurController extends AbstractController
{
    #[Route('', name: 'list', methods: ['GET'])]
    public function list(ProfesseurRepository $repository): JsonResponse
    {
        $professeurs = $repository->findAll();

        /*$profArray = [];
        foreach ($professeurs as $professeur) {
            $profArray[] = $professeur->toArray();
        }*/

        /*$json = json_encode(array_map(fn ($professeur) => $professeur->toArray(), $professeurs));

        $response = new Response();
        $response->setContent($json);
        $response->setStatusCode(Response::HTTP_OK);
        $response->headers->set('Content-Type', 'application/json');

        return $response;*/

        // return $this->json(array_map(fn ($professeur) => $professeur->toArray(), $professeurs));
        
        return $this->json($professeurs, Response::HTTP_OK);
    }

    #[Route('/{id}', name: 'show', methods: ['GET'])]
    public function show(?Professeur $professeur): JsonResponse
    {
        if (is_null($professeur)) {
            return $this->json([
                'message' => 'Ce professeur est introuvable',
            ], Response::HTTP_NOT_FOUND);
        }

        return $this->json($professeur, Response::HTTP_OK);
    }

    #[Route('/{id}/avis', name: 'list_avis', methods: ['GET'])]
    public function listAvis(?Professeur $professeur): JsonResponse
    {
        if (is_null($professeur)) {
            return $this->json([
                'message' => 'Ce professeur est introuvable',
            ], Response::HTTP_NOT_FOUND);
        }

        return $this->json($professeur->getAvis()->toArray(), Response::HTTP_OK);
    }

    #[Route('/{id}/avis', name: 'create_avis', methods: ['POST'])]
    public function createAvis(Request $request, ?Professeur $professeur, AvisRepository $repository, ValidatorInterface $validator): JsonResponse
    {
        if (is_null($professeur)) {
            return $this->json([
                'message' => 'Ce professeur est introuvable',
            ], Response::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);

        if (is_null($data)) {
            return $this->json([
                'message' => 'Requête mal formattée',
            ], Response::HTTP_BAD_REQUEST);
        }

        $avis = (new Avis)
            ->fromArray($data)
            ->setProfesseur($professeur);

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
