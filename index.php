<?php
    require_once('connection.php');
    include_once('navigation.php');
?>

<html>
    <head>
        <title>Auction - Home</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Sulphur+Point:wght@400;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="styles/master.css">
    </head>
    <body>
        <div class="container">
            <div class="body">
                <div class="row row-cols-1 row-cols-md-4">
                    <?php
                        $query = "SELECT `image`,`item_name`,`due_date`,`item_id`,`init_bid`,`current_bid` FROM `auction_item`";
                        $result = $conn->query($query);
                        $rows = $result->num_rows;
                        if($rows >= 1){
                            while ($data = $result->fetch_assoc()){
                                $name = $data['item_name'];
                                $image = $data['image'];
                                $due_date = $data['due_date'];
                                $price = 0;
                                $id = $data['item_id'];
                                if(!$data['current_bid'] == 0){
                                    $price = $data['current_bid'];
                                }else{
                                    $price = $data['init_bid'];
                                }
                                if($CURRENTDATE <=  $due_date){
                                    echo'<a href="singleItem.php?itemId=';echo $id;echo'&itemName=';echo $name;echo'" class="itemCard"><div class="col mb-4">
                                        <div class="card">
                                            <img src="';echo $image;echo '" class="card-img-top" alt="';echo $name;echo'" height="300">
                                            <div class="card-body">
                                                <h5 class="card-title">';echo $name;echo'</h5>
                                                <font color="green">Active</font>
                                                <h5 style="float:right;">Rs. ';echo $price;echo '</h5>
                                            </div>
                                        </div>
                                    </div></a>';
                                }else{
                                    echo'<div class="card">
                                            <img src="';echo $image;echo '" class="card-img-top" alt="';echo $name;echo'" height="300">
                                            <div class="card-body">
                                                <h5 class="card-title">';echo $name;echo'</h5>
                                                <font color="red">Expired</font>
                                                <h5 style="float:right;">Rs. ';echo $price;echo '</h5>
                                            </div>
                                        </div>
                                    </div>';
                                }
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>
