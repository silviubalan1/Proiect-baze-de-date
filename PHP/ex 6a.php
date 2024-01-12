<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Afisare detalii chitante</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="table.css">
</head>
<body>
    <h1>Afisare consum</h1>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>An</th>
                <th>Id_ap</th>
                <th>Minim</th>
                <th>Mediu</th>
                <th>Maxim</th>
            </tr>
        </thead>
        <tbody>
            <?php
                // Create short variables
                $id_ap = $_POST['id_ap'];
                $id_ap = trim($id_ap);

                if (!$id_ap)
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
                $query = "select an, id_ap, min(valoare) as 'min', avg(valoare) as 'avg', max(valoare) as 'max' from consum where id_ap=".$id_ap." group by an,id_ap";

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
                    echo '<td>' . htmlspecialchars(stripslashes($row['an'])) . '</td>';
                    echo '<td>' . stripslashes($row['id_ap']) . '</td>';
                    echo '<td>' . stripslashes($row['min']) . '</td>';
                    echo '<td>' . stripslashes($row['avg']) . '</td>';
                    echo '<td>' . stripslashes($row['max']) . '</td>';
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
