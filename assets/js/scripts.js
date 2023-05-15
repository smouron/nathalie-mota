console.log("Script lancé !!!");

const contactBtn = document.querySelectorAll(".contact");
const popupOverlay = document.querySelector(".popup-overlay");
const popupClose = document.querySelector(".popup-close");

const photoInfo = document.querySelector(".photo__info--image");
const lightboxs = document.querySelectorAll(".lightbox");
const photoFull = document.querySelector(".photo__full");

// Gestion de la fermeture et de l'ouverture de la modale avec jQuery
(function ($) {
  $(".photo__info--image").click(function () {
    $(".photo__full").toggleClass("hidden");
  });

  $(".lightbox").click(function () {
    $(".photo__full").toggleClass("hidden");
  });
})(jQuery);

// Ouverture de la pop contact au clic sur un lien contact
contactBtn.forEach((contact) => {
  contact.addEventListener("click", () => {
    popupOverlay.classList.remove("hidden");
  });
});

// Refermeture de la pop contact au clic
popupClose.addEventListener("click", () => {
  popupOverlay.classList.add("hidden");
});


