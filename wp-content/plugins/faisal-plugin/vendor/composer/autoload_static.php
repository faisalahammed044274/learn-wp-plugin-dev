<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit0bdf7123111e15c0df3d557fb2ed9d55
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Faisal\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Faisal\\' => 
        array (
            0 => __DIR__ . '/../..' . '/inc',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit0bdf7123111e15c0df3d557fb2ed9d55::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit0bdf7123111e15c0df3d557fb2ed9d55::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit0bdf7123111e15c0df3d557fb2ed9d55::$classMap;

        }, null, ClassLoader::class);
    }
}
