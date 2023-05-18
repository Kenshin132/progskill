<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Data</title>
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

        if (isset($_POST['submit'])){
            $last_name = strtoupper(mysqli_real_escape_string($mysqli, $_POST['last_name']));
            $first_name = strtoupper(mysqli_real_escape_string($mysqli, $_POST['first_name']));
            $mid_name = strtoupper(mysqli_real_escape_string($mysqli, $_POST['mid_name']));
            $type = mysqli_real_escape_string($mysqli, $_POST['type']);
            $dor = date('Y-m-d');
            $gen_id = generateGenId($last_name, $dor);

            $result = mysqli_query($mysqli, "INSERT INTO guests (`last_name`, `first_name`, `mid_name`, `type`, `dor`, `gen_id`) VALUES ('$last_name', '$first_name', '$mid_name', '$type', '$dor', '$gen_id')");

            if ($result) {
                echo "<p>Data added!</p>";
                echo "<a href='index.php'>View Result</a>";
            } else {
                echo "<p>Error: " . mysqli_error($mysqli) . "</p>";
            }
        }
    ?>
</body>
</html>