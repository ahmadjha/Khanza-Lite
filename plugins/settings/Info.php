<?php

return [
    'name'          =>  'Pengaturan',
    'description'   =>  'Pengelolaan pengaturan',
    'author'        =>  'Basoro.ID',
    'version'       =>  '1.0',
    'compatibility' =>  '2021',
    'icon'          =>  'wrench',

    'install'       =>  function () use ($core) {
        $core->db()->pdo()->exec("CREATE TABLE IF NOT EXISTS `mlite_settings` (
            `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `module` text,
            `field` text,
            `value` text
        ) ENGINE=MyISAM DEFAULT CHARSET=utf8;");

        $core->db()->pdo()->exec("INSERT INTO `mlite_settings` (`module`, `field`, `value`) VALUES ('settings', 'logo', 'uploads/settings/logo.png')");
        $core->db()->pdo()->exec("INSERT INTO `mlite_settings` (`module`, `field`, `value`) VALUES ('settings', 'nama_instansi', 'RS Masa Kini')");
        $core->db()->pdo()->exec("INSERT INTO `mlite_settings` (`module`, `field`, `value`) VALUES ('settings', 'alamat', 'Jl. Perintis Kemerdekaan 45')");
        $core->db()->pdo()->exec("INSERT INTO `mlite_settings` (`module`, `field`, `value`) VALUES ('settings', 'kota', 'Barabai')");
        $core->db()->pdo()->exec("INSERT INTO `mlite_settings` (`module`, `field`, `value`) VALUES ('settings', 'propinsi', 'Kalimantan Selatan')");
        $core->db()->pdo()->exec("INSERT INTO `mlite_settings` (`module`, `field`, `value`) VALUES ('settings', 'nomor_telepon', '0812345678')");
        $core->db()->pdo()->exec("INSERT INTO `mlite_settings` (`module`, `field`, `value`) VALUES ('settings', 'email', 'info@mlite.org')");
        $core->db()->pdo()->exec("INSERT INTO `mlite_settings` (`module`, `field`, `value`) VALUES ('settings', 'website', 'https://mlite.org')");
        $core->db()->pdo()->exec("INSERT INTO `mlite_settings` (`module`, `field`, `value`) VALUES ('settings', 'ppk_bpjs', '010101')");
        $core->db()->pdo()->exec("INSERT INTO `mlite_settings` (`module`, `field`, `value`) VALUES ('settings', 'footer', 'Copyright {?=date(\"Y\")?} &copy; by drg. F. Basoro. All rights reserved.')");
        $core->db()->pdo()->exec("INSERT INTO `mlite_settings` (`module`, `field`, `value`) VALUES ('settings', 'homepage', 'main')");
        $core->db()->pdo()->exec("INSERT INTO `mlite_settings` (`module`, `field`, `value`) VALUES ('settings', 'igd', '1')");
        $core->db()->pdo()->exec("INSERT INTO `mlite_settings` (`module`, `field`, `value`) VALUES ('settings', 'laboratorium', '1')");
        $core->db()->pdo()->exec("INSERT INTO `mlite_settings` (`module`, `field`, `value`) VALUES ('settings', 'pj_laboratorium', '1')");
        $core->db()->pdo()->exec("INSERT INTO `mlite_settings` (`module`, `field`, `value`) VALUES ('settings', 'radiologi', '1')");
        $core->db()->pdo()->exec("INSERT INTO `mlite_settings` (`module`, `field`, `value`) VALUES ('settings', 'pj_radiologi', '1')");
        $core->db()->pdo()->exec("INSERT INTO `mlite_settings` (`module`, `field`, `value`) VALUES ('settings', 'BpjsApiUrl', 'https://new-api.bpjs-kesehatan.go.id:8080/new-vclaim-rest/')");
        $core->db()->pdo()->exec("INSERT INTO `mlite_settings` (`module`, `field`, `value`) VALUES ('settings', 'BpjsConsID', '')");
        $core->db()->pdo()->exec("INSERT INTO `mlite_settings` (`module`, `field`, `value`) VALUES ('settings', 'BpjsSecretKey', '')");
        $core->db()->pdo()->exec("INSERT INTO `mlite_settings` (`module`, `field`, `value`) VALUES ('settings', 'timezone', '".date_default_timezone_get()."')");
        $core->db()->pdo()->exec("INSERT INTO `mlite_settings` (`module`, `field`, `value`) VALUES ('settings', 'theme', 'default')");
        $core->db()->pdo()->exec("INSERT INTO `mlite_settings` (`module`, `field`, `value`) VALUES ('settings', 'theme_admin', 'flatly')");
        $core->db()->pdo()->exec("INSERT INTO `mlite_settings` (`module`, `field`, `value`) VALUES ('settings', 'editor', 'wysiwyg')");
        $core->db()->pdo()->exec("INSERT INTO `mlite_settings` (`module`, `field`, `value`) VALUES ('settings', 'version', '2021-01-01 00:00:01')");
        $core->db()->pdo()->exec("INSERT INTO `mlite_settings` (`module`, `field`, `value`) VALUES ('settings', 'update_check', '0')");
        $core->db()->pdo()->exec("INSERT INTO `mlite_settings` (`module`, `field`, `value`) VALUES ('settings', 'update_changelog', '')");
        $core->db()->pdo()->exec("INSERT INTO `mlite_settings` (`module`, `field`, `value`) VALUES ('settings', 'update_version', '0')");
        $core->db()->pdo()->exec("INSERT INTO `mlite_settings` (`module`, `field`, `value`) VALUES ('settings', 'license', '')");

    },
    'uninstall'     =>  function () use ($core) {
    }
];
