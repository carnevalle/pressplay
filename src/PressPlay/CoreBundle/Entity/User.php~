<?php
// src/PressPlay/CoreBundle/Entity/User.php

namespace PressPlay\CoreBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="pp_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     *
     * @ORM\OneToMany(targetEntity="TimeSheet", mappedBy="user")
     */
    protected $timesheets;    

    public function __construct()
    {
        parent::__construct();
        $this->timesheets = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add timesheets
     *
     * @param PressPlay\CoreBundle\Entity\TimeSheet $timesheets
     */
    public function addTimeSheet(\PressPlay\CoreBundle\Entity\TimeSheet $timesheets)
    {
        $this->timesheets[] = $timesheets;
    }

    /**
     * Get timesheets
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getTimesheets()
    {
        return $this->timesheets;
    }
}