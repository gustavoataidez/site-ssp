<?php
// Simulação de notícias
$noticias = [
    1 => [
        "titulo" => "Notícia 1",
        "conteudo" => "Conteúdo completo da notícia 1.",
        "categoria" => "Tecnologia",
        "capa" => "capa1.png",
    ],
    2 => [
        "titulo" => "Notícia 2",
        "conteudo" => "Conteúdo completo da notícia 2.",
        "categoria" => "Esportes",
        "capa" => "capa2.jpg",
    ],
    3 => [
        "titulo" => "Notícia 3",
        "conteudo" => "Conteúdo completo da notícia 3.",
        "categoria" => "Entretenimento",
        "capa" => "capa3.jpg",
    ],
];

$id = $_GET['id'] ?? 1; // Obtém o ID da notícia
$noticia = $noticias[$id];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $noticia['titulo'] ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container noticia-detalhada">
        <h1><?= $noticia['titulo'] ?></h1>
        <img src="<?= $noticia['capa'] ?>" alt="Capa da <?= $noticia['titulo'] ?>">
        <span class="categoria"><?= $noticia['categoria'] ?></span>
        <p><?= $noticia['conteudo'] ?></p>
        <a href="index.php" class="btn">Voltar</a>
    </div>
</body>
</html>
