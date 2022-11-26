console.log("Hello World");

document.querySelector("body  > span#ciao");  // Posso trovare piu di un elemento
document.querySelectorAll("span");
let tagHello = document.getElementById("ciao"); // Get the element from the hello.html by using the ID
tagHello.innerHTML = "Hello World"; // Set the new content of the element

let tagYear = document.querySelector(".anno");
tagYear.innerText = "2022"; 