<?php

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
