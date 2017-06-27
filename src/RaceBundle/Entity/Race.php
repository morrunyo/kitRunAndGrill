<?php

namespace RaceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Race
 *
 * @ORM\Table(name="races")
 * @ORM\Entity(repositoryClass="RaceBundle\Repository\RaceRepository")
 */
class Race
{
    /**
     * @ORM\OneToMany(targetEntity="Runner", mappedBy="Race")
     */
    protected $runners;
    
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="started_at", type="datetime")
     */
    private $startedAt;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;


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
     * Set name
     *
     * @param string $name
     *
     * @return Race
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
     * Set startedAt
     *
     * @param \DateTime $startedAt
     *
     * @return Race
     */
    public function setStartedAt($startedAt)
    {
        $this->startedAt = $startedAt;

        return $this;
    }

    /**
     * Get startedAt
     *
     * @return \DateTime
     */
    public function getStartedAt()
    {
        return $this->startedAt;;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return Race
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return bool
     */
    public function getIsActive()
    {
        return $this->isActive;
    }
    
    public function __construc()
    {
        $this->$runners= new ArrayCollection();
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->runners = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add runner
     *
     * @param \RaceBundle\Entity\Runner $runner
     *
     * @return Race
     */
    public function addRunner(\RaceBundle\Entity\Runner $runner)
    {
        $this->runners[] = $runner;

        return $this;
    }

    /**
     * Remove runner
     *
     * @param \RaceBundle\Entity\Runner $runner
     */
    public function removeRunner(\RaceBundle\Entity\Runner $runner)
    {
        $this->runners->removeElement($runner);
    }

    /**
     * Get runners
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRunners()
    {
        return $this->runners;
    }
}
