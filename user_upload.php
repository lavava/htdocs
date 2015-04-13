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
		<title>Artists.net</title>
		<link rel="stylesheet" type="text/css" href="css/style.css" />
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/jquery.dropotron-1.0.js"></script>	
		<script type="text/javascript" src="js/jquery.slidertron-1.0.js"></script>
		<script type="text/javascript" src="js/jquery.poptrox-1.0.js"></script>
		<script type="text/javascript">
			$(document).ready(function () {
			$('#session').click(function () {
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
				<h1><a href="index.php">Artists<span>.net</span></a></h1>
			</div>
		
				
			<ul id="nav">
				<li>
					<a href="index.php" id="item">Home</a>
				</li>
				<li>
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
				<li style="float:right" class="first active">
					<a href="user_home.php">Home<a>
				</li>
				';
				}
				else{
				
				echo 
				'<li class="active-links">
      				<div id="session">
						<a id="signin-link" href="#">Artist Login</a>
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
								<a class="register" href="#">Don\'t have an account? Register!</a>								</p>
							  </form>
					  </div>
       			  </div>                     
    			
				</li>';	
				}
			
				?>
			</ul>


		<!-- ****************************************************************************************************************** -->

		<div>
		<div class="user_tabs">
			<ul>
				<li>
				<a href="user_home.php">My Account</a>
				</li>
				<li>
				<a href="user_upload.php">Upload New</a>
				</li>
				<li>
				</li>
				<li>
				</li>
			
			</ul>
		
		</div>
		<div class="right_div">
			<div>
			<h1>Create a new listing!</h1>
			<p>
			Upload a new art work to your marketplace. 
			</p>
			<form method="post" enctype="multipart/form-data" name="upload" target="_self">
			<div class="image">
			 <fieldset class="textbox">
			 <label><img id="uploadPreview" src="images/placeholder.png" alt="Uploaded image" />
			 </label>
			 <input type="file" name="fileToUpload" id="fileToUpload" onchange="PreviewImage();">
			 <script>
				function readURL(input) {
				if (input.files && input.files[0]) {
					var reader = new FileReader();
		
					reader.onload = function (e) {
						$('#uploadPreview').attr('src', e.target.result);
					}
		
					reader.readAsDataURL(input.files[0]);
						}
					}
				
					$("#fileToUpload").change(function(){
						readURL(this);
					});
			 </script>
			 <br />
    		</fieldset>
			</div>
			<div class="details">
				<fieldset class="textbox">
				<label for="title">
				<span>Title:<br /></span> 
				</label>
				<input type="text" id="title" />
				<br />
				<label for="artist">
				<span>Artist's name:<br /></span> 
				</label>	
				<input type="text" id="artist" />
				<br/>
				<label for="price">
				<span>Asking price:<br /></span> 
				</label>	
				<input type="text" id="price" />
				<br />
				<input type="submit" value="Upload Image" name="submit">
				</form>	
			</div>
			
			</div>
			
		</div>
	<div align="center">
	</div>
		<?php
		$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
			$target_dir = $uploadsDirectory = $_SERVER['DOCUMENT_ROOT'] . $directory_self . 'images/'.$_SESSION['username']."/";
			echo $target_dir." is the target <br>";
			echo "!!!!!!!!!!!!!!!!!!!!!!!!!!!!";
			if (!file_exists($target_dir)) {
				mkdir($target_dir, 0777, true);
				echo "made target<br>";
			}
			$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
				$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
				if($check !== false) {
					echo "File is an image - " . $check["mime"] . ".";
					$uploadOk = 1;
				} else {
					echo "File is not an image.";
					$uploadOk = 0;
				}
			}
			// Check if file already exists
			if (file_exists($target_file)) {
				echo "Sorry, file already exists.";
				$uploadOk = 0;
			}
			// Check file size
			if ($_FILES["fileToUpload"]["size"] > 500000) {
				echo "Sorry, your file is too large.";
				$uploadOk = 0;
			}
			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
				echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
				$uploadOk = 0;
			}
			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
				echo "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
			} else {
				if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
					echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
				} else {
					echo "Sorry, there was an error uploading your file.";
				}
			}
		?>
</div>
	
		<!-- ****************************************************************************************************************** -->			
			
	</body>
</html>
