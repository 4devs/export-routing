<?php

namespace FDevs\JsRouting\Encoder;

use Symfony\Component\Serializer\Encoder\ContextAwareEncoderInterface;
use Symfony\Component\Serializer\Encoder\JsonEncode;

class JsCallbackEncoder implements ContextAwareEncoderInterface
{
    public const CONTEXT_KEY = 'callback';
    private const FORMAT = 'js';

    /**
     * @var JsonEncode
     */
    protected $encodingImpl;

    /**
     * JsCallbackEncoder constructor.
     * @param JsonEncode $encodingImpl
     */
    public function __construct(JsonEncode $encodingImpl = null)
    {
        $this->encodingImpl = $encodingImpl ?? new JsonEncode();
    }

    /**
     * {@inheritdoc}
     */
    public function supportsEncoding($format, array $context = array())
    {
        return self::FORMAT === $format && isset($context[self::CONTEXT_KEY]);
    }

    /**
     * {@inheritdoc}
     */
    public function encode($data, $format, array $context = array())
    {
        return sprintf("%s(%s);", $context[self::CONTEXT_KEY], $this->encodingImpl->encode($data, self::FORMAT, $context));
    }
}
