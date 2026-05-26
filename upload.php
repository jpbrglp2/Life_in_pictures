<?php

require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = $_POST['title'];
    $story = $_POST['story'];

    $file = $_FILES['image'];

    $allowed = [
        'image/jpeg',
        'image/png',
        'image/webp'
    ];

    if (!in_array($file['type'], $allowed)) {
        die("Formato inválido");
    }

    $fileName = uniqid() . '_' . basename($file['name']);

    $destination = 'uploads/' . $fileName;

    move_uploaded_file($file['tmp_name'], $destination);

    $sql = "INSERT INTO photos
            (title, story, image_path)
            VALUES (?, ?, ?)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        $title,
        $story,
        $fileName
    ]);

    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Upload • Life in Pictures</title>

    <link
        rel="stylesheet"
        href="assets/css/style.css"
    >

</head>

<body>

    <div class="upload-page">

        <form
            class="upload-form"
            method="POST"
            enctype="multipart/form-data"
        >

            <h1>Nova memória</h1>

            <p>
                registre um momento.
            </p>

            <label>
                título
            </label>

            <input
                type="text"
                name="title"
                placeholder="ex: noite silenciosa"
                required
            >

            <label>
                história
            </label>

            <textarea
                name="story"
                placeholder="o que essa foto significa?"
                required
            ></textarea>

            <label class="custom-file">

                <input
                    type="file"
                    name="image"
                    required
                >

                <span>
                    selecionar foto
                </span>

            </label>

            <button type="submit">

                publicar memória

            </button>

        </form>

    </div>

</body>
</html>