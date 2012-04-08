<?php

namespace PressPlay\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * PressPlay\CoreBundle\Entity\WorkMonth
 *
 * @ORM\Table()
 * @ORM\Entity
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
     * @ORM\Column(name="month", type="string")
     */
    private $month;

    /**
     * @var string $year
     *
     * @ORM\Column(name="year", type="string")
     */
    private $year;  
    
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
     * Get month
     *
     * @return string 
     */
    public function getMonth()
    {
        return $this->month;
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
}