
<?php

$errors = [];
$currencyData = [
    "EUR" => 1,
    "MAD" => 10,
    "USD" => 0.85,
    "GBP" => 1.11,
];

//calculer le prix converti
function convertedPrice($currencyData, $price, $currencies1, $currencies2) {
    return $price * $currencyData[$currencies2] / $currencyData[$currencies1];
}

// switcher les 2 devises
function swapCurrencies()
{
    list($_POST["currencies1"], $_POST["currencies2"]) = [$_POST["currencies2"], $_POST["currencies1"]]; 
}



if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["submit"]) && $_POST["submit"] === "convert") {
        $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT);
        $currencies1 = $_POST["currencies1"];
        $currencies2 = $_POST["currencies2"];
        if (empty($price)) {
            $errors["price"] = "Price is required.";
        } else if ($price < 0) {
            $errors["price"] = "Enter a positive number.";
        } else {
            $convertedPrice = convertedPrice($currencyData, $price, $currencies1, $currencies2);
        }
    }
    if (isset($_POST["submit"]) && $_POST["submit"] === "swap") {
        swapCurrencies();
    }
}

require_once "./converter.php";
?>