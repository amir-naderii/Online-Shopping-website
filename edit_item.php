<?php
error_reporting(0);

$msg = "";

include 'queries.php';

$id = $_GET['edit'];
$sql = 'SELECT * from items where id=' . $id;
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
if (isset($_POST['upload'])) {
    $title = $_POST['name'];
    $price = $_POST['price'];
    $noitem = $_POST['noitem'];
    $category = $_POST['category'];

    $query = "select id from categories where title='$category'";
    $result = mysqli_query($conn, $query);
    $cat = mysqli_fetch_assoc($result);
    $category = (int) $cat['id'];

    $image = $_POST['pic'];
    if (empty($image)) {
        $folder = $row['location'];
    } else {
        $filename = $_FILES["uploadfile"]["name"];
        $temp = explode(".", $filename);
        $filename = $title . rand() . '.' . end($temp);
        $tempname = $_FILES["uploadfile"]["tmp_name"];
        $folder = "./pics/" . $filename;
    }

    $query = "UPDATE items set title='$title', price=$price, location='$folder', stock=$noitem, category_id=$category where id=" . $id;
    $exec = mysqli_query($conn, $query);

    if (!$exec) {
        $msg = mysqli_error($conn);
        print_r($msg);
        // $msg = 'Failed to upload image!<br>values are not accepted.';
    } else {
        // Now let's move the uploaded image into the folder: image
        $msg = 'Item edited successfully!';
        if (!empty($image)) {
            if (move_uploaded_file($tempname, $folder)) {
                $msg = 'Item edited successfully!';
            } else {
                $msg = "Failed to upload Item!";
            }
        }
    }
    header("refresh:2;url=dashboard.php");
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

<body style="background-color:rgb(61,77,88);">
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <?php include "admin_sidebar.php" ?>
            <div class="col py-3">
                <form style="margin: 5% 25% 0% 25%; background-color: white; padding:1rem; border-radius:1rem;" method="POST" enctype='multipart/form-data'>

                    <?php
                    $id = $_GET['edit'];
                    $sql = 'SELECT * from items where id=' . $id;
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    ?>

                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">
                                <input type="text" id="item-name" class="form-control" name="name" value="<?php echo $row['title'] ?>" />
                                <label class="form-label" for="name">Item name</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <input type="text" id="item-price" class="form-control" name="price" value="<?php echo $row['price'] ?>" />
                                <label class="form-label" for="price">Price</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-outline mb-4">
                        <input type="number" id="item-number" class="form-control" name="noitem" value="<?php echo $row['stock'] ?>" />
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
                        <input type="file" class="form-control-file" id="item-pic" accept="images/*" name="pic">
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