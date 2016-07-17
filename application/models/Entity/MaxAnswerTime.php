<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MaxAnswerTime
 *
 * @ORM\Table(name="maxAnswerTime")
 * @ORM\Entity(repositoryClass="Entity\MaxAnswerTimeRepository")
 */
class MaxAnswerTime
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
     * @ORM\Column(name="incident_priority", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $incidentPriority;

    /**
     * @var string
     *
     * @ORM\Column(name="incident_type", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     */
    private $incidentType;

    /**
     * @var integer
     *
     * @ORM\Column(name="max_time", type="integer", precision=0, scale=0, nullable=false, unique=false)
     */
    private $maxTime;

    /**
     * @var \Entity\TicketType
     *
     * @ORM\ManyToOne(targetEntity="Entity\TicketType", inversedBy="maxAnswerTimes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ticket_id", referencedColumnName="id", nullable=false)
     * })
     */
    private $tickeyType;


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
     * Set incidentPriority
     *
     * @param string $incidentPriority
     * @return MaxAnswerTime
     */
    public function setIncidentPriority($incidentPriority)
    {
        $this->incidentPriority = $incidentPriority;

        return $this;
    }

    /**
     * Get incidentPriority
     *
     * @return string
     */
    public function getIncidentPriority()
    {
        return $this->incidentPriority;
    }

    /**
     * Set incidentType
     *
     * @param string $incidentType
     * @return MaxAnswerTime
     */
    public function setIncidentType($incidentType)
    {
        $this->incidentType = $incidentType;

        return $this;
    }

    /**
     * Get incidentType
     *
     * @return string
     */
    public function getIncidentType()
    {
        return $this->incidentType;
    }

    /**
     * Set maxTime
     *
     * @param integer $maxTime
     * @return MaxAnswerTime
     */
    public function setMaxTime($maxTime)
    {
        $this->maxTime = $maxTime;

        return $this;
    }

    /**
     * Get maxTime
     *
     * @return integer
     */
    public function getMaxTime()
    {
        return $this->maxTime;
    }

    /**
     * Set tickeyType
     *
     * @param \Entity\TicketType $tickeyType
     * @return MaxAnswerTime
     */
    public function setTickeyType(\Entity\TicketType $tickeyType)
    {
        $this->tickeyType = $tickeyType;

        return $this;
    }

    /**
     * Get tickeyType
     *
     * @return \Entity\TicketType
     */
    public function getTickeyType()
    {
        return $this->tickeyType;
    }
}
