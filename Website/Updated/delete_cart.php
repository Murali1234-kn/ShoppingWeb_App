<?php include  "inc/connect.inc.php" ; ?>
<?php
const INDEX = "Location: index.php";
session_start();
if (!isset($_SESSION['user_login'])) {
	header("location: login.php");
}
else {
	$user = $_SESSION['user_login'];
	$result = mysqli_query($conn, "SELECT * FROM user WHERE id='$user'");
		$get_user_email = mysqli_fetch_assoc($result);
			$uname_db = $get_user_email['firstName'];
			$uemail_db = $get_user_email['email'];

			$umob_db = $get_user_email['mobile'];
			$uadd_db = $get_user_email['address'];
}


if (isset($_REQUEST['cid'])) {
		$cid = mysqli_real_escape_string($conn, $_REQUEST['cid']);
		if(mysqli_query($conn, "DELETE FROM cart WHERE pid='$cid' AND uid='$user'")){
//		header('location: mycart.php?uid='.$user.'');
            mycart($user);

        }else{
		header(INDEX);
	}
}
if (isset($_REQUEST['aid']))
{
		$aid = mysqli_real_escape_string($conn, $_REQUEST['aid']);
//		$result = mysqli_query($conn, "SELECT * FROM cart WHERE pid='$aid'");
//		$get_p = mysqli_fetch_assoc($result);
//		$num = $get_p['quantity'];
   $num = my($aid);
		$num += 1;
		if(mysqli_query($conn, "UPDATE cart SET quantity='$num' WHERE pid='$aid' AND uid='$user'")){
//		header('location: mycart.php?uid='.$user.'');
            mycart($user);

        }else{
//		header('location: index.php');
            header(INDEX);
	}
}
if (isset($_REQUEST['sid'])) {
		$sid = mysqli_real_escape_string($conn, $_REQUEST['sid']);
//		$result = mysqli_query($conn, "SELECT * FROM cart WHERE pid='$sid'");
//		$get_p = mysqli_fetch_assoc($result);
//		$num = $get_p['quantity'];
    $num = my($sid);
		$num -= 1;
		if ($num <= 0){
			$num = 1;
		}
		if(mysqli_query($conn, "UPDATE cart SET quantity='$num' WHERE pid='$sid' AND uid='$user'")){
//		header('location: mycart.php?uid='.$user.'');
            mycart($user);
	}
        else{
            header(INDEX);
        }
}
 function my($aid)
 {
     $result = mysqli_query($conn, "SELECT * FROM cart WHERE pid='$aid'");
     $get_p = mysqli_fetch_assoc($result);
     $num1 = $get_p['quantity'];

     return $num1;
 }
function mycart($user)
{
    header('location: mycart.php?uid='.$user.'');
}

?>