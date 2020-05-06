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
                        $query = "SELECT `image`,`item_name`,`item_id`,`init_bid`,`current_bid` FROM `auction_item`";
                        $result = $conn->query($query);
                        $rows = $result->num_rows;
                        if($rows >= 1){
                            while ($data = $result->fetch_assoc()){
                                $name = $data['item_name'];
                                $image = $data['image'];
                                $price = 0;
                                $id = $data['item_id'];
                                if(!$data['current_bid'] == 0){
                                    $price = $data['current_bid'];
                                }else{
                                    $price = $data['init_bid'];
                                }
                                echo'<a href="singleItem.php?itemId=';echo $id;echo'&itemName=';echo $name;echo'" class="itemCard"><div class="col mb-4">
                                    <div class="card">
                                        <img src="';echo $image;echo '" class="card-img-top" alt="';echo $name;echo'" height="300">
                                        <div class="card-body">
                                            <h5 class="card-title">';echo $name;echo'</h5>
                                            <h5 style="float:right;">Rs. ';echo $price;echo '</h5>
                                        </div>
                                    </div>
                                </div></a>';
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>

<!-- INSERT INTO `auction_item` (`item_id`, `item_name`, `item_type`, `init_bid`, `current_bid`, `due_date`, `post_date`, `category`, `item_condition`, `location`, `description`, `image`, `item_poster`) VALUES (NULL, 'Sofa', '', '5000', '0', '2020-05-21', '2020-05-06', 'Furniture', 'old', 'Peshawar', 'This is a very good sofa, you can sit you can lay down, watch TV or give us 4GPA when sitting on it :)', '', '1'); -->