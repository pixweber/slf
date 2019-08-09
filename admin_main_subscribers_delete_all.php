<?php
    
session_start();

if (!isset($_SESSION['password']))
    header('location: admin.php');

$files = array_diff(scandir('subs/'), array('.', '..'));
for ($i = 0; $i < count($files); $i++)
{
    unlink('subs/' . $files[$i + 2]);
}

header('location: admin_main_subscribers.php');

?>