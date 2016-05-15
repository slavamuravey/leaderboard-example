<?php

namespace AppBundle\Controller;

use AppBundle\Service\LeaderBoardRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        /** @var LeaderBoardRepository $leaderboard */
        $leaderboard = $this->get('leaderboard');

        print_r($leaderboard->findBy(['name' => 'Vasya Pupkin1', 'place' => 3]));
    }
}
