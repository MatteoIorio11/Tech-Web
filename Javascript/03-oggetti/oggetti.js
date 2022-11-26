class Computer {
    constructor(processore, disco, ram) {
        this.processore = processore;
        this.disco = disco;
        this.ram = ram;


    }
    infoComputerConsole() {
        const values = {
            Processore: this.processore,
            Disco: this.disco,
            Ram: this.ram,
        };
        console.log(values);
    }
    infoComputerDOM(id) {
        document.getElementById(id).innerHTML = `
    <p> Processore : ${this.processore} </p>
    <p> Disco : ${this.disco} </p>
    <p> Ram : ${this.ram} </p>`;
    }
}



const miopPc = new Computer("i7", "256GB", "1024GB");
miopPc.infoComputerConsole();
miopPc.infoComputerDOM("miopc");
//miopPc.infoComputerDOM("miopc");