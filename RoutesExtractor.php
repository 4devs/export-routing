<?php

namespace FDevs\JsRouting;


use FDevs\JsRouting\Extractor\ExposedInterface;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\RouterInterface;

class RoutesExtractor implements RoutesExtractorInterface
{
    /**
     * @var RouterInterface
     */
    private $router;

    /**
     * @var ExposedInterface
     */
    private $exposed;

    /**
     * RoutesExtractor constructor.
     * @param RouterInterface $router
     * @param ExposedInterface $exposed
     */
    public function __construct(RouterInterface $router, ExposedInterface $exposed)
    {
        $this->router = $router;
        $this->exposed = $exposed;
    }

    /**
     * {@inheritdoc}
     */
    public function getRoutes(): \Traversable
    {
        $routes = new RouteCollection();
        $collection = $this->router->getRouteCollection();
        foreach ($collection as $name => $item) {
            if ($this->exposed->isRouteExposed($item, $name)) {
                $routes->add($name, $item);
            }
        }

        return $routes;
    }

    /**
     * {@inheritdoc}
     */
    public function getContext(): RequestContext
    {
        return $this->router->getContext();
    }
}