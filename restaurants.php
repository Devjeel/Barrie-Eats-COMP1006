<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Restaurants</title>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
</head>
<body>

<?php
// access the current session
session_start();
if (isset($_SESSION['userId'])) {
    echo '<a href="restaurant.php">Add a New Restaurant</a> ';
    echo '<a href="logout.php">Logout</a>';
}
?>

<h1>View all restaurants</h1>

<?php
//connect
$db = new PDO('mysql:host=localhost;dbname=barrieEats', 'root','jeelhp2015.');

//set up query
$sql = "SELECT * FROM restaurants";

//execute and store the table
$cmd = $db->prepare($sql);
$cmd->execute();
$restaurants = $cmd->fetchAll();

//start the table
echo '<table class="table table-bordered table-striped text-center"><thead><th>Name</th><th>Address</th><th>Phone</th><th>Restaurant Type</th>';

if (isset($_SESSION['userId'])) {
    echo '<th>Actions</th>';
}
echo'</thead><tbody>';

//loop the data & show each restaurants
foreach($restaurants as $r){
    echo"<tr><td>{$r['name']}</td>
             <td>{$r['address']}</td>
             <td>{$r['phone']}</td>
             <td>{$r['restaurantType']}</td>";

    if (isset($_SESSION['userId'])) {
        echo "<td><a href=\"restaurant.php?restaurantId={$r['restaurantId']}\"
                    class=\"btn btn-info btn-sm\">Edit</a>
             <a href=\"delete-restaurants.php?restaurantId={$r['restaurantId']}\"
                    class=\"btn btn-danger btn-sm confirmation\">Delete</a></td></tr>";
    }
}

//close the table
echo '</tbody></table>';

//disconnect
$db = null;
?>

<script src="https://code.jquery.com/jquery-3.3.1.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
</body>
</html>