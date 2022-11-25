const divP = document.querySelector("div");

document.querySelector("input").addEventListener("click", function(){
    let text = divP.innerHTML;
    text = text.toUpperCase();
    divP.innerHTML = text;  
}); // Get the first button and create a function in order to upper all the chars

document.querySelectorAll("input")[1].addEventListener("click", function(){
    let text = divP.innerHTML;
    text = text.toLocaleLowerCase();
    divP.innerHTML = text;  
});

document.querySelectorAll("input")[2].addEventListener("click", function(){
    let text = divP.innerHTML;
    text = text.substring(5) + text.substring(0, 5);
    divP.innerHTML = text;  
});
