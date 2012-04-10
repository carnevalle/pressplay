<?php

namespace PressPlay\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * PressPlay\CoreBundle\Entity\WorkMonthEmployee
 *
 * @ORM\Table(uniqueConstraints={@UniqueConstraint(name="no_duplicate_user_per_month", columns={"user_id", "workmonth_id"})})
 * @ORM\Entity(repositoryClass="PressPlay\CoreBundle\Repository\WorkMonthEmployeeRepository")
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
     *
     * @ORM\OneToMany(targetEntity="TimeSheet", mappedBy="workmonthemployee", cascade={"persist"})
     */
    private $timesheets;

    public function __construct()
    {
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

    public function getDatestring(){

        return $this->workmonth->getDatestring();
    }

    public function getFormattedDate(){

        return $this->workmonth->getFormattedDate();
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

    public function getWorkDayAverageHours(){

        if($this->workdays == 0){
            return $this->workhours;
        }
        
        return $this->workhours / $this->workdays;
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