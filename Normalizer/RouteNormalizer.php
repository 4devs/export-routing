<?php

/*
 * This file is part of the 4devs Serialiser package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FDevs\JsRouting\Normalizer;

use Symfony\Component\Routing\CompiledRoute;
use Symfony\Component\Routing\Route;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;

class RouteNormalizer implements ContextAwareNormalizerInterface
{
    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null, array $context = [])
    {
        return $data instanceof Route;
    }

    /**
     * {@inheritdoc}
     */
    public function normalize($route, $format = null, array $context = [])
    {
        /** @var CompiledRoute $compiledRoute */
        /** @var Route $route */
        $compiledRoute = $route->compile();
        $defaults = array_intersect_key(
            $route->getDefaults(),
            array_fill_keys($compiledRoute->getVariables(), null)
        );

        if (empty($defaults['_locale']) && !empty($context['_locale']) && in_array('_locale', $compiledRoute->getVariables())) {
            $defaults['_locale'] = $context['_locale'];
        }

        return [
            'tokens' => $compiledRoute->getTokens(),
            'defaults' => $defaults,
            'requirements' => $route->getRequirements(),
            'hosttokens' => $compiledRoute->getHostTokens(),
            'methods' => $route->getMethods(),
            'schemes' => $route->getSchemes(),
        ];
    }
}
