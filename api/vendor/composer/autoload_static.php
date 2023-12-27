<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5e8cb49e240b0ac94a30754da4b52733
{
    public static $prefixLengthsPsr4 = array (
        'Y' => 
        array (
            'YogeshKoli\\UserIP\\' => 18,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'YogeshKoli\\UserIP\\' => 
        array (
            0 => __DIR__ . '/..' . '/yogeshkoli/user-ip/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit5e8cb49e240b0ac94a30754da4b52733::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit5e8cb49e240b0ac94a30754da4b52733::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit5e8cb49e240b0ac94a30754da4b52733::$classMap;

        }, null, ClassLoader::class);
    }
}
