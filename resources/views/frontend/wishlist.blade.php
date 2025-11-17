<button 
    class="btn btn-outline-danger wishlist-toggle" 
    data-id="{{ $product->id }}" 
    data-type="Product">
    <i class="bi bi-heart{{ $product->isWishlistedBy(auth()->user()) ? '-fill' : '' }}"></i>
</button>

<script>
$('.wishlist-toggle').click(function(){
    let id = $(this).data('id');
    let type = $(this).data('type');
    $.post('{{ route('wishlist.toggle') }}', {
        id: id,
        type: type,
        _token: '{{ csrf_token() }}'
    }, function(response){
        location.reload(); // or update icon dynamically
    });
});
</script>
<h3>My Wishlist</h3>
<ul>
    @foreach($wishlists as $item)
        <li>
            {{ $item->wishlistable->title ?? $item->wishlistable->name }}
            <form action="{{ route('wishlist.toggle') }}" method="POST">
                @csrf
                <input type="hidden" name="type" value="{{ class_basename($item->wishlistable_type) }}">
                <input type="hidden" name="id" value="{{ $item->wishlistable_id }}">
                <button class="btn btn-sm btn-danger">Remove</button>
            </form>
        </li>
    @endforeach
</ul>
