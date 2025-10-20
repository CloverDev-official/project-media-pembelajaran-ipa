const btnHapus = document.querySelectorAll('.btn-hapus');
const modalHapus = document.getElementById('modalHapus');
const btnCloseHapus = document.getElementById('btnCloseHapus');
const overlayHapus = document.getElementById('overlayHapus');
const formHapus = document.getElementById('formHapus');

btnHapus.forEach((btn) => {
    btn.addEventListener('click', () => {   
        modalHapus.classList.remove('hidden');
        modalHapus.classList.add('flex');
    });
}); 

btnCloseHapus.addEventListener('click',() => {
    modalHapus.classList.remove('flex');
    modalHapus.classList.add('hidden');

} );    