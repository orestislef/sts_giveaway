<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Προβολή Καταχωρήσεων</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f2f2f2;
        }
        .container {
            max-width: 95%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .no-entries {
            text-align: center;
            color: #999;
            font-style: italic;
        }
        .search-container {
            margin-bottom: 20px;
        }
        .search-container input[type="text"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Προβολή Καταχωρήσεων</h2>
        <div class="search-container">
            <input type="text" id="searchInput" onkeyup="searchEntries()" placeholder="Αναζήτηση καταχωρήσεων...">
        </div>
        <table id="entriesTable">
            <thead>
                <tr>
                    <th>Όνομα</th>
                    <th>Επώνυμο</th>
                    <th>Αριθμός Τηλεφώνου</th>
                    <th>Αποδοχή Όρων</th>
                    <th>Ημερομηνία Καταχώρησης</th>
                </tr>
            </thead>
            <tbody>
               <?php
					include 'connect.php';

					$sql = "SELECT * FROM giveaways";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						// Output data of each row
						while($row = $result->fetch_assoc()) {
							echo "<tr>";
							echo "<td>" . $row["name"] . "</td>";
							echo "<td>" . $row["surname"] . "</td>";
							echo "<td>" . $row["phone_number"] . "</td>";
							echo "<td>" . ($row["accepted_terms"] ? "Ναι" : "Όχι") . "</td>";
							echo "<td>" . $row["entry_date"] . "</td>";
							echo "</tr>";
						}
					} else {
						echo '<tr><td colspan="5" class="no-entries">Δεν υπάρχουν καταχωρήσεις.</td></tr>';
					}

					$conn->close();
					?>
            </tbody>
        </table>
    </div>

    <script>
        function searchEntries() {
            var input, filter, table, tr, td, i, txtValue;
            input = document.getElementById("searchInput");
            filter = input.value.toUpperCase();
            table = document.getElementById("entriesTable");
            tr = table.getElementsByTagName("tr");

            for (i = 0; i < tr.length; i++) {
                td = tr[i].getElementsByTagName("td")[0];
                if (td) {
                    txtValue = td.textContent || td.innerText;
                    if (txtValue.toUpperCase().indexOf(filter) > -1) {
                        tr[i].style.display = "";
                    } else {
                        tr[i].style.display = "none";
                    }
                }
            }
        }
    </script>
</body>
</html>
