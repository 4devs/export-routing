<?php

/*
 * This file is part of the 4devs Export Routing package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FDevs\ExportRouting;

use FDevs\ExportRouting\Extractor\ExposedInterface;
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
     *
     * @param RouterInterface  $router
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
    public function getRoutes(): RouteCollection
    {
        $routes = new RouteCollection();
        $collection = $this->router->getRouteCollection();
        foreach ($collection->all() as $name => $item) {
            if (true === $this->exposed->isRouteExposed($item, $name)) {
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
