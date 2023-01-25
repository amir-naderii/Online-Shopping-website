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
                <form style="margin: 5% 25% 0% 25%; background-color: white; padding:1rem; border-radius:1rem;">
                    <!-- 2 column grid layout with text inputs for the first and last names -->
                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">
                                <input type="text" id="form6Example1" class="form-control" />
                                <label class="form-label" for="form6Example1">Item name</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <input type="text" id="form6Example2" class="form-control" />
                                <label class="form-label" for="form6Example2">Price</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-outline mb-4">
                        <input type="number" id="form6Example6" class="form-control" />
                        <label class="form-label" for="form6Example6">Available Items</label>
                    </div>


                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Category</label>
                        <select class="form-control" id="exampleFormControlSelect1">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>
                    <div class="form-group" style="margin-top:2rem;">
                        <label for="exampleFormControlFile1">Picture</label><br>
                        <input type="file" class="form-control-file" id="exampleFormControlFile1" accept="image/*">
                    </div>

                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-block mb-4" style="margin-top:2rem;">Add</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>