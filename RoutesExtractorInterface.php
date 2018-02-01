<?php

namespace FDevs\JsRouting;

use Symfony\Component\Routing\RequestContext;

interface RoutesExtractorInterface
{
    /**
     * @return \Traversable
     */
    public function getRoutes(): \Traversable;

    /**
     * @return RequestContext
     */
    public function getContext(): RequestContext;
}