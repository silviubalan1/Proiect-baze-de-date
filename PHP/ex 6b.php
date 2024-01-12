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
    <h1>Afisare nume restantieri</h1>
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
                $data = $_POST['data'];
                $data = trim($data);

                $adresa = $_POST['adresa'];
                $adresa = trim($adresa);

                if (!$adresa || !$data)
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
                $query = "select p.nume from proprietar p join apartament ap on p.id_proprietar=ap.id_proprietar join consum cs on ap.id_ap=cs.id_ap join chitanta ct on ct.id_ap=cs.id_ap 
                where ap.adresa='".$adresa."'
                and ct.data='".$data."'
                group by p.nume
                having sum(ct.valoare)<sum(cs.valoare)";

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
