<?php

namespace PaZa\ClientUrlMapperBundle\Entity;

use Doctrine\ORM\EntityManager;

class HostManager
{
    /**
     * Instance of doctrine entity manager
     *
     * @var: Doctrine\ORM\EntityManager
     */
    protected $em;
    
    /**
     * Name of folder entity class
     *
     * @var: string
     */
    protected $class;
    
    /**
     * Instance of doctrine entity repository
     *
     * @var: Doctrine\ORM\EntityRepository
     */
    protected $repository;

    public function __construct($em, $class)
    {
        $this->em           = $em;
        $this->repository   = $em->getRepository($class);
    }
    
    /**
     * Finds the host by the host string
     *
     * @param string $host_string
     * @return PaZa\ClientUrlMapperBundle\Entity\Host
     */
    public function getByName($host_string)
    {
        return $this->repository->findOneBy(array('name' => $host_string));
    }
    
}
