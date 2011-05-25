<?php

namespace PaZa\ClientUrlMapperBundle\Entity;

use Doctrine\ORM\Mapping as ORM,
    Symfony\Component\Validator\Constraints as Assert;

/**
 * Client
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="paza_mandant_client")
 */
class Client
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length="100")
     */
    private $slug;

    /**
     * @var string
     *
     * @Assert\NotBlank(message="Please enter a mandant name")
     * @ORM\Column(name="name", type="string", length="50")
     */
    private $name;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $created_at;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updated_at;
    
    
    /**
     * Get Id
     *
     * @return int $id
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Set Slug
     *
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }
    
    /**
     * Get Slug
     *
     * @return string $slug
     */
    public function getSlug()
    {
        return $this->slug;
    }
    
    /**
     * Increment Slug (creates a slug for the given name on create/update)
     */
    public function incrementSlug()
    {
        $this->setSlug($this->generateSlug($this->getName()));
    }
    
    /**
     * Generates the slug from a string
     *
     * @param string $text
     * @return string
     */
    protected function generateSlug($text) {
        return preg_replace('/[^a-zA-Z0-9]+/i', '-', $text);
    }
    
    /**
     * Set Name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get Name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }
    
    /**
     * Set CreatedAt
     *
     * @param \DateTime $created_at
     */
    public function setCreatedAt(\DateTime $created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * Get CreatedAt
     *
     * @return \DateTime $created_at
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }
    
    /**
     * Increment CreatedAt (Sets the created_at time on create)
     */
    public function incrementCreatedAt()
    {
        if (null === $this->created_at) {
            $this->created_at = new \DateTime();
        }
        $this->updated_at = new \DateTime();
    }
    
    /**
     * Set UpdatedAt
     *
     * @param \DateTime $updated_at
     */
    public function setUpdatedAt(\DateTime $updated_at)
    {
        $this->updated_at = $updated_at;
    }

    /**
     * Get UpdatedAt
     *
     * @return \DateTime $updated_at
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }
    
    /**
     * Increment UpdatedAt (Sets the updated_at time on update)
     */
    public function incrementUpdatedAt()
    {
        $this->updated_at = new \DateTime();
    }
    
    
    /**
     * @ORM\PrePersist
     */
    public function doPrePersist()
    {
        $this->incrementCreatedAt();
        $this->incrementSlug();
    }
    
    /**
     * @ORM\PreUpdate
     */
    public function doPreUpdate()
    {
        $this->incrementUpdatedAt();
        $this->incrementSlug();
    }
    
    
}