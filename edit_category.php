<?php
error_reporting(0);

$msg = "";

$conn = new mysqli('127.0.0.1', 'admin', 'admin', 'storedb');
if ($conn->connect_error) {
    die('connection failed: ' . $conn->connect_error);
}

if (isset($_POST['upload'])) {
    $id = $_GET['edit'];
    $title = $_POST['name'];

    $query = "UPDATE categories set title='$title' where id=$id";
    echo $query;
    $exec = mysqli_query($conn, $query);
    if (!$exec) {
        $msg = mysqli_error($conn);
        // $msg = 'Failed to edit category!<br>values are not accepted.';
    } else {
        $msg = 'category edited successfully!';
    }
    header( "refresh:2;url=dashboard.php" );
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />

</head>

<body style="background-color:navy;">
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <?php include "admin_sidebar.php" ?>
            <div class="col py-3">
                <form style="margin: 5% 25% 0% 25%; background-color: white; padding:1rem; border-radius:1rem;" method="POST">

                    <?php
                    $id = $_GET['edit'];
                    $sql = 'SELECT * from categories where id=' . $id;
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    print_r($row);
                    ?>

                    <div class="form-outline mb-4">
                        <input type="text" id="name" name="name" class="form-control" value="<?php echo $row['title'] ?>" />
                        <label class="form-label" for="name">Category name</label>
                    </div>
                    <p><?php echo $msg; ?></p>
                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-block mb-4" style="margin-top:2rem;" name="upload">Edit</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>