<?php

namespace PressPlay\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * PressPlay\CoreBundle\Entity\TimeSheet
 *
 * @ORM\Table(uniqueConstraints={@UniqueConstraint(name="one_per_day", columns={"user_id", "date"})})
 * @ORM\Entity(repositoryClass="PressPlay\CoreBundle\Repository\TimeSheetRepository")
 */
class TimeSheet
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
     * @var datetime $date
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var text $comment
     *
     * @ORM\Column(name="comment", type="text", nullable=true)
     */
    private $comment;

    /**
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="timesheets")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;     

    /**
     *
     * @ORM\OneToMany(targetEntity="TimeTracking", mappedBy="timesheet")
     */
    protected $timetrackings;      
    
    public function __construct()
    {
        $this->timetrackings = new ArrayCollection();
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
     * Set date
     *
     * @param datetime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * Get date
     *
     * @return datetime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set comment
     *
     * @param text $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * Get comment
     *
     * @return text 
     */
    public function getComment()
    {
        return $this->comment;
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
     * Add timetrackings
     *
     * @param PressPlay\CoreBundle\Entity\TimeTracking $timetrackings
     */
    public function addTimeTracking(\PressPlay\CoreBundle\Entity\TimeTracking $timetrackings)
    {
        $this->timetrackings[] = $timetrackings;
    }

    /**
     * Get timetrackings
     *
     * @return Doctrine\Common\Collections\Collection 
     */
    public function getTimetrackings()
    {
        return $this->timetrackings;
    }
}