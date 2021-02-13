<?php

namespace Bfg\Route;

use Illuminate\Routing\Router;
use Illuminate\Support\Arr;
use ReflectionAttribute;
use ReflectionClass;
use Bfg\Route\Attributes\Route;
use Bfg\Route\Attributes\RouteAttribute;
use SplFileInfo;
use Symfony\Component\Finder\Finder;
use Throwable;

/**
 * Class RouteRegistrar
 * @package Bfg\Route
 */
class RouteRegistrar
{
    /**
     * @var \Illuminate\Routing\Route|\Illuminate\Routing\RouteRegistrar
     */
    public $route;

    /**
     * RouteRegistrar constructor.
     * @param  \Illuminate\Routing\Route|\Illuminate\Routing\RouteRegistrar  $router
     */
    public function __construct(
        private $router
    ) {}

    /**
     * Register directory/s witch controller classes
     * @param  string|array  $directories
     * @throws \ReflectionException
     */
    public function registerDirectory(string|array $directories): void
    {
        $directories = Arr::wrap($directories);

        $files = (new Finder())->files()->name('*.php')->in($directories);

        collect($files)->each(fn(SplFileInfo $file) => $this->registerFile($file));
    }

    /**
     * Register controller file
     * @param  string|SplFileInfo  $path
     * @throws \ReflectionException
     */
    public function registerFile(string|SplFileInfo $path): void
    {
        if (is_string($path)) {
            $path = new SplFileInfo($path);
        }

        if (\Str::is('*.php', $path->getRealPath())) {

            $this->registerClass(
                class_in_file($path->getRealPath())
            );
        }
    }

    /**
     * Register controller class
     * @param  string|null  $className
     * @throws \ReflectionException
     */
    public function registerClass(string $className = null): void
    {
        if (!$className || !class_exists($className)) {
            return;
        }

        $class = new ReflectionClass($className);

        $classRouteAttributes = new ClassRouteAttributes($class);

        foreach ($class->getMethods() as $method) {

            $attributes = $method->getAttributes(RouteAttribute::class, ReflectionAttribute::IS_INSTANCEOF);

            foreach ($attributes as $attribute) {
                try {
                    $attributeClass = $attribute->newInstance();
                } catch (Throwable) {
                    continue;
                }

                if (!$attributeClass instanceof Route) {
                    continue;
                }

                $action = $attributeClass->method === '__invoke'
                    ? $class->getName()
                    : [$class->getName(), $method->getName()];

                if ($attributeClass->method == 'any') {

                    /** @var \Illuminate\Routing\Route $route */
                    $route = $this->router->any(
                        $attributeClass->uri,
                        $action
                    );
                }

                else {

                    /** @var \Illuminate\Routing\Route $route */
                    $route = $this->router->match(
                        \Arr::wrap($attributeClass->method),
                        $attributeClass->uri,
                        $action
                    );
                }

                $route->name(static::generate_name($attributeClass->uri, $attributeClass->name));

                if ($domain = $classRouteAttributes->domain()) {

                    $route->domain($domain);
                }

                if ($prefix = $classRouteAttributes->prefix()) {

                    $route->prefix($prefix);
                }

                $route->middleware([
                    ...$classRouteAttributes->middleware(),
                    ...$attributeClass->middleware
                ]);

                $this->route = $route;
            }
        }
    }

    /**
     * Name generator
     * @param  string  $uri
     * @param  string|null  $name
     * @return string
     */
    public static function generate_name(string $uri, string $name = null)
    {
        return trim(
            ($name ? $name :
                (\Str::slug(str_replace('/', '.', $uri), '.') ?: 'home')),
            '.'
        );
    }
}
