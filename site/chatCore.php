<?php
    session_start();
    include_once("connection.php");

    if (!isset($_SESSION["logged"])){
        if ($_SESSION["userType"] != 'e'){
            header("Location: noAuth.php");
        }
    }

    $method = $_POST["method"];
    $chatId = $_POST["chatId"];

    if (strcmp($method,'update') == 0){
        $shipment = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM shipments WHERE id = $chatId"));
        $result = mysqli_query($conn,"SELECT * FROM messages WHERE shipment = $chatId LIMIT 18446744073709551610 OFFSET $_POST[lastLine]");
        $text = array();

        if ($shipment["status"] == '1'){
            echo "[quit]";
            return;
        }

        foreach ($result as $row){
            $text[] = $row['sender']." said: ".$row['text'];
        }

        if (mysqli_num_rows($result) <= 0){
            echo "[]";
        }else{
            echo json_encode($text);
        }
    }else if (strcmp($method,'send') == 0){
        mysqli_query($conn,"INSERT INTO messages VALUES(null,'$_POST[message]',$chatId,'$_SESSION[user]')");
    }else if (strcmp($method,'updateStatus') == 0){
        mysqli_query($conn,"UPDATE shipments SET status = $_POST[status] WHERE id = $chatId");
    }
?>
