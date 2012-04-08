<?php

namespace PressPlay\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\UniqueConstraint;

/**
 * PressPlay\CoreBundle\Entity\WorkMonth
 *
 * @ORM\Table(uniqueConstraints={@UniqueConstraint(name="no_duplicate_months", columns={"date"})})
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks()
 */
class WorkMonth
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
     * @var string $month
     *
     * @ORM\Column(name="month", type="integer")
     */
    private $month;

    /**
     * @var string $year
     *
     * @ORM\Column(name="year", type="integer")
     */
    private $year;  
    
    /**
     * @var string $date
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;  

    /**
     *
     * @ORM\OneToMany(targetEntity="WorkMonthEmployee", mappedBy="workmonth", cascade={"persist"})
     */
    protected $employees;      

    public function __construct()
    {
        $this->employees = new ArrayCollection();
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
     * Set month
     *
     * @param string $month
     */
    public function setMonth($month)
    {
        $this->month = $month;
    }

    /**
     * Get year
     *
     * @return string 
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set year
     *
     * @param string $year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }

    /**
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function setDate()
    {
        $this->date = new \DateTime($this->year.'-'.$this->month.'-01');
    }

    /**
     * Get month
     *
     * @return string 
     */
    public function getMonth()
    {
        return $this->month;
    }

    public function getFormattedDate(){

        setlocale(LC_TIME, "da_DK");
        return strftime("%B %Y", $this->date->getTimestamp());
    }

    /**
     * Add employees
     *
     * @param PressPlay\CoreBundle\Entity\WorkMonthEmployee $employees
     */
    public function addWorkMonthEmployee(\PressPlay\CoreBundle\Entity\WorkMonthEmployee $employees)
    {
        $this->employees[] = $employees;
    }

    /**
     * Set employees
     *
     * @param PressPlay\CoreBundle\Entity\WorkMonthEmployee $employees
     */
    public function setEmployees($employees)
    {
        $this->employees = $employees;
    }  

    /**
     * Get employees
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getEmployees()
    {
        return $this->employees;
    }
    
    public function __toString(){
        return $this->month." ".$this->year;
    }

    /**
     * Get date
     *
     * @return date 
     */
    public function getDate()
    {
        return $this->date;
    }
}