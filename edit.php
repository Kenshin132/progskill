<?php
    require_once("dbConnection.php");

    $id = $_GET['id'];

    $result = mysqli_query($mysqli, "SELECT * FROM guests WHERE guest_id = $id");

    $resultData = mysqli_fetch_assoc($result);

    $last_name = $resultData['last_name'];
    $first_name = $resultData['first_name'];
    $mid_name = $resultData['mid_name'];
    $type = $resultData['type'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data</title>
</head>
<body>
    <h2>Edit Data</h2>
    <p><a href="index.php">Home</a></p>

    <form name="edit" action="editAction.php" method="post">
        <table>
            <tr>
                <td>Last Name</td>
                <td><input type="text" name="last_name" value="<?php echo $last_name;?>"></td>
            </tr>
            <tr>
                <td>First Name</td>
                <td><input type="text" name="first_name" value="<?php echo $first_name;?>"></td>
            </tr>
            <tr>
                <td>Middle Name</td>
                <td><input type="text" name="mid_name" value="<?php echo $mid_name;?>"></td>
            </tr>
            <tr>
                <td>Type</td>
                <td><input type="number" name="type" value="<?php echo $type;?>" min="0" max="1"></td>
            </tr>
            <tr>
                <td><input type="hidden" name="id" value="<?php echo $id;?>"></td>
                <td><input type="submit" name="update" value="Update"></td>
            </tr>
        </table>
    </form>
</body>
</html>