<?php

use Symfony\Component\Debug\Debug;
use Symfony\Component\HttpFoundation\Request;


require __DIR__.'/vendor/autoload.php';
Debug::enable();

$kernel = new AppKernel('dev', true);
if (PHP_VERSION_ID < 70000) {
    $kernel->loadClassCache();
}
$request = Request::createFromGlobals();
//$response = $kernel->handle($request);
//$response->send();
//$kernel->terminate($request, $response);

//test de sa mere la pute

$container = $kernel->getContainer();
$container->enterScope('request');
$container->set('request', $request);

use Yoda\EventBundle\Entity\Event;

$event = new Event();
$event->setName('Darth\'s surprise birthday party!');
$event->setLocation('Deathstar');
$event->setTime(new \datetime('tomorrow noon'));
$event->setDetails('Ha! Darth HATES surprises!!!!!');

$em = $container->get('doctrine')->getManager();
$em->persist($event);
$em->flush();
