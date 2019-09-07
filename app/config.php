<?php
namespace App;

class Config {
    const DB_HOST = 'dallardttfbenjam.mysql.db';
    const DB_NAME = 'dallardttfbenjam';
    const DB_USER = 'dallardttfbenjam';
    const DB_PASSWORD = 'Ninilidu94';
    const DB_TYPE = 'mysqli';
    const DB_PORT = '3306';
    const HOURS = array(
        array(
            'hour' => '09h00',
            'slots' => 7
        ),
        array(
            'hour' => '09h30',
            'slots' => 7
        ),
        array(
            'hour' => '10h00',
            'slots' => 7
        ),
        array(
            'hour' => '10h30',
            'slots' => 7
        ),
        array(
            'hour' => '11h00',
            'slots' => 7
        ),
        array(
            'hour' => '11h30',
            'slots' => 7
        ),
        array(
            'hour' => '12h00',
            'slots' => 7
        ),
        array(
            'hour' => '12h30',
            'slots' => 7
        ),
        array(
            'hour' => '13h00',
            'slots' => 7
        ),
        array(
            'hour' => '14h00',
            'slots' => 15
        ),
        array(
            'hour' => '14h30',
            'slots' => 15
        ),
        array(
            'hour' => '15h00',
            'slots' => 15
        ),
        array(
            'hour' => '15h30',
            'slots' => 15
        ),
        array(
            'hour' => '16h00',
            'slots' => 15
        ),
        array(
            'hour' => '16h30',
            'slots' => 15
        ),
        array(
            'hour' => '17h00',
            'slots' => 15
        ),
        array(
            'hour' => '17h30',
            'slots' => 32
        )
    );

    const SITE_URL = 'https://dev.inscriptionpolesimonlefranc.org';
    
    const SMTP_SERVER = 'in-v3.mailjet.com';
    const SMTP_USERNAME = '012ee40091916628ec08ddfda1b51481';
    const SMTP_PASSWORD = '136515a81cfb2cf37957192e18258022';
    const SMTP_SECURE = 'tls';
    const SMTP_PORT = '587';
    const SMTP_SENDER_NAME = 'Pôle Simon le Franc';
    const SMTP_FROM = 'contact@inscriptionpolesimonlefranc.org';
    const SMTP_REPLY_TO = 'contact@inscriptionpolesimonlefranc.org';
    const REGISTRATION_LIMIT = 200;
    const REGISTRATION_START = '2019-09-04 19:00';
}