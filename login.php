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
            <center>
                <h1>Sign Up</h1>
            </center>
            <form action="#" method="post">
                <center>
                    <div class="md-form">
                        <input required type="text" id="FirstName" placeholder="First Name">
                        <input required type="email" id="email" placeholder="Email Address" style="float: right;">
                        <br><br>
                        <input required type="text" id="LastName" placeholder="Last Name">
                        <input required type="password" id="password" placeholder="Your Password" style="float: right;">
                        <br><br>
                        <input required type="number" id="Contact" placeholder="Contact">
                        <input type="submit" value="Sign Up" class="btn btn-primary"
                            style="float: right; margin-left: 60px;">
                        <br><br>
                        <select required name="payment" id="payment" class="custom-select">
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
            <center>
                <h1>Log In</h1>
                <form action="#" method="post">
                    <div class="md-form">
                        <input required type="email" name="Email" id="email" placeholder="Email Address">
                        <br><br>
                        <input required type="password" name="password" id="password" placeholder="Your Password">
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
    
?>