<?php
    
function GetDateByLIFOIndex($index)
{
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

function ReplaceSpecialCharacters($s)
{
    return strtr($s, 
              'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
              'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
}

?>