<?php
require_once("dbConnection.php");

if (isset($_GET['id']) && isset($_GET['roomType']) && isset($_GET['stayDuration']) && isset($_GET['totalCost'])) {
    $guestId = mysqli_real_escape_string($mysqli, $_GET['id']);
    $roomType = mysqli_real_escape_string($mysqli, $_GET['roomType']);
    $stayDuration = mysqli_real_escape_string($mysqli, $_GET['stayDuration']);
    $totalCost = mysqli_real_escape_string($mysqli, $_GET['totalCost']);

    $guestQuery = "SELECT * FROM guests WHERE guest_id = '$guestId'";
    $guestResult = mysqli_query($mysqli, $guestQuery);
    $guestData = mysqli_fetch_assoc($guestResult);
} else {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billing</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <a href="index.php"><h1>Billing</h1></a>
    <h2>Guest Information</h2>
    <h2>Guest Information</h2>
    <p>Guest ID: <?php echo $guestData['gen_id']; ?></p>
    <p>Name: <?= $guestData['last_name'] ?>, <?= $guestData['first_name'] ?> <?= $guestData['mid_name'] ?></p>
    <p>Membership: <?php echo $guestData['type'] == 1 ? 'Member' : 'Non-Member'; ?></p>

    <h2>Billing Details</h2>
    <table>
        <thead>
            <tr>
                <th>Generated ID</th>
                <th>Room Type</th>
                <th>Stay Duration</th>
                <th>Total Cost</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?php echo $guestData['gen_id']; ?></td>
                <td><?php echo $roomType; ?></td>
                <td><?php echo $stayDuration; ?> day(s)</td>
                <td>Php <?php echo number_format($totalCost,2); ?></td>
            </tr>
        </tbody>
    </table>
</body>
</html>