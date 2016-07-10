<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ticket
 *
 * @ORM\Table(name="ticket")
 * @ORM\Entity(repositoryClass="Entity\TicketRepository")
 */
class Ticket
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=true)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="subject", type="string", length=55, precision=0, scale=0, nullable=false, unique=false)
     */
    private $subject;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=500, precision=0, scale=0, nullable=false, unique=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="level", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $level;

    /**
     * @var string
     *
     * @ORM\Column(name="priority", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $priority;

    /**
     * @var string
     *
     * @ORM\Column(name="answer_time", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $answerTime;

    /**
     * @var string
     *
     * @ORM\Column(name="quality_of_service", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $qualityOfService;

      /**
     * @var \Entity\Users
     *
     * @ORM\ManyToOne(targetEntity="Entity\Users", inversedBy="tickets")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $userReporter;

    /**
     * @var string
     *
     * @ORM\Column(name="department", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $department;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="submit_date", type="date", precision=0, scale=0, nullable=false, unique=false)
     */
    private $submitDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="close_date", type="date", precision=0, scale=0, nullable=true, unique=false)
     */
    private $closeDate;

    /**
     * @var string
     *
     * @ORM\Column(name="state", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $state;

    /**
     * @var string
     *
     * @ORM\Column(name="soluction_description", type="string", length=500, precision=0, scale=0, nullable=true, unique=false)
     */
    private $solutionDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="evaluation", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $evaluation;

    /**
     * @var string
     *
     * @ORM\Column(name="observations", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $observations;


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
     * Set subject
     *
     * @param string $subject
     * @return Ticket
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
    
        return $this;
    }

    /**
     * Get subject
     *
     * @return string 
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Ticket
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Ticket
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set level
     *
     * @param string $level
     * @return Ticket
     */
    public function setLevel($level)
    {
        $this->level = $level;
    
        return $this;
    }

    /**
     * Get level
     *
     * @return string 
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set priority
     *
     * @param string $priority
     * @return Ticket
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;
    
        return $this;
    }

    /**
     * Get priority
     *
     * @return string 
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     * Set answerTime
     *
     * @param string $answerTime
     * @return Ticket
     */
    public function setAnswerTime($answerTime)
    {
        $this->answerTime = $answerTime;
    
        return $this;
    }

    /**
     * Get answerTime
     *
     * @return string 
     */
    public function getAnswerTime()
    {
        return $this->answerTime;
    }

    /**
     * Set qualityOfService
     *
     * @param string $qualityOfService
     * @return Ticket
     */
    public function setQualityOfService($qualityOfService)
    {
        $this->qualityOfService = $qualityOfService;
    
        return $this;
    }

    /**
     * Get qualityOfService
     *
     * @return string 
     */
    public function getQualityOfService()
    {
        return $this->qualityOfService;
    }

    /**
     * Set userReporter
     *
     * @param string $userReporter
     * @return Ticket
     */
    public function setUserReporter($userReporter)
    {
        $this->userReporter = $userReporter;
    
        return $this;
    }

    /**
     * Get userReporter
     *
     * @return string 
     */
    public function getUserReporter()
    {
        return $this->userReporter;
    }

    /**
     * Set deparment
     *
     * @param string $deparment
     * @return Ticket
     */
    public function setDepartment($department)
    {
        $this->department = $department;
    
        return $this;
    }

    /**
     * Get deparment
     *
     * @return string 
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * Set submitDate
     *
     * @param \DateTime $submitDate
     * @return Ticket
     */
    public function setSubmitDate($submitDate)
    {
        $this->submitDate = $submitDate;
    
        return $this;
    }

    /**
     * Get submitDate
     *
     * @return \DateTime 
     */
    public function getSubmitDate()
    {
        return $this->submitDate;
    }

    /**
     * Set closeDate
     *
     * @param \DateTime $closeDate
     * @return Ticket
     */
    public function setCloseDate($closeDate)
    {
        $this->closeDate = $closeDate;
    
        return $this;
    }

    /**
     * Get closeDate
     *
     * @return \DateTime 
     */
    public function getCloseDate()
    {
        return $this->closeDate;
    }

    /**
     * Set state
     *
     * @param string $state
     * @return Ticket
     */
    public function setState($state)
    {
        $this->state = $state;
    
        return $this;
    }

    /**
     * Get state
     *
     * @return string 
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set solutionDescription
     *
     * @param string $solutionDescription
     * @return Ticket
     */
    public function setSolutionDescription($solutionDescription)
    {
        $this->solutionDescription = $solutionDescription;
    
        return $this;
    }

    /**
     * Get solutionDescription
     *
     * @return string 
     */
    public function getSolutionDescription()
    {
        return $this->solutionDescription;
    }

    /**
     * Set evaluation
     *
     * @param string $evaluation
     * @return Ticket
     */
    public function setEvaluation($evaluation)
    {
        $this->evaluation = $evaluation;
    
        return $this;
    }

    /**
     * Get evaluation
     *
     * @return string 
     */
    public function getEvaluation()
    {
        return $this->evaluation;
    }

    /**
     * Set observations
     *
     * @param string $observations
     * @return Ticket
     */
    public function setObservations($observations)
    {
        $this->observations = $observations;
    
        return $this;
    }

    /**
     * Get observations
     *
     * @return string 
     */
    public function getObservations()
    {
        return $this->observations;
    }
}