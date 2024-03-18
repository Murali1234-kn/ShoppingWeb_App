<?php include  "inc/connect.inc.php" ; ?>
<?php 
ob_start();
if (!isset($_SESSION['user_login'])) {
	$user = "";
}
else {
	$user = $_SESSION['user_login'];
	$result = mysqli_query($conn,"SELECT * FROM customer WHERE id='$user'");
		$get_user = mysqli_fetch_assoc($result);
			$fname = $get_user['firstName'];
            $lname = $get_user['lastName'];
            $fullname = $lname ." ". $fname;
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Welcome to ebuybd online shop</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<script src="/js/homeslideshow.js"></script>
	</head>
	<body style="min-width: 980px;">
		<div class="homepageheader" style="position: relative;">
			<div class="signinButton loginButton">
				<div class="uiloginbutton signinButton loginButton" style="margin-right: 40px;">
					<?php 
						if ($user!="") {
							echo '<a style="text-decoration: none; color: #fff;" href="logout.php">LOG OUT</a>';
						}
						else {
							echo '<a style="color: #fff; text-decoration: none;" href="signin.php">SIGN IN</a>';
						}
					 ?>
					
				</div>
				<div class="uiloginbutton signinButton loginButton" style="">
					<?php 
						if ($user!="") {
							echo '<a style="text-decoration: none; color: #fff;" href="profile.php?uid='.$user.'">Hi '.$fullname.'</a>';
						}
						else {
							echo '<a style="text-decoration: none; color: #fff;" href="login.php">LOG IN</a>';
						}
					 ?>
				</div>
			</div>
			<div style="float: left; margin: 5px 0px 0px 23px;">
				<a href="index.php">
					<img style=" height: 75px; width: 130px;" src="image/ebuybdlogo.png">
				</a>
			</div>
			<div class="">
				<div id="srcheader">
					<form id="newsearch" method="get" action="search.php">
					        <input type="text" class="srctextinput" name="keywords" size="21" maxlength="120"  placeholder="Search Here..."><input type="submit" value="search" class="srcbutton" >
					</form>
				<div class="srcclear"></div>
				</div>
			</div>
		</div>
		<div class="home-welcome">
			<div class="home-welcome-text" style="background-image: url(image/homebackgrndimg.png); height: 380px; ">
                <h1 style="margin: 0px;">Welcome To ebuybd </h1>
				<h2>Largest Online Shopping In India</h2>
			</div>
		</div>
		<div class="home-prodlist">
			<div>
				<h3 style="text-align: center;">Products Category</h3>
			</div>
			<div style="padding: 20px 30px; width: 85%; margin: 0 auto;">
				<ul style="float: left;">
					<li style="float: left; padding: 25px;">
						<div class="home-prodlist-img"><a href="All/electronic.php">
                                <img src="./image/product/Electronics/all.jpeg" class="home-prodlist-imgi">
						</div>
					</li>
				</ul>
				<ul style="float: left;">
					<li style="float: left; padding: 25px;">
						<div class="home-prodlist-img"><a href="All/perfume.php">
							<img src="./image/product/perfume/pp2.jpg" class="home-prodlist-imgi">
							</a>
						</div>
					</li>
				</ul>
				<ul style="float: left;">
					<li style="float: left; padding: 25px;">
						<div class="home-prodlist-img"><a href="All/kitchen.php">
							<img src="./image/product/Kitchen/mc1.jpeg" class="home-prodlist-imgi"></a>
						</div>
					</li>
				</ul>
				<ul style="float: left;">
					<li style="float: left; padding: 25px;">
						<div class="home-prodlist-img"><a href="All/toilatry.php">
							<img src="./image/product/Smartphones/mp1.jpg" class="home-prodlist-imgi"></a>
						</div>
					</li>
				</ul>
				<ul style="float: left;">
					<li style="float: left; padding: 25px;">
						<div class="home-prodlist-img"><a href="All/footwear.php">
							<img src="./image/product/footwear/mf1.jpeg" class="home-prodlist-imgi"></a>
						</div>
					</li>
				</ul>
				<ul style="float: left;">
					<li style="float: left; padding: 25px;">
						<div class="home-prodlist-img"><a href="All/tshirt.php">
							<img src="./image/product/tshirt/t1.jpg" class="home-prodlist-imgi"></a>
						</div>
					</li>
				</ul>
				<ul style="float: left;">
					<li style="float: left; padding: 25px;">
						<div class="home-prodlist-img"><a href="All/watch.php">
							<img src="./image/product/watch/mainw.jpg" class="home-prodlist-imgi"></a>
						</div>
					</li>
				</ul>
				<ul style="float: left;">
					<li style="float: left; padding: 25px;">
						<div class="home-prodlist-img"><a href="All/ornament.php">
							<img src="./image/product/ornament/main.jpg" class="home-prodlist-imgi"></a>
						</div>
					</li>
				</ul>
                <ul style="float: left;">
                    <li style="float: left; padding: 25px;">
                        <div class="home-prodlist-img"><a href="All/ornament.php">
                                <img src="./image/product/footwear/" class="home-prodlist-imgi"></a>
                        </div>
                    </li>
                </ul>
                <ul style="float: left;">
                    <li style="float: left; padding: 25px;">
                        <div class="home-prodlist-img"><a href="All/ornament.php">
                                <img src="./image/product/saree/main.jpg" class="home-prodlist-imgi"></a>
                        </div>
                    </li>
                </ul>
                <ul style="float: left;">
                    <li style="float: left; padding: 25px;">
                        <div class="home-prodlist-img"><a href="All/ornament.php">
                                <img src="./image/product/toiletry/maintt1.jpg" class="home-prodlist-imgi"></a>
                        </div>
                    </li>
                </ul>
                <ul style="float: left;">
                    <li style="float: left; padding: 25px;">
                        <div class="home-prodlist-img"><a href="All/ornament.php">
                                <img src="./image/product/books/main.jpg" class="home-prodlist-imgi"></a>
                        </div>
                    </li>
                </ul>
			</div>			
		</div>
	</body>
</html>