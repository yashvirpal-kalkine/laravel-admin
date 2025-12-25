/***************************************
 * OFFER SLIDER
 ***************************************/
$(document).ready(function () {
  $('.offer-slider').owlCarousel({
    items: 1,
    loop: true,
    autoplay: true,
    autoplayTimeout: 4000,
    autoplayHoverPause: true,
    smartSpeed: 2000,
    nav: false,
    dots: false
  });
});


/***************************************
 * PAGE SWITCH (My Account)
 ***************************************/
function showPage(pageName, event) {
  const pages = document.querySelectorAll('.page-content');
  pages.forEach(p => p.style.display = 'none');

  document.getElementById(pageName + '-page').style.display = 'block';

  document.querySelectorAll('.nav-menu a')
    .forEach(i => i.classList.remove('active'));

  event.target.classList.add('active');
  event.preventDefault();
}


/***************************************
 * ADD / EDIT ADDRESS
 ***************************************/
document.addEventListener('DOMContentLoaded', () => {

  const addBtn = document.getElementById("addNewAddressBtn");
  const editBtn = document.querySelector(".edit-address-btn");
  const cancelBtn = document.getElementById("cancelFormBtn");

  if (addBtn) {
    addBtn.addEventListener("click", () => {
      document.getElementById("formTitle").innerText = "Add Address";
      document.getElementById("addressForm").reset();
      document.getElementById("addressFormWrapper").style.display = "block";
    });
  }

  if (editBtn) {
    editBtn.addEventListener("click", () => {
      document.getElementById("formTitle").innerText = "Edit Address";
      document.getElementById("addressFormWrapper").style.display = "block";

      document.getElementById("firstName").value = "Yog";
      document.getElementById("lastName").value = "Raj";
      document.getElementById("country").value = "India";
    });
  }

  if (cancelBtn) {
    cancelBtn.addEventListener("click", () => {
      document.getElementById("addressFormWrapper").style.display = "none";
    });
  }
});


/***************************************
 * CATEGORY CAROUSEL
 ***************************************/
$('.category').owlCarousel({
  loop: true,
  margin: 0,
  nav: true,
  dots: false,
  navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
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


/***************************************
 * CUSTOMIZED IMAGE SLIDER
 ***************************************/
$('#customised-img').owlCarousel({
  loop: true,
  margin: 10,
  nav: true,
  dots: false,
  navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
  autoplay: false,
  smartSpeed: 1600,
  responsive: {
    0: { items: 1 },
    600: { items: 1 },
    1000: { items: 1 }
  }
});


/***************************************
 * PRODUCTS SLIDER
 ***************************************/
$('.products-silder').owlCarousel({
  loop: true,
  margin: 10,
  nav: true,
  dots: false,
  navText: ["<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>"],
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


/***************************************
 * INSTAGRAM SLIDER
 ***************************************/
$('#instagram').owlCarousel({
  loop: true,
  margin: 10,
  nav: false,
  dots: false,
  autoplay: true,
  autoplayTimeout: 3000,
  smartSpeed: 1600,
  responsive: {
    0: { items: 1 },
    600: { items: 3 },
    1000: { items: 5 }
  }
});


/***************************************
 * MEGA MENU (Mobile)
 ***************************************/
document.addEventListener("DOMContentLoaded", () => {

  const pToggle = document.querySelector(".products-toggle");
  const pMenu = document.querySelector(".products-submenu");

  if (pToggle && pMenu) {
    pToggle.addEventListener("click", (e) => {
      if (window.innerWidth < 992) {
        e.preventDefault();
        pMenu.classList.toggle("open");
      }
    });
  }

  const zToggle = document.querySelector(".zodiac-toggle");
  const zMenu = document.querySelector(".mega-menu");

  if (zToggle && zMenu) {
    zToggle.addEventListener("click", (e) => {
      if (window.innerWidth < 992) {
        e.preventDefault();
        zMenu.classList.toggle("open");
      }
    });
  }

});



/***************************************
 * ACCORDION TOGGLE
 ***************************************/
function toggleContent(id) {
  const box = document.getElementById(id);
  if (!box) return;

  box.style.maxHeight = box.style.maxHeight ? null : box.scrollHeight + "px";
}


/***************************************
 * CART OPEN/CLOSE
 ***************************************/
document.addEventListener("DOMContentLoaded", () => {

  const toggle = document.querySelector(".cart-toggle");
  const box = document.querySelector(".cart-box");
  const close = document.querySelector(".cart-close");

  if (toggle && box) {
    toggle.addEventListener("click", (e) => {
      e.preventDefault();
      box.classList.toggle("open");
    });
  }

  if (close) {
    close.addEventListener("click", (e) => {
      e.preventDefault();
      box.classList.remove("open");
    });
  }

  document.addEventListener("click", (e) => {
    if (box && toggle && !box.contains(e.target) && !toggle.contains(e.target)) {
      box.classList.remove("open");
    }
  });

});


/***************************************
 * PASSWORD SHOW/HIDE
 ***************************************/
document.addEventListener("DOMContentLoaded", () => {

  const btn = document.getElementById("togglePass");
  const pass = document.getElementById("pass");
  const eye = document.getElementById("eyeIcon");

  if (btn && pass && eye) {
    btn.addEventListener("click", () => {

      if (pass.value.trim() === "") return;

      if (pass.type === "password") {
        pass.type = "text";
        eye.classList.replace("fa-eye-slash", "fa-eye");
      } else {
        pass.type = "password";
        eye.classList.replace("fa-eye", "fa-eye-slash");
      }

    });
  }

});


/***************************************
 * PRODUCT MAIN IMAGE CHANGE
 ***************************************/
function smoothChange(img) {
  $("#mainImg").removeClass("active-slide");
  setTimeout(() => {
    $("#mainImg").attr("src", img).addClass("active-slide");
  }, 50);
}

$(".owl-thumbs").owlCarousel({
  items: 5,
  margin: 10,
  loop: true,
  dots: false,
  nav: false,
  mouseDrag: true,
  smartSpeed: 400,
  slideBy: 1,
  onInitialized: () => {
    var first = $(".owl-thumbs .owl-item:not(.cloned)").first();
    first.addClass("active-thumb");
    smoothChange(first.find("img").attr("data-large"));
  },
  responsive: {
    0: { items: 3 },
    600: { items: 4 },
    1000: { items: 5 }
  }
});


$(document).on("click", ".owl-thumbs .owl-item", function () {
  let img = $(this).find("img").attr("data-large");
  smoothChange(img);
  $(".owl-thumbs .owl-item").removeClass("active-thumb");
  $(this).addClass("active-thumb");
  $(".color-dot").removeClass("active");
  $(`.color-dot[data-img="${img}"]`).addClass("active");
});


$(".color-dot").click(function () {
  $(".color-dot").removeClass("active");
  $(this).addClass("active");

  let img = $(this).attr("data-img");
  smoothChange(img);
});


/***************************************
 * PRICE RANGE SLIDER
 ***************************************/
const minRange = document.getElementById("minRange");
const maxRange = document.getElementById("maxRange");
const progress = document.getElementById("progressBar");

if (minRange && maxRange && progress) {

  function updateUI() {
    const min = +minRange.value;
    const max = +maxRange.value;
    const total = +minRange.max;

    progress.style.left = (min / total * 100) + "%";
    progress.style.right = (100 - (max / total * 100)) + "%";
  }

  minRange.addEventListener("input", () => {
    if (+minRange.value > +maxRange.value - 500)
      minRange.value = +maxRange.value - 500;
    updateUI();
  });

  maxRange.addEventListener("input", () => {
    if (+maxRange.value < +minRange.value + 500)
      maxRange.value = +minRange.value + 500;
    updateUI();
  });

  updateUI();
}


document.querySelectorAll(".rating-stars i").forEach(star => {
  star.addEventListener("click", function () {

    let index = parseInt(this.getAttribute("data-index"));

    // Remove all active first
    document.querySelectorAll(".rating-stars i")
      .forEach(s => s.classList.remove("active"));

    // Add active only up to clicked star
    for (let i = 1; i <= index; i++) {
      document.querySelector(`.rating-stars i[data-index="${i}"]`)
        .classList.add("active");
    }
  });
});


/* ===== Tabs Switch ===== */
const tabBtns = document.querySelectorAll(".product-tab-btn");
const tabContents = document.querySelectorAll(".tab-content-box");

tabBtns.forEach(btn => {
  btn.addEventListener("click", () => {
    tabBtns.forEach(b => b.classList.remove("active"));
    tabContents.forEach(c => c.classList.remove("active"));

    btn.classList.add("active");
    document.getElementById(btn.dataset.tab).classList.add("active");
  });
});

/***************************************
  Click here to login
 ***************************************/

function toggleContent(contentId, arrowId) {
  const content = document.getElementById(contentId);
  const arrow = document.getElementById(arrowId);

  content.classList.toggle("active");
  arrow.classList.toggle("rotate");
}

/* Loader functionality */
function showLoader() {
  document.getElementById('ajax-overlay').classList.add('active');
  document.body.style.pointerEvents = 'none';
}

function hideLoader() {
  document.getElementById('ajax-overlay').classList.remove('active');
  document.body.style.pointerEvents = '';
}


/* Cart & Mini Cart functionality is handled in CartController.php */


document.addEventListener("click", function (e) {
  const btn = e.target.closest(".qty-btn");
  if (!btn) return;

  const wrapper = btn.closest(".qty-wrapper");
  const input = wrapper.querySelector(".qty-input");
  const productId = input.dataset.productId;
  let value = parseInt(input.value);

  const min = parseInt(input.min) || 1;
  const max = parseInt(input.max) || 999;

  if (btn.dataset.type === "plus" && value < max) value++;
  if (btn.dataset.type === "minus" && value > min) value--;

  input.value = value;

  const buyNowBtn = document.querySelector(`#buyNow${productId}`);
  if (!buyNowBtn) {
    if (value === 1) return;
    updateCart(productId, value);
  }
});

function route(name, id = null) {
  let url = App.routes[name];
  return id ? url.replace(':id', id) : url;
}


function addToCart(productId, qty = 1, buyNow = false) {
  showLoader();
  const input = document.querySelector('.qty-input');
  if (input) {
    qty = input.value;
  }
  fetch(route('cartAdd', productId), {
    method: 'POST',
    headers: {
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      'Content-Type': 'application/json',
      'Accept': 'application/json'
    },
    body: JSON.stringify({ quantity: qty })
  })
    .then(res => res.json())
    .then(data => {
      loadMiniCart();
      document.querySelectorAll('.cartCount').forEach(el => el.innerText = data.cart_count);

      const buyNowBtn = document.querySelector(`#buyNow${productId}`);

      if (buyNowBtn) {
        const addCart = document.querySelector(`#addCart${productId}`);
        addCart.disabled = true;
        addCart.textContent = 'Already in Cart';
        buyNowBtn.disabled = true;

        const wrapper = document.querySelector(`#qtywrapper${productId}`);
        wrapper.querySelectorAll("button, input").forEach((el) => {
          el.disabled = true;
        });


      } else {
        const addCartButtons = document.querySelectorAll(`.addCart${productId}`);
        addCartButtons.forEach(function (item) {
          item.disabled = true;
          item.setAttribute('title', 'Already in Cart');
        });
      }
      if (buyNow) {
        setTimeout(() => {
          window.location = window.routes.checkOutUrl
        }, 2000)
      }

    })
    .catch(err => console.error(err))
    .finally(hideLoader);
}

function updateCart(productId, qty) {
  showLoader();
  fetch(route('cartUpdate', productId), {
    method: 'POST',
    headers: {
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      'Content-Type': 'application/json',
      'Accept': 'application/json'
    },
    body: JSON.stringify({ quantity: qty })
  })
    .then(res => res.json())
    .then(data => {
      document.querySelector(`#subtotal-${productId}`).innerText = `₹${data.product_subtotal.toFixed(2)}`;
      document.getElementById('cart-subtotal').innerText = `₹${data.cart_total.toFixed(2)}`;
      document.getElementById('cart-total').innerText = `₹${data.cart_total.toFixed(2)}`;

      loadMiniCart()
    })
    .catch(err => console.error(err))
    .finally(hideLoader);
}

function removeFromCart(productId) {
  showLoader();
  fetch(route('cartRemove', productId), {
    method: 'DELETE',
    headers: {
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      'X-Requested-With': 'XMLHttpRequest',
      'Accept': 'application/json'
    }
  })
    .then(res => res.json())
    .then(data => {

      loadMiniCart();
      // ---- CART PAGE ONLY ----
      const cartItem = document.getElementById(`cart-item-${productId}`);

      if (cartItem) {
        cartItem.remove();

        if (data.cart_count === 0) {
          const cartPage = document.getElementById('cartpage');
          if (cartPage) {
            cartPage.innerHTML = `<div class="text-center py-4">Your cart is empty.</div>`;
          }
        } else {
          const subtotalEl = document.getElementById('cart-subtotal');
          const totalEl = document.getElementById('cart-total');

          if (subtotalEl) {
            subtotalEl.innerText = `${window.symbol}${data.cart_total.toFixed(2)}`;
          }

          if (totalEl) {
            totalEl.innerText = `${window.symbol}${data.cart_total.toFixed(2)}`;
          }
        }
      }
    })
    .catch(err => console.error(err))
    .finally(hideLoader);
}


function loadMiniCart() {

  fetch(route('cartMini'), {
    headers: { 'Accept': 'application/json' }
  })
    .then(res => res.json())
    .then(data => {
      if (!data.success) return;

      document.getElementById('minicart').innerHTML = data.html;
      document.querySelectorAll('.cartCount').forEach(el => el.innerText = data.cart_count);
    })
    .catch(err => console.error(err));
}


document.addEventListener('DOMContentLoaded', loadMiniCart);

function productQty(productId) {
  if (!productId) return;

  const input = document.querySelector('.qty-input');
  if (!input) return;

  fetch(route('cartProductQty', productId), {
    headers: {
      'Accept': 'application/json'
    }
  })
    .then(res => res.json())
    .then(data => {
      if (data.qty > 0) {
        input.value = data.qty;
      }
    })
    .catch(err => console.error('Qty fetch error:', err));
}

// document.addEventListener('DOMContentLoaded', function () {
//   const input = document.querySelector('.qty-input');
//   if (!input) return;

//   const productId = input.dataset.productId;
//   productQty(productId);
// });

