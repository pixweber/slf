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

function get_current_available_hour() {
    $database = new Database();
    $database->query("SELECT `hour`, count(hour) as hours_count FROM appointments
                            GROUP BY `hour`
                            HAVING hours_count <= 15
                            ORDER BY hour ASC");
    $database->execute();
    $result = $database->single();

    echo '<pre>';
    var_dump($result);
    echo '</pre>';

    $output = '09h30';

    if ( isset($result['hours_count']) && (int)$result['hours_count'] < 15 ) {
        $output = $result['hour'];
    }

    if ( isset($result['hours_count']) && (int)$result['hours_count'] >= 15 ) {
        $current_item_key = array_search($result['hour'], Config::HOURS);
        $next_hour = Config::HOURS[$current_item_key + 1];
        $output = $next_hour;
    }

    return $output;
}