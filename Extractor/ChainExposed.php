<?php

namespace FDevs\JsRouting\Extractor;

use Symfony\Component\Routing\Route;

class ChainExposed implements ExposedInterface
{
    /**
     * @var ExposedInterface[]|iterable
     */
    private $exposed;

    /**
     * ChainExposed constructor.
     * @param ExposedInterface[]|iterable $exposed
     */
    public function __construct(iterable $exposed = [])
    {
        $this->exposed = $exposed;
    }

    /**
     * {@inheritdoc}
     */
    public function isRouteExposed(Route $route, string $name): bool
    {
        $support = false;
        foreach ($this->exposed as $item) {
            if ($item->isRouteExposed($route, $name)) {
                $support = true;
                break;
            }
        }

        return $support;
    }
}
