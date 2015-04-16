<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php
session_start();
if(!isset($_SESSION['status'])||$_SESSION['status']!='authorized'){
	$_SESSION['status']='unauth';
	$_SESSION['username']='Guest';
	header('Location:index.php');
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
				<h1><a href="index.php">artists<span>.net</span></a></h1>
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

	<div class="container-div">
		<div class="user_tabs">
			<ul>
				<li>
				<a href="user_home.php"><br />
				My Account</a>				
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
			<h1>Create a new listing!</h1>
			<p>
			Upload a new art work to your marketplace. 
			</p>
			
			<div class="center-left"> 
			<form method="post" enctype="multipart/form-data" name="upload" target="_self">
			
			 <fieldset class="textbox">
			 <label><img id="uploadPreview" src="images/placeholder.png" alt="Uploaded image" />
			 </label>
			 <br />
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
		
			<div class="center-right" align="left"> 
				<label for="title">
				<span>Title:<br /></span> 
				</label>
				<input type="text" id="title" name="title" />
				<br />
				<label for="artist">
				<span>artist's name:<br /></span> 
				</label>	
				<input type="text" id="artist" name="artist" />
				<br/>
				<br />
				<br />
				<br />
				<input type="submit" value="Upload Image" name="submit">
				</form>	
				 
			</div>
		</div>			
	<div align="center" style="text-align:center">
		<?php
	require_once('connect.php');
	require_once('connect_param.php');
	
	$dbc = new Connect();
	$conn = $dbc->get_conn();
	if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
	} 
		
	$directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
	$target_dir = $uploadsDirectory = $_SERVER['DOCUMENT_ROOT'] . $directory_self . 'images/'.$_SESSION['username']."/";
	$save_dir = 'images/'.$_SESSION['username']."/";
	  if (isset($_POST['submit'])) {
			if( !is_uploaded_file($_FILES['fileToUpload']['tmp_name']) ){
				echo "<script>
						window.alert(\"Select a file to upload\")
						</script>";
				}
		
			else{
				if(!file_exists($target_dir)) {
				mkdir($target_dir, 0777, true);
					}
				$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
				$path = $save_dir.basename($_FILES["fileToUpload"]["name"]);
				$uploadOk = 1;
				$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
				// Check if image file is a actual image or fake image
				
					$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
					if($check !== false) {
						//echo "File is an image - " . $check["mime"] . ".";
						$uploadOk = 1;
					} else {
						echo "<script>
						window.alert(\"File is not an image.\")
						</script>"; 
						$uploadOk = 0;
					}
				
				// Check if file already exists
				if (file_exists($target_file)) {
					echo "<script>
						window.alert(\"Sorry, file already exists. Check your gallery or select a different title.\")
						</script>"; 
					$uploadOk = 0;
				}
				// Check file size
				if ($_FILES["fileToUpload"]["size"] > 500000) {
					echo "<script>
						window.alert(\"Sorry, your file is too large.\")
						</script>"; 
	
					$uploadOk = 0;
				}
				// Allow certain file formats
				if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
				&& $imageFileType != "gif" ) {
					echo "<br>Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
					$uploadOk = 0;
				}
				// Check if $uploadOk is set to 0 by an error
				if ($uploadOk == 0) {
					echo "<br>Sorry, your file was not uploaded.";
				// if everything is ok, try to upload file
				} else {
						$title = $_POST['title'];
						$artist = $_POST['artist'];
						$user = $_SESSION['username'];
						$sold = FALSE;
						$time = time();
						echo "<br>";
	echo "<br>";
	echo "<br>";

						echo $time;
	echo "<br>";
	echo "<br>";
	echo "<br>";
						
						$id = substr($_POST['artist'],0,3).substr(basename($_FILES["fileToUpload"]["name"]),0,3).$time;
						
						
						$query = "INSERT INTO images (title,user,artist,sold,path,time,id)  
						VALUES ('$title','$user','$artist','sold','$path','$time','$id')";
						echo $query;
						
						$result = $conn->query($query);
						echo $result;
						
						echo "<br>";

					if ($result && move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
						echo "<br>The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
						

					} else {
						echo "<script>
						window.alert(\"Sorry, there was an error uploading your file.\")
						</script>";
					}
				}
			}
			}
	?>
	</div>
	</div>
</div>
	
		<!-- ****************************************************************************************************************** -->			
			
	</body>
</html>
