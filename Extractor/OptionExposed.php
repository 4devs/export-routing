<?php

namespace FDevs\JsRouting\Extractor;

use Symfony\Component\Routing\Route;

class OptionExposed implements ExposedInterface
{
    /**
     * @var string
     */
    private $option;

    /**
     * OptionExposed constructor.
     * @param string $option
     */
    public function __construct(string $option = 'expose')
    {
        $this->option = $option;
    }

    /**
     * {@inheritdoc}
     */
    public function isRouteExposed(Route $route, string $name): bool
    {
        return true === $route->getOption($this->option);
    }
}
