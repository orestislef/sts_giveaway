<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Νικητές</title>
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
            max-width: 800px;
            margin: 0 auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>
    <div class="winner-container">
        <h2>Λίστα Νικητών</h2>
        <table>
            <thead>
                <tr>
                    <th>Όνομα</th>
                    <th>Επίθετο</th>
                    <th>Αριθμός Τηλεφώνου</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Place your database connection code here
                include 'connect.php';

                // Fetch winners from the winners table
                $sql = "SELECT * FROM winners";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['surname'] . "</td>";
                        echo "<td>" . $row['phone_number'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>Δεν υπάρχουν καταχωρήσεις για να εμφανιστούν.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
