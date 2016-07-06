<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TicketType
 *
 * @ORM\Table(name="ticket_type")
 * @ORM\Entity(repositoryClass="Entity\TicketTypeRepository")
 */
class TicketType
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
     * @ORM\Column(name="name", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="states", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $states;

    /**
     * @var string
     *
     * @ORM\Column(name="types", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $types;

    /**
     * @var string
     *
     * @ORM\Column(name="levels", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $levels;

    /**
     * @var string
     *
     * @ORM\Column(name="priorities", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $priorities;

    /**
     * @var string
     *
     * @ORM\Column(name="answer_time", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $answerTimes;

    /**
     * @var string
     *
     * @ORM\Column(name="quality_of_services", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $qualityOfServices;

    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean", precision=0, scale=0, nullable=false, unique=false)
     */
    private $active;


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
     * Set name
     *
     * @param string $name
     * @return TicketType
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set states
     *
     * @param string $states
     * @return TicketType
     */
    public function setStates($states)
    {
        $this->states = $states;
    
        return $this;
    }

    /**
     * Get states
     *
     * @return string 
     */
    public function getStates()
    {
        return $this->states;
    }

    /**
     * Set types
     *
     * @param string $types
     * @return TicketType
     */
    public function setTypes($types)
    {
        $this->types = $types;
    
        return $this;
    }

    /**
     * Get types
     *
     * @return string 
     */
    public function getTypes()
    {
        return $this->types;
    }

    /**
     * Set levels
     *
     * @param string $levels
     * @return TicketType
     */
    public function setLevels($levels)
    {
        $this->levels = $levels;
    
        return $this;
    }

    /**
     * Get levels
     *
     * @return string 
     */
    public function getLevels()
    {
        return $this->levels;
    }

    /**
     * Set priorities
     *
     * @param string $priorities
     * @return TicketType
     */
    public function setPriorities($priorities)
    {
        $this->priorities = $priorities;
    
        return $this;
    }

    /**
     * Get priorities
     *
     * @return string 
     */
    public function getPriorities()
    {
        return $this->priorities;
    }

    /**
     * Set answerTimes
     *
     * @param string $answerTimes
     * @return TicketType
     */
    public function setAnswerTimes($answerTimes)
    {
        $this->answerTimes = $answerTimes;
    
        return $this;
    }

    /**
     * Get answerTimes
     *
     * @return string 
     */
    public function getAnswerTimes()
    {
        return $this->answerTimes;
    }

    /**
     * Set qualityOfServices
     *
     * @param string $qualityOfServices
     * @return TicketType
     */
    public function setQualityOfServices($qualityOfServices)
    {
        $this->qualityOfServices = $qualityOfServices;
    
        return $this;
    }

    /**
     * Get qualityOfServices
     *
     * @return string 
     */
    public function getQualityOfServices()
    {
        return $this->qualityOfServices;
    }

    /**
     * Set Active
     *
     * @param boolean $active
     * @return TicketType
     */
    public function setActive($active)
    {
        $this->active = $active;
    
        return $this;
    }

    /**
     * Get Active
     *
     * @return boolean 
     */
    public function getactive()
    {
        return $this->active;
    }
}
