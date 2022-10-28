<!DOCTYPE html>
<html lang="it">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $templateParams["titolo"]; ?></title>
    <link rel="stylesheet" type="text/css" href="sito/css/style.css" />
</head>
<body>
    <header>
        <h1>Blog di Tecnologie Web</h1>
    </header>
    <nav>
        <ul>
            <li><a href="index.html">Home</a></li><li><a href="archivio.html">Archivio</a></li><li><a href="contatti.html">Contatti</a></li><li><a href="login.html">Login</a></li>
        </ul>
    </nav>
    <main>
        <article>
            <header>
                <div>
                    <img src="./img/html5-js-css3.png" alt="" />
                </div>
                <h2>Intro alle Tecnologie Web Client Side</h2>
                <p>28 Ottobre 2022 - Gino Pino</p>
            </header>
            <section>
                <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>
            </section>
            <footer>
                <a href="#">Leggi tutto</a>
            </footer>
        </article>
        <article>
            <header>
                <div>
                    <img src="./img/php.png" alt="" />
                </div>
                <h2>Intro alle Tecnologie Web Server Side</h2>
                <p>28 Ottobre 2022 - Cippa Lippa</p>
            </header>
            <section>
                <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>
            </section>
            <footer>
                <a href="#">Leggi tutto</a>
            </footer>
        </article>
    </main><aside>
        <section>
            <h2>Post Casuali</h2>
            <ul>
                <?php foreach($templateParams["articolicasuali"] as $articolocasuale): ?>        
                    <li>
                        <img src="<?php echo UPLOAD_DIR.$articolocasuale["imgarticolo"]; ?>" alt="" />
                        <a href="#"><?php echo $articolocasuale["titoloarticolo"]; ?></a>
                    </li>
                <?php endforeach; ?>
                </ul>
        </section>
        <section>
            <h2>Categorie</h2>
            <ul>
                <li><a href="#">HTML</a></li>
                <li><a href="#">CSS</a></li>
                <li><a href="#">PHP</a></li>
                <li><a href="#">Javascript</a></li>
                <li><a href="#">jQuery</a></li>
                <li><a href="#">Apache</a></li>
            </ul>
        </section>
    </aside>
    <footer>
        <p>Tecnologie Web - A.A. 2022/2023</p>
    </footer>
</body>
</html>