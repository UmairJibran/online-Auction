<?php
    require_once('connection.php');
    require_once('navigation.php');
    $item = $_GET['itemName'];
?>

<html>
    <head>
        <title>Search Results for <?php echo $item?></title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Sulphur+Point:wght@400;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="styles/master.css">
    </head>
    <body>
        <div class="container">
            <?php
                $query = "SELECT *  FROM `auction_item` WHERE `item_name` LIKE '%$item%' ORDER BY `item_id` ASC";
                $result = $conn->query($query);
                $rows = $result->num_rows;
                if($rows >= 1){
                    while($data = $result->fetch_assoc()){
                        $name = $data['item_name'];
                        $image = $data['image'];
                        $itemID = $data['item_id'];
                        $description = $data['description'];
                        $condition = $data['item_condition'];
                        $highest_bid = $data['current_bid'];
                        echo "
                            <a href='singleItem.php?itemId=$itemID&itemName=$name'>
                                <div class='card mb-3'>
                                    <img src='$image' class='responsive' height='300px' style='object-fit: cover;' class='card-img-top' alt='$name'>
                                    <div class='card-body'>
                                        <h4 class='card-title'>$name</h4>
                                        <h5 class='card-text'>$description</h5>
                                        <p class='card-text' style='float:right'><small class='text-muted'>Current Highest Bid $highest_bid</small></p>
                                        <p class='card-text'><small class='text-muted'>Condition $condition</small></p>
                                    </div>
                                </div>
                            </a>
                        ";
                    }
                }else{
                    echo "
                        <div class='alert alert-danger' role='alert'>
                            <center>No Item found for $item, why don't you post one</center>
                        </div>
                    ";
                }
            ?>
        </div>
    </body>
</html>