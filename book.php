<?php
require_once("dbConnection.php");
require_once("bookAction.php")
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check-In</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <a href="index.php"><h1>Check-In</h1></a>
    <h2>Guest Information</h2>
    <p>Guest ID: <?php echo $guestData['gen_id']; ?></p>
    <p>Name: <?= $guestData['last_name'] ?>, <?= $guestData['first_name'] ?> <?= $guestData['mid_name'] ?></p>
    <p>Membership: <?php echo $guestData['type'] == 1 ? 'Member' : 'Non-Member'; ?></p>
    <form method="POST">
        <h2>Select Room and Stay Duration</h2>
        <?php if (isset($error)) : ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
        <label for="room">Room Type:</label>
        <select name="room" id="room">
            <?php
            while ($roomData = mysqli_fetch_assoc($roomsResult)) {
                echo "<option value='" . $roomData['room_id'] . "'>" . $roomData['type'] . "</option>";
            }
            ?>
        </select>
        <label for="stay_duration">Stay Duration (in days):</label>
        <input type="number" name="stay_duration" id="stay_duration" min="1" required>
        <button type="submit" name="checkin">Check-In</button>
    </form>
</body>
</html>