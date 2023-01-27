<head>
<link href="css/styles.css" rel="stylesheet" />
</head>
<body>
    <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
        <div class="d-flex flex-column align-items-center align-items-sm-start px-3 pt-2 text-white min-vh-100">
            <a href="/" class="d-flex align-items-center pb-3 mb-md-0 me-md-auto text-white text-decoration-none">
                <span class="fs-5 d-none d-sm-inline">Filter</span>
            </a>
            <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                <form method="post" action="index.php">
                    <?php
                    include "queries.php";
                    foreach($categories as $cat){
                        echo '<li class="nav-item">
                        <a class="nav-link align-middle px-0">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="'.$cat["id"].'" value="" id="flexCheckDefault">
                                <label class="form-check-label" style="color:white;">
                                    '.$cat["title"].'
                                </label>
                        </div>
                        </a>
                        </li>';
                    }
                    $sql = "SELECT MAX(price) as max FROM items";
                    $max = mysqli_query($conn,$sql);
                    $max = mysqli_fetch_assoc($max);
                    $sql = "SELECT MIN(price) as min FROM items";
                    $min = mysqli_query($conn,$sql);
                    $min = mysqli_fetch_assoc($min);
                    ?>
                    
                    <div class="range-slider">
                        <input id="max_range" type="range" name="max" class="max-price" <?php echo 'min='.$min['min']?> <?php echo 'max='.$max['max']?> step="10" onchange="handle_slider_change()">
                    </div>
                    <div>
                    <label>Max</label>
                    <p id="max_text"></p>
                    </div>
                    <div class="range-slider">
                        <input id="min_range" type="range" name="min" class="min-price" <?php echo 'min='.$min['min']?> <?php echo 'max='.$max['max']?> step="10" onchange="handle_slider_change_min()">
                    </div>
                    <div>
                    <label>Min</label>
                    <p id="min_text"></p>
                    </div>          
                    <li>
                        <button type="submit" name="filter" class="nav-link px-0 align-middle" style="color:white;">
                            <i class="bi bi-ui-checks"></i> <span class="ms-1 d-none d-sm-inline">submit</span> </button>
                    </li>
                
                </form>
            </ul>
        </div>
    </div>
    <script src="./js/scripts.js"></script>
</body>