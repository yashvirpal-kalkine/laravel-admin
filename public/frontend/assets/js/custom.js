
function showPage(pageName) {
  // Hide all pages
  const pages = document.querySelectorAll('.page-content');
  pages.forEach(page => page.style.display = 'none');

  // Show selected page
  document.getElementById(pageName + '-page').style.display = 'block';

  // Update active menu item
  const menuItems = document.querySelectorAll('.nav-menu a');
  menuItems.forEach(item => item.classList.remove('active'));
  event.target.classList.add('active');

  event.preventDefault();
}



document.addEventListener('DOMContentLoaded', function () {
  /* Show Add Address Form */
  document.getElementById("addNewAddressBtn").addEventListener("click", function () {
    document.getElementById("formTitle").innerText = "Add Address";
    document.getElementById("addressForm").reset(); // empty form
    document.getElementById("addressFormWrapper").style.display = "block";
  });

  /* Show Edit Form */
  document.querySelector(".edit-address-btn").addEventListener("click", function () {

    document.getElementById("formTitle").innerText = "Edit Address";
    document.getElementById("addressFormWrapper").style.display = "block";

    // Prefill (you can extend more fields later)
    document.getElementById("firstName").value = "Yog";
    document.getElementById("lastName").value = "Raj";
    document.getElementById("country").value = "India";
  });

  /* Cancel Button */
  document.getElementById("cancelFormBtn").addEventListener("click", function () {
    document.getElementById("addressFormWrapper").style.display = "none";
  });
})


// marquee Silder

var elements = $('ul.marquee-item-list li').length;
for (var i = 0; i < elements; i++) {
  $(".marquee-item-list").clone().prependTo(".marquee-block");
};
var liEle = [];
var liEle = $(".marquee-item-list li");



// Category  Carousel

$('.category').owlCarousel({
  loop: true,
  margin: 0,
  nav: true,
  dots: false,
  navText: [
    "<i class='fa fa-angle-left'></i>",
    "<i class='fa fa-angle-right'></i>"
  ],
  autoplay: true,
  autoplayTimeout: 4000,
  autoplayHoverPause: true,
  smartSpeed: 1600,
  responsive: {
    0: { items: 1 },
    600: { items: 3 },
    1000: { items: 5 }
  }
});



// Category  Carousel

$('#customised-img').owlCarousel({
  loop: true,
  margin: 10,
  nav: true,
  dots: false,
  navText: [
    "<i class='fa fa-angle-left'></i>",
    "<i class='fa fa-angle-right'></i>"
  ],
  autoplay: false,
  autoplayTimeout: 4000,
  autoplayHoverPause: true,
  smartSpeed: 1600,
  responsive: {
    0: { items: 1 },
    600: { items: 1 },
    1000: { items: 1 }
  }
});



// Products Silder Carousel

$('.products-silder').owlCarousel({
  loop: true,
  margin: 10,
  nav: true,
  dots: false,
  navText: [
    "<i class='fa fa-angle-left'></i>",
    "<i class='fa fa-angle-right'></i>"
  ],
  autoplay: true,
  autoplayTimeout: 4000,
  autoplayHoverPause: true,
  smartSpeed: 1600,
  responsive: {
    0: { items: 1 },
    600: { items: 3 },
    1000: { items: 4 }
  }
});


// Instagram Feed Carousel

$('#instagram').owlCarousel({
  loop: true,
  margin: 10,
  nav: false,
  dots: false,
  navText: [
    "<i class='fa fa-angle-left'></i>",
    "<i class='fa fa-angle-right'></i>"
  ],
  autoplay: true,
  autoplayTimeout: 3000,
  autoplayHoverPause: true,
  smartSpeed: 1600,
  responsive: {
    0: { items: 1 },
    600: { items: 3 },
    1000: { items: 5 }
  }
});

// mega menu js
document.addEventListener("DOMContentLoaded", function () {


  const pToggle = document.querySelector(".products-toggle");
  const pMenu = document.querySelector(".products-submenu");

  pToggle.addEventListener("click", function (e) {
    if (window.innerWidth < 992) {
      e.preventDefault();
      pMenu.classList.toggle("open");
    }
  });


  const zToggle = document.querySelector(".zodiac-toggle");
  const zMenu = document.querySelector(".mega-menu");

  zToggle.addEventListener("click", function (e) {
    if (window.innerWidth < 992) {
      e.preventDefault();
      zMenu.classList.toggle("open");
    }
  });

});


document.querySelectorAll(".btn-plus").forEach(function (button) {
  button.addEventListener("click", function () {
    let input = this.parentElement.querySelector(".qty-input");
    input.value = parseInt(input.value) + 1;
  });
});

document.querySelectorAll(".btn-minus").forEach(function (button) {
  button.addEventListener("click", function () {
    let input = this.parentElement.querySelector(".qty-input");
    let value = parseInt(input.value);
    if (value > 1) {
      input.value = value - 1;
    }
  });
});





function toggleContent(id) {
  var content = document.getElementById(id);

  // If content is closed → open it
  if (content.style.maxHeight) {
    content.style.maxHeight = null;
  } else {
    content.style.maxHeight = content.scrollHeight + "px";
  }
}
