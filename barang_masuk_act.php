<?php 
include '../dbconnect.php';

if (isset($_POST['barang']) && isset($_POST['qty']) && isset($_POST['tanggal']) && isset($_POST['ket']) && isset($_POST['department'])) {
    $barang = $_POST['barang'];
    $qty = $_POST['qty'];
    $tanggal = $_POST['tanggal'];
    $ket = $_POST['ket'];
    $department = $_POST['department'];
    $serialnumber = isset($_POST['serialnumber']) ? $_POST['serialnumber'] : '';

    // Validate input values here if needed

    $dt = mysqli_query($conn, "SELECT * FROM sstock_brg WHERE idx='$barang'");
    $data = mysqli_fetch_assoc($dt);

    if ($data) {
        $sisa = $data['stock'] + $qty;

        $query1 = mysqli_query($conn, "UPDATE sstock_brg SET stock='$sisa' WHERE idx='$barang'");
        $query2 = mysqli_query($conn, "INSERT INTO sbrg_masuk (idx, tgl, jumlah, keterangan, department, serialnumber) 
                    VALUES ('$barang', '$tanggal', '$qty', '$ket', '$department', '$serialnumber')");

        if ($query1 && $query2) {
            echo " <div class='alert alert-success'>
            <strong>Success!</strong> Redirecting you back in 1 second.
            </div>
            <meta http-equiv='refresh' content='1; url= masuk.php'/>  ";
        } else {
            echo "<div class='alert alert-warning'>
            <strong>Failed!</strong> Redirecting you back in 1 second.
            </div>
            <meta http-equiv='refresh' content='1; url= masuk.php'/> ";
        }
    } else {
        echo "<div class='alert alert-danger'>
        <strong>Error!</strong> Invalid item selected.
        </div>";
    }

} else {
    echo "<div class='alert alert-danger'>
    <strong>Error!</strong> Required fields not provided.
    </div>";
}

mysqli_close($conn);
?>

<html>
<head>
  <title>Barang Masuk</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<!-- Your HTML content here -->
</body>
</html>
