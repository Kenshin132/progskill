<?php
require_once("dbConnection.php");

if (isset($_POST['search'])) {
    $searchTerm = mysqli_real_escape_string($mysqli, $_POST['search_term']);
    $query = "SELECT * FROM guests WHERE first_name LIKE '%$searchTerm%' OR mid_name LIKE '%$searchTerm%' OR last_name LIKE '%$searchTerm%' OR gen_id LIKE '%$searchTerm%'";
} else {
    $query = "SELECT * FROM guests";
}

$result = mysqli_query($mysqli, $query);
$rooms = mysqli_query($mysqli, "SELECT * FROM `rooms`");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <a href="index.php"><h1>Guests</h1></a>
    <form method="POST">
        <input type="text" name="search_term" placeholder="Search...">
        <button type="submit" name="search">Search</button>
    </form>
    <a href="add.php"><button>Add Guest</button></a>
    <table>
        <thead>
            <tr>
                <th>Guest Name and Date of Registration</th>
                <th>Generated Guest ID</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        <?php
        while($res = mysqli_fetch_assoc($result)){
            echo "<tr>";
            echo "<td>".$res['last_name'].", ".$res['first_name']." ".$res['mid_name']." <br> ".date('F j, Y', strtotime($res['dor']))."</td>";
            echo "<td>".$res['gen_id']."</td>";
            
            echo "<td>
            <a href=\"book.php?id=$res[guest_id]\"><button>Check-In</button></a>
            <a href=\"edit.php?id=$res[guest_id]\"><button>Edit</button></a>
            <a href=\"delete.php?id=$res[guest_id]\" onClick=\"return confirm('Are you sure you want to delete?')\"><button>Delete</button></a>
            </td>";
            echo "</tr>";
        }
        ?>
        </tbody>
    </table>

    <h1>Rooms and Rates</h1>
    <table>
        <thead>
            <tr>
                <th>Type</th>
                <th>Cost</th>
                <th>Minimum Stay</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while($rm = mysqli_fetch_assoc($rooms)){
                echo"<tr>";
                echo"<td>".$rm['type']."</td>";
                echo"<td>".$rm['cost']."</td>";
                echo"<td>".$rm['stay']."</td>";
                echo"</tr>";
            }
            ?>
        </tbody>
    </table>

</body>
</html>