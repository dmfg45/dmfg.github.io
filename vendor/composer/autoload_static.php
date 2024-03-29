<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit801b2f3b965680f177f8a587450844b5
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Stripe\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Stripe\\' => 
        array (
            0 => __DIR__ . '/..' . '/stripe/stripe-php/lib',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit801b2f3b965680f177f8a587450844b5::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit801b2f3b965680f177f8a587450844b5::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
