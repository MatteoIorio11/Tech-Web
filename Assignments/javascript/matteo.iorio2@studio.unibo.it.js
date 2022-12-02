const CURRENT = "current";
const img_tags = document.querySelectorAll("img");
const img_lenght = img_tags.length;
let current_index  = 0;
img_tags[current_index].classList.add(CURRENT);
//PUNTO 0
//Al caricamento della pagina vengano nascoste tutte le immagini, eccetto le prime due.
//Alla prima immagine deve essere inoltre aggiunta la classe "current". 
for(let i = 2; i < img_tags.length; i++){
    img_tags[i].style.display = 'none';
}

function handler(index){
    //PUNTO 1:
    //Al click su un'immagine, si dovrà controllare se l’immagine ha la classe current e
    //nel caso non fare nulla.
    if(img_tags[index].className === ""){
        //PUNTO 2:
        //In caso contrario, invece, bisognerà aggiungere la classe current, rimuovendola da altre immagini
        img_tags[current_index].classList.remove(CURRENT);
        img_tags[index].classList.add(CURRENT);
        coverNeighbors(index);
        current_index = index;
        showNeighbors();
    }

}

//PUNTO 3
//Successivamente, andranno opportunamente nascoste e visualizzate le immagini in modo
// che siano visibili: l’immagine con classe current, l’eventuale immagine prima e l’eventuale immagine dopo.

function coverNeighbors(nw_curr){
    if(current_index-1 >= 0 && current_index-1 !== nw_curr){
        img_tags[current_index-1].style.display = 'none';
    }
    if(current_index+1 < img_lenght && current_index+1 !== nw_curr){
        img_tags[current_index+1].style.display = 'none';
    }
}

function showNeighbors(){
    if(current_index-1 >= 0){
        img_tags[current_index-1].style.display = '';
    }
    if(current_index+1 < img_lenght){
        img_tags[current_index+1].style.display = '';
    }
}

for(let i = 0; i < img_lenght; i++){
    img_tags[i].addEventListener("click", event => {
        handler(i);
    });
}