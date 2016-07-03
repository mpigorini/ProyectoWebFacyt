<?php

namespace Entity;

//use Doctrine\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Users
 *
 * @Table(name="ticket_type", schema="core")
 * @Entity(repositoryClass="TicketTypeRepository")
 */
class TicketType
{
    /**
     * @var integer
     *
     * @Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=true)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @Column(name="name", type="string", length=255, nullable=false, unique=false)
     */
    private $name;

     /**
     * @var string
     *
     * @Column(name="states", type="string", length=255, nullable=false, unique=false)
     */
    private $states;
    
    /**
     * @var string
     *
     * @Column(name="types", type="string", length=255, nullable=false, unique=false)
     */
    private $types;

    /**
     * @var string
     *
     * @Column(name="levels", type="string", length=255, nullable=false, unique=false)
     */
    private $levels;
    
    /**
     * @var string
     *
     * @Column(name="priorities", type="string", length=255, nullable=false, unique=false)
     */
    private $priorities;
    
      /**
     * @var string
     *
     * @Column(name="answer_time", type="string", length=255, nullable=false, unique=false)
     */
    private $answerTimes;
    
     /**
     * @var string
     *
     * @Column(name="quality_of_services", type="string", length=255, nullable=false, unique=false)
     */
    private $qualityOfServices;
    
    /**
     * @var bool
     * 
     * @Column(name="default", type="boolean", nullable=false)
     */
     private $default;


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
     * SetDefault 
     * @params bool $default
    */
    public function setDefault($default){
        $this->default = $default;
    }
    
    /**
     * Get defalt
     * @return bool
     */
     public function getDefault(){
         return $this->default;
     }
     
}