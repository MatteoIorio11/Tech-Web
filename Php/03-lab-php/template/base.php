<!DOCTYPE html>
<html lang="it">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $templateParams["titolo"]; ?></title>
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
</head>
<body>
    <header>
        <h1>Blog di Tecnologie Web</h1>
    </header>
    <nav>
        <ul>
            <li><a <?php isActive("index.php");?> href="index.php">Home</a></li><li><a <?php isActive("archivio.php");?> href="archivio.php">Archivio</a></li><li><a <?php isActive("contatti.php");?> href="contatti.php">Contatti</a></li><li><a <?php isActive("login.php");?> href="login.php">Login</a></li>
        </ul>
    </nav>
    <main>
    <?php
    if(isset($templateParams["nome"])){
        require($templateParams["nome"]);
    }
    ?>
    </main><aside>
        <section>
            <h2>Post Casuali</h2>
            <ul>
            <?php foreach($templateParams["articolicasuali"] as $articolocasuale): ?>
                <li>
                    <img src="<?php echo UPLOAD_DIR.$articolocasuale["imgarticolo"]; ?>" alt="" />
                    <a href="articolo.php?id=<?php echo $articolocasuale["idarticolo"]; ?>"><?php echo $articolocasuale["titoloarticolo"]; ?></a>
                </li>
            <?php endforeach; ?>
            </ul>
        </section>
        <section>
            <h2>Categorie</h2>
            <ul>
<<<<<<< HEAD
            <?php foreach($templateParams["categorie"] as $categoria): ?>
                <li><a href="articoli-categoria.php?id=<?php echo $categoria["idcategoria"]; ?>"><?php echo $categoria["nomecategoria"]; ?></a></li>
            <?php endforeach; ?>
=======
                <?php foreach($templateParams["categorie"] as $categoria) :?>
                <li><a href="categorie.php?cat=<?php echo $categoria['idcategoria']; ?>"> <?php echo $categoria["nomecategoria"]; ?></a></li>
                <?php endforeach; ?>
>>>>>>> bc306d50ff3a707d639c0ab78dac1dbc9d7c8351
            </ul>
        </section>
    </aside>
    <footer>
        <p>Tecnologie Web - A.A. 2022/2023</p>
    </footer>
</body>
</html>