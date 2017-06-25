<?php

namespace RaceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Runner
 *
 * @ORM\Table(name="runners")
 * @ORM\Entity(repositoryClass="RaceBundle\Repository\RunnerRepository")
 */
class Runner
{
    /**
     * @ORM\ManyToOne(targetEntity="Race",inversedBy="runners")
     * @ORM\JoinColumn(name="race_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $race;
    
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="code", type="integer")
     */
    private $code;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="finished_at", type="datetime")
     */
    private $finishedAt;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set code
     *
     * @param integer $code
     *
     * @return Runner
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return int
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Runner
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
     * Set finishedAt
     *
     * @param \DateTime $finishedAt
     *
     * @return Runner
     */
    public function setFinishedAt($finishedAt)
    {
        $this->finishedAt = $finishedAt;

        return $this;
    }

    /**
     * Get finishedAt
     *
     * @return \DateTime
     */
    public function getFinishedAt()
    {
        return $this->finishedAt;
    }

    /**
     * Set race
     *
     * @param \RaceBundle\Entity\Race $race
     *
     * @return Runner
     */
    public function setRace(\RaceBundle\Entity\Race $race = null)
    {
        $this->race = $race;

        return $this;
    }

    /**
     * Get race
     *
     * @return \RaceBundle\Entity\Race
     */
    public function getRace()
    {
        return $this->race;
    }
}
