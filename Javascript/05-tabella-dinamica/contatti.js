const datiTabella = [{
    "Autore": "Gino Pino",
    "Email": "ginopino@blogtw.com",
    "Argomenti": "HTML, CSS, JS",
    "AOOO" : "aoo"
},
{
    "Autore": "Cippa Lippa",
    "Email": "cippalippa@blogtw.com",
    "Argomenti": "PHP",
    "AOOO" : "aooAOOOO"
}]

function stringaToID(stringa){
    return stringa.toLowerCase().replace(/[^a-zA-Z]/g, "");
}
const table = document.querySelector("table");
let content = "";
Object.keys(datiTabella[0]).forEach(col => {
    content += `<th id="${col.toLocaleLowerCase()}">${col}</th>`;
});
table.innerHTML = "<tr>" + content + "</tr>";
content = "";
datiTabella.forEach(element => {
    content +="<tr>"
    const id = stringaToID(element["Autore"]);
    Object.keys(element).forEach(tag =>{
        
        if(tag === "Autore"){
            content +=`<th id="${id}">${element[tag]}</th>`
        }else{
            content +=`<td headers="${tag.toLocaleLowerCase()} ${id} ">${element[tag]}</th>`
        }
    });
    content += "</tr>";
});
table.innerHTML += content;

