<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit498d7330f819465c216895a0d2c435e8
{
    public static $prefixLengthsPsr4 = array (
        'C' => 
        array (
            'Cowsayphp\\' => 10,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Cowsayphp\\' => 
        array (
            0 => __DIR__ . '/..' . '/alrik11es/cowsayphp/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit498d7330f819465c216895a0d2c435e8::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit498d7330f819465c216895a0d2c435e8::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
