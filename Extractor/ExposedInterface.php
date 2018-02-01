<?php

namespace FDevs\JsRouting\Extractor;

use Symfony\Component\Routing\Route;

interface ExposedInterface
{
    /**
     * @param Route $route
     * @param string $name
     * @return bool
     */
    public function isRouteExposed(Route $route, string $name): bool;
}
