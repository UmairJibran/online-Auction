<?php
    require_once('connection.php');
    if(!isset($_COOKIE['user_id'])){
        header('location:login.php',false);
        die;
    }
    if(isset($_POST['signOut'])){
        setcookie('user_id',$_COOKIE['user_id'],time() - 1);
        header('location:login.php');
    }
?>

<html>
    <head>
        <title>Auction - Home</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Sulphur+Point:wght@400;700&display=swap" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.16.0/css/mdb.min.css" rel="stylesheet">
        <link rel="stylesheet" href="styles/master.css">
    </head>
    <body>
        <div class="container">
            <div class="jumbotron">
                <center>
                    <h1>Welcom <?php echo "{$_COOKIE['user_first_name']}" . " " . "{$_COOKIE['user_last_name']}" ?></h1>
                </center>
            </div>
            <form method='POST'>
                <input type="submit" value="Sign Out" class="btn btn-primary" name='signOut' style='float:right;'>
            </form>
        </div>
    </body>
</html>