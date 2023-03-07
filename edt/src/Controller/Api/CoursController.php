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

#[Route('/api/cours', name: 'api_cours_')]
class CoursController extends AbstractController
{
    #[Route('', name: 'list', methods: ['GET'])]
    public function list(CoursRepository $repository): JsonResponse
    {
        $cours = $repository->findAll();
        return $this->json($cours, Response::HTTP_OK);
    }

    #[Route('/{day}', name: 'list_for_day', methods: ['GET'])]
    public function listForDay(CoursRepository $repository,EntityManagerInterface $entityManager, string $day): JsonResponse
    {
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

}
