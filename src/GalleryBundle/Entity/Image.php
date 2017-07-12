<?php

namespace GalleryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Image
 *
 * @ORM\Table(name="images")
 * @ORM\Entity(repositoryClass="GalleryBundle\Repository\ImageRepository")
 */
class Image
{
    /**
     * @ORM\ManyToOne(targetEntity="RyGBundle\Entity\Griller", inversedBy="images")
     * @ORM\JoinColumn(name="griller_id", referencedColumnName="id")
     */
    private $griller;
    
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var array
     *
     * @ORM\Column(name="filenames", type="array", length=255, nullable=true)
     */
    private $filenames;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime", nullable=true)
     */
    private $createdAt;


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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Image
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set griller
     *
     * @param \RyGBundle\Entity\Griller $griller
     *
     * @return Image
     */
    public function setGriller(\RyGBundle\Entity\Griller $griller = null)
    {
        $this->griller = $griller;

        return $this;
    }

    /**
     * Get griller
     *
     * @return \RyGBundle\Entity\Griller
     */
    public function getGriller()
    {
        return $this->griller;
    }

    /**
     * Set filenames
     *
     * @param array $filenames
     *
     * @return Image
     */
    public function setFilenames($filenames)
    {
        $this->filenames = $filenames;

        return $this;
    }

    /**
     * Get filenames
     *
     * @return array
     */
    public function getFilenames()
    {
        return $this->filenames;
    }
}
