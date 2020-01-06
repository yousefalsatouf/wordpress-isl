<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>YOUSEF Theme</title>
    <?php
    wp_head(); //html head
    ?>
</head>

<body>
    <header>
        <div class="nav">
            <?php
            wp_nav_menu(
                array('theme_location', 'theme_yousef_nav_main')
            );
            ?>
        </div>
    </header>