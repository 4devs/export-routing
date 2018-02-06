<?php
$collection = new \Symfony\Component\Routing\RouteCollection();

$collection->add('homepage', new \Symfony\Component\Routing\Route('/'));

return $collection;