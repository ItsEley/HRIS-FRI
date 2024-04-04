<?php
session_start();

if (!isset($_SESSION['role_mode'])) {

    $_SESSION['role_mode'] = 'HR';
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test | Session Toggle</title>
</head>

<body>

    <h1>Session toggle</h1>
    <div>
        <form action="set_role.php" method="post">
            <?php
            if ($_SESSION['role_mode'] == 'HR') {
                echo '<button name = "button_toggle" type = "submit" value = "EMP">Click here to toggle as Employee</button>';
            } else if ($_SESSION['role_mode'] == 'EMP') {
                echo '<button name = "button_toggle" type = "submit" value = "HR">Click here to toggle as HR</button>';
            }

            ?>
        </form>
    </div>

    <div>
        <?php
        print_r($_SESSION);


        if ($_SESSION['role_mode'] == 'HR') {

        ?>

            <h1> HERE IS YOUR DASHBORD FOR HR</h1>
            <div style = 'display:inline-flex'>
                <div style = "width:200px;height:150px">Box 1</div>
                <div style = "width:200px;height:150px">Box 2</div>
                <div style = "width:200px;height:150px">Box 3</div>
                <div style = "width:200px;height:150px">Box 4</div>

            </div>


        <?php
        } else if ($_SESSION['role_mode'] == 'EMP') {
        ?>

        <?php
        }
        ?>



    </div>

</body>

</html>