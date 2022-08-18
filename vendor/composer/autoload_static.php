<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc33fb71d1d2b4c8d773cf4b820f289f6
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Src\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Src\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc33fb71d1d2b4c8d773cf4b820f289f6::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc33fb71d1d2b4c8d773cf4b820f289f6::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc33fb71d1d2b4c8d773cf4b820f289f6::$classMap;

        }, null, ClassLoader::class);
    }
}