<?php

namespace PressPlay\CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;

class TimeSheetRepository extends EntityRepository
{
    public function findOneTimeSheetByDateAndUser($date, $user){
        $query = $this->getEntityManager()
                ->createQuery('
                SELECT t FROM PressPlayCoreBundle:TimeSheet t
                JOIN t.user u
                WHERE t.date = :date
                AND u.id = :id
                ')
                ->setParameter('id', $user->getId() )
                ->setParameter('date', $date->format('Y-m-d'));
        try {
            return $query->getSingleResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }        
        
    }
}