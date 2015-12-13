<?php

namespace AppBundle\Controller;

use Doctrine\Common\Collections\Criteria;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CoachController extends Controller
{
    /**
     * @Route("/coach/view/{teamName}/{coachName}", requirements={"teamName": "[-A-Za-z\x20\.\']+", "coachName": "[-A-Za-z\x20\.\']+"}, name="coachView")
     * @Method("GET")
     * @Template()
     */
    public function viewAction($teamName, $coachName)
    {
        $em = $this->getDoctrine()->getManager();
        $coachs = $em->getRepository('AppBundle:Team')->findOneBy(['name' => $teamName])->getCoachs();
        $criteria = Criteria::create()->where(Criteria::expr()->eq("name", $coachName));
        $coach = $coachs->matching($criteria)[0];
        return ['coach' => $coach];
    }

    /**
     * @Route("/coach/view/{teamName}", requirements={"teamName": "[-A-Za-z\x20\.\']+"}, name="coachIndex")
     * @Method("GET")
     * @Template()
     */
    public function indexAction($teamName)
    {
        $em = $this->getDoctrine()->getManager();
        $coachs = $em->getRepository('AppBundle:Team')->findOneBy(['name' => $teamName])->getCoachs()->getValues();
        return ['coachs' => $coachs];
    }
}
