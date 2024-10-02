const modal = document.getElementById("myModal");
const openModal = document.getElementById("openModal");
const noBtn = document.getElementById("noBtn")

// Ouvre la modal au clique du bouton
openModal.addEventListener('click', () => {
    modal.style.display = "block";
})

// Ferme la modal au clique du bouton 'non'
noBtn.addEventListener('click', () => {
    modal.style.display = "none";
})

// Ferme la modal au clique hors de la modal
window.addEventListener('click', () => {
    if (event.target == modal) {
        modal.style.display = "none";
    }
})


