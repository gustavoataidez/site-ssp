<?php
// Simulação de notícias (em produção, use um banco de dados)
$noticias = [
    [
        "id" => 1,
        "titulo" => "Notícia 1",
        "categoria" => "Tecnologia",
        "capa" => "capa1.png",
        "resumo" => "Resumo da notícia 1."
    ],
    [
        "id" => 2,
        "titulo" => "Notícia 2",
        "categoria" => "Esportes",
        "capa" => "capa2.jpg",
        "resumo" => "Resumo da notícia 2."
    ],
    [
        "id" => 3,
        "titulo" => "Notícia 3",
        "categoria" => "Entretenimento",
        "capa" => "capa3.jpg",
        "resumo" => "Resumo da notícia 3."
    ],
];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Notícias</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Últimas Notícias</h1>
        <div class="noticias-lista">
            <?php foreach ($noticias as $noticia): ?>
                <div class="noticia">
                    <img src="<?= $noticia['capa'] ?>" alt="Capa da <?= $noticia['titulo'] ?>">
                    <div class="noticia-detalhes">
                        <h2><?= $noticia['titulo'] ?></h2>
                        <span class="categoria"><?= $noticia['categoria'] ?></span>
                        <p><?= $noticia['resumo'] ?></p>
                        <a href="noticia.php?id=<?= $noticia['id'] ?>" class="btn">Leia Mais</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
