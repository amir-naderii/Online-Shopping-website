<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <title>Document</title>
</head>

<?php include 'queries.php' ?>

<body>
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <?php include "admin_sidebar.php" ?>
            <div class="col py-3">
                <h5>Items</h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Item Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $cnt = 1;
                        foreach ($items as $item) {
                            echo '<tr>
                    <th scope="row">' . $cnt . '</th>
                    <td>' . $item['title'] . '</td>
                    <td>' . $item['price'] . '</td>
                    <td class="options">
                    <form style="display: inline-block;" action="delete.php" method="get">
                      <input type="hidden" name="delete" value="' . $item["id"] . '">
                      <input type="hidden" name="item_del" value="post">
                      <button type="submit" class="option_butt">Delete</button>
                    </form>
                    <form style="display: inline-block;" action="post.php" method="get">
                      <input type="hidden" name="edit" value="' . $item["id"] . '">
                      <button type="submit" class="option_butt">Edit</button>
                    </form>
                    </td>
                    </tr>';
                            $cnt++;
                        }
                        ?>
                    </tbody>
                </table>
                <h5>categories</h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">title</th>
                            <th scope="col">Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $cnt = 1;
                        foreach ($categories as $cat) {
                            echo '<tr>
                    <th scope="row">' . $cnt . '</th>
                    <td>' . $cat['title'] . '</td>
                    <td class="options">
                    <form style="display: inline-block;" action="delete.php" method="get">
                      <input type="hidden" name="delete" value="' . $cat["id"] . '">
                      <input type="hidden" name="cat_del" value="category">
                      <button type="submit" class="option_butt">Delete</button>
                    </form>
                    <form style="display: inline-block;" action="category.php" method="get">
                      <input type="hidden" name="edit" value="' . $cat["id"] . '">
                      <button type="submit" class="option_butt">Edit</button>
                    </form>
                    </td>
                    </form>
                    </tr>';
                            $cnt++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>