<?php

namespace Controllers;

use Silex\Application;
use Silex\Api\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Response;

class IndexController implements ControllerProviderInterface{
    public function connect(Application $app){
        $indexController = $app['controllers_factory'];
        $indexController->get('/', [$this, 'index']);
        return $indexController;
    }
    public function index(Application $app){

        $twigdata = [];

        $resp = new Response(202);
        $resp->setCache(array(
            'max_age'       => 10,
            's_maxage'      => 10,
            'public'        => true,
        ));
        return $app['twig']->render('index.twig', $twigdata, $resp);
    }
}
