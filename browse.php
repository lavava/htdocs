<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
session_start();
if(!isset($_SESSION['status'])||$_SESSION['status']!='authorized'){
	$_SESSION['status']='unauth';
	$_SESSION['username']='Guest';
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<title>artists.net</title>
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquery.dropotron-1.0.js"></script>	
		<script type="text/javascript" src="js/jquery.slidertron-1.0.js"></script>
		<script type="text/javascript" src="js/jquery.poptrox-1.0.js"></script>
			<script type="text/javascript">
			$(document).ready(function () {
			$('#signin-link').click(function () {
					if ($('#signin-dropdown').is(":visible")) {
						$('#signin-dropdown').hide()
						$('#session').removeClass('active');
					} else {
						$('#signin-dropdown').show()
						$('#session').addClass('active');
					}
					return false;
				});
				$('#signin-dropdown').click(function(e) {
					e.stopPropagation();
				});
			$(document).click(function() {
					$('#signin-dropdown').hide();
					$('#session').removeClass('active');
				});
			});     
		</script>

		
	</head>
	<body>
		<div id="outer">
		
			<div id="logo">
				<h1><a href="index.php">artists<span>.net</span></a></h1>
			</div>
		
				
			<ul id="nav">
				<li>
					<a href="index.php" id="item">Home</a>
				</li>
				<li class="first active">
					<a href="browse.php" id="item">Browse</a>
				</li>				
				<li>
					<a href="about.php" id="item">About</a>
				</li>
				<?php
				if($_SESSION['username']!='Guest'){
				echo'
				<li>
					<a href="logout.php" id="item">Logout</a>
				</li>					
				<li class="user_name">
					 Hello '.$_SESSION['username'].'! 
				</li>
				<li style="float:right" >
					<a href="user_home.php">Home<a>
				</li>
				';
				}
				else{
				
				echo 
				'<li class="active-links">
      				<div id="session">
						<a id="signin-link" href="#">Login</a>
					</div>
				  <div id="login-content">
	        		  <div id="signin-dropdown">
							  <form method="post" class="signin" action="login.php">
								<fieldset class="textbox">
								<label class="username">
								<span>Username or email</span>
								<input id="username" name="username" value="" type="text" autocomplete="on">
								</label>
								
								<label class="password">
								<span>Password</span>
								<input id="password" name="password" value="" type="password">
								</label>
								</fieldset>
								
								<fieldset class="remb">
								<label class="remember">
								<input type="checkbox" value="1" name="remember_me" />
								<span>Remember me</span>								</label>
								<button class="submit button" type="submit">Sign in</button>
								</fieldset>
								<p>
								<a class="forgot" href="#">Forgot your password</a>
								<br>
								<a class="register" href="register.php">Don\'t have an account? Register!</a>								</p>
							  </form>
					  </div>
       			  </div>                     
    			
				</li>';	
				}
			
				?>
			</ul>

	
				
		
		<!-- ****************************************************************************************************************** -->			

				
		<div id="main">
			
				<ul class="gallery">
				
					<li>
						<h3>1</h3>
						<a href="images/paintings/beach.jpg"><img class="top" src="images/paintings/beach.jpg" width="260" height="200" title="Beach" alt="" /></a>
					</li>

					<li>
						<h3>2</h3>
						<a href="images/paintings/bear.jpg"><img class="top" src="images/paintings/bear.jpg" width="260" height="200" title="Bear" alt="" /></a>
					</li>

					<li>
						<h3>3</h3>
						<a href="images/paintings/bench.jpg"><img class="top" src="images/paintings/bench.jpg" width="260" height="200" title="Bench" alt="" /></a>
					</li>

					<li>
						<h3>4</h3>
						<a href="images/paintings/horse.jpg"><img class="top" src="images/paintings/horse.jpg" width="260" height="200" title="Horse" alt="" /></a>
					</li>

					<li>
						<h3>5</h3>
						<a href="images/paintings/island.jpg"><img class="top" src="images/paintings/island.jpg" width="260" height="200" title="Island" alt="" /></a>
					</li>

					<li>
						<h3>6</h3>
						<a href="images/paintings/lane.jpg"><img class="top" src="images/paintings/lane.jpg" width="260" height="200" title="Lane" alt="" /></a>
					</li>

					<li>
						<h3>7</h3>
						<a href="images/paintings/monalisa.jpg"><img class="top" src="images/paintings/monalisa.jpg" width="260" height="200" title="Monalisa" alt="" /></a>
					</li>

					<li>
						<h3>8</h3>
						<a href="images/paintings/village.jpg"><img class="top" src="images/paintings/village.jpg" width="260" height="200" title="Village" alt="" /></a>
					</li>
					
					<li>
						<h3>9</h3>
						<a href="images/paintings/whale.jpg"><img class="top" src="images/paintings/whale.jpg" width="260" height="200" title="Whale" alt="" /></a>
					</li>				
					
				</ul>

				<br class="clear" />
				
			</div>
		</div>
		<div id="copyright">
			Akash Goel<br>
			Anmol Singh Jaggi<br />
			Aditya Rajan Tigga
		</div>
		
		<script type="text/javascript">
			$('#nav').dropotron();
		</script>	
		
			<script type="text/javascript">
				$('.gallery').poptrox({
					overlayColor: '#222222',
					overlayOpacity: 0.75,
					popupCloserText: 'Close',
					usePopupCaption: true,
					usePopupDefaultStyling: false
				});
			</script>
			
	</body>
</html>
