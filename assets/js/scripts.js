console.log("Script lancé !!!");

let currentPage = 1;
const contactBtn = document.querySelectorAll(".contact");
const popupOverlay = document.querySelector(".popup-overlay");
const popupClose = document.querySelector(".popup-close");

// Gestion de la fermeture et de l'ouverture de la modale avec jQuery
(function ($) {
  $(document).ready(function () {
    $("#load-more").click(function (e) {
      console.log(e);

      currentPage++; // Do currentPage + 1, because we want to load the next page

      $.ajax({
        type: "POST",
        url: "/nathalie-motta/wp-admin/admin-ajax.php",
        dataType: "json", // <-- Change dataType from 'html' to 'json'
        data: {
          action: "weichie_load_more",
          paged: currentPage,
        },
        success: function (res) {
          $(".publication-list").append(res);
        },
      });
    });
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
