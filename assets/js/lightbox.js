// Script pour la gestion de la Lightbox sur toutes les photos

console.log("Script lightbox lancé !!!");

// photo en pleine page

// Récupération des tous les icones Lightbox présent
const listOpenLightbox = document.querySelectorAll(".openLightbox");
const listLightbox = document.querySelectorAll(".lightbox");
const listLightboxClose = document.querySelectorAll(".lightbox__close");
const listLightboxPrev = document.querySelectorAll(".lightbox__prev");
const listLightboxNext = document.querySelectorAll(".lightbox__next");

// Récupération du tableau de toutes les photos selon les filtres
let total_posts = "";
if (document.getElementById("total_posts") !== null) {
  total_posts = document.getElementById("total_posts").value;

  // Supression du début "Array (" et de la fin ")" pour n'avoir que les données du tableau d'origine
  total_posts = total_posts.slice(8, total_posts.length - 3);
}

let nb_total_posts = 1;
if (document.getElementById("nb_total_posts") !== null) {
  nb_total_posts = document.getElementById("nb_total_posts").value;
}

// Intialisation des données pour le filtrage
let regex1 = /[(]/g;
let regex2 = /[)]/g;

let arrayIntial = total_posts;
let arrayFinish = new Array();
let data = new Array();

recupArrayPhp();

let id = "";
let idPhoto = null;
let idPhotoNext = null;
let idValue = 10;

// listOpenLightbox.forEach((openLightbox) => {
//   openLightbox.addEventListener("click", (e) => {
//     //   On stop le comportement par défaut
//     e.preventDefault();
//     // Récupération de l'élément du DOM qui suit l'icone pour afficher la Lightbox
//     next = e.currentTarget.nextElementSibling;
//     // Récupération de l'élément du DOM qui précède l'icone pour afficher pour récupérer l'identifiant de la photo
//     previous = e.currentTarget.previousElementSibling;
//     idPhoto = previous.lastElementChild.value;
//     recupIdData(idPhoto);
//     next.classList.remove("hidden");
//   });
// });

listLightboxClose.forEach((lightboxClose) => {
  lightboxClose.addEventListener("click", (e) => {
    e.preventDefault();
    // si on click sur la croix, cela referme la lightbox
    listLightbox.forEach((lightbox) => {
      lightbox.classList.add("hidden");
    });
  });
});

listLightboxPrev.forEach((lightboxPrev) => {
  lightboxPrev.addEventListener("click", (e) => {
    idPhotoNext = idPhoto;
    console.log("Photo précédent");
    if (idValue > 0) {
      idValue--;
    } else {
      idValue = nb_total_posts - 1;
    }
    console.log("id: " + idValue);
    recupIdPhoto(idValue);
    changePhoto();
  });
});

listLightboxNext.forEach((lightboxNext) => {
  lightboxNext.addEventListener("click", (e) => {
    idPhotoNext = idPhoto;
    console.log("Photo suivante");
    if (idValue < nb_total_posts - 1) {
      idValue++;
    } else {
      idValue = 0;
    }
    console.log("id: " + idValue);
    recupIdPhoto(idValue);
    changePhoto();
  });
});

function recupArrayPhp() {
  // Récupérarion des données qui sont en texte et transfert dans un tableau javascript

  // Parcour des données pour en extraire les éléments de chaque photo
  // et les regroupper dans un seul élément commun
  for (let pas = 0; pas < nb_total_posts; pas++) {
    start = arrayIntial.search(regex1) + 2;
    end = arrayIntial.search(regex2);
    next = end + 1;

    // On extrait les informations de la photo et on les regroupe
    arrayFinish.push(arrayIntial.slice(`${start}`, `${end}`));

    // On retire ces éléments pour le filtrage suivant
    arrayIntial = arrayIntial.slice(`${next}`, -1);
  }
}

// Récupérération de la position de la photo dans le tableau
function recupIdData(arg) {
  // On parcour le tableau à la recherche de l'identifiant de la photo
  for (let i = 0; i < nb_total_posts; i++) {
    data = arrayFinish[i].split("\n");
    let position = data[0].search("ID") + 7;
    if (data[0].slice(`${position}`) == arg) {
      idValue = i;
    }
  }
}

// Récupérération de l'identifiant de la photo en fonction de notre position dans la tableau
function recupIdPhoto(arg) {
  data = arrayFinish[arg].split("\n");
  let position = data[0].search("ID") + 7;
  idPhoto = data[0].slice(`${position}`);

  console.log(idPhoto);
}

function changePhoto() {
  if (idPhoto != idPhotoNext) {
    console.log("Le n° de la photo a changé");
  }
}

(function ($) {
  $(document).ready(function () {
    // Gestion de la pagination des photos en page d'accueil
    $(".openLightbox").click(function (e) {
      e.preventDefault();
      console.log(e);
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
      console.log(ajaxurl);
      console.log(data);

      // Requête Ajax en JS natif via Fetch
      fetch(ajaxurl, {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded",
          "Cache-Control": "no-cache",
        },
        body: new URLSearchParams(data),
      }).then((response) => {
        console.log(response);

        // En cas d'erreur
        // if (!response.success) {
        //   console.log("Erreur !!!");
        //   alert(response.data);
        //   return;
        // }

        // Et en cas de réussite
        console.log("Réponse OK");
        $(".lightbox").remove("hidden");
        // $(this).hide(); // Cacher le formulaire
        $(".lightbox").html(response.data); // Et afficher le HTML
        // $(".lightbox").append(response);
      });
    });
  });
})(jQuery);
