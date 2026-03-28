document.addEventListener('DOMContentLoaded', function() {
    const menuBtn = document.querySelector('.mobile-menu-toggle');
    const navMenu = document.querySelector('#nav-menu');

    if (menuBtn && navMenu) {
        menuBtn.addEventListener('click', function() {
            // Alterna a classe 'active' em ambos
            this.classList.toggle('active');
            navMenu.classList.toggle('active');
            
            // Impede o scroll da página atrás do menu aberto
            document.body.style.overflow = navMenu.classList.contains('active') ? 'hidden' : 'auto';
        });

        // Fecha o menu ao clicar em um link (importante para One Pages)
        navMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                menuBtn.classList.remove('active');
                navMenu.classList.remove('active');
                document.body.style.overflow = 'auto';
            });
        });
    }
});