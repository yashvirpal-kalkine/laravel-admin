<script>
    const categorypage = document.querySelector('#categorypage');

    if (categorypage) {
        const categoryId = categorypage.value;
        const parentCategoryId = categorypage.dataset.parentcategoryid;

        document.querySelectorAll('.category-filter').forEach((ele) => {
            if (ele.value === categoryId || ele.value === parentCategoryId) {
                ele.checked = true;
            }
        });
    }



    let currentPage = 1;

    const productList = document.getElementById('product-list');
    const loadMoreBtn = document.getElementById('load-more-btn');

    function loadProducts(append = false) {

        const categories = Array.from(
            document.querySelectorAll('.category-filter:checked')
        ).map(el => el.value);

        const rating = document.querySelector('.rating-filter:checked')?.value ?? null;

        fetch("{{ route('products.load') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({
                page: currentPage,
                categories,
                rating,
                min_price: document.getElementById('minPriceInput').value,
                max_price: document.getElementById('maxPriceInput').value,
                sort: document.getElementById('sortBy').value
            })
        })
            .then(res => res.json())
            .then(data => {

                if (append) {
                    productList.insertAdjacentHTML('beforeend', data.html);
                } else {
                    productList.innerHTML = data.html;
                }

                loadMoreBtn.classList.toggle('d-none', !data.hasMore);
            });
    }

    // 🔄 Load more click
    loadMoreBtn.addEventListener('click', () => {
        currentPage++;
        loadProducts(true);
    });

    // 🔁 Filters change → RESET pagination
    document.querySelectorAll(
        '.category-filter, .rating-filter, #sortBy, #minPriceInput, #maxPriceInput'
    ).forEach(el => {
        el.addEventListener('change', () => {
            currentPage = 1;
            loadProducts(false);
        });
    });

    // 🚀 Initial load
    loadProducts();
</script>