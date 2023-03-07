<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EdtController extends AbstractController
{
    #[Route('/edt', name: 'index', methods: ['GET'])]
    public function index(): Response
    {
        return $this->render('base.html.twig');
    }
}
