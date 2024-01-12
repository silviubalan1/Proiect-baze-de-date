<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Afisare detalii chitante</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="table.css">
</head>
<body>
    <h1>Afisare detalii consum</h1>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Id apartament</th>
                <th>An</th>
                <th>Luna</th>
                <th>Nr_pers</th>
                <th>Cantitate</th>
                <th>Valoare</th>
                <th>Pret_apa</th>
            </tr>
        </thead>
        <tbody>
            <?php
                // Create short variables
                $an = $_POST['an'];
                $an = trim($an);

                $luna = $_POST['luna'];
                $luna = trim($luna);

                if (!$an || !$luna)
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
                $query = "select * from consum where valoare <= ALL (select valoare from consum where luna=".$luna." and an=".$an.") and luna=".$luna." and an=".$an."";

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
                    echo '<td>' . htmlspecialchars(stripslashes($row['id_ap'])) . '</td>';
                    echo '<td>' . stripslashes($row['an']) . '</td>';
                    echo '<td>' . stripslashes($row['luna']) . '</td>';
                    echo '<td>' . stripslashes($row['nr_pers']) . '</td>';
                    echo '<td>' . stripslashes($row['cantitate']) . '</td>';
                    echo '<td>' . stripslashes($row['valoare']) . '</td>';
                    echo '<td>' . stripslashes($row['pret_apa']) . '</td>';
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
