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
        /** @var RoutesExtractorInterface $object */
        $requestContext = $object->getContext();
        return [
            'base_url' => $requestContext->getBaseUrl(),
            'routes' => $this->normalizer->normalize($object->getRoutes(), $format, $context),
            'host' => $requestContext->getHost(),
            'scheme' => $requestContext->getScheme(),
        ];
    }
}
