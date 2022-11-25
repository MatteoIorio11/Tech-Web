const datiArticoli = [{
    "Autore": "Gino Pino",
    "Data": "2 Ottobre 2019",
    "Titolo": "Intro alle Tecnologie Web Client Side",
    "Immagine": "./img/html5-js-css3.png",
    "Testo": '"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."'
},
{
    "Autore": "Cippa Lippa",
    "Data": "2 Ottobre 2019",
    "Titolo": "Intro alle Tecnologie Web Server Side",
    "Immagine": "./img/php.png",
    "Testo": '"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."'
}]

const main = document.querySelector("main");
datiArticoli.forEach(element => {
    main.innerHTML += `
    <article> 
        <header>
            <div> 
                <img = src="${element["Immagine"]}" alt=""/>
            </div>
        </header>
        <h2>${element["Titolo"]}</h2>
        <p>${element["Data"]}</p>
        <section>
            <p>${element["Testo"]}</p>
        </section>
         <footer>
            <a href="#">Leggi tutto</a>
        </footer>
    </article>`
});

