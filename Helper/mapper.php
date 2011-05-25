<?php

namespace PaZa\ClientUrlMapperBundle\Helper;

class Mapper
{
    protected $request  = NULL; 
    protected $em       = NULL;
    
    public function __construct($request, $em) {
        $this->request  = $request;
        $this->em       = $em;
        
        /*var_dump($this->request->hasPreviousSession());
        var_dump($this->request->hasSession());
        var_dump($this->request->getClientIp());
        var_dump($this->request->getScriptName());
        var_dump($this->request->getPathInfo());
        var_dump($this->request->getBasePath());
        var_dump($this->request->getBaseUrl());
        var_dump($this->request->getScheme());
        var_dump($this->request->getPort());
        var_dump($this->request->getHttpHost());
        var_dump($this->request->getRequestUri());
        var_dump($this->request->getUri());
        #var_dump($this->request->getUriForPath());
        var_dump($this->request->getQueryString());
        var_dump($this->request->isSecure());
        var_dump($this->request->getHost());
        var_dump($this->request->getMethod());
        #var_dump($this->request->getMimeType());
        #var_dump($this->request->getFormat());
        var_dump($this->request->getRequestFormat());
        var_dump($this->request->isMethodSafe());
        var_dump($this->request->getContent());
        var_dump($this->request->getETags());
        var_dump($this->request->isNoCache());
        var_dump($this->request->getPreferredLanguage());
        var_dump($this->request->getLanguages());
        var_dump($this->request->getCharsets());
        var_dump($this->request->getAcceptableContentTypes());
        var_dump($this->request->isXmlHttpRequest());*/
        
        $host = $this->request->getHttpHost();
        
        
        
        var_dump($host);die();
    }
    
    public function getMandant() {
        
    }
}
