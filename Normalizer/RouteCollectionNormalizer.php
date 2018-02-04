<?php

namespace FDevs\JsRouting\Normalizer;

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;

class RouteCollectionNormalizer implements ContextAwareNormalizerInterface, NormalizerAwareInterface
{
    use NormalizerAwareTrait;

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null, array $context = array())
    {
        return $data instanceof RouteCollection;
    }

    /**
     * {@inheritdoc}
     */
    public function normalize($object, $format = null, array $context = array())
    {
        /** @var RouteCollection $object */
        $routes = [];
        foreach ($object->all() as $name => $item) {
            $routes[$name] = $this->normalizer->normalize($item, $format, $context);
        }

        return $routes;
    }
}