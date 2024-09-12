ScrollReveal({ 
    distance: '80px',
    duration: 2000,
    delay: 200
});

ScrollReveal().reveal('.author, .logo, .feed-new-editor, .head-side-right, .perfil', { origin: 'top' });
ScrollReveal().reveal('.form, .feed-item, .feed-pagination, .follow, .fotos-page, .config-form', { origin: 'bottom' });
ScrollReveal().reveal('.button, .input, .nav, .pesquisa, .info', { origin: 'left' });
ScrollReveal().reveal('.img, .copyright, .banners, .fotos, .texto', { origin: 'right' });

const typed = new Typed('.multiple-text', {
    strings: ['FrontEnd Developer', 'Youtuber', 'Blogger'],
    typeSpeed: 100,
    backSpeed: 100,
    backDelay: 1000,
    loop: true
});