 // Function to open the modal
 function openModal(modalId) {
    var modal = document.getElementById(modalId + '-modal');
    if (modal) {
        modal.style.display = 'block';
    }
}

// Function to close the modal
function closeModal(modalId) {
    var modal = document.getElementById(modalId + '-modal');
    if (modal) {
        modal.style.display = 'none';
    }
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target.classList.contains('modal')) {
        event.target.style.display = "none";
    }
}