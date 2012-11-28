<?php

namespace Ivelazquez\Bundle\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


/**
 * @Route("/")
 */
class MainController extends Controller
{
    /**
     * @Route("/", name="home")
     * @Template()
     */
    public function indexAction()
    {
        $server = $this->container->getParameter('ivelazquez_core.server');
        $tools = $this->container->getParameter('ivelazquez_core.tools');
        $projects = $this->container->getParameter('ivelazquez_core.projects');

        return array(
            'server'   => $server,
            'tools'    => array_chunk($tools, 6),
            'projects' => array_chunk($projects, 6),
        );
    }
}
