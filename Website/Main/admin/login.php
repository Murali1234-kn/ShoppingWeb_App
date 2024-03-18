<?php
ob_start();
include_once "../inc/connect.inc.php";

// Check if the admin is already logged in
if (isset($_SESSION['admin_login'])) {
    header("location: index.php");
    exit();
}
$email = $password = "";
$emailErr = $passwordErr = "";
$success = $invalid = "";

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

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (empty($_POST['email'])) {
        $emailErr = "Email is required";
    } else {
        $email = validate($_POST['email']);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    if (empty($_POST['password'])) {
        $passwordErr = "Password is Required";
    } else {
        $password = validate($_POST['password']);
        if (!isPasswordValid($password)) {
            $passwordErr = "Invalid password";
        }
    }

    if (empty($emailErr) && empty($passwordErr)) {
        $result = mysqli_query($conn, "SELECT * FROM admin WHERE email='$email' AND password='$password'");
        $get_user_email = mysqli_fetch_assoc($result);

        if (mysqli_num_rows($result) > 0) {
            $_SESSION['admin_login'] = $get_user_email['id'];
            setcookie('admin_login', $email, time() + (365 * 24 * 60 * 60), "/");

            header('location: index.php');
            exit();
        } else {
            $invalid = "<h5 style='color: red'>Invalid Credentials!!...</h5>";
        }
    }
}

$search_value = "";
?>

<!doctype html>
<html>
<head>
    <title>Welcome to ebuybd online shop</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body class="home-welcome-text" style="background-image: url(../image/homebackgrndimg1.png);">
<div class="homepageheader">
    <div class="signinButton loginButton">
        <div class="uiloginbutton signinButton loginButton" style="margin-right: 40px;">
            <a style="text-decoration: none;" href="login.php">LOG IN</a>
        </div>
    </div>
    <div style="float: left; margin: 5px 0px 0px 23px;">
        <a href="index.php">
            <img style=" height: 75px; width: 130px;" src="../image/ebuybdlogo.png">
        </a>
    </div>
    <div id="srcheader">
        <form id="newsearch" method="get" action="search.php">
            <?php
            echo '<input type="text" class="srctextinput" name="keywords" size="21" maxlength="120"  placeholder="Search Here..." value="'.$search_value.'"><input type="submit" value="search" class="srcbutton" >';
            ?>
        </form>
        <div class="srcclear"></div>
    </div>
</div>
<div class="holecontainer" style="float: right; margin-right: 36%; padding-top: 110px;">
    <div class="container">
        <div>
            <div>
                <div class="signupform_content">
                    <h2>Admin Login</h2>
                    <div class="signupform_text"></div>
                    <div>
                        <form id="form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
                            <div class="signup_form">
                                <div>
                                    <td>
                                        <input name="email" placeholder="Enter Your Email" class="email signupbox" type="email" size="30" value="<?php echo $email?>">
                                        <span class="error"><?php echo $emailErr; ?></span>
                                    </td>
                                </div>
                                <div>
                                    <td>
                                        <input name="password" id="password-1" placeholder="Enter Password" class="password signupbox " type="password" size="30" value="<?php echo $password ?>">
                                        <span class="error"> <?php echo $passwordErr; ?></span>
                                    </td>
                                </div>
                                <div>
                                    <input name="login" class="uisignupbutton signupbutton" type="submit" value="Log In">
                                    <span class="error"><?php echo $success; echo $invalid; ?></span>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
