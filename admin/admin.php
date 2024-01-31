<?php
// admin.php
$json = file_get_contents('config.json');
$data = json_decode($json, true);

foreach ($data['ads'] as $ad) {
    echo "Title: " . $ad['title'] . "<br>";
    echo "Description: " . $ad['description'] . "<br>";
    echo "Price: " . $ad['price'] . "<br>";
    echo "<img src='" . $ad['image'] . "'><br>";
    echo "<a href='updateAd.php?id=" . $ad['id'] . "'>Update</a>";
    echo "<a href='deleteAd.php?id=" . $ad['id'] . "'>Delete</a>";
}
?>