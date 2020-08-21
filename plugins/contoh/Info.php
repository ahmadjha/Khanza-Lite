<?php
return [
    'name'          =>  'Contoh',
    'description'   =>  'Modul contoh saja',
    'author'        =>  'Basoro',
    'version'       =>  '1.0',
    'compatibility' =>  '3.*',
    'icon'          =>  'code', // Icon from https://fontawesome.com/v4.7.0/icons/

    // Registering page for possible use as a homepage
    //'pages'            =>  ['Sample Page' => 'sample'],

    'install'       =>  function () use ($core) {
    },
    'uninstall'     =>  function () use ($core) {
    }
];
