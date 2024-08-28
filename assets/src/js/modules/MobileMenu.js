class MobileMenu {
  constructor() {
    this.mobileMenuBtn = document.querySelector('.js-mobile-menu-trigger');
    this.menu = document.querySelector('.menu');
    this.events();
  }

  events() {
    this.mobileMenuBtn.addEventListener('click', () => this.toggleMenu());
  }

  toggleMenu() {
    document.body.classList.toggle('no-scroll');
    document.body.classList.toggle('menu-active');
    this.menu.classList.toggle('active');
    this.mobileMenuBtn.classList.toggle('active');
    this.mobileMenuBtn.getAttribute('aria-expanded') === 'false'
      ? this.mobileMenuBtn.setAttribute('aria-expanded', 'true')
      : this.mobileMenuBtn.setAttribute('aria-expanded', 'false');
  }
}

export default MobileMenu;
