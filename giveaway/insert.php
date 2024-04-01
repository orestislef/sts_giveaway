<?php
include 'connect.php';

// via POST method
$name = $_POST['name'];
$surname = $_POST['surname'];
$phone_number = $_POST['phone_number'];
$accepted_terms = $_POST['accepted_terms'];

// Check if the phone number already exists
$check_sql = "SELECT COUNT(*) as count FROM giveaways WHERE phone_number = '$phone_number'";
$check_result = $conn->query($check_sql);
$row = $check_result->fetch_assoc();

$response = array();

if ($row['count'] > 0) {
    $response['success'] = false;
    $response['message'] = "Έχετε ήδη υποβάλει συμμετοχή στον διαγωνισμό!";
} else {
    $insert_sql = "INSERT INTO giveaways (name, surname, phone_number, accepted_terms) VALUES ('$name', '$surname', '$phone_number', '$accepted_terms')";
    
    if ($conn->query($insert_sql) === TRUE) {
        $response['success'] = true;
        $response['message'] = "Νέα εγγραφή δημιουργήθηκε με επιτυχία!";
    } else {
        $response['success'] = false;
        $response['message'] = "Σφάλμα: " . $insert_sql . "<br>" . $conn->error;
    }
}

header('Content-Type: application/json');
echo json_encode($response);

$conn->close();
?>
