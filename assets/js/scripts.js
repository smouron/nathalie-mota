console.log("Script lancé !!!");

let currentPage = 1;
const contactBtn = document.querySelectorAll(".contact");
const popupOverlay = document.querySelector(".popup-overlay");
const popupClose = document.querySelector(".popup-close");

// photo en pleine page
const photoInfo = document.querySelector(".photo__info--image");
const lightbox = document.querySelector(".lightbox");
const openLightboxs = document.querySelectorAll(".openLightbox");
const visiblelightbox = document.querySelector(".visible");

// filtres
const filtreCategorie = document.getElementById("categorie");
const filtreFormat = document.getElementById("format");
const filtreDate = document.getElementById("date");
const filtres = document.querySelectorAll(".option-filter");
const pElem = document.getElementById("p");

let valueCategorie = "?categorie=";
let valueFormat = "&format=";
let valueDate = "&date=";
let valueSubmit = valueCategorie + valueFormat + valueDate;

console.log(filtreCategorie);

// Quand une nouvelle <option> est selectionnée
filtres.forEach((filtre) => {
  filtre.addEventListener("change", function () {
    // Récupération du filtre sélectionné
    let filtreName = filtre.name;
    let filtreValue = filtre.value;

    console.log(filtre);

    // Récupération de l'url
    let urlHref = window.location.href;
    let url = new URL(urlHref);
    let chemin = window.location.pathname + "index.php";
    let index = filtre.selectedIndex;

    // Recherce dans l'URL la présence des paramètres des filtres
    // s'ils sont présents, on récupère les valeurs actuelles
    let search = url.searchParams.get("categorie");

    // Si le paramètre est dans l'URL et qu'elle est numérique, on la récupère
    if (search && Number(search)) {
      console.log(url.searchParams.get("categorie"));
      valueCategorie = "?categorie=" + search;
    }

    search = url.searchParams.get("format");
    if (search && Number(search)) {
      console.log(url.searchParams.get("format"));
      valueFormat = "&format=" + search;
    }

    search = url.searchParams.get("date");
    if (search) {
      console.log(url.searchParams.get("date"));
      valueDate = "&date=" + search;
    }

    if (filtreName === "categorie") {
      valueCategorie = "?categorie=" + filtreValue;
    }

    if (filtreName === "format") {
      valueFormat = "&format=" + filtreValue;
    }

    if (filtreName === "date") {
      valueDate = "&date=" + filtreValue;
    }

    valueSubmit = valueCategorie + valueFormat + valueDate;
    chemin = "index.php" + valueSubmit;

    window.location.href = "index.php" + valueSubmit;
  });
});

// const photoFull = document.querySelector(".photo__full");

// Gestion de la fermeture et de l'ouverture de la modale avec jQuery
(function ($) {
  $(document).ready(function () {
    $(".photo__info--image").click(function () {
      $(".lightbox").toggleClass("hidden");
    });

    $(".lightbox").click(function () {
      $(".lightbox").toggleClass("hidden");
    });

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
// popupClose.addEventListener("click", () => {
//   popupOverlay.classList.add("hidden");
// });

// openLightboxs.forEach((openLightbox) => {
//   openLightbox.addEventListener("click", (e) => {
//     console.log(e);
//     let test1 = openLightbox.nextElementSibling;
//     test1.classList.add("visible");
//     test1.classList.remove("hidden");
//   });
// });
