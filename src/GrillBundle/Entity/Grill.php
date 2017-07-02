<?php

namespace GrillBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Grill
 *
 * @ORM\Table(name="grill")
 * @ORM\Entity(repositoryClass="GrillBundle\Repository\GrillRepository")
 */
class Grill
{
    /**
     * @ORM\OneToMany(targetEntity="Griller", mappedBy="Grill")
     */
    protected $grillers;
    
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
     * @ORM\Column(name="date", type="date")
     */
    private $date;

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
     * @return Grill
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Grill
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }
    
     /**
     * Constructor
     */
     public function __construct()
    {
        $this->$runners= new ArrayCollection();
    }

    /**
     * Add griller
     *
     * @param \GrillBundle\Entity\Griller $griller
     *
     * @return Grill
     */
    public function addGriller(\GrillBundle\Entity\Griller $griller)
    {
        $this->grillers[] = $griller;

        return $this;
    }

    /**
     * Remove griller
     *
     * @param \GrillBundle\Entity\Griller $griller
     */
    public function removeGriller(\GrillBundle\Entity\Griller $griller)
    {
        $this->grillers->removeElement($griller);
    }

    /**
     * Get grillers
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGrillers()
    {
        return $this->grillers;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return Grill
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }
}