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
     * @var bool
     */
    private $abstain;

    /**
     * ChainExposed constructor.
     *
     * @param ExposedInterface[]|iterable $exposed
     * @param bool                        $abstain
     */
    public function __construct(iterable $exposed = [], bool $abstain = false)
    {
        $this->exposed = $exposed;
        $this->abstain = $abstain;
    }

    /**
     * {@inheritdoc}
     */
    public function isRouteExposed(Route $route, string $name): ?bool
    {
        $support = false;
        foreach ($this->exposed as $item) {
            $support = $item->isRouteExposed($route, $name);
            if (false === $support) {
                break;
            }
        }

        return $support ?? $this->abstain;
    }
}
