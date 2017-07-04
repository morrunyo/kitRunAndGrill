<?php

namespace GrillBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Image
 *
 * @ORM\Table(name="images")
 * @ORM\Entity(repositoryClass="GrillBundle\Repository\ImageRepository")
 */
class Image
{
    
    
    /**
     * @ORM\ManyToOne(targetEntity="Griller",inversedBy="images")
     * @ORM\JoinColumn(name="griller_id", referencedColumnName="id", onDelete="CASCADE")
     */
    protected $griller;
    
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
     * @ORM\Column(name="photo", type="string", length=255)
     */
    private $photo;


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
     * Set photo
     *
     * @param string $photo
     *
     * @return Image
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
     * Set griller
     *
     * @param \GrillBundle\Entity\Griller $griller
     *
     * @return Image
     */
    public function setGriller(\GrillBundle\Entity\Griller $griller = null)
    {
        $this->griller = $griller;

        return $this;
    }

    /**
     * Get griller
     *
     * @return \GrillBundle\Entity\Griller
     */
    public function getGriller()
    {
        return $this->griller;
    }
}
