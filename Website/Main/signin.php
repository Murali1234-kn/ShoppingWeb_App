<?php
require_once "inc/connect.inc.php" ;
ob_start();
if (!isset($_SESSION['user_login'])) {
}
else {
	header("location: index.php");
}

$fname = $lname = $email = $mobile = $address = $password = "";
$fnameErr = $lnameErr = $emailErr = $mobileErr = $addressErr = $passwordErr = "";
$error="";
function validate($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
function isPasswordValid($password)
{
    return preg_match('/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[^\w\d\s])\S{8,}$/', $password);
}

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST['signup'])) {
    $fname = validate($_POST['first_name']);
    $lname = validate($_POST['last_name']);
    $email = validate($_POST['email']);
    $mobile = validate($_POST['mobile']);
    $address = validate($_POST['signupaddress']);
    $password = validate($_POST['password']);

    if (empty($fname)) {
        $fnameErr = "Name is required";
    } elseif (!preg_match('/^[a-zA-Z ]{1,}$/', $fname)) {
        $fnameErr = "Enter Alphabets";
    }

    if (empty($lname)) {
        $lnameErr = "Name is required";
    } elseif (!preg_match('/^[a-zA-Z ]{3,}$/', $lname)) {
        $lnameErr = "Enter Alphabets";
    }

    if (empty($email)) {
        $emailErr = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
    }

    if (empty($mobile)) {
        $mobileErr = "Phone number is required";
    } elseif (!preg_match('/^[0-9]{10}$/', $mobile)) {
        $mobileErr = "Invalid phone Number";
    }

    if (!empty($email)) {
        $email_query = "SELECT email FROM customer WHERE email ='$email'";
        $email_result = mysqli_query($conn, $email_query);
        if (mysqli_num_rows($email_result) > 0) {
            $emailErr = "Email Already Register!..";
        }
    }
    if (!empty($mobile)) {
        $mobile_query = "SELECT mobile FROM customer WHERE mobile='$mobile'";
        $mobile_result = mysqli_query($conn, $mobile_query);
        if (mysqli_num_rows($mobile_result) > 0) {
            $mobileErr = "Mobile Already Register!..";
        }
    }
    if (empty($address)) {
        $addressErr = "Address is required";
    }

    if (empty($password)) {
        $passwordErr = "Password is Required";
    } elseif (!isPasswordValid($password)) {
        $passwordErr = "Invalid password";
    }

    if (empty($fnameErr) && empty($lnameErr) && empty($emailErr) && empty($mobileErr) && empty($addressErr) && empty($passwordErr)) {
        $confirmCode = substr(rand() * 900000 + 100000, 0, 6);

//        // send email
//        $to = $_POST['email'];
//        $subject = "eBuyBD Activation Code";
//        $headers = "From: eBuyBD <muraliroyal0504@gmail.com>";
//        $msg = "Welcome
//        Your activation code: " . $confirmCode . "
//        Signup email: " . $_POST['email'] . " ";
//
//        if (@mail($to, $subject, $msg, $headers))
//        {
            $stmt = $conn->prepare("INSERT INTO customer (firstName, lastName, email, mobile, address, password, confirmCode) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("sssssss", $fname, $lname, $email, $mobile, $address, $password, $confirmCode);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                header('Location: login.php');
                exit();
            } else {
                $error = "Failed to insert data into the database.";
            }
//        } else {
//            $error = "Failed to send activation email.";
//        }
    }

}
?>

<!doctype html>
<html>
	<head>
		<title>Welcome to ebuybd online shop</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
        <style>
            .error{
                font-size: large;
                font-family: Arial, Helvetica, tahoma, verdana, arial, sans-serif;
                color: red;
            }
        </style>
	</head>
	<body class="home-welcome-text" style="background-image: url(image/homebackgrndimg2.png);">
		<div class="homepageheader" style="position: inherit;">
			<div class="signinButton loginButton">
				<div class="uiloginbutton signinButton loginButton" style="margin-right: 40px;">
					<a style="text-decoration: none;" href="signin.php">SIGN IN</a>
				</div>
				<div class="uiloginbutton signinButton loginButton" style="">
					<a style="text-decoration: none;" href="login.php">LOG IN</a>
				</div>
			</div>
			<div style="float: left; margin: 5px 0px 0px 23px;">
				<a id="" href="login.php">
					<img style=" height: 75px; width: 130px;" src="image/ebuybdlogo.png">
				</a>
			</div>
			<div class="">
				<div id="srcheader">
					<form id="newsearch" method="get" action="http://www.google.com">
					        <input type="text" class="srctextinput" name="q" size="21" maxlength="120"  placeholder="Search Here..."><input type="submit" value="search" class="srcbutton" >
					</form>
				<div class="srcclear"></div>
				</div>
			</div>
		</div>
        <?php
        if(isset($success_message))
        {echo $success_message;}
        else {
            ?>
					<div class="holecontainer" style="float: right; margin-right: 36%; padding-top: 26px;">
						<div class="container">
							<div>
								<div>
									<div class="signupform_content">
										<h2>Sign Up Form!</h2>
										<div class="signupform_text"></div>
										<div>
                                            <form id="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
												<div class="signup_form">
													<div>
														<td >
													       <input name="first_name" id="first_name" placeholder="First Name" class="first_name signupbox" type="text" size="30" value="<?php echo $fname;?>" >
                                                             <span class="error"> <?php echo $fnameErr; ?></span>
														</td>
													</div>
													<div>
														<td >
															<input name="last_name" id="last_name" placeholder="Last Name" class="last_name signupbox" type="text" size="30" value="<?php echo $lname ;?>" >
														     <span class="error"> <?php echo $lnameErr; ?></span>
														</td>
													</div>
													<div>
														<td>
															<input name="email" placeholder="Enter Your Email" class="email signupbox" type="email" size="30" value="<?php echo $email; ?>">
                                                               <span class="error"><?php echo $emailErr; ?></span>
														</td>     
													</div>
													<div>
														<td>
															<input name="mobile" placeholder="Enter Your Mobile" class="email signupbox" type="text" size="30" value="<?php echo $mobile; ?>">
														      <span class="error"> <?php echo $mobileErr; ?></span>
														</td>
													</div>
													<div>
														<td>
															<input name="signupaddress" placeholder="Write Your Full Address" class="email signupbox" type="text" size="30" value="<?php echo $address; ?>">
															            <span class="error"> <?php echo $addressErr; ?></span>
														</td>
													</div>
													<div>
														<td>
															<input name="password" id="password-1"  placeholder="Enter New Password" class="password signupbox " type="password" size="30" value="<?php echo $password; ?>">
											               <span class="error"> <?php echo $passwordErr; ?></span>
														</td>
													</div>
													<div>
														<input name="signup" class="uisignupbutton signupbutton" type="submit" value="Sign Me Up!">
                                                        <span class="error"><?php if(!empty($error)) {echo $error; }?></span>
                                                    </div>
											</form>

                                        </div>
									</div>
								</div>
							</div>
						</div>
					</div>
    <?php }?>
	 </body>
</html>
