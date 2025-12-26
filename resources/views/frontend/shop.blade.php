@extends('layouts.frontend')


@section('meta')
    {{-- <x-frontend-meta :model="$page" /> --}}
@endsection

@section('content')
    <!-- All products section start here -->
    <section class="all-products-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="top-bar">
                        <div class="top-baar-right">
                            <x-frontend.sorting-shop />
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <x-frontend.shop-sidebar :filters="$filters" />
                </div>

                <div class="col-md-9">
                    <div class="row gy-4 gx-3">
                        @if($products->count() > 0)
                            @foreach ($products as $product)
                                <x-frontend.product-card :item="$product" />
                            @endforeach
                        @else
                            <div class="col-12 text-center py-5">
                                <x-frontend.no-product />
                            </div>
                        @endif
                    </div>
                    <nav aria-label="Page navigation" class="mt-4">
                        <div class="d-flex justify-content-center">
                            {{ $products->links('pagination::bootstrap-5') }}
                        </div>
                    </nav>

                    {{-- <nav aria-label="Page navigation" class="mt-4">
                        <ul class="pagination justify-content-center">

                            <!-- Previous -->
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Previous</a>
                            </li>

                            <!-- Page Numbers -->
                            <li class="page-item active">
                                <a class="page-link" href="#">1</a>
                            </li>

                            <li class="page-item">
                                <a class="page-link" href="#">2</a>
                            </li>

                            <li class="page-item">
                                <a class="page-link" href="#">3</a>
                            </li>

                            <!-- Next -->
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>

                        </ul>
                    </nav> --}}

                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- All products section end here -->
@endsection