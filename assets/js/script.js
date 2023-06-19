const openModalButton = document.querySelector("#open-modal")
const closeModalButton = document.querySelector("#close-modal")
const modal = document.querySelector("#modal")
const fade =document.querySelector("#fade")

//toggle é um metodo que altera o estado do elemento entre inv e visivel

function toggleModal(){
    [modal, fade].forEach((elemento) => elemento.classList.toggle("hide"))
}


[openModalButton, closeModalButton, fade].forEach((elemento) => {
    elemento.addEventListener("click", () => toggleModal())
})