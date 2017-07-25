<?php
/**
 * Created by PhpStorm.
 * User: hamid
 * Date: 1/3/17
 * Time: 4:11 PM
 */
return [
    /* identity values */

    'identity_hostname'       => env('IDENTITY_HOSTNAME', 'https://accounts.appson.ir'),
    'identity_app_key'        => env('IDENTITY_APP_KEY', 'Appson-Identity-App-Id:263BE671-6EEF-44F1-946A-3BF7C3BD9D0D'),
    'identity_app_key_mobile' => env('IDENTITY_APP_KEY_MOBILE', 'Appson-Identity-App-Id:9a01e0fc-2fc0-4741-9811-2ec82f3b49e0'),

    'identity_public_key' => env('IDENTITY_PUBLIC_KEY', '-----BEGIN PUBLIC KEY-----
MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAsohsmy4PQ/S1duiiwUGr
CdgRK29TgHZziLv31/JYLKW7nD03O8r64u/WjmVyA3rDXcPybcAnmnApOXEjUQXc
OEu7GfY12YI/fUT4LQHhxmOIXzqx3nleWLZdV3TDPXsfa5bcxzZqCKMEJxKItcFV
4pmNDyA0jfx6oan5zD3PC9bOJx10TXX/qYPNdjWaFIWcWcW4y4Uaqi0mqlsp6Bul
cofytzViRS92mwUK9F6S5SoIqWk9gIBOw0eU+2wxDBKiLej/uKegI2M/msZp4Qw2
BDdCGzFkoEUOYyTtjP29A28oPgBz2Kpnq2oQQUgY9mX2uCUNKAPZrL02DkTu+Yz8
/wIDAQAB
-----END PUBLIC KEY-----'),

    /* VAS services values */
    'MCI_server' => 'http://172.16.41.17:8080',
    'IMI_server' => 'http://172.16.41.18:8002',

    /* phone number patterns */
    'MCI_pattern' => '/^09[1,9]\d{8}$/',
    'MTN_pattern' => '/^09[0,3]\d{8}$/',
    'Rightel_pattern' => '/^092\d{8}$/',
];