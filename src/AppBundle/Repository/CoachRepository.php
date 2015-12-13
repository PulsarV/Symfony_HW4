<?php

namespace AppBundle\Repository;

/**
 * CoachRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CoachRepository extends \Doctrine\ORM\EntityRepository
{
    public function findCoachByTeam($team, $coach)
    {
        $dql = "SELECT c, t FROM AppBundle:Coach c JOIN c.team t WHERE c.name = :coach AND t.name = :team";
        return $this->getEntityManager()->createQuery($dql)->setParameter('coach', $coach)->setParameter('team', $team)->getOneOrNullResult();
    }

    public function findAllCoachsByTeam($team)
    {
        $dql = "SELECT c, t FROM AppBundle:Coach c JOIN c.team t WHERE t.name = :team ORDER BY c.name ASC";
        return $this->getEntityManager()->createQuery($dql)->setParameter('team', $team)->getResult();
    }
}