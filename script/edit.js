// edit
const btnCloseEdit = document.getElementById("btnCloseEdit");
const modalEdit = document.getElementById("modalEdit");
const btnEdit = document.querySelectorAll(".btn-edit");
const overlayEdit = document.getElementById("overlayEdit");

// edit
btnEdit.forEach((btn) => {
    btn.addEventListener('click', () => {   
        modalEdit.classList.remove('hidden');
        modalEdit.classList.add('flex');
    });
}); 

btnCloseEdit.addEventListener('click',() => {
    modalEdit.classList.remove('flex');
    modalEdit.classList.add('hidden');

} );   