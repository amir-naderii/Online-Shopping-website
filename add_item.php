<?php
error_reporting(0);

$msg = "";

$conn = new mysqli('127.0.0.1', 'admin', 'admin', 'storedb');
if ($conn->connect_error) {
    die('connection failed: ' . $conn->connect_error);
}

if (isset($_POST['upload'])) {
    $title = $_POST['name'];
    $price = $_POST['price'];
    $noitem = $_POST['noitem'];
    $category = $_POST['category'];

    $query = "select id from categories where title='$category'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $category = (int) $row['id'];

    $filename = $_FILES["pic"]["name"];
    print_r($_FILES['pic']);
    $temp = explode(".", $filename);
    $filename = $title . rand() . '.' . end($temp);
    $tempname = $_FILES["pic"]["tmp_name"];
    $folder = "./image/" . $filename;

    $sql = "INSERT INTO items (title, price, location, stock, category_id, score) VALUES ('$title', '$price', '$folder', '$noitem', $category, 0)";
    $exec = mysqli_query($conn, $sql);

    if (!$exec) {
        $msg = mysqli_error($conn);
        print_r($msg);
        // $msg = 'Failed to upload image!<br>values are not accepted.';
    } else {
        // Now let's move the uploaded image into the folder: image
        if (move_uploaded_file($tempname, $folder)) {
            $msg = 'Item uploaded successfully!';
        } else {
            $msg = "Failed to upload Item!";
        }
    }
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

<?php include 'queries.php' ?>

<body style="background-color:navy;">
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <?php include "admin_sidebar.php" ?>
            <div class="col py-3">
                <form style="margin: 5% 25% 0% 25%; background-color: white; padding:1rem; border-radius:1rem;" method="POST">
                    <!-- 2 column grid layout with text inputs for the first and last names -->
                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">
                                <input type="text" id="item-name" class="form-control" name="name" />
                                <label class="form-label" for="name">Item name</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <input type="text" id="item-price" class="form-control" name="price" />
                                <label class="form-label" for="price">Price</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-outline mb-4">
                        <input type="number" id="item-number" class="form-control" name="noitem" />
                        <label class="form-label" for="noitem">Number of Available Items</label>
                    </div>


                    <div class="form-group">
                        <label for="category">Category</label>
                        <select class="form-control" id="item-category" name="category">
                            <?php
                            foreach ($categories as $cat) {
                                echo '<option value="' . $cat['title'] . '">' . $cat['title'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group" style="margin-top:2rem;">
                        <label for="pic">Picture</label><br>
                        <input type="file" class="form-control-file" id="item-pic" accept="image/*" name="pic" value="">
                    </div>

                    <p><?php echo $msg; ?></p>

                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-block mb-4" style="margin-top:2rem;" name="upload">Add</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>