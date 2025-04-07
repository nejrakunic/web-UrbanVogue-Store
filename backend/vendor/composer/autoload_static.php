<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit26028881abed911292e3ab259ec7252a
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/services',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit26028881abed911292e3ab259ec7252a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit26028881abed911292e3ab259ec7252a::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit26028881abed911292e3ab259ec7252a::$classMap;

        }, null, ClassLoader::class);
    }
}
