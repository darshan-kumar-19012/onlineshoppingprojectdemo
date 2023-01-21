<?php
session_start();
include('config.php');
include('main-header.html');
if(isset($_POST['submit']))
{
    $name=$_POST['fullname'];
    $email=$_POST['emailid'];
    $contactno=$_POST['contactno'];
    $cookie_name = "user";
    $cookie_value = $_POST['fullname'];
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
    $password=md5($_POST['password']);
    $query=mysqli_query($con,"insert into users(name,email,contactno,password) values('$name','$email','$contactno','$password')");
    if($query)
    {
        echo "<script>alert('You are successfully register');</script>";
    }
    else{
        echo "<script>alert('Not register something went worng');</script>";
    }
}
if(isset($_POST['login']))
{
   $email=$_POST['email'];
   $password=md5($_POST['password']);
    $query=mysqli_query($con,"SELECT * FROM users WHERE email='$email' and password='$password'");
    $num=mysqli_fetch_array($query);
    if($num>0)
    {
        $extra="index.php";
        $_SESSION['login']=$_POST['email'];
        $_SESSION['id']=$num['id'];
        $_SESSION['username']=$num['name'];
        $uip=$_SERVER['REMOTE_ADDR'];
        $status=1;
        $log=mysqli_query($con,"insert into userlog(userEmail,userip,status) values('".$_SESSION['login']."','$uip','$status')");
        $host=$_SERVER['HTTP_HOST'];
        $uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
        header("location:http://$host$uri/$extra");
        exit();
    }
    else
    {
        $extra="login.php";
        $email=$_POST['email'];
        $uip=$_SERVER['REMOTE_ADDR'];
        $status=0;
        $log=mysqli_query($con,"insert into userlog(userEmail,userip,status) values('$email','$uip','$status')");
        $host  = $_SERVER['HTTP_HOST'];
        $uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
        header("location:http://$host$uri/$extra");
        $_SESSION['errmsg']="Invalid email id or Password";
        exit();
    }
    }
?>
<!DOCTYPE html>
<html>
<head>
  <style>
    body{
    margin: 2%;
    }
    .login-signup{
      display: flex;
    }
    .login-signup form {
      margin-top: 5%;
      margin-left: 4%;
      width: 40%;
    }

    .login-signup input[type=text],input[type=password],input[type=email] {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }

    .login-signup button {
      background: linear-gradient(to right, #1D2671, #C33764);   
      color: white;
      padding: 14px 20px;
      margin: 8px 0;
      border: none;
      cursor: pointer;
      width: 100%;
    }

    .login-signup button:hover {
      opacity: 0.8;
    }
  </style>
</head>

<body>
  <span style="color:red;" >
    <?php echo htmlentities($_SESSION['errmsg']="");?>
  </span>
  <div class="login-signup">
    <form  method="post">
      <div class="container">
        <h1>Sign in </h1>
        <label for="email"><b>Email</b></label>
        <input type="text" placeholder="Enter Email" name="email" required>
        <label  for="exampleInputPassword1">Password <span>*</span></label>
		<input type="password" name="password" id="exampleInputPassword1" >
        <button type="submit" name="login">Login</button>
      </div>
    </form>
    <form  method="post" onSubmit="return valid();">
        <h1>Create a new account</h1>
        <p>Create your own shopping account</p>
        <label for="fullname">Full Name<span>*</span></label>
        <input type="text" id="fullname" name="fullname" required="required">
        <label for="exampleInputEmail2">Email Address <span>*</span></label>
        <input type="email" id="email" onBlur="userAvailability()" name="emailid" required>
        <span id="user-availability-status1" style="font-size:12px;"></span>
        <label for="contactno">Contact No. <span>*</span></label>
        <input type="text" id="contactno" name="contactno" maxlength="10" required>
        <label for="password">Password. <span>*</span></label>
        <input type="password" id="password" name="password" required>
        <label for="confirmpassword">Confirm Password. <span>*</span></label>
        <input type="password" id="confirmpassword" name="confirmpassword" required>
        <button type="submit" name="submit" id="submit">Sign Up</button>
    </form>
</div>
  <br><br><br>
  <?php include('footer.html')?>
</body>

</html>