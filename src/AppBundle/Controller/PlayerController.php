<?php

namespace AppBundle\Controller;

use Doctrine\Common\Collections\Criteria;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PlayerController extends Controller
{
    /**
     * @Route("/player/view/{teamName}/{playerName}", requirements={"teamName": "[-A-Za-z\x20\.\']+", "playerName": "[-A-Za-z\x20\.\']+"}, name="playerView")
     * @Method("GET")
     * @Template()
     */
    public function viewAction($teamName, $playerName)
    {
        $em = $this->getDoctrine()->getManager();
        $players = $em->getRepository('AppBundle:Team')->findOneBy(['name' => $teamName])->getPlayers();
        $criteria = Criteria::create()->where(Criteria::expr()->eq("name", $playerName));
        $player = $players->matching($criteria)[0];
        return ['player' => $player];
    }

    /**
     * @Route("/player/view/{teamName}", requirements={"teamName": "[-A-Za-z\x20\.\']+"}, name="playerIndex")
     * @Method("GET")
     * @Template()
     */
    public function indexAction($teamName)
    {
        $em = $this->getDoctrine()->getManager();
        $players = $em->getRepository('AppBundle:Team')->findOneBy(['name' => $teamName])->getPlayers()->getValues();
        return ['players' => $players];
    }

}
