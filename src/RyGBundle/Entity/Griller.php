<?php

namespace RyGBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Griller
 *
 * @ORM\Table(name="grillers")
 * @ORM\Entity(repositoryClass="RyGBundle\Repository\GrillerRepository")
 */
class Griller
{
    /**
     * @ORM\OneToMany(targetEntity="GalleryBundle\Entity\Image", mappedBy="griller")
     */
    private $images;
    
    /**
     * @ORM\ManyToOne(targetEntity="Edition", inversedBy="grillers")
     * @ORM\JoinColumn(name="edition_id", referencedColumnName="id")
     */
    private $edition;
    
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
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;
    
    /**
     * @var string
     *
     * @ORM\Column(name="team", type="string", length=255, nullable=true)
     */
    private $team;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=255, nullable=true)
     */
    private $photo;

    /**
     * @var string
     *
     * @ORM\Column(name="instagram", type="string", length=255, nullable=true)
     */
    private $instagram;

    /**
     * @var int
     *
     * @ORM\Column(name="phone", type="integer", nullable=true)
     */
    private $phone;


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
     * @return Griller
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
     * Set photo
     *
     * @param string $photo
     *
     * @return Griller
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Set phone
     *
     * @param integer $phone
     *
     * @return Griller
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone
     *
     * @return int
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set edition
     *
     * @param \RyGBundle\Entity\Edition $edition
     *
     * @return Griller
     */
    public function setEdition(\RyGBundle\Entity\Edition $edition = null)
    {
        $this->edition = $edition;

        return $this;
    }

    /**
     * Get edition
     *
     * @return \RyGBundle\Entity\Edition
     */
    public function getEdition()
    {
        return $this->edition;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->images = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add image
     *
     * @param \GalleryBundle\Entity\Image $image
     *
     * @return Griller
     */
    public function addImage(\GalleryBundle\Entity\Image $image)
    {
        $this->images[] = $image;

        return $this;
    }

    /**
     * Remove image
     *
     * @param \GalleryBundle\Entity\Image $image
     */
    public function removeImage(\GalleryBundle\Entity\Image $image)
    {
        $this->images->removeElement($image);
    }

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Set team
     *
     * @param string $team
     *
     * @return Griller
     */
    public function setTeam($team)
    {
        $this->team = $team;

        return $this;
    }

    /**
     * Get team
     *
     * @return string
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * Set instagram
     *
     * @param string $instagram
     *
     * @return Griller
     */
    public function setInstagram($instagram)
    {
        $this->instagram = $instagram;

        return $this;
    }

    /**
     * Get instagram
     *
     * @return string
     */
    public function getInstagram()
    {
        return $this->instagram;
    }
}
