<?php foreach($templateParams["articoli"] as $articolo): ?>
<article>
        <header>
            <div>
                <img src="<?php echo $articolo["imgarticolo"] ?>" alt="" />
            </div>
            <h2>Intro alle Tecnologie Web Server Side</h2>
            <p>2 Ottobre 2019 - Cippa Lippa</p>
        </header>
        <section>
            <p>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."</p>
        </section>
        <footer>
            <a href="#">Leggi tutto</a>
        </footer>
</article>
<?php endforeach; ?>    