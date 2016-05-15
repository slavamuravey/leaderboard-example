<?php

namespace AppBundle\Controller;

use Slavamuravey\LeaderBoardBundle\Service\LeaderBoardRepository;
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

        $leaders = $leaderboard->findBy(['name' => 'Vasya Pupkin1', 'place' => 3]);

        return $this->render('default/index.html.twig', array(
            'leaders' => $leaders,
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir').'/..'),
        ));
    }
}
