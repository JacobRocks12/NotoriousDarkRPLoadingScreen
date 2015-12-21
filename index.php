<?php
$SteamAPIKey = "412EAA3ED576F8A5E6514AE43726316A";
$error_url = "http://" . $_SERVER[HTTP_HOST] . $_SERVER[REQUEST_URI];
$error_url_test = $error_url . "?steamid=76561198000430367";
$error_url_server = $error_url . "?steamid=%s";

if (!isset($_GET["steamid"])) {
	die("<img src='images/logo.png' style='margin-top: 20px;' /><br />Woops, you don't seem to be using the correct extension in the address bar to get the loading screen to work.<br />
	Please make sure it has the correct extension it should have ?steamid= at the end of it and look something like this: www.yourdomain.com/loading/index.php?steamid=%s<br /><br />

	You can use the link below which will automatically add a test steam id to see if your loading screen is configured properly<br />
	<a href='$error_url_test'>$error_url_test</a><br /><br />
	
	When setting your loading url please make sure you set the steam id to %s as shown in the link below<br />
	<a href='$error_url_server'>$error_url_server</a>
	
	");
}
$steamid64 = $_GET["steamid"];
$url = "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=" . $SteamAPIKey . "&steamids=" . $steamid64;
$json = file_get_contents($url);
$table2 = json_decode($json, true);
$table = $table2["response"]["players"][0];
?>
<!DOCTYPE HTML>
<html>
	<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="description" content="Welcome to Crystal Load - Crystal Blue Persuassion!" />
	<title>Crystal Load</title>
	<link href="style.css" rel="stylesheet" type="text/css" />
    <link href="colour.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="scripts/jquery.js"></script>
    <script type="text/javascript" src="scripts/cycle.js"></script>
    <script type="text/javascript">
	$(document).ready(function() {
		$('.audio').prop("volume", 0.3);
		$(window).resize(function(){
			  $('.core-wrapper').css({
			   position:'absolute',
			   left: ($(window).width() 
				 - $('.core-wrapper').outerWidth())/2,
			   top: ($(window).height() 
				 - $('.core-wrapper').outerHeight())/2
			  });	
		});
		$(window).resize();
		$('#background-scroll').cycle({ 
			fx: 'fade',
			pause: 0, 
			speed: 1800,
			timeout: 3500
		});
	});
    </script>
	</head>
	<body>
    <div id="background-scroll">
    	<?php
			$bg_folder = "backgrounds/";
			$bg_array = array_diff(scandir($bg_folder), array('..', '.'));
			foreach ($bg_array as $bg) {
			echo "<img src='backgrounds/" .$bg . "' class='background' />";
			}
		?>
   	</div>
    <div class="core-wrapper"><!-- Opens the wrapper so we can contain and center everything -->
    	
        <img src="images/logo.png" width="960" height="120" alt="Your Logo" /><!-- This adds in the logo, simply change logo.png to make this look different -->
    
    	<div id="left-items"><!-- Opens the wrapper for the left content, there isn't really much to change on the left side as it's dynamic -->
    
			<?php
				echo "<div id=\"profile-wrap\">";
					echo "<div id=\"profile-top\">";
						echo "<div id=\"avatarimg\">";
							echo "<img src=\"" . $table["avatarfull"] . "\" />";
						echo "</div>";
					echo "</div>";
					echo "<div id=\"profile-bottom\">";
						echo "<p>" . $table["personaname"] . "</p>";
					echo "</div>";
				echo "</div>";
            ?>
            <div class="clear"></div>
            <div class="title server">
            	<h2>Notorious DarkRP</h2>
           	</div>
            <ul id="server-list">
            	<li><img src="images/server-name.png" alt="Server Name" /> <span id="s-name">Notorious DarkRP</span></li>
                <li><img src="images/server-mode.png" alt="Game Mode" /> <span id="s-mode">DarkRP</span></li>
                <li><img src="images/server-map.png" alt="Map Name" /> <span id="s-map">rp_downtown_v4c_v2</span></li>
           	</ul>
     	</div>
        <div id="right-items">
            <div class="title">
            	<h2>Our Rules</h2>
           	</div>
            <ul id="rules">
            	<li><span>1</span> Be respecful to players and staff</li>
                <li><span>2</span> Do not be annoying</li>
                <li><span>3</span> Do not propkill</li>
                <li><span>4</span> Do not RDM</li>
                <li><span>5</span> Do not metagame</li>
                <li><span>6</span> Do not hack or exploit</li>
                <li><span>7</span> Do not micspam</li>
                <li><span>8</span> Do not kill players who are AFK</li>
                <li><span>9</span> Obey all staff orders</li>
                <li><span>10</span> Thanks, and have fun!</li>
            </ul>
      	</div>
        <div class="clear"></div>
        <div id="bar">
        	<div id="bar-width" style="width: 0%;"></div>
       	</div>
        <div id="percentage">
        	<p></p>
       	</div>
        <div id="download-item">
        	<p>Connecting...</p>
      	</div>
    </div>
    <script type="text/javascript" src="scripts/main.js"></script>
	</body>
</html>
