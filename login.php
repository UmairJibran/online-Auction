<?php
    require_once ('connection.php');
    if(isset($_COOKIE['user_id'])){
        header('location:index.php',false);
        die;
    }
?>

<html>

<head>
    <title>Auction - Log In/Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Sulphur+Point:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.16.0/css/mdb.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/master.css">
</head>

<body class="entirePage">
    <div class="jumbotron"></div>
    <div class="row">
        <div class="col col-1"></div>
        <div class="col col-6">
            <!--Sign up Starts Here -->
            <center>
                <h1>Sign Up</h1>
            </center>
            <form action="#" method="post">
                <center>
                    <div class="md-form">
                        <input required type="text" name="FirstName" placeholder="First Name">
                        <input required type="email" name="email" placeholder="Email Address" style="float: right;">
                        <br><br>
                        <input required type="text" name="LastName" placeholder="Last Name">
                        <input required type="password" name="password" placeholder="Your Password" style="float: right;">
                        <br><br>
                        <input required type="number" name="Contact" placeholder="Contact">
                        <input type="submit" value="Sign Up" class="btn btn-primary" name = 'signUp'
                            style="float: right; margin-left: 60px;">
                        <br><br>
                        <select required name="payment" name="payment" class="custom-select">
                            <option value="easypaisa">EasyPaisa</option>
                            <option value="cashOnDelivery">Cash on Delivery</option>
                        </select>
                    </div>
                </center>
            </form>
        </div>
        <div class="col col-1" style="border-right: 1px solid #7070702F"></div>
        <div class="col col-1"></div>
        <div class="col col-2">
            <!--Login Starts Here -->
            <center>
                <h1>Log In</h1>
                <form action="#" method="post">
                    <div class="md-form">
                        <input required type="email" name="Email" placeholder="Email Address">
                        <br><br>
                        <input required type="password" name="password" placeholder="Your Password">
                        <br><br>
                        <input type="submit" name='login' value="Log In" class="btn btn-primary" style="float: right;">
                    </div>
                </form>
            </center>
        </div>
    </div>
</body>

</html>

<?php
    if(isset($_POST['login'])){
        $email = $_POST['Email'];
        $password = $_POST['password'];
        $query = "SELECT * FROM `auction_user` WHERE `user_email` = '$email' AND `user_password` = '$password'";
        $result = $conn->query($query);
        $rows = $result->num_rows;
        if($rows == 1){
            while ($data = $result->fetch_assoc()){
                setcookie('user_id', $data['user_id'], time() + 3600); //we want the user Logged in for one hour
                setcookie('user_first_name', $data['user_first_name'], time() + 3600);
                setcookie('user_last_name', $data['user_last_name'], time() + 3600);
                header('location:index.php');
            }
        }else{
            echo "<br><br><center>Please Double Check your Credential</center>";
        }
    }
    if(isset($_POST['signUp'])){
        $user_first_name = $_POST['FirstName'];
        $user_last_name = $_POST['LastName'];
        $user_contact = $_POST['Contact'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $payment = $_POST['payment'];
        $query = "SELECT *  FROM `auction_user` WHERE `user_email` = '$email' OR `user_contact` = '$user_contact'";
        $result = $conn->query($query);
        $rows = $result->num_rows;
        if($rows >= 1){
            print "<br><br><center>There Exists a User with same email or Password</center>" ;
        }else{
            if($payment == 'easypaisa') $payment = 'esp';
            else $payment = 'cod';
            $query = "INSERT INTO `auction_user` (`user_first_name`, `user_last_name`, `user_email`, `user_contact`, `user_password`, `payment`) VALUES ('$user_first_name', '$user_last_name', '$email', '$user_contact', '$password', '$payment'); ";
            $result = $conn->query($query);
            if(!$result){
                echo '<br><br><center>We Encountered a Problem, please try again</center>';
            }else{
                $query = "SELECT * FROM `auction_user` WHERE `user_email` = '$email'";
                $result = $conn->query($query);
                $rows = $result->num_rows;
                if($rows == 1){
                    while ($data = $result->fetch_assoc())
                        $userID =   $data['user_id'];
                }             
                setcookie('user_id', $userID, time() + 3600); //we want the user Logged in for one hour
                setcookie('user_first_name', $user_first_name, time() + 3600);
                setcookie('user_last_name', $user_last_name, time() + 3600);
                header('location:index.php');
            }
        }
    }
    
?>