<?php
include('config.php');
// fetching admin email where mail will send

$sql ="SELECT emailId from tblemail";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0):
foreach($results as $result):
$adminemail=$result->emailId;
endforeach;
endif;
if(isset($_POST['submit']))
{
// getting Post values	
$name=$_POST['name'];
$phoneno=$_POST['phonenumber'];
$email=$_POST['emailaddres'];
$temp=$_POST['temperature'];
$oxy=$_POST['oxygen'];
$subject=$_POST['subject'];
$message=$_POST['message'];
$uip = $_SERVER ['REMOTE_ADDR'];
$isread=0;
// Insert query
$sql="INSERT INTO  tblcontactdata(FullName,PhoneNumber,EmailId,Temperature,Oxygen,Subject,Message,UserIp,Is_Read) VALUES(:fname,:phone,:email,:temp,:oxy,:subject,:message,:uip,:isread)";
$query = $dbh->prepare($sql);
// Bind parameters
$query->bindParam(':fname',$name,PDO::PARAM_STR);
$query->bindParam(':phone',$phoneno,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':temp',$temp,PDO::PARAM_STR);
$query->bindParam(':oxy',$oxy,PDO::PARAM_STR);
$query->bindParam(':subject',$subject,PDO::PARAM_STR);
$query->bindParam(':message',$message,PDO::PARAM_STR);
$query->bindParam(':uip',$uip,PDO::PARAM_STR);
$query->bindParam(':isread',$isread,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
//mail function for sending mail
/*$to=$email.",".$adminemail; 
$headers .= "MIME-Version: 1.0"."\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
$headers .= 'From:Insight jayesh<jayeshrokade123@gmail.com>'."\r\n";
$ms.="<html></body><div>
<div><b>Name:</b> $name,</div>
<div><b>Phone Number:</b> $phoneno,</div>
<div><b>Email Id:</b> $email,</div>";
$ms.="<div style='padding-top:8px;'><b>Message : </b>$message</div><div></div></body></html>";
mail($to,$subject,$ms,$headers);
*/



echo "<script>alert('Thank you for filling the form! Have a great day!');</script>";
}
else 
{
echo "<script>alert('Something went wrong. Please try again');</script>";
}


}


?>
<!DOCTYPE HTML>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Insight Visitor Management System</title>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
<!--web-fonts-->
<link href='//fonts.googleapis.com/css?family=Josefin+Sans:400,100,300,600,700' rel='stylesheet' type='text/css'>
<link rel="shortcut icon" href="images/insight_logo_mini.ico">
<!--web-fonts-->
</head>
<body>
		<!---header--->
		
		<!---header--->
		<!---main--->
			<div class="main">
				
				<div class="login-form">
					<center><h2>Welcome to Insight !</h2><center>
					<p>Please fill in all the details!</p>
					<form name="ContactForm" method="post">

<h4>your name:</h4>
<input type="text" name="name" class="user" placeholder="Enter your Full name"  autocomplete="off" required>

<h4>your phone number:</h4>
<input type="text" name="phonenumber" class="phone" placeholder="900234145678" maxlength="10" required autocomplete="off">

<h4>your email address:</h4>
<input type="email" name="emailaddres" class="email" placeholder="Example@mail.com" required autocomplete="off">

<h4>Temperature:</h4>
<input type="text" name="temperature" class="phone" placeholder="Enter your measured temperature" maxlength="10" required autocomplete="off">

<h4>Oxygen:</h4>
<input type="text" name="oxygen" class="phone" placeholder="Enter your detected oxygen" maxlength="3" required autocomplete="off">

<h4>Person to Meet:</h4>
<input type="text" name="subject" class="user" placeholder="Whom to meet" autocomplete="off">

<h4>Purpose of Visiting:</h4>
<input type="text" name="message" placeholder="Your purpose of meeting" required></textarea>
<input type="submit" value="send your message" name="submit">
</form>
				
				</div>
				</div>
			</div>

		<!---main--->
</body>
</html>