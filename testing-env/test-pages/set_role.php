<?php

session_start();

print_r($_SESSION);

print_r($_POST);

echo $_POST['button_toggle'];

if (isset($_SESSION['role_mode'])) {

    $_SESSION['role_mode'] = $_POST['button_toggle'];
    echo $_SESSION['role_mode'];
}

header('Location: hr-home.php');

?>