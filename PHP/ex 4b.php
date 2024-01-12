<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Afisare detalii chitante</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="table.css">
</head>
<body>
    <h1>Afisare lista cheltuieli</h1>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Id_ap 1</th>
                <th>Id_ap 2</th>
            </tr>
        </thead>
        <tbody>
            <?php
                // Create short variables
                $adresa = $_POST['adresa'];
                $adresa = trim($adresa);

                if (!$adresa)
                {
                    echo 'Nu ati introdus criteriul de cautare. Va rog sa incercati din nou.';
                    exit;
                }

                // Connect to the database
                $db = new mysqli("localhost", "root", "", "partial");
                if (!$db) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // Prepare the query
                $query = "select a1.id_ap as 'Id apartament 1', a2.id_ap as 'Id apartament 2'
                from apartament a1 join apartament a2 on a1.adresa='".$adresa."' and a1.adresa=a2.adresa and a1.suprafata=a2.suprafata and a1.id_ap!=a2.id_ap and a1.id_ap<a2.id_ap";

                // Execute the query
                $result = mysqli_query($db, $query);

                // Check if the query was successful
                if (!$result) {
                    die("Query failed: " . mysqli_error($db));
                }

                // Fetch the data and display it in a table
                $numRows = mysqli_num_rows($result);
                for ($i = 0; $i < $numRows; $i++) {
                    $row = mysqli_fetch_assoc($result);

                    echo '<tr>';
                    echo '<td>' . ($i + 1) . '</td>';
                    echo '<td>' . htmlspecialchars(stripslashes($row['Id apartament 1'])) . '</td>';
                    echo '<td>' . stripslashes($row['Id apartament 2']) . '</td>';
                    echo '</tr>';
                }
            ?>
        </tbody>
    </table>
    <div class="button1">
            <button onclick="window.location.href='main_page.html'">Main Page</button>
    </div>
</body>
</html>
