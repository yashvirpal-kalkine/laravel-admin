@if($isSingle)

    <button class="btn btn-sm btn-outline-success me-1" data-id="{{ $product->id }}"
        onclick="wishlistToggle({{ $product->id }},this)"
        title="{{ $product->is_wishlisted ? 'Remove from Wishlist' : 'Add to Wishlist' }}">
        <i class="{{ $product->is_wishlisted ? 'fas' : 'far' }} fa-heart"></i>
    </button>
@else
    <button class="btn-wishlist text-white " data-id="{{ $product->id }}" onclick="wishlistToggle({{ $product->id }},this)"
        title="{{ $product->is_wishlisted ? 'Remove from Wishlist' : 'Add to Wishlist' }}">
        <i class="{{ $product->is_wishlisted ? 'fas' : 'far' }} fa-heart"></i>
    </button>
    {{-- <button class="btn-wishlist">
        <svg id="Capa_1" enable-background="new 0 0 511.933 511.933" height="512" viewBox="0 0 511.933 511.933" width="512"
            xmlns="http://www.w3.org/2000/svg">
            <g>
                <g>
                    <g id="Layer_2_00000145060757712065768520000010951869483675587996_">
                        <g id="heart_00000179625350871963104660000003479433197253248677_">
                            <path
                                d="m256.001 464.957c-2.482.004-4.926-.611-7.11-1.79-2.3-1.24-57-30.84-114.86-76.95-79.43-63.26-124.03-124.44-132.53-181.85-6.54-44 8.31-84.65 44.13-120.7 48.937-48.921 128.263-48.921 177.2 0l33.11 33.14 33.17-33.14c48.937-48.921 128.263-48.921 177.2 0 35.82 36.05 50.66 76.66 44.12 120.7-8.52 57.41-53.1 118.58-132.49 181.81-57.9 46.11-112.56 75.71-114.86 76.95-2.173 1.185-4.605 1.813-7.08 1.83zm-121.76-388c-25.271-.126-49.532 9.909-67.33 27.85-29.18 29.37-40.91 60.49-35.74 95.15 15.95 107.53 187.5 211.36 224.83 232.76 37.26-21.4 208.82-125.23 224.76-232.76 5.14-34.64-6.55-65.76-35.74-95.13-37.215-37.151-97.485-37.151-134.7 0l-43.79 43.76c-2.812 2.81-6.625 4.389-10.6 4.39-3.976-.01-7.786-1.592-10.6-4.4l-43.72-43.74c-17.831-17.919-42.091-27.958-67.37-27.88z" />
                        </g>
                    </g>
                </g>
            </g>
        </svg>
    </button> --}}
@endif