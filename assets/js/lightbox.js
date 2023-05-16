// Script pour la gestion de la Lightbox sur toutes les photos

// console.log("Script lightbox lancé !!!");

// photo en pleine page
let link = "";

/**
 * @property {HTMLElement} element
 */
class lightbox {
  static init() {
    const openLightboxs = document.querySelectorAll(".openLightbox");
    openLightboxs.forEach((openLightbox) => {
      openLightbox.addEventListener("click", (e) => {
        console.log(e);
        //   On stop le comportement par défaut
        e.preventDefault();
        link = e.currentTarget.previousElementSibling.getAttribute("src");
        new lightbox(link);
      });
    });
  }

  /**
   * @param {string} url de l'image
   */
  constructor() {
    //   const element = this.builDOM();
    //   document.body.appendChild(element);
    this.element = this.builDOM();
    document.body.appendChild(this.element);
  }

  /**
   * Ferme la lightbox
   * @param {MouseEvent} e
   */
  close(e) {
    e.preventDefault();
    this.element.parentElement.removeChild(this.element);
  }

  /**
   * @param {string} url de l'image et retournera un élément html/php
   */
  builDOM(url) {
    const dom = document.createElement("div");
    dom.classList.add("lightbox");
    dom.innerHTML = `<div class="closeLightbox">
        <img src="${link}" alt="">
      </div>`;
    dom
      .querySelector(".closeLightbox")
      .addEventListener("click", this.close.bind(this));
    return dom;
  }
}

lightbox.init();
