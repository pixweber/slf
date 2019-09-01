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
        '09h30', '10h00', '10h30', '11h00',
        '11h20', '11h45', '12h10', '12h40',
        '13h00', '14h00', '14h30', '14h45',
        '15h00', '15h15', '15h40', '16h00',
        '16h25', '16h45', '17h00'
    );

    const SITE_URL = 'https://dev.inscriptionpolesimonlefranc.org';
    
    const SMTP_SERVER = 'in-v3.mailjet.com';
    const SMTP_USERNAME = '012ee40091916628ec08ddfda1b51481';
    const SMTP_PASSWORD = '136515a81cfb2cf37957192e18258022';
    const SMTP_SECURE = 'tls';
    const SMTP_PORT = '587';
    CONST SMTP_SENDER_NAME = 'Pôle Simon le Franc';
    CONST SMTP_FROM = 'contact@inscriptionpolesimonlefranc.org';
    CONST SMTP_REPLY_TO = 'contact@inscriptionpolesimonlefranc.org';
}