<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Users
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="Entity\UserRepository")
 */
class Users
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
     * @var integer
     *
     * @ORM\Column(name="cedula", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $cedula;

    /**
     * @var string
     *
     * @ORM\Column(name="login", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $login;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="last_name", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $lastName;

    /**
     * @var integer
     *
     * @ORM\Column(name="phone", type="bigint", precision=0, scale=0, nullable=false, unique=false)
     */
    private $phone;

    /**
     * @var integer
     *
     * @ORM\Column(name="type", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $type;

    /**
     * @ORM\ManyToOne(targetEntity="Position")
     * @ORM\JoinColumn(name="position_id", referencedColumnName="id")
     */
    private $position;

    /**
     * @ORM\ManyToOne(targetEntity="Department")
     * @ORM\JoinColumn(name="department_id", referencedColumnName="id")
     */
    private $department;

    
     /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Entity\Ticket", mappedBy="userReporter")
     */
     private $tickets;
     
     
     /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="Entity\Ticket", mappedBy="userAssigned")
     */
     private $ticketsAssigned;

     /**
     * @var integer
     *
     * @ORM\Column(name="question", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $question;

     /**
     * @var string
     *
     * @ORM\Column(name="answer", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $answer;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $email;
     
     
     
    /**
     * Constructor
    */
    public function __construct()
    {
        $this->tickets = new \Doctrine\Common\Collections\ArrayCollection();
        $this->ticketsAssigned = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Get cedula
     *
     * @return integer 
     */
    public function getCedula()
    {
        return $this->cedula;
    }

    /**
     * Set login
     *
     * @param string $login
     * @return Users
     */
    public function setLogin($login)
    {
        $this->login = $login;
    
        return $this;
    }

    /**
     * Get login
     *
     * @return string 
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return Users
     */
    public function setPassword($password)
    {
        $this->password = $password;
    
        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Users
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
     * Set lastName
     *
     * @param string $lastName
     * @return Users
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    
        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Get phone
     *
     * @return integer 
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set phone
     *
     * @param integer $phone
     * @return Users
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    
        return $this;
    }

    /**
     * Set type
     *
     * @param integer $type
     * @return Users
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return integer 
     */
    public function getType()
    {
       return $this->type;
    }    
     
    /**
     * Set position
     *
     * @param \Entity\Position $position
     * @return Users
     */
    public function setPosition(\Entity\Position $position = null)
    {
        $this->position = $position;
    
        return $this;
    }
    /**
     * Get position
     *
     * @return \Entity\Position 
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * Set department
     *
     * @param \Entity\Department $department
     * @return Users
     */
    public function setDepartment(\Entity\Department $department = null)
    {
        $this->department = $department;
    
        return $this;
    }
    /**
     * Get department
     *
     * @return \Entity\Department 
     */
    public function getDepartment()
    {
        return $this->department;
    }
    
    public function getTypeText() {
        $type = $this->type;
        // Translate integer user type to it's corresponding string
        return ($type == 1 ? "Gerente" : ($type == 2 ? "Coordinador de sistema" : ($type == 3 ? "Técnico" : "Solicitante")));
    }
    


    /**
     * Set cedula
     *
     * @param integer $cedula
     * @return Users
     */
    public function setCedula($cedula)
    {
        $this->cedula = $cedula;
    
        return $this;
    }

    /**
     * Add tickets
     *
     * @param \Entity\Ticket $tickets
     * @return Users
     */
    public function addTicket(\Entity\Ticket $tickets)
    {
        $this->tickets[] = $tickets;
    
        return $this;
    }

    /**
     * Remove tickets
     *
     * @param \Entity\Ticket $tickets
     */
    public function removeTicket(\Entity\Ticket $tickets)
    {
        $this->tickets->removeElement($tickets);
    }

    /**
     * Get tickets
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTickets()
    {
        return $this->tickets;
    }

    
    /**
     * Add tickets
     *
     * @param \Entity\Ticket $ticketAssigned
     * @return Users
     */
    public function addTicketsAssigned(\Entity\Ticket $ticketAssigned)
    {
        $this->ticketsAssigned[] = $ticketAssigned;
    
        return $this;
    }

    /**
     * Remove tickets
     *
     * @param \Entity\Ticket $ticketAssigned
     */
    public function removeTicketsAssigned(\Entity\Ticket $ticketAssigned)
    {
        $this->tickets->removeElement($ticketAssigned);
    }

    /**
     * Get tickets
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTicketsAssigneds()
    {
        return $this->$ticketsAssigned;
    }
    
    /**
     * Get question
     *
     * @return integer 
     */
    public function getQuestion()
    {
       return $this->question;
    }

    public function getQuestionText() {
        $question = $this->question;

        return ($question == 1 ? "¿Quién fue tu mejor amigo de la infancia?" : ($question == 2 ? "¿Cuál es el nombre de tu primera mascota?" : ($question == 3 ? "¿Cuál es el titulo de tu libro favorito?" : ($question == 4 ? "¿Cómo se llama tu abuela materna?" : "¿Cuál es tu deporte favorito?"))));
    }

    /**
     * Set question
     *
     * @param integer $question
     * @return Users
     */
    public function setQuestion($question)
    {
        $this->question = $question;
    
        return $this;
    }

    /**
     * Set answer
     *
     * @param string $answer
     * @return Users
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;
    
        return $this;
    }

    /**
     * Get answer
     *
     * @return string 
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Users
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }
    
}