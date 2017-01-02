<?php
use Lilly\Core\Template as Template;

$tempBlocks = new Template\TemplateBlocks(
    array(
        'header' => 'header',
        'sidebar' => 'sidebar',
        ':view' => 'app',
        'footer' => 'footer'
    ),
    array(
        'css' => array(
            'normalize' => CSS . 'normalize.css',
            'fontawsome' => CSS . 'fawsome.min.css',
            'gicons' => CSS . 'googleicons.css',
            'jqueryui' => CSS . 'jquery-ui.min.css',
            'main' => CSS . 'main.css',
            'select' => CSS . 'select.css'
        ),
        'js' => array(
            'modernizr' => JS . 'vendor/modernizr-2.6.2.min.js'
        )
    ),
    array(
        'js' => array(
            'jquery' => JS . 'vendor/jquery-1.10.2.min.js',
            'jqueryui' => JS . 'jquery.ui.min.js',
            'plugins' => JS . 'plugins.js',
            'select' => JS . 'select.js',
            'main' => JS . 'main.js',
            'header' => JS . 'header.js'
        )
    ));