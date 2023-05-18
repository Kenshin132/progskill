<?php
if (isset($_GET['id'])) {
    $guestId = mysqli_real_escape_string($mysqli, $_GET['id']);
    $guestQuery = "SELECT * FROM guests WHERE guest_id = '$guestId'";
    $guestResult = mysqli_query($mysqli, $guestQuery);
    $guestData = mysqli_fetch_assoc($guestResult);

    $roomsQuery = "SELECT * FROM `rooms`";
    $roomsResult = mysqli_query($mysqli, $roomsQuery);
} else {
    header("Location: index.php");
    exit();
}

if (isset($_POST['checkin'])) {
    $roomId = mysqli_real_escape_string($mysqli, $_POST['room']);
    $stayDuration = mysqli_real_escape_string($mysqli, $_POST['stay_duration']);

    $roomQuery = "SELECT * FROM `rooms` WHERE room_id = '$roomId'";
    $roomResult = mysqli_query($mysqli, $roomQuery);
    $roomData = mysqli_fetch_assoc($roomResult);

    $roomType = $roomData['type'];
    $roomMinStay = $roomData['stay'];
    $roomCost = $roomData['cost'];

    $discount = 0.05;
    $memberFreeStay = 1;

    if ($stayDuration < $roomMinStay) {
        $error = "Stay duration must be equal to or greater than the minimum stay for the selected room type.";
    } else {
        // Calculate the total cost with discounts and free stay
        $totalCost = 0;
        $subTotal = 0;
        $newStayDuration = 0;

        if ($guestData['type'] == 1) {
            $totalCost = $roomMinStay * $roomCost; //room cost
            $subTotal = $roomCost - ($roomCost * $discount); //get discounted cost

            $newStayDuration = $stayDuration - $memberFreeStay; //subtract free day
            $newStayDuration = $newStayDuration - $roomMinStay; //get the exceeding days

            //total computation
            $subTotal = $subTotal *  $newStayDuration;
            $totalCost = $totalCost + $subTotal;



        } else {
            $totalCost = $roomMinStay * $roomCost; //room cost
            $subTotal = $roomCost - ($roomCost * $discount); //get discounted cost

            $newStayDuration = $stayDuration - $roomMinStay; //get the exceeding days

            //total computation
            $subTotal = $subTotal *  $newStayDuration;
            $totalCost = $totalCost + $subTotal;
        }
        
        // Redirect to billing.php with the necessary data
        header("Location: billing.php?id=$guestId&roomType=$roomType&stayDuration=$stayDuration&totalCost=$totalCost");
        exit();
    }
}
?>