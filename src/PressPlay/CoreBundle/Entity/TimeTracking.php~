<?php

namespace PressPlay\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PressPlay\CoreBundle\Entity\TimeTracking
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class TimeTracking
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
     * @var time $startTime
     *
     * @ORM\Column(name="startTime", type="time")
     */
    private $startTime;

    /**
     * @var time $stopTime
     *
     * @ORM\Column(name="stopTime", type="time")
     */
    private $stopTime;

    /**
     * @var decimal $adjustment
     *
     * @ORM\Column(name="adjustment", type="decimal")
     */
    private $adjustment;

    /**
     * @var boolean $sickday
     *
     * @ORM\Column(name="sickday", type="boolean")
     */
    private $sickday;

    /**
     * @var boolean $holiday
     *
     * @ORM\Column(name="holiday", type="boolean")
     */
    private $holiday;    

    /**
     *
     * @ORM\ManyToOne(targetEntity="TimeSheet", inversedBy="timetrackings")
     * @ORM\JoinColumn(name="timesheet_id", referencedColumnName="id")
     */
    private $timesheet;     
    
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
     * Set startTime
     *
     * @param time $startTime
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;
    }

    /**
     * Get startTime
     *
     * @return time 
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * Set stopTime
     *
     * @param time $stopTime
     */
    public function setStopTime($stopTime)
    {
        $this->stopTime = $stopTime;
    }

    /**
     * Get stopTime
     *
     * @return time 
     */
    public function getStopTime()
    {
        return $this->stopTime;
    }

    /**
     * Set sickday
     *
     * @param boolean $sickday
     */
    public function setSickday($sickday)
    {
        $this->sickday = $sickday;
    }

    /**
     * Get sickday
     *
     * @return boolean 
     */
    public function getSickday()
    {
        return $this->sickday;
    }

    /**
     * Set holiday
     *
     * @param boolean $holiday
     */
    public function setHoliday($holiday)
    {
        $this->holiday = $holiday;
    }

    /**
     * Get holiday
     *
     * @return boolean 
     */
    public function getHoliday()
    {
        return $this->holiday;
    }

    /**
     * Set adjustment
     *
     * @param decimal $adjustment
     */
    public function setAdjustment($adjustment)
    {
        $this->adjustment = $adjustment;
    }

    /**
     * Get adjustment
     *
     * @return decimal 
     */
    public function getAdjustment()
    {
        return $this->adjustment;
    }

    /**
     * Set timesheet
     *
     * @param PressPlay\CoreBundle\Entity\TimeSheet $timesheet
     */
    public function setTimesheet(\PressPlay\CoreBundle\Entity\TimeSheet $timesheet)
    {
        $this->timesheet = $timesheet;
    }

    /**
     * Get timesheet
     *
     * @return PressPlay\CoreBundle\Entity\TimeSheet 
     */
    public function getTimesheet()
    {
        return $this->timesheet;
    }
}