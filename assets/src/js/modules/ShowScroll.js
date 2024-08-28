class ScrollShow {
  constructor() {
    this.items = [];
    this.delay = 0.05;
    this.default_element_percent = 25;
    this.default_viewport_percent = 0;
    this.hide_on_scroll_back = false;
    this.addItems();
    this.onScroll();
    this.events();
  }

  events() {
    window.addEventListener('resize', () => this.onResize());
    window.addEventListener('scroll', () => this.onScroll());
  }

  addItems(classname = 'js-slide-in') {
    let elements = document.getElementsByClassName(classname);
    for (let i = 0; i < elements.length; i++) {
      const el = elements[i];
      const showClass = el.getAttribute('data-scroll-show-class') || 'active';
      let elPercent = parseInt(
        el.getAttribute('data-scroll-show-element-percent') ||
          this.default_element_percent
      );
      let vpPercent = parseInt(
        el.getAttribute('data-scroll-show-viewport-percent') ||
          this.default_viewport_percent
      );
      let item = {
        element: el,
        showClass: showClass,
        elPercent: elPercent,
        vpPercent: vpPercent,
        top: null,
        height: null,
        keyY: null,
      };
      item = this.updateRect(item);
      this.items.push(item);
    }
    this.onScroll();
  }

  updateRect(item) {
    const rect = item.element.getBoundingClientRect();
    item.top = rect.top + scrollY;
    item.height = rect.height;
    item.keyY =
      item.top +
      (item.height * item.elPercent) / 100 -
      innerHeight * (1 - item.vpPercent / 100);
    return item;
  }

  onResize() {
    for (let i = 0; i < this.items.length; i++) {
      this.items[i] = this.updateRect(this.items[i]);
    }
    this.onScroll();
  }

  onScroll() {
    const isAfterY = this.items.map(function (item) {
      return item.keyY <= scrollY;
    });
    const alreadyShown = this.items.map(function (item) {
      return item.element.classList.contains(item.showClass);
    });

    let count = 0;
    for (let i = 0; i < isAfterY.length; i++) {
      const showClass = this.items[i].showClass;
      let el = this.items[i].element;
      el.style.transitionDelay = null;
      if (isAfterY[i] && !alreadyShown[i]) {
        el.style.transitionDelay = `${this.delay * count}s`;
        count++;
        el.classList.add(showClass);
      } else if (this.hide_on_scroll_back && !isAfterY[i] && alreadyShown[i]) {
        el.classList.remove(showClass);
      }
    }
  }
}

export default ScrollShow;
