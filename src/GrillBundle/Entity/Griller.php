<?php

namespace GrillBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Griller
 *
 * @ORM\Table(name="grillers")
 * @ORM\Entity(repositoryClass="GrillBundle\Repository\GrillerRepository")
 */
class Griller
{
     /**
     * @ORM\OneToMany(targetEntity="Image", mappedBy="Griller")
     */
    protected $images;

    /**
     * @ORM\ManyToOne(targetEntity="Grill",inversedBy="grillers")
     * @ORM\JoinColumn(name="grill_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $grill;
    
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
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=255)
     *
     * @Assert\NotBlank(message="Please, insert a JPG or PNG photo")
     * @Assert\File(mimeTypes={ "image/jpeg","image/png" })
     */
    private $photo;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=2000)
     */
    private $description;


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
     * Set email
     *
     * @param string $email
     *
     * @return Griller
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
     * Set description
     *
     * @param string $description
     *
     * @return Griller
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
     * Set race
     *
     * @param \GrillBundle\Entity\Grill $race
     *
     * @return Griller
     */
    public function setGrill(\GrillBundle\Entity\Grill $grill = null)
    {
        $this->grill = $grill;

        return $this;
    }

    /**
     * Get race
     *
     * @return \GrillBundle\Entity\Grill
     */
    public function getGrill()
    {
        return $this->grill;
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
     * @param \GrillBundle\Entity\images $image
     *
     * @return Griller
     */
    public function addImage(\GrillBundle\Entity\images $image)
    {
        $this->images[] = $image;

        return $this;
    }

    /**
     * Remove image
     *
     * @param \GrillBundle\Entity\images $image
     */
    public function removeImage(\GrillBundle\Entity\images $image)
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
}
