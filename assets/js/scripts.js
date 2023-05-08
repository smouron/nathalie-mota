console.log("Script lancé !!!");

const photoInfo = document.querySelector(".photo__info--image");
const refPhoto = document.querySelector(".refPhoto");


console.log(refPhoto);
console.log(refPhoto.value);

// Gestion de la fermeture et de l'ouverture de la modale avec jQuery
(function ($) {
  $(".popup-close").click(function () {
    // $(".popup-overlay").hide();
    $(".popup-overlay").toggleClass("hidden");
  });
  $("#contact_btn_navbar").click(function () {
    // $(".popup-overlay").show();
    $(".popup-overlay").toggleClass("hidden");
  });
  $("#contact_btn").click(function () {
    // $(".popup-overlay").show();
    $(".popup-overlay").toggleClass("hidden");
  });

  $(".photo__info--image").click(function () {
    $(".photo__full").toggleClass("hidden");
  });

  $(".lightbox").click(function () {
    $(".photo__full").toggleClass("hidden");
  });
})(jQuery);

//
if (refPhoto) {
  refPhoto.addEventListener("click", (e) => {
    refPhoto.value = "Hello";
  });
}
