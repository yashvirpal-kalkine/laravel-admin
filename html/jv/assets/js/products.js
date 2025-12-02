

    document.addEventListener("DOMContentLoaded", function () {

        const toggle = document.querySelector(".cart-toggle");
        const box = document.querySelector(".cart-box");
        const close = document.querySelector(".cart-close");

        // Toggle on click
        toggle.addEventListener("click", function (e) {
            e.preventDefault();
            box.classList.toggle("open");
        });

        // Close button
        close.addEventListener("click", function (e) {
            e.preventDefault();
            box.classList.remove("open");
        });

        // Close on outside click
        document.addEventListener("click", function(e) {
            if (!box.contains(e.target) && !toggle.contains(e.target)) {
                box.classList.remove("open");
            }
        });

    });

          function toggleContent(id) {
    var content = document.getElementById(id);
    if (!content) return;

    var isOpen = content.classList.contains('active');

    if (isOpen) {
      content.classList.remove('active');
    } else {
      content.classList.add('active');
    }

    // Arrow icon rotate ke liye (sirf login & coupon mein hai)
    var parentCard = content.closest('.notification-card');
    if (parentCard) {
      var toggle = parentCard.querySelector('.toggle-section');
      if (toggle) {
        var arrow = toggle.querySelector('.arrow-icon');
        if (arrow) {
          if (isOpen) {
            arrow.classList.remove('rotated');
          } else {
            arrow.classList.add('rotated');
          }
        }
      }
    }

    // Shipping checkbox ka state sync
    if (id === 'shippingContent') {
      var checkbox = document.getElementById('differentShipping');
      if (checkbox) {
        if (!isOpen && !checkbox.checked) checkbox.checked = true;
        if (isOpen && checkbox.checked) checkbox.checked = false;
      }
    }
  }



// password show
document.getElementById("togglePass").addEventListener("click", function () {
  const pass = document.getElementById("pass");
  const eyeIcon = document.getElementById("eyeIcon");


  if (pass.value.trim() === "") {
    return;
  }

  if (pass.type === "password") {
    pass.type = "text";      
    eyeIcon.classList.remove("fa-eye-slash");
    eyeIcon.classList.add("fa-eye");          
  } else {
    pass.type = "password";  
    eyeIcon.classList.remove("fa-eye");       
    eyeIcon.classList.add("fa-eye-slash");  
  }
});










function smoothChange(img) {
    $("#mainImg").removeClass("active-slide");

    setTimeout(function () {
        $("#mainImg").attr("src", img);
        $("#mainImg").addClass("active-slide");
    }, 50);
}

var thumbs = $(".owl-thumbs");

thumbs.owlCarousel({
    items: 5,
    margin: 10,
    loop: true,
    dots: false,
    nav: false,
    mouseDrag: true,
    smartSpeed: 400,
    slideBy: 1,

    onInitialized: function(event) {
        var realFirst = $(".owl-thumbs .owl-item:not(.cloned)").first();
        realFirst.addClass("active-thumb");

        var firstImg = realFirst.find("img").attr("data-large");

        // DEFAULT LOAD SMOOTH SLIDE
        smoothChange(firstImg);
    },

    responsive: {
        0: { items: 3 },
        600: { items: 4 },
        1000: { items: 5 }
    }
});


// THUMB CLICK
$(document).on("click", ".owl-thumbs .owl-item", function () {
    let img = $(this).find("img").attr("data-large");

    smoothChange(img);

    $(".owl-thumbs .owl-item").removeClass("active-thumb");
    $(this).addClass("active-thumb");
});

// COLOR DOT CLICK
$(".color-dot").click(function () {

    $(".color-dot").removeClass("active");
    $(this).addClass("active");

    let img = $(this).attr("data-img");

    smoothChange(img);
});

// ARROWS
$(".prev-thumb").click(function () {
    $(".owl-thumbs").trigger("prev.owl.carousel", [300]);
});

$(".next-thumb").click(function () {
    $(".owl-thumbs").trigger("next.owl.carousel", [300]);
});






$(".color-dot").click(function () {


    $(".color-dot").removeClass("active");
    $(this).addClass("active");

    let img = $(this).attr("data-img");
    $("#mainImg").attr("src", img);

    let targetIndex = -1;

    $(".owl-thumbs .owl-item:not(.cloned)").each(function (i) {
        let t = $(this).find("img").attr("data-large");
        if (t === img) {
            targetIndex = i;
        }
    });

    if (targetIndex !== -1) {


        $(".owl-thumbs .owl-item").removeClass("active-thumb");


        let realItem = $(".owl-thumbs .owl-item:not(.cloned)").eq(targetIndex);
        realItem.addClass("active-thumb");


        let absoluteIndex = realItem.index(); 
        $(".owl-thumbs").trigger("to.owl.carousel", [absoluteIndex, 300, true]);
    }

});


$(document).on("click", ".owl-thumbs .owl-item", function () {
    let img = $(this).find("img").attr("data-large");

    smoothChange(img);

    $(".owl-thumbs .owl-item").removeClass("active-thumb");
    $(this).addClass("active-thumb");


    $(".color-dot").removeClass("active");
    $('.color-dot[data-img="'+img+'"]').addClass("active");
});













document.querySelectorAll(".btn-plus").forEach(function(button) {
  button.addEventListener("click", function () {
    let input = this.parentElement.querySelector(".qty-input");
    input.value = parseInt(input.value) + 1;
  });
});

document.querySelectorAll(".btn-minus").forEach(function(button) {
  button.addEventListener("click", function () {
    let input = this.parentElement.querySelector(".qty-input");
    let value = parseInt(input.value);
    if (value > 1) {
      input.value = value - 1;
    }
  });
});














(function(){
    const productsContainer = document.getElementById('productsContainer');
    const searchInput = document.getElementById('searchProduct');
    const sortSelect = document.getElementById('sortProduct');
    const gridBtn = document.getElementById('gridView');
    const listBtn = document.getElementById('listView');

    /* ===== DEFAULT ACTIVE (All Products) ===== */
    const defaultCat = document.querySelector('.category-list .cat-link[data-cat="all"]');
    if(defaultCat){
        defaultCat.classList.add('active');
    }

    /* ===== CATEGORY DROPDOWN TOGGLE + ACTIVE ===== */
    document.querySelectorAll('.category-list .cat-toggle').forEach(toggle => {
        toggle.addEventListener('click', function(e){
            e.preventDefault();

            // Remove active from ALL cat-link and ALL cat-toggle
            document.querySelectorAll('.category-list .cat-link, .category-list .cat-toggle')
                .forEach(el => el.classList.remove('active'));

            // Add active to the clicked cat-toggle
            this.classList.add('active');

            // Open/close submenu
            this.parentElement.classList.toggle('open');
        });
    });

    /* ===== CATEGORY LINK ACTIVE ===== */
    document.querySelectorAll('.category-list .cat-link').forEach(link => {
        link.addEventListener('click', function(e){
            e.preventDefault();

            // Remove active from ALL cat-link AND ALL cat-toggle
            document.querySelectorAll('.category-list .cat-link, .category-list .cat-toggle')
                .forEach(el => el.classList.remove('active'));

            // Add active to clicked link
            this.classList.add('active');

            filterAndRender();
        });
    });

    /* ===== VIEW TOGGLE ===== */
    function setView(view){
        if(view === 'list'){
            productsContainer.classList.add('list');
            productsContainer.classList.remove('products-grid');
            listBtn.classList.add('active');
            gridBtn.classList.remove('active');
        } else {
            productsContainer.classList.remove('list');
            productsContainer.classList.add('products-grid');
            gridBtn.classList.add('active');
            listBtn.classList.remove('active');
        }
    }

    gridBtn.addEventListener('click', () => setView('grid'));
    listBtn.addEventListener('click', () => setView('list'));

    /* ===== SEARCH + SORT ===== */
    searchInput.addEventListener('input', filterAndRender);
    sortSelect.addEventListener('change', filterAndRender);

    /* ===== FILTER + RENDER ===== */
    function filterAndRender(){
        const q = searchInput.value.toLowerCase().trim();
        const sort = sortSelect.value;

        const activeCatEl = document.querySelector('.category-list .active[data-cat]');
        const activeCat = activeCatEl ? activeCatEl.getAttribute('data-cat') : 'all';

        const items = Array.from(productsContainer.querySelectorAll('.product-item'));

        let filtered = items.filter(item => {
            const name = item.getAttribute('data-name').toLowerCase();
            const price = item.getAttribute('data-price');
            const cat   = item.getAttribute('data-cat');

            const matchesQuery =
                q === '' || name.includes(q) || price.includes(q);

            const matchesCat =
                activeCat === 'all' || cat === activeCat;

            return matchesQuery && matchesCat;
        });

        // sorting
        if(sort === 'name'){
            filtered.sort((a,b) =>
                a.getAttribute('data-name').localeCompare(b.getAttribute('data-name'))
            );
        } 
        else if(sort === 'price-low'){
            filtered.sort((a,b) =>
                Number(a.getAttribute('data-price')) - Number(b.getAttribute('data-price'))
            );
        }
        else if(sort === 'price-high'){
            filtered.sort((a,b) =>
                Number(b.getAttribute('data-price')) - Number(a.getAttribute('data-price'))
            );
        }

        productsContainer.innerHTML = '';
        if(filtered.length === 0){
            productsContainer.innerHTML = '<div class="p-3 bg-white rounded">No products found.</div>';
            return;
        }

        filtered.forEach(item => productsContainer.appendChild(item));
    }

    filterAndRender();

})();











const minRange = document.getElementById("minRange");
const maxRange = document.getElementById("maxRange");
const progress = document.getElementById("progressBar");

function updateUI() {
  const min = +minRange.value;
  const max = +maxRange.value;
  const total = +minRange.max;

  const left = (min / total) * 100;
  const right = (max / total) * 100;

  progress.style.left = left + "%";
  progress.style.right = (100 - right) + "%";
}

minRange.addEventListener("input", () => {
  if (+minRange.value > +maxRange.value - 500) minRange.value = +maxRange.value - 500;
  updateUI();
});
maxRange.addEventListener("input", () => {
  if (+maxRange.value < +minRange.value + 500) maxRange.value = +minRange.value + 500;
  updateUI();
});

updateUI();
