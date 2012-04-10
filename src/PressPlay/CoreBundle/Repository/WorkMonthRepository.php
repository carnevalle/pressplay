<?php

namespace PressPlay\CoreBundle\Repository;

use Doctrine\ORM\EntityRepository;

class WorkMonthRepository extends EntityRepository
{
    /*
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
    */

    public function findByDate($date){

        // We make sure dates are first of the month
        $date = new \DateTime($date->format("Y-m-d"));
        $date->setDate($date->format("Y"),$date->format("m"),1);

        $query = $this->getEntityManager()
                ->createQuery('
                SELECT w FROM PressPlayCoreBundle:WorkMonth w
                WHERE w.date = :date
                ')
                ->setParameter('date', $date->format('Y-m-d'));
        try {
            return $query->getSingleResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        } 
    }

    public function findByDateAndUser($date, $user){
        // We make sure dates are first of the month
        $date = new \DateTime($date->format("Y-m-d"));
        $date->setDate($date->format("Y"),$date->format("m"),1);

        $query = $this->getEntityManager()
                ->createQuery('
                SELECT w FROM PressPlayCoreBundle:WorkMonth w
                JOIN w.employees e
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

    public function findAllByUser($user){
        $query = $this->getEntityManager()
                ->createQuery('
                SELECT w FROM PressPlayCoreBundle:WorkMonth w
                JOIN w.employees e
                WHERE e.user = :id
                ')
                ->setParameter('id', $user->getId());
        try {
            return $query->getResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }          
    }

    public function findAllByDate($sortorder = "ASC"){
        $query = $this->getEntityManager()
                ->createQuery('
                SELECT w FROM PressPlayCoreBundle:WorkMonth w
                ORDER BY w.date '.$sortorder
                );
        try {
            return $query->getResult();
        } catch (\Doctrine\ORM\NoResultException $e) {
            return null;
        }         
    }
}