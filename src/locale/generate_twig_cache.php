<?php

/** Copiado de: https://twig-extensions.readthedocs.io/en/latest/i18n.html */

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

require __DIR__ . '/../vendor/autoload.php';

$viewDir = __DIR__ . '/../View';
$cacheDir = __DIR__ . '/../View/cache';
$loader = new FilesystemLoader($viewDir);

$twig = new Environment($loader, [
    'cache' => $cacheDir,
    'auto_reload' => true,
]);
$twig->addExtension(new Twig_Extensions_Extension_I18n());

/** @var SplFileInfo $file */
foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($viewDir), RecursiveIteratorIterator::LEAVES_ONLY) as $file) {
    if ($file->isFile()) {
        $twig->loadTemplate(str_replace($viewDir.'/', '', $file));
    }
}
