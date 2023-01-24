<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<table class="table table-striped">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">title</th>
                    <th scope="col">Author</th>
                    <th scope="col">Option</th>
                  </tr>
                </thead>
                <tbody>
                <?php
                  $cnt = 1; 
                  foreach($posts as $post){
                    echo '<tr>
                    <th scope="row">' . $cnt . '</th>
                    <td>'.$post['title'].'</td>
                    <td>'.$post['author'].'</td>
                    <td class="options">
                    <form style="display: inline-block;" action="delete.php" method="get">
                      <input type="hidden" name="delete" value="'.$post["id"].'">
                      <input type="hidden" name="post_del" value="post">
                      <button type="submit" class="option_butt">Delete</button>
                    </form>
                    <form style="display: inline-block;" action="post.php" method="get">
                      <input type="hidden" name="edit" value="'.$post["id"].'">
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
                  foreach($categories as $cat){
                    echo '<tr>
                    <th scope="row">' . $cnt . '</th>
                    <td>'.$cat['title'].'</td>
                    <td class="options">
                    <form style="display: inline-block;" action="delete.php" method="get">
                      <input type="hidden" name="delete" value="'.$cat["id"].'">
                      <input type="hidden" name="cat_del" value="category">
                      <button type="submit" class="option_butt">Delete</button>
                    </form>
                    <form style="display: inline-block;" action="category.php" method="get">
                      <input type="hidden" name="edit" value="'.$cat["id"].'">
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
</body>
</html>