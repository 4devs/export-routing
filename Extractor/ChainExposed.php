<?php

/*
 * This file is part of the 4devs Export Routing package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FDevs\ExportRouting\Extractor;

use Symfony\Component\Routing\Route;

class ChainExposed implements ExposedInterface
{
    /**
     * @var ExposedInterface[]|iterable
     */
    private $exposed;

    /**
     * ChainExposed constructor.
     *
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
