<?php

/*
 * This file is part of the 4devs Serialiser package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FDevs\JsRouting;

use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\RouteCollection;

interface RoutesExtractorInterface
{
    /**
     * @return RouteCollection
     */
    public function getRoutes(): RouteCollection;

    /**
     * @return RequestContext
     */
    public function getContext(): RequestContext;
}
