<?php
error_reporting(0);

$msg = "";

$conn = new mysqli('127.0.0.1', 'root', '', 'storedb');
if ($conn->connect_error) {
    die('connection failed: ' . $conn->connect_error);
}
?>

<?php
$sql = "SELECT * FROM items";
$result = mysqli_query($conn, $sql);
$items = [];
while ($row = mysqli_fetch_assoc($result)) {
    $items[] = $row;
}
?>

<?php
$query = "SELECT * FROM categories";
$result = mysqli_query($conn, $query);
$categories = [];
while ($row = mysqli_fetch_assoc($result)) {
    $categories[] = $row;
}
?>
