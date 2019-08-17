<?php
use App\Core\Database;
use App\Config;

/**
 * @param $index
 * @return int|mixed
 */
function GetDateByLIFOIndex($index) {
    $hours = array('9:30', '10:00', '10:30', '11:00',
        '11:20', '11:45', '12:10', '12:40',
        '13:00', '14:00', '14:30', '14:45',
        '15:00', '15:15', '15:40', '16:00',
        '16:25', '16:45', '17:00');

    if ($index > 200)
        return 0;
    else
    {
        return $hours[floor(($index - 1) / 10)];
    }
}

/**
 * @param $s
 * @return string
 */
function ReplaceSpecialCharacters($s) {
    return strtr($s, 
              'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
              'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
}

/**
 * @param $array
 * @return mixed
 */
function convert_array_to_json_input_value($array) {
    $json = json_encode($array);
    return str_replace('"','\'', $json);
}

/**
 * @param $string
 * @return mixed
 */
function convert_json_input_value_to_array($string) {
    // Normalize string to json format
    $json = str_replace('\'','"', $string);
    return json_decode($json);
}

/**
 * @return string
 */
function get_current_available_hour() {
    $database = new Database();

    $output_hour = Config::HOURS[0];

    foreach (Config::HOURS as $hour) {

        $database->query("SELECT COUNT(*) as `count` FROM appointments WHERE `hour` LIKE '$hour'");
        $database->execute();
        $count = (int)$database->single()['count'];

        if ( $count < 15) {
            $output_hour = $hour;
            break;
        }

    }

    return $output_hour;
}

/**
 * @return int
 */
function get_registrations_count() {
    $database = new Database();
    $database->query("SELECT count(*) as count FROM appointments");
    $database->execute();
    $result = $database->single();
    if (!$result) return 0;
    return (int)$result['count'];
}

/**
 * @param $url
 * @param $data
 */
function send_post_request($url, $data) {
    // use key 'http' even if you send the request to https://...
    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($data)
        )
    );
    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    if ($result === FALSE) {
        echo '<pre>';
        var_dump('Problems!');
        echo '</pre>';
        /* Handle error */
    }
}