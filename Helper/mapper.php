<?php

namespace PaZa\ClientUrlMapperBundle\Helper;

use Symfony\Component\Routing\Exception\ResourceNotFoundException;

class Mapper
{
    protected $request      = NULL; 
    protected $hostManager  = NULL;
    
    static $host            = NULL;
    
    public function __construct($request, $hostManager) {
        $this->request      = $request;
        $this->hostManager  = $hostManager;
    }
    
    /**
     * Returns the actual client
     *
     * @return PaZa\ClientUrlMapperBundle\Entity\Client
     */
    public function getClient() {
        if(is_null(self::$host)) {
            $host_string    = $this->request->getHttpHost();
            self::$host     = $this->hostManager->getByName($host_string);
            if(is_null(self::$host)) {
                throw new ResourceNotFoundException('Host ' . $host_string . ' not found');
            }
        }
        return self::$host;
    }
}
