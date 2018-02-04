<?php

/*
 * This file is part of the 4devs Serialiser package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FDevs\JsRouting\Extractor;

use Symfony\Component\Routing\Route;

interface ExposedInterface
{
    /**
     * @param Route  $route
     * @param string $name
     *
     * @return bool
     */
    public function isRouteExposed(Route $route, string $name): bool;
}
