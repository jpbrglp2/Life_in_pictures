<?php

require 'config.php';

$sql = "SELECT * FROM photos ORDER BY created_at DESC";

$photos = $pdo->query($sql)->fetchAll();

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Life in Pictures</title>

    <link
        rel="stylesheet"
        href="assets/css/style.css"
    >

</head>

<body>

    <header>

        <h1>Life in Pictures</h1>

        <p>
            Um arquivo visual de memórias.
        </p>

    </header>

    <main class="gallery">

        <?php foreach($photos as $photo): ?>

            <a
                href="photo.php?id=<?php echo $photo['id']; ?>"
                class="photo-card"
            >

                <div class="image-container">

                    <img
                        src="uploads/<?php echo $photo['image_path']; ?>"
                        alt="<?php echo htmlspecialchars($photo['title']); ?>"
                    >

                </div>

                <div class="content">

                    <div>

                        <h2>
                            <?php
                            echo htmlspecialchars(
                                $photo['title']
                            );
                            ?>
                        </h2>

                        <p>
                            <?php
                            echo nl2br(
                                htmlspecialchars(
                                    $photo['story']
                                )
                            );
                            ?>
                        </p>

                    </div>

                    <span class="date">

                        📅

                        <?php
                        echo date(
                            'd/m/Y',
                            strtotime($photo['created_at'])
                        );
                        ?>

                    </span>

                </div>

            </a>

        <?php endforeach; ?>

    </main>
     <a href="upload.php" class="upload-button" aria-label="Ir para upload">+</a>


</body>
</html>