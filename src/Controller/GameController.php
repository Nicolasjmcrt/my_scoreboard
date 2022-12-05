<?php

namespace App\Controller;

use App\Repository\ContestRepository;
use App\Repository\GameRepository;
use App\Repository\PlayerContestRepository;
use App\Repository\PlayerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GameController extends AbstractController
{
    #[Route('/game', name: 'app_game', methods: ['GET'])]
    public function index(GameRepository $gameRepository, PlayerRepository $playerRepository, ContestRepository $contestRepository, PlayerContestRepository $playerContestRepository): Response
    {
        $games = $gameRepository->findAll();
        $players = $playerRepository->findAll();
        $contests = $contestRepository->findAll();
        $playerContests = $playerContestRepository->findAll();
        return $this->render('game/index.html.twig', [
            'games' => $games,
            'players' => $players,
            'contests' => $contests,
            'playerContests' => $playerContests,
        ]);
    }
}
