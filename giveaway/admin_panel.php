<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Διαχειριστής</title>
    <style>
        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
        }
        .tab {
            overflow: hidden;
            border: 1px solid #ccc;
            background-color: #f1f1f1;
            border-radius: 8px;
        }
        .tab button {
            background-color: inherit;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
            font-size: 17px;
        }
        .tab button:hover {
            background-color: #ddd;
        }
        .tab button.active {
            background-color: #007bff;
            color: white;
        }
        .tabcontent {
            display: none;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #ccc;
            background-color: #fff;
        }
    </style>
    <script>
        function openTab(evt, tabName) {
            // Declare variables
            var i, tabcontent, tablinks;

            // Get all elements with class="tabcontent" and hide them
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            // Get all elements with class="tablinks" and remove the class "active"
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }

            // Show the current tab, and add an "active" class to the button that opened the tab
            document.getElementById(tabName).style.display = "block";
            evt.currentTarget.className += " active";
        }
    </script>
</head>
<body>

<div class="tab">
    <button class="tablinks" onclick="openTab(event, 'ViewEntries')">Προβολή Καταχωρήσεων</button>
    <button class="tablinks" onclick="openTab(event, 'DrawWinner')">Επιλογή Νικητή</button>
    <button class="tablinks" onclick="openTab(event, 'Winners')">Νικητές</button>
</div>

<!-- Content for the tabs -->
<div id="ViewEntries" class="tabcontent">
    <?php include 'view_entries.php'; ?>
</div>

<div id="DrawWinner" class="tabcontent">
    <?php include 'draw_winner.php'; ?>
</div>

<div id="Winners" class="tabcontent">
    <?php include 'winners.php'; ?>
</div>

</body>
</html>
