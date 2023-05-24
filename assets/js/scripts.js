console.log("Script lancé !!!");

let currentPage = 1;
const contactBtn = document.querySelectorAll(".contact");
const popupOverlay = document.querySelector(".popup-overlay");
const popupClose = document.querySelector(".popup-close");

// Récupération des variables de PHP
let categorieId = document.getElementById("categorie_id").value;
let formatId = document.getElementById("format_id").value;
let order = document.getElementById("order").value;
let orderby = document.getElementById("orderby").value;
let max_pages = document.getElementById("max_pages").value;

// Gestion de la pagination des photos
(function ($) {
  $(document).ready(function () {
    $("#load-more").click(function (e) {
      console.log(e);

      currentPage++; // Do currentPage + 1, because we want to load the next page
      console.log("max_page: " + max_pages + " - currentPage: " + currentPage);

      if (currentPage >= max_pages) {
        $("#load-more").addClass("hidden");
      }

      $.ajax({
        type: "POST",
        url: "/nathalie-motta/wp-admin/admin-ajax.php",
        dataType: "html", // <-- Change dataType from 'html' to 'json'
        data: {
          action: "weichie_load_more",
          paged: currentPage,
          categorie: categorieId,
          format: formatId,
          orderby: orderby,
          order: order,
        },
        success: function (res) {
          $(".publication-list").append(res);
        },
      });
    });

    // Chargment des commentaires en Ajax
    $(".js-load-comments").click(function (e) {
      // Empêcher l'envoi classique du formulaire
      e.preventDefault();

      // L'URL qui réceptionne les requêtes Ajax dans l'attribut "action" de <form>
      const ajaxurl = $(this).data("ajaxurl");

      // Les données de notre formulaire
      // ⚠️ Ne changez pas le nom "action" !
      const data = {
        action: $(this).data("action"),
        nonce: $(this).data("nonce"),
        postid: $(this).data("postid"),
      };

      // Pour vérifier qu'on a bien récupéré les données
      console.log("-- ajaxurl --");
      console.log(ajaxurl);
      console.log("-- data --");
      console.log(data);

      // Requête Ajax en JS natif via Fetch
      fetch(ajaxurl, {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
          "Cache-Control": "no-cache",
        },
        body: new URLSearchParams(data),
      })
        .then((response) => response.json())
        .then((response) => {
          console.log(response);

          // En cas d'erreur
          if (!response.success) {
            alert(response.data);
            return;
          }

          // Et en cas de réussite
          $(this).hide(); // Cacher le formulaire
          $(".comments").html(response.data); // Et afficher le HTML
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
