<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $json = file_get_contents('config.json');
    $data = json_decode($json, true);

    $newAd = array(
        'id' => uniqid(),
        'title' => $_POST['title'],
        'description' => $_POST['description'],
        'price' => $_POST['price'],
        'image' => $_FILES['image']['name']
    );

    array_push($data['ads'], $newAd);
    file_put_contents('config.json', json_encode($data));

    // Upload image
    move_uploaded_file($_FILES['image']['tmp_name'], 'assets/photos/' . $_FILES['image']['name']);
}

?>

<form method="post" enctype="multipart/form-data">
    Title: <input type="text" name="title"><br>
    Description: <textarea name="description"></textarea><br>
    Price: <input type="number" name="price"><br>
    Image: <input type="file" name="image"><br>
    <input type="submit" value="Create Ad">
</form