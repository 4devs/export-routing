<?php
$collection = new \Symfony\Component\Routing\RouteCollection();

$collection->add('homepage', new \Symfony\Component\Routing\Route('/'));
$collection->add('api', new \Symfony\Component\Routing\Route('/api', [], [], ['expose' => true]));
$collection->add('security', new \Symfony\Component\Routing\Route('/security', [], [], ['expose' => false]));

return $collection;