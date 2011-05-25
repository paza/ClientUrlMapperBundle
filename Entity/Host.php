<?php

namespace PaZa\ClientUrlMapperBundle\Entity;

use Doctrine\ORM\Mapping as ORM,
    Symfony\Component\Validator\Constraints as Assert;

/**
 * Host
 *
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="paza_mandant_host")
 */
class Host
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
     * @var Client
     *
     * @ORM\ManyToOne(targetEntity="PaZa\ClientUrlMapperBundle\Entity\Client", inversedBy="children")
     * @ORM\JoinColumn(name="paza_mandant_client_id", referencedColumnName="id")
     */
    private $client;
    
    
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
     * Set Client
     *
     * @param Client $client
     */
    public function setClient(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Get Client
     *
     * @return Client $client
     */
    public function getClient()
    {
        return $this->client;
    }
    
    
    /**
     * @ORM\PrePersist
     */
    public function doPrePersist()
    {
        $this->incrementCreatedAt();
    }
    
    /**
     * @ORM\PreUpdate
     */
    public function doPreUpdate()
    {
        $this->incrementUpdatedAt();
    }
    
    
}