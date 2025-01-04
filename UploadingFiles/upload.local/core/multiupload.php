<?php

$images = $_FILES['images'];

$normalizedImages = [];

foreach ($images as $key => $image) {
    foreach ($image as $key_name => $item) {
        $normalizedImages[$key_name][$key] = $item;
    }
}

foreach ($normalizedImages as $image) {

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
