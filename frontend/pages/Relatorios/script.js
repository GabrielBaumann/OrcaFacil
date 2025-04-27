 // Funções para abrir e fechar o modal (agora instantâneo)
 function openModal() {
    document.getElementById('materialModal').classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeModal() {
    document.getElementById('materialModal').classList.remove('active');
    document.body.style.overflow = 'auto';
}

// Fechar modal ao clicar no overlay
document.querySelector('.modal-overlay')?.addEventListener('click', closeModal);

// Fechar modal com ESC
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeModal();
    }
});