<?php
// Initialiser la session
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">

    <title>Drink Converter</title>
</head>

<body>
    <div class="container my-5">
        <h1 class="bg-warning text-white text-center mb-5"> Drink Converter</h1>
        <div class="border rounded border-warning p-5">
            <form action="" method="POST">
                <div class="form-row">
                    <div class="form-group col-3">
                        <!-- selection de la 1ère monnaie -->
                        <select name="currencies1" id="currencies1">
                            <option value="EUR">EUR</option>
                            <option value="MAD">MAD</option>
                            <option value="USD">USD</option>
                            <option value="GBP">GBP</option>
                        </select>
                    </div>
                        <!-- input price  -->
                    <div class="form-group col-6">
                        <input class="form-control" type="number"  id="price" name="price">
                    </div>
                    
          <!-- price input error message -->
          <?php if (!empty($errors["price"])) : ?>
            <span class="error-message"><?= $errors["price"] ?? "" ?></span>
        <?php endif ?>
                </div>

                <div class="form-row">
                    <div class="form-group col-3">
                        <!-- selection de la 2ème monnaie --> 
                    <select name="currencies2" id="currencies2">
                        <option value="USD">USD</option>
                        <option value="EUR">EUR</option>
                        <option value="GBP">GBP</option>
                        <option value="MAD">MAD</option>
                        </select>
                    </div>
                    <div class="form-group col-6">
                           <!-- CONVERTED PRICE OUTPUT -->
            <span class="converted-price"><?= $convertedPrice ?? "0" ?></span>
                    </div>
                </div>


                <button class="btn btn-warning" type="submit" name="submit" value="convert">convert</button>
                <button class="btn btn-warning" type="submit" name="submit" value="swap"> swap </button>


            </form>
        </div>
    </div>
    <a href="logout.php">Logout</a>
</body>

</html>