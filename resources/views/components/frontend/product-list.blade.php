@if($products->count() > 0)
    @foreach ($products as $product)
        <x-frontend.product-card :item="$product" />
    @endforeach
@else
    <div class="col-12 text-center py-5">
        <x-frontend.no-product />
    </div>
@endif