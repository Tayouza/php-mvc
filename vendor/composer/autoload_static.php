<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit707b1abca39cc6b717c2ecd21dc00f3e
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
            0 => __DIR__ . '/../..' . '/App',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit707b1abca39cc6b717c2ecd21dc00f3e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit707b1abca39cc6b717c2ecd21dc00f3e::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit707b1abca39cc6b717c2ecd21dc00f3e::$classMap;

        }, null, ClassLoader::class);
    }
}
