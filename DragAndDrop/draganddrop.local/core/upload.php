<?php

$images = $_FILES;

foreach ($images as $image) {

    //validate

    $types = ['image/jpeg', 'image/png'];

    if (! in_array($image['type'], $types)) {
        continue;
    }

    $fileSize = $image['size'] / 1000000;
    $maxSize = 1; //mb

    if ($fileSize > $maxSize) {
        continue;
    }

    if (! is_dir('../uploads')) {
        mkdir('../uploads', 0777, true);
    }

    $extension = pathinfo($image['name'], PATHINFO_EXTENSION);

    $fileName = time().$image['name'];

    move_uploaded_file($image['tmp_name'], '../uploads/'.$fileName);
}

echo json_encode(['status' => true]);
