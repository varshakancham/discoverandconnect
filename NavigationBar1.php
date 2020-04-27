<?php
?>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Document</title>

    <link rel="stylesheet" href="style_navbar1.css">
    <link rel="stylesheet" href="style_searchbar.scss">
    <link rel="stylesheet" href="style_socialbuttons.scss">
    <script

    src="https://code.jquery.com/jquery-3.4.1.slim.min.js"

    integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8="

    crossorigin="anonymous"></script>

    <script>

    $(function() {

    $(".toggle").on("click", function() {

        if ($(".item").hasClass("active")) {

            $(".item").removeClass("active");

        } else {

            $(".item").addClass("active");

        }

    });

});

    </script>

</head>

<body>

    <nav>

        <ul class="menu" height = "90">

            <li class="logo"><a href="#">Discover&Connect</a></li>

            <li class="item">
            <object data="searchbar.php" width="375" height="90"> </object>
            </li>

            <li class = "item">
            <object data="navbuttons.php" width="420" height="90"> </object>
        </li>

        </ul>
        
    </nav>

    

</body>

</html>