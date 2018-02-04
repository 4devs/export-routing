<?php

/*
 * This file is part of the 4devs Export Routing package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FDevs\ExportRouting\Normalizer;

use FDevs\ExportRouting\RoutesExtractorInterface;
use Symfony\Component\Serializer\Normalizer\ContextAwareNormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;

class RoutesExtractorNormalizer implements ContextAwareNormalizerInterface, NormalizerAwareInterface
{
    use NormalizerAwareTrait;

    /**
     * {@inheritdoc}
     */
    public function supportsNormalization($data, $format = null, array $context = [])
    {
        return $data instanceof RoutesExtractorInterface;
    }

    /**
     * {@inheritdoc}
     */
    public function normalize($object, $format = null, array $context = [])
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
