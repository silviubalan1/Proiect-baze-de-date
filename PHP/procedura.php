<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <title>Afisare detalii chitante</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="table.css">
</head>
<body>
    <h1>Afisare tabela apartament</h1>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Id apartament</th>
                <th>Adresa</th>
                <th>Nr apartament</th>
                <th>Suprafata</th>
                <th>Id proprietar</th>
            </tr>
        </thead>
        <tbody>
            <?php
                // Connect to the database
                $db = new mysqli("localhost", "root", "", "partial");
                if (!$db) {
                    die("Connection failed: " . mysqli_connect_error());
                }

                // Prepare the query
                $query = "call tabela_apartament";

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
                    echo '<td>' . stripslashes($row['adresa']) . '</td>';
                    echo '<td>' . stripslashes($row['nr_ap']) . '</td>';
                    echo '<td>' . stripslashes($row['suprafata']) . '</td>';
                    echo '<td>' . stripslashes($row['id_proprietar']) . '</td>';
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
