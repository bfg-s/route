<?php

namespace Bfg\Route;

use Bfg\Route\Attributes\Domain;
use Bfg\Route\Attributes\Invokable;
use Bfg\Route\Attributes\Middleware;
use Bfg\Route\Attributes\Prefix;
use Bfg\Route\Attributes\RouteAttribute;
use Bfg\Route\Attributes\WebChannel;
use ReflectionClass;

/**
 * Class ClassRouteAttributes.
 * @package Bfg\Route
 */
class ClassRouteAttributes
{
    /**
     * @var ReflectionClass
     */
    private ReflectionClass $class;

    /**
     * ClassRouteAttributes constructor.
     * @param  ReflectionClass  $class
     */
    public function __construct(ReflectionClass $class)
    {
        $this->class = $class;
    }

    /**
     * @return string|null
     */
    public function prefix(): ?string
    {
        /** @var \Bfg\Route\Attributes\Prefix $attribute */
        if (! $attribute = $this->getAttribute(Prefix::class)) {
            return null;
        }

        return $attribute->prefix;
    }

    /**
     * @return string|null
     */
    public function domain(): ?string
    {
        /** @var \Bfg\Route\Attributes\Domain $attribute */
        if (! $attribute = $this->getAttribute(Domain::class)) {
            return null;
        }

        return $attribute->domain;
    }

    /**
     * @return array
     */
    public function middleware(): array
    {
        /** @var \Bfg\Route\Attributes\Middleware $attribute */
        if (! $attribute = $this->getAttribute(Middleware::class)) {
            return [];
        }

        return $attribute->middleware;
    }

    /**
     * @return Invokable|false
     */
    public function invokable()
    {
        /** @var \Bfg\Route\Attributes\Invokable $attribute */
        if (! $attribute = $this->getAttribute(Invokable::class)) {
            return false;
        }

        return $attribute;
    }

    /**
     * @return WebChannel|false
     */
    public function channel()
    {
        /** @var \Bfg\Route\Attributes\WebChannel $attribute */
        if (! $attribute = $this->getAttribute(WebChannel::class)) {
            return false;
        }

        return $attribute;
    }

    /**
     * @param  string  $attributeClass
     * @return RouteAttribute|null
     */
    protected function getAttribute(string $attributeClass): ?RouteAttribute
    {
        $attributes = $this->class->getAttributes($attributeClass, \ReflectionAttribute::IS_INSTANCEOF);

        if (! count($attributes)) {
            return null;
        }

        return $attributes[0]->newInstance();
    }
}
