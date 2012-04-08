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
     * @var string $firstname
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;   
    
    /**
     *
     * @ORM\OneToMany(targetEntity="TimeSheet", mappedBy="user")
     */
    protected $timesheets;   
    
    /**
     *
     * @ORM\OneToMany(targetEntity="WorkMonthEmployee", mappedBy="user")
     */
    protected $workmonths;      

    public function __construct()
    {
        parent::__construct();
        $this->timesheets = new ArrayCollection();
        $this->workmonths = new ArrayCollection();
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

    public function setEmail($email)
    {
        parent::setEmail($email);
        $this->setUsername($email);
    }

    public function getName()
    {
        return $this->name;
    }    

    public function setName($name)
    {
        $this->name = $name;
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
    
    /**
     * Add workmonts
     *
     * @param PressPlay\CoreBundle\Entity\TimeSheet $workmonths
     */
    public function addWorkMonthEmployee(\PressPlay\CoreBundle\Entity\WorkMonthEmployee $workmonths)
    {
        $this->workmonths[] = $workmonths;
    }

    /**
     * Get workmonts
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getWorkMonthEmployee()
    {
        return $this->workmonths;
    }    

    /**
     * Get workmonths
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getWorkmonths()
    {
        return $this->workmonths;
    }
}