<?php
    if(!isset($_COOKIE['user_id'])){
        header('location:login.php',false);
        die;
    }
    if(isset($_POST['signOut'])){
        setcookie('user_id',$_COOKIE['user_id'],time() - 1);
        header('location:login.php');
    }
    if(isset($_POST['addItem'])){
        header('location:posting_item.php');
    }
?>

<html>
    <body>
        <div class="jumbotron">
            <div class="row">
                <div class="col col-3">
                    <h1 style='float:left;'><a class="text-primary" href="index.php">Home</a></h1>
                </div>
                <div class="col col-6">
                <form method='POST' action="items.php">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <img src="assets/search-solid.svg" alt="Search Icon" height='15' width='15'>
                            </div>
                        </div>
                        <input type="text" name="itemName" required placeholder='Search an Item' class='form-control'>
                        <input type="submit" value="Search" class='btn btn-outline-primary' style='float:right;'>
                    </div>
                </form>
                </div>
                <div class="col col-3">
                    <div style = "float:right;">
                        <h5>Hello, <?php echo"{$_COOKIE['user_first_name']}"; ?></h5>
                        <form method='POST'>
                            <input type="submit" value="+" class="btn btn-outline-success ml-2" name='addItem'>
                            <input type="submit" value="Sign Out" class="btn btn-outline-danger" name='signOut'>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>