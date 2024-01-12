<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Afisare detalii chitante</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="table.css">
</head>
<body>
    <h1>Afisare proprietari</h1>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nume</th>
            </tr>
        </thead>
        <tbody>
            <?php
                // Create short variables
                $nr = $_POST['nr'];
                $nr = trim($nr);

                if (!$nr)
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
                $query = "select p.nume from proprietar p join apartament a on p.id_proprietar = a.id_proprietar group by p.nume having count(a.id_ap) = ".$nr.";";

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
                    echo '<td>' . htmlspecialchars(stripslashes($row['nume'])) . '</td>';
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
