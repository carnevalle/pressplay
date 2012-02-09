<?php

namespace PressPlay\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * PressPlay\CoreBundle\Entity\TimeSheet
 *
 * @ORM\Table()
 * @ORM\Entity
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
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var text $comment
     *
     * @ORM\Column(name="comment", type="text")
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