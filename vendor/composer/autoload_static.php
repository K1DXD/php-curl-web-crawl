<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc5b71a6015fa9fdb59d087c38ee19c14
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
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitc5b71a6015fa9fdb59d087c38ee19c14::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc5b71a6015fa9fdb59d087c38ee19c14::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc5b71a6015fa9fdb59d087c38ee19c14::$classMap;

        }, null, ClassLoader::class);
    }
}