
<?php

try{
	$db= new mysqli("localhost","root" ,"","my_form_db");
}catch (Exception $exc){
	echo $exc->getTraceAsString();

}
if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['name'])){
	$name = $_POST['name'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$msg = $_POST['msg'];
	
	$is_insert = $db->query("INSERT INTO `data`( `name`, `email`, `phone`, `msg`) VALUES ('$name','$email','$phone','$msg')");
	
	if($is_insert == TRUE){
		echo "<h2> Thank you ,your request submitted successfully</h2>";
		exit();
	}
}


// define variables and set to empty values
$nameErr = $emailErr = $phoneErr =  "";
$name = $email = $phone = $msg = "";

if(isset($_POST['submit'])){
if ($_SERVER["REQUEST_METHOD"] == "POST"){
  if (empty($_POST["name"])) {
    $nameErr = "Name is required";
  } else {
    $name = test_input($_POST["name"]);
    // check if  Name must consist only of alphabets
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
      $nameErr = "Name must consist only of alphabets";
    }
  } 
}
  
   if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }


 if(empty($_POST['phone']))
 {
	 $phoneErr = "Please enter Phone number";
 }else if(strlen($_POST['phone'])<10)
 {
	 $phoneErr = "phone Number should be of 10 digit ";
 }else if(!preg_match("/^[6-9]\d{9}$/",$_POST['phone']))
 {
	 $phoneErr = "Invalid phone number";
 }
 
  if (empty($_POST["msg"])) {
    $msg = "";
  } else {
    $msg = test_input($_POST["msg"]);
  }
 
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>



<!DOCTYPE html>
 <html>
    <head>
	   <meta charset="UTF-8">
	   <title> Form||form</title>
	   
	   <style>
	  .error {color:#FF0000;}
	</style>
	
	</head>
	<p><span class="error">* required field</span></p>
	 <body>
	    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<input type="text" name ="name" placeholder="Name" value="<?php echo $name;?>">
		 <span class="error">* <?php echo $nameErr;?></span>
		<br><br>
		
		<input type="email" name="email" placeholder="Email" value="<?php echo $email;?>">
		<span class="error">* <?php echo $emailErr;?></span>
		<br><br>
		
		<input type="text" name="phone" placeholder="Phone" value="<?php echo $phone;?>">
        <span class="error">*<?php echo $phoneErr;?></span>
		<br><br>
		
		<textarea  name="msg" placeholder="Type your reuest"><?php echo $msg;?>
		</textarea><br>
	   <input type="submit" name="submit" value="submit request">
	   </form>
	  </body>
	   
</html>