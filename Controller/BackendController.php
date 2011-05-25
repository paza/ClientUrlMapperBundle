<?php

namespace PaZa\ClientUrlMapperBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Templating\TemplateReference,
    Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer,
    Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use PaZa\ClientUrlMapperBundle\Entity\Client,
    PaZa\ClientUrlMapperBundle\Form\ClientForm,
    PaZa\ClientUrlMapperBundle\Entity\Host,
    PaZa\ClientUrlMapperBundle\Form\HostForm;

/**
 * imho injecting the container is a bad practice
 * however for the purpose of this demo it makes it easier since then not all Bundles are required
 * in order to play around with just a few of the actions.
 */
class BackendController
{    
    protected $request;
    
    /**
     * @var Liip\ViewBundle\View\DefaultView
     */
    protected $view;
    
    protected $em;
    
    protected $security;
    
    protected $form_factory;

    public function __construct($request, $view, $em, $security, $form_factory)
    {
        $this->request      = $request;
        $this->view         = $view;
        $this->em           = $em;
        $this->security     = $security;
        $this->form_factory = $form_factory;
    }
    
    protected function getRequest()
    {
        return $this->request;
    }
    protected function getView()
    {
        return $this->view;
    }
    protected function getEm()
    {
        return $this->em;
    }
    protected function getSecurity()
    {
        return $this->security;
    }
    protected function getFormFactory()
    {
        return $this->form_factory;
    }
    protected function isPostRequest()
    {
        $request = $this->getRequest();
        return $request->getMethod() === 'POST';
    }
    
    public function clientAction()
    {
        $form       = new ClientForm();
        $entity     = new Client();
        
        $view       = $this->getView();
        $request    = $this->getRequest();
        $form       = $this->getFormFactory()->create($form);
        
        $form->setData($entity);
        
        if($this->isPostRequest())
        {
            $form->bindRequest($request);
        }
        
        if ($form->isValid())
        {
            $em = $this->getEm();
            $em->persist($entity);
            $em->flush();

            $view->setRouteRedirect('paza_clienturlmapper_host', array('clientSlug' => $entity->getSlug()));
        }
        else
        {
            $clients = $this->em->getRepository('PaZa\ClientUrlMapperBundle\Entity\Client')->findAll();
            
            $view->setParameters(array('form' => $form->createView(), 'entity' => $entity, 'clients' => $clients));
            $view->setTemplate(new TemplateReference('ClientUrlMapperBundle', 'Backend', 'clients'));
        }
        
        return $view->handle();
    }
    
    public function hostAction($clientSlug)
    {
        $client     = $this->em->getRepository('PaZa\ClientUrlMapperBundle\Entity\Client')->findOneBy(array('slug' => $clientSlug));
        
        if(!$client)
        {
            throw new \Exception('xx');
        }
        
        $form       = new HostForm();
        $entity     = new Host();
        $entity->setClient($client);
        
        $view       = $this->getView();
        $request    = $this->getRequest();
        $form       = $this->getFormFactory()->create($form);
        
        $form->setData($entity);
        
        if($this->isPostRequest())
        {
            $form->bindRequest($request);
        }
        
        if ($form->isValid())
        {
            $em = $this->getEm();
            $em->persist($entity);
            $em->flush();

            $view->setRouteRedirect('paza_clienturlmapper_host', array('clientSlug' => $client->getSlug()));
        }
        else
        {
            $hosts = $this->em->getRepository('PaZa\ClientUrlMapperBundle\Entity\Host')->findBy(array('client' => $client->getId()));
            
            $view->setParameters(array('form' => $form->createView(), 'entity' => $entity, 'hosts' => $hosts, 'client' => $client));
            $view->setTemplate(new TemplateReference('ClientUrlMapperBundle', 'Backend', 'hosts'));
        }
        
        return $view->handle();
    }
}
