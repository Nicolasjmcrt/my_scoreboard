<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PlayerContestController extends AbstractController
{
    #[Route('/player/contest', name: 'app_player_contest')]
    public function index(): Response
    {
        return $this->render('player_contest/index.html.twig', [
            'controller_name' => 'PlayerContestController',
        ]);
    }
}
