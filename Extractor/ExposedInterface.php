<?php

/*
 * This file is part of the 4devs Export Routing package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FDevs\ExportRouting\Extractor;

use Symfony\Component\Routing\Route;

interface ExposedInterface
{
    /**
     * @param Route $route
     * @param string $name
     *
     * @return null|bool
     */
    public function isRouteExposed(Route $route, string $name): ?bool;
}
