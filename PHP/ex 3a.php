<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Afisare note studenti</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="table.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Afisare detalii proprietar</h1>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>ID Proprietar</th>
                <th>Nume</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <?php
                // Create short variables
                $lit = $_POST['litera'];
                $lit = trim($lit);

                if (!$lit)
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
                $query = "select * from proprietar where nume like '%".$lit."' order by nume desc";

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
                    echo '<td>' . htmlspecialchars(stripslashes($row['id_proprietar'])) . '</td>';
                    echo '<td>' . stripslashes($row['nume']) . '</td>';
                    echo '<td>' . stripslashes($row['email']) . '</td>';
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
