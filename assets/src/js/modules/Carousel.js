import Swiper, { Navigation, Pagination, Parallax } from 'swiper';
import 'swiper/css';

class Carousel {
  constructor() {
    const homePortfolio = new Swiper('.home__portfolio-posts .swiper', {
      // configure Swiper to use modules
      modules: [Navigation, Pagination],
      slidesPerView: 'auto',
      spaceBetween: 30,
      navigation: {
        nextEl: '.swiper-button.portfolio-swiper-button-next',
        prevEl: '.swiper-button.portfolio-swiper-button-prev',
      },
      pagination: {
        el: '.swiper-pagination',
        type: 'fraction',
      },
      mobileFirst: true,
      breakpoints: {
        900: {
          // slidesPerView: 'auto',
          spaceBetween: 150,
        },
      },
      // last slide not getting active class fix: https://github.com/nolimits4web/swiper/issues/3108#issuecomment-923878247
      on: {
        reachEnd: function () {
          this.snapGrid = [...this.slidesGrid];
          setTimeout(() => {
            document.querySelector('.swiper-button-next').click();
            clearTimeout();
          }, 1);
        },
      },
    });

    const aboutTicker = new Swiper('.about__main-ticker', {
      // configure Swiper to use modules
      modules: [Navigation, Parallax],
      slidesPerView: 1,
      parallax: true,
      speed: 1500,
      loop: true,
      navigation: {
        nextEl: '.swiper-button.ticker-swiper-button-next',
      },
      mobileFirst: true,
      breakpoints: {
        900: {
          // slidesPerView: 'auto',
          slidesPerView: 1.15
        },
      },
    });

    const teamMembers = new Swiper('.about__team-team-members', {
      // configure Swiper to use modules
      modules: [Navigation, Parallax],
      slidesPerView: 1,
      parallax: true,
      speed: 1200,
      navigation: {
        nextEl: '.swiper-button-next.team-swiper-button-next',
        prevEl: '.swiper-button-prev.team-swiper-button-prev',
      },
    });
  }
}

export default Carousel;
