<?php
    include 'lib/Session.php';
    Session::init();
	  include 'lib/Database.php';
    include 'helpers/Format.php';

	spl_autoload_register(function($class){
		include_once "classes/".$class.".php";
	});

	$db = new Database();
	$fm = new Format();
	$ev = new Event();
	$user = new User();	


?>
<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
  header_remove();
?>
<!DOCTYPE php>
<head>
<title>Event Management System</title>
<meta http-equiv="Content-Type" content="text/php; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<link href="css/menu.css" rel="stylesheet" type="text/css" media="all"/>
<script src="js/jquerymain.js"></script>
<script src="js/script.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script> 
<script type="text/javascript" src="js/nav.js"></script>
<script type="text/javascript" src="js/move-top.js"></script>
<script type="text/javascript" src="js/easing.js"></script> 
<script type="text/javascript" src="js/nav-hover.js"></script>
<link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
<script type="text/javascript">
  $(document).ready(function($){
    $('#dc_mega-menu-orange').dcMegaMenu({rowItems:'4',speed:'fast',effect:'fade'});
  });
  </script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script type="text/javascript">
  //
        $(document).ready(function () {
            $("#live_search").keyup(function () {
                var query = $(this).val();
                if (query != "") {
                    $.ajax({
                        url: './classes/Search.php',
                        method: 'POST',
                        data: {
                            query: query
                        },
                        success: function (data) {
                            $('#search_result').html(data);
                            $('#search_result').css('display', 'block');
                            $("#search_result li").click(function() {
                                 var value = $(this).html();
                                 $('#live_search').val(value);                                
                                 $('#search_result').css('display', 'none');                            
                            });
                        }
                    });
                } else {
                    $('#search_result').css('display', 'none');
                }
            });
        });
    </script>
<style>
    .ullist{
            padding-left:190px;
            margin-bottom:20px;
            width:635px;
            margin-top:-15px;
			margin-left: auto;
			margin-right: auto;
    }
  </style>

<style>
#overlay {
  position: fixed;
  display: none;
  width: 20%;
  height: 20%;
 
  background-color: rgba(0,0,0,0.5);
  z-index: 2;
  cursor: pointer;
}

#text{
  position: absolute;
  top: 50%;
  left: 50%;
  font-size: 50px;
  color: white;
  transform: translate(-50%,-50%);
  -ms-transform: translate(-50%,-50%);
}
</style>
</head>

<body>
<div class="wrap">
		<div class="header_top">
			<div class="logo">
				<a href="index.php"><img src="images/ems.png" alt="" /></a>
			</div>
			  <div class="header_top_right">
			    <div class="search_box">
        <form>
				    	<input type="text" class="form-control" id="live_search"  name="live_search" tabindex="1" value="Search for Events" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search for Events';}"><input type="submit" value="SEARCH">
				    </form>
			    </div>
				<?php
				 if (isset($_GET['userid'])) {
					Session::destroy();
					header("Location:index.php");
				 } 
				  ?>
          <div class="login">
	<?php
	$login = Session::get("userlogin");
	if ($login == false) { ?>
		<a href="login.php">Login</a>
	<?php } else { ?>
		<a href="?userid=<?php Session::get("userId")?>">Logout</a>
		<?php } ?>
		
		</div>
		  
		 <div class="clear"></div>
	 </div>
	 <div class="clear"></div>
 </div>
 <div id="overly">
					<div id="text"></div>
				<ul id="search_result" class="list-group ullist">
                     <li></li>  
					   </ul>
				</div>
<div class="menu">
	<ul id="dc_mega-menu-orange" class="dc_mm-orange">
	  <li><a href="index.php">Home</a></li>
	  <li><a href="events.php">Events</a> </li>
	  <li><a href="active_events.php">Active Events</a> </li>		  

	  <?php
	 	$login = Session::get("userlogin");
		if ($login == true) { ?>
			<li> <a href="profile.php">Profile</a> </li>
		<?php } ?>


	  <div class="clear"></div>
	</ul>
</div>
<script type='text/javascript'>
$("#live_search").on("keyup", function() {
  var search_term = $(this).val().trim(); // Trim the search term to remove leading/trailing spaces

  // If the search term is empty, clear all records
  if (search_term === "") {
    clearRecords();
  } else {
    // Perform the regular search operation
    $.ajax({
      url: "classes/Search.php",
      type: "POST",
      data: { search: search_term },
      success: function(data) {
        $("#overly").html(data);
      }
    });
  }
});

// Function to clear all records
function clearRecords() {
  $.ajax({
    url: "classes/Search.php", // Replace with the actual URL that handles clearing the records
    type: "POST", // Use POST or GET depending on your implementation
    data: { clear: true },
    success: function(response) {
      // Handle success response, if needed
      $("#overly").html(""); // Clear the table content on the page
    },
    error: function(xhr, status, error) {
      // Handle error, if needed
    }
  });
}
</script>