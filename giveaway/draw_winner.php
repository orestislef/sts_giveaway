<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Επιλογή Νικητή</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
        }
        .winner-container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 400px;
            margin: 0 auto;
            text-align: center;
        }
        h2 {
            color: #007bff;
        }
        p {
            margin: 10px 0;
        }
        .draw-button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="winner-container">
        <?php
        // Place your database connection code here
        include 'connect.php';

        if (isset($_POST['draw_winner'])) {
            // Query to select a random winner from the giveaways table
            $sql = "SELECT * FROM giveaways WHERE phone_number NOT IN (SELECT phone_number FROM winners) ORDER BY RAND() LIMIT 1";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Fetch the winner's details
                $winner = $result->fetch_assoc();

                // Display the winner's details
                echo "<h2>Ο Νικητής είναι:</h2>";
                echo "<p><strong>Όνομα:</strong> " . $winner['name'] . "</p>";
                echo "<p><strong>Επίθετο:</strong> " . $winner['surname'] . "</p>";
                echo "<p><strong>Αριθμός Τηλεφώνου:</strong> " . $winner['phone_number'] . "</p>";
                ?>
                <!-- Button to add the winner to the winners table -->
                <form method="post">
                    <input type="hidden" name="winner_name" value="<?= $winner['name'] ?>">
                    <input type="hidden" name="winner_surname" value="<?= $winner['surname'] ?>">
                    <input type="hidden" name="winner_phone_number" value="<?= $winner['phone_number'] ?>">
                    <button class="draw-button" type="submit" name="add_to_winners">Add to Winners</button>
                </form>
                <?php
            } else {
                echo "<p>Δεν υπάρχουν διαθέσιμοι νικητές για να γίνει η επιλογή.</p>";
            }
        }

        // Code to add the winner to the winners table
        if (isset($_POST['add_to_winners'])) {
            $winner_name = $_POST['winner_name'];
            $winner_surname = $_POST['winner_surname'];
            $winner_phone_number = $_POST['winner_phone_number'];

            // Check if the winner's phone number already exists in the winners table
            $existing_winner_sql = "SELECT * FROM winners WHERE phone_number = '$winner_phone_number'";
            $existing_winner_result = $conn->query($existing_winner_sql);

            if ($existing_winner_result->num_rows == 0) {
                // Add the winner to the winners table
                $insert_winner_sql = "INSERT INTO winners (name, surname, phone_number) VALUES ('$winner_name', '$winner_surname', '$winner_phone_number')";
                if ($conn->query($insert_winner_sql) === TRUE) {
                    echo "<p>Ο νικητής προστέθηκε επιτυχώς στους νικητές!</p>";
                } else {
                    echo "<p>Προέκυψε σφάλμα κατά την προσθήκη του νικητή: " . $conn->error . "</p>";
                }
            } else {
                echo "<p>Το τηλέφωνο του νικητή υπάρχει ήδη στους νικητές.</p>";
            }
        }
        ?>
        <!-- Button to draw a random winner -->
        <form method="post">
            <button class="draw-button" type="submit" name="draw_winner">Επιλέξτε τυχαίο νικητή</button>
        </form>
    </div>
</body>
</html>
