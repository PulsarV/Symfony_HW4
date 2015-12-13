<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Coach;
use AppBundle\Entity\Player;
use AppBundle\Entity\Team;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Country;
use Faker\Factory;

class FakerController extends Controller
{
    protected $countryNames = ['Albania', 'Austria', 'Belgium', 'Croatia', 'Czech Republic', 'England', 'France',
        'Germany', 'Hungary', 'Iceland', 'Ireland', 'Italy', 'Northern Ireland', 'Poland', 'Portugal', 'Romania',
        'Russia', 'Slovakia', 'Spain', 'Sweden', 'Switzerland', 'Turkey', 'Ukraine', 'Wales',
    ];

    /**
     * @Route("/generate", name="fakeEntityGenerator")
     * @Method("GET")
     */
    public function generateAction()
    {
        $faker = Factory::create();
        $em = $this->getDoctrine()->getManager();
        foreach ($this->countryNames as $countryName) {
            $country = new Country();
            $country->setName($countryName);
            $country->setFlag($countryName . '.png');
            $country->setDescription($faker->text(3000));

            $team = new Team();
            $team->setName($countryName);
            $team->setDescription($faker->text(3000));
            $team->setCountry($country);

            for ($i = 0; $i < 16; $i++) {
                $player = new Player();
                $player->setName($faker->name);
                $player->setDescription($faker->text(3000));
                $player->setTeam($team);
                $em->persist($player);
            }

            for ($i = 0; $i < 4; $i++) {
                $coach = new Coach();
                $coach->setName($faker->name);
                $coach->setDescription($faker->text(3000));
                $coach->setTeam($team);
                $em->persist($coach);
            }

            $em->persist($country);
            $em->persist($team);
        }
        $em->flush();
        return $this->redirectToRoute('homePage');
    }
}
