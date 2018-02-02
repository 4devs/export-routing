<?php

namespace FDevs\JsRouting\Normalizer;

use FDevs\JsRouting\RoutesExtractorInterface;
use Symfony\Component\Serializer\Encoder\NormalizationAwareInterface;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;

class RoutesExtractorNormalizer implements ContextAwareNormalizerInterface, NormalizationAwareInterface
{
    use NormalizerAwareTrait;

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null, array $context = array())
    {
        return $data instanceof RoutesExtractorInterface;
    }

    /**
     * {@inheritdoc}
     */
    public function normalize($object, $format = null, array $context = array())
    {
        $routes = [];
        /** @var RoutesExtractorInterface $object */
        foreach ($object->getRoutes() as $item) {
            $routes[] = $this->normalizer->normalize($item, $format, $context);
        }
        $requestContext = $object->getContext();
        return [
            'base_url' => $requestContext->getBaseUrl(),
            'routes' => $routes,
            'host' => $requestContext->getHost(),
            'scheme' => $requestContext->getScheme(),
        ];
    }
}
