<?php

namespace PressPlay\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * PressPlay\CoreBundle\Entity\WorkMonthEmployee
 *
 * @ORM\Table(uniqueConstraints={@UniqueConstraint(name="one_month_per_user", columns={"user_id", "workmonth_id"})})
 * @ORM\Entity
 */
class WorkMonthEmployee
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer $workhours
     *
     * @ORM\Column(name="workhours", type="integer")
     */
    private $workhours;

    /**
     * @var integer $workdays
     *
     * @ORM\Column(name="workdays", type="integer")
     */
    private $workdays;

    /**
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="workmonths")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;  
    
    /**
     *
     * @ORM\ManyToOne(targetEntity="WorkMonth", inversedBy="employees")
     * @ORM\JoinColumn(name="workmonth_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $workmonth;      
    
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
     * Set workhours
     *
     * @param integer $workhours
     */
    public function setWorkhours($workhours)
    {
        $this->workhours = $workhours;
    }

    /**
     * Get workhours
     *
     * @return integer 
     */
    public function getWorkhours()
    {
        return $this->workhours;
    }

    /**
     * Set workdays
     *
     * @param integer $workdays
     */
    public function setWorkdays($workdays)
    {
        $this->workdays = $workdays;
    }

    /**
     * Get workdays
     *
     * @return integer 
     */
    public function getWorkdays()
    {
        return $this->workdays;
    }
    
    /**
     * Set user
     *
     * @param PressPlay\CoreBundle\Entity\User $user
     */
    public function setUser(\PressPlay\CoreBundle\Entity\User $user)
    {
        $this->user = $user;
    }

    /**
     * Get user
     *
     * @return PressPlay\CoreBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }    

    /**
     * Set workmonth
     *
     * @param PressPlay\CoreBundle\Entity\WorkMonth $workmonth
     */
    public function setWorkmonth(\PressPlay\CoreBundle\Entity\WorkMonth $workmonth)
    {
        $this->workmonth = $workmonth;
    }

    /**
     * Get workmonth
     *
     * @return PressPlay\CoreBundle\Entity\WorkMonth 
     */
    public function getWorkmonth()
    {
        return $this->workmonth;
    }
}