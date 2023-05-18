<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Data</title>
</head>
<body>
    <?php
        require_once("dbConnection.php");

        function generateGenId($lastName, $dor) {
            $randomNumber = str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
            $formattedDor = strtoupper(date('dMY', strtotime($dor)));
            $genId = strtoupper(substr($lastName, 0, 3)) . '-' . $randomNumber . '-' . $formattedDor;
            return $genId;
        }

        if (isset($_POST['update'])){
            $guest_id = $_POST['id'];
            $last_name = strtoupper(mysqli_real_escape_string($mysqli, $_POST['last_name']));
            $first_name = strtoupper(mysqli_real_escape_string($mysqli, $_POST['first_name']));
            $mid_name = strtoupper(mysqli_real_escape_string($mysqli, $_POST['mid_name']));
            $type = mysqli_real_escape_string($mysqli, $_POST['type']);
            $dor = date('Y-m-d');
            $gen_id = generateGenId($last_name, $dor);

            $result = mysqli_query($mysqli, "UPDATE guests SET `last_name`='$last_name', `first_name`='$first_name', `mid_name`='$mid_name', `type`='$type', `gen_id`='$gen_id' WHERE `guest_id` = '$guest_id'");

            if ($result) {
                echo "<p>Data updated!</p>";
                echo "<a href='index.php'>View Result</a>";
            } else {
                echo "<p>Error: " . mysqli_error($mysqli) . "</p>";
            }
        }
    ?>
</body>
</html>