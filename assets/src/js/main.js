import Carousel from './modules/Carousel';
import MobileMenu from './modules/MobileMenu';
import ShowScroll from './modules/ShowScroll';
import '@lottiefiles/lottie-player';

const mobileMenu = new MobileMenu();
const carousel = new Carousel();
const wysiwyg = document.querySelector('.wysiwyg');
if (wysiwyg) {
  // for each html tag inside wysiwyg, add a class .js-slide-in
  wysiwyg.querySelectorAll('p').forEach((el) => {
    el.classList.add('slide-in', 'js-slide-in');
  });
}
window.onload = () => {
  document.body.classList.remove('preload');
  const showScroll = new ShowScroll();
};

// split section titles
const sectionTitle = document.querySelectorAll(
  '.home__hero-text h1, .section-columns__title h2'
);
sectionTitle.forEach((title) => {
  const sectionSplitTitle = title.textContent.split('\n').map((word) => {
    return `<span class="slide-in js-slide-in">${word}</span>`;
  });
  title.innerHTML = sectionSplitTitle.join(' ');
});

// split homepage banner text
const bannerText = document.querySelectorAll(
  '.home__bottom-banner__text p:last-child'
);
bannerText.forEach((line) => {
  const bannerSplitText = line.textContent.split(' ').map((word) => {
    return `<span class="slide-in js-slide-in">${word}</span>`;
  });
  line.innerHTML = bannerSplitText.join(' ');
});

// split contact page text
const contactText = document.querySelector('.contact__main-text p');
if (contactText) {
  const contactSplitText = contactText.textContent.split('\n').map((word) => {
    return `<span class="slide-in js-slide-in">${word}</span>`;
  });
  contactText.innerHTML = contactSplitText.join(' ');
}

// post cards block link
const cards = document.querySelectorAll('.post-card');

cards.forEach((card) => {
  const mainLink = card.querySelector('.main-link');
  const clickableElements = Array.from(card.querySelectorAll('a')); //we are using 'a' here for simplicity but ideally you should put a class like 'clickable' on every clicable element inside card(a, button) and use that in query selector

  clickableElements.forEach((ele) =>
    ele.addEventListener('click', (e) => e.stopPropagation())
  );

  function handleClick(event) {
    const noTextSelected = !window.getSelection().toString();
    if (noTextSelected) {
      mainLink.click();
    }
  }
  card.addEventListener('click', handleClick);
});

// about page tabs

const aboutItems = document.querySelectorAll('.home__about-tabs li');
const aboutContentMobile = document.querySelectorAll(
  '.home__about-tabs--mobile .tab-content__inner'
);

aboutItems.forEach((item) => {
  const card = item.querySelector('.tab-content');
  const motionMatchMedia = window.matchMedia('(prefers-reduced-motion)');
  const THRESHOLD = 5;

  /*
   * Read the blog post here:
   * https://letsbuildui.dev/articles/a-3d-hover-effect-using-css-transforms
   */
  function handleHover(e) {
    const { clientX, clientY, currentTarget } = e;
    const { clientWidth, clientHeight, offsetLeft, offsetTop } = currentTarget;

    const horizontal = (clientX - offsetLeft) / 150;
    const vertical = (clientY - offsetTop) / clientHeight;
    const moveX = (THRESHOLD * 3 - horizontal * THRESHOLD).toFixed(2);
    const moveY = (vertical * THRESHOLD * 3).toFixed(2);

    card.style.transform = `translateX(${-moveX}px) translateY(${moveY}px) scale3d(1, 1, 1)`;
  }

  // function resetStyles(e) {
  // card.style.transform = `perspective(${e.currentTarget.clientWidth}px) rotateX(0deg) rotateY(0deg)`;
  // }

  if (
    !motionMatchMedia.matches &&
    !document.body.classList.contains('mobile')
  ) {
    item.addEventListener('mousemove', handleHover);
    // item.addEventListener('mouseleave', resetStyles);
  }
});

aboutItems.forEach((item) => {
  item.addEventListener('click', (e) => {
    const activeIndex = item.querySelector('span').dataset.index;
    aboutContentMobile.forEach((content) => {
      if (content.dataset.index == activeIndex) {
        content.parentElement.style.height = content.clientHeight + 'px';
        content.classList.add('active');
      } else {
        content.classList.remove('active');
      }
    });
  });
});

document.addEventListener('click', (event) => {
  if (!event.target.closest('.home__about-tabs li')) {
    aboutContentMobile.forEach((content) => {
      content.classList.remove('active');
      content.parentElement.style.height = 0 + 'px';
    });
  }
});

const copyUrl = document.getElementById('share-copy');
if (copyUrl) {
  copyUrl.addEventListener('click', (e) => {
    e.preventDefault();
    navigator.clipboard.writeText(window.location.href);
    copyUrl.parentNode.classList.add('copied');
    setTimeout(() => {
      copyUrl.parentNode.classList.remove('copied');
    }, 2000);
  });
}

const newsletterBtn = document.querySelector('#mc-embedded-subscribe');

// if window is bigger than 600px, set newsletterBtn value to 'SUBSCRIBE TO OUR NEWSLETTER'
const width =
  window.innerWidth ||
  document.documentElement.clientWidth ||
  document.body.clientWidth;

if (width > 600) {
  newsletterBtn.innerHTML =
    newsletterBtn.innerHTML + 'SUBSCRIBE TO OUR NEWSLETTER';
}

// newsletter email validation

const newsletterEmail = document.querySelector('#mce-EMAIL');
const submitBtn = document.querySelector('#mc-embedded-subscribe');
const emailRegex = /^[^\s@]+@([^\s@.,]+\.)+[^\s@.,]{2,}$/;

newsletterEmail.addEventListener('keyup', (e) => {
  if (emailRegex.test(e.target.value)) {
    submitBtn.removeAttribute('disabled');
  } else {
    submitBtn.setAttribute('disabled', true);
  }
});
