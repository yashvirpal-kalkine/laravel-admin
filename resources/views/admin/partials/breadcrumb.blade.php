<!-- resources/views/admin/partials/breadcrumb.blade.php -->
<div class="app-content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">{{ $title ?? 'Dashboard' }}</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    @if(!empty($breadcrumbs))
                    @foreach ($breadcrumbs as $label => $url)
                    @if ($loop->last)
                    <li class="breadcrumb-item active" aria-current="page">{{ $label }}</li>
                    @else
                    <li class="breadcrumb-item"><a href="{{ $url }}">{{ $label }}</a></li>
                    @endif
                    @endforeach
                    @else
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $title ?? 'Dashboard' }}</li>
                    @endif
                </ol>
            </div>
        </div>
    </div>
</div>