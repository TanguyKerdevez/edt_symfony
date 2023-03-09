<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CoursRepository;
use App\Entity\Cours;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Persistence\ManagerRegistry;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Repository\ProfesseurRepository;
use App\Repository\AvisRepository;
use App\Entity\Professeur;
use App\Entity\Avis;


#[Route('/api/cours', name: 'api_cours_')]
class CoursController extends AbstractController
{
    #[Route('', name: 'list', methods: ['GET'])]
    public function list(CoursRepository $repository): JsonResponse
    {
        $cours = $repository->findAll();
        return $this->json($cours, Response::HTTP_OK);
    }

    #[Route('/day/{day}', name: 'list_for_day', methods: ['GET'])]
    public function listForDay(CoursRepository $repository,EntityManagerInterface $entityManager, string $day): JsonResponse
    {
        $exp = "(\d{4}\-\d{2}-\d{2})";
        if (preg_match($exp, $day) == 0)
            return $this->json(['message' => 'La date est au mauvais format, elle doit respecter le format: yyyy-mm-dd'], Response::HTTP_BAD_REQUEST);

        $startDate = \DateTime::createFromFormat('Y-m-d', $day)->setTime(0,0,0,0);
        $endDate = \DateTime::createFromFormat('Y-m-d', $day)->setTime(0,0,0,0);

        $endDate->modify('+1 day');
        $query = $entityManager->createQuery(
            'SELECT c
            FROM App\Entity\Cours c
            WHERE c.date_heure_debut > :startDate AND c.date_heure_debut < :endDate'
        )->setParameter('startDate', $startDate)->setParameter('endDate', $endDate);

        $cours = $query->getResult();
        
        return $this->json($cours, Response::HTTP_OK);
    }

    #[Route('/createCours', name: 'create_cours', methods: ['POST'])]
    public function createCours(  Request $request, ?Cours $cours , ValidatorInterface $validator   ): JsonResponse {

        if(is_null( $cours)){
            return $this->json([
                'message' => ' Le cours est vide ',
            ], Response::HTTP_NOT_FOUND);
        }

        $data = json_decode($request->getContent(), true);

        if (is_null($data)) {
            return $this->json([
                'message' => 'Requête mal formattée',
            ], Response::HTTP_BAD_REQUEST);
        }

        $cours = (new Cours) ->fromArray($data);


        $errors = $validator->validate($cours); 

        if ($errors->count() > 0) {
            $messages = [];
            foreach ($errors as $error) {
                $messages[$error->getPropertyPath()] = $error->getMessage();
            }
            return $this->json($messages, Response::HTTP_BAD_REQUEST);
        }


        return null; 
    }

}
