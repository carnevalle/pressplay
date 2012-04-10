<?php

namespace PressPlay\CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;

class WorkMonthEmployeeRepository extends EntityRepository
{

    public function findByDateAndUser($date, $user){
        // We make sure dates are first of the month
        $date = new \DateTime($date->format("Y-m-d"));
        $date->setDate($date->format("Y"),$date->format("m"),1);

        $query = $this->getEntityManager()
                ->createQuery('
                SELECT e FROM PressPlayCoreBundle:WorkMonthEmployee e
                JOIN e.workmonth w
                WHERE w.date = :date
                AND e.user = :id
                ')
                ->setParameter('id', $user->getId() )
                ->setParameter('date', $date->format('Y-m-d'));
        try {
            return $query->getSingleResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        } 
    }

    public function findLatest($user){
        $query = $this->getEntityManager()
                ->createQuery('
                SELECT e FROM PressPlayCoreBundle:WorkMonthEmployee e
                JOIN e.workmonth w
                WHERE e.user = :id
                ORDER BY w.date DESC
                ')
                ->setParameter('id', $user->getId() );

        $query->setMaxResults(1);

        try {
            return $query->getSingleResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        } 
    }    
}