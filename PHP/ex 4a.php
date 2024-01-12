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
    <h1>Afisare lista cheltuieli</h1>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Proprietar</th>
                <th>Adresa</th>
                <th>Id_ap</th>
                <th>Valoare</th>
            </tr>
        </thead>
        <tbody>
            <?php
                // Create short variables
                $an = $_POST['an'];
                $an = trim($an);

                $luna = $_POST['luna'];
                $luna = trim($luna);

                $adresa = $_POST['adresa'];
                $adresa = trim($adresa);

                if (!$an || !$luna || !$adresa)
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
                $query = "select p.nume as 'Proprietar', a.adresa as 'Adresa', a.nr_ap as 'Numar Apartament', c.valoare as 'Valoare' 
                from proprietar p join apartament a on p.id_proprietar=a.id_proprietar join consum c on a.id_ap=c.id_ap 
                where c.luna=".$luna." and an=".$an." and a.adresa LIKE '%".$adresa."%'";

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
                    echo '<td>' . htmlspecialchars(stripslashes($row['Proprietar'])) . '</td>';
                    echo '<td>' . stripslashes($row['Adresa']) . '</td>';
                    echo '<td>' . stripslashes($row['Numar Apartament']) . '</td>';
                    echo '<td>' . stripslashes($row['Valoare']) . '</td>';
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
