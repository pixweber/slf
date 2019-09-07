<?php
namespace App;

class Config {
    const DB_HOST = 'localhost';
    const DB_NAME = 'dbname';
    const DB_USER = 'dbuser';
    const DB_PASSWORD = 'dbpassword';
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
    
    const SMTP_SERVER = 'smtp_server';
    const SMTP_USERNAME = 'smtp_username';
    const SMTP_PASSWORD = 'smtp_password';
    const SMTP_SECURE = 'tls';
    const SMTP_PORT = '587';
    const SMTP_SENDER_NAME = 'Pôle Simon le Franc';
    const SMTP_FROM = 'contact@inscriptionpolesimonlefranc.org';
    const SMTP_REPLY_TO = 'contact@inscriptionpolesimonlefranc.org';
    const REGISTRATION_LIMIT = 200;
    const REGISTRATION_START = '2019-09-04 19:00';
}