

<head>
<title>NavBar</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" href="style_NavBar.scss">
<!-- <link rel="stylesheet" href="style_searchbar.scss">-->

	<!-- Javascript -->
    <!--
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="assets/js/jquery.Jcrop.js"></script>
	<script src="assets/js/jcrop_bits.js"></script>
    <script src="assets/js/bootstrap.js"></script>
	<script src="assets/js/bootbox.min.js"></script>
    <script src="assets/js/demo.js"></script>-->
	

	<!-- CSS -->
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
	<!--<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">-->
	<link rel="stylesheet" href="assets/css/jquery.Jcrop.css" type="text/css" />

<script src="https://kit.fontawesome.com/712a35edce.js" crossorigin="anonymous"></script>

<script
    src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
    integrity="sha256-pasqAKBDmFT4eHoN2ndd6lN370kFiGUFyTiUHWhU7k8="
    crossorigin="anonymous">
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

<!-- script for toggle button -->
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





    <nav>
    <ul class="menu" height = "90">
        <li class="logo"><a href="#">Discover&Connect</a></li>
        <li class="item button">
        <form class="search-form" action="search.php">
            <input type="text"  name="q" placeholder="Search" class="search-input"
            onkeyup="getLiveSearchUsers(this.value, '<?php echo $userLoggedIn; ?>')"
            id="search_text_input"
            autocomplete="off"
            >
            <button type="submit" class="search-button" id="button_holder">
                <svg class="bi bi-search" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M10.442 10.442a1 1 0 011.415 0l3.85 3.85a1 1 0 01-1.414 1.415l-3.85-3.85a1 1 0 010-1.415z" clip-rule="evenodd"/>
                <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 100-11 5.5 5.5 0 000 11zM13 6.5a6.5 6.5 0 11-13 0 6.5 6.5 0 0113 0z" clip-rule="evenodd"/>
                </svg>
            </button>
        </form>    
        </li>
        <li class ="item "><a href=""><i class="fa fa-user"></i></a><p class = "navmsg">Profile</p></li>
        <!--<li class ="item "><a href=""><i class="fa fa-comment-alt"></i></a><p class = "navmsg">Messages</p></li>-->
        <li class ="item "><a href=""><i class="fa fa-user-friends"></i></a><p class = "navmsg">Friends</p></li>
        <li class ="item"><a href=""><i class="fa fa-bell"></i></a><p class = "navmsg">Notifications</p></li>
        <li class ="item "><a href=""><i class="fa fa-cog"></i></a><p class = "navmsg">Settings</p></li>
        <li class ="item"><a href="logout.php"><i class="fa fa-power-off"></i></a><p class = "navmsg">Logout</p></li>
        <li class = "toggle"><a href="#"> <span class="bars"> </span> </a></li>

    </ul>

    </nav>
    