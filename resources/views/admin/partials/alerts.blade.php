{{-- resources/views/admin/partials/alerts.blade.php --}}
@if (session('success'))
    <div class="mb-4 rounded-lg bg-green-100 border border-green-300 text-green-800 px-4 py-3">
        <strong class="font-semibold">Success!</strong> {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="mb-4 rounded-lg bg-red-100 border border-red-300 text-red-800 px-4 py-3">
        <strong class="font-semibold">Error!</strong> {{ session('error') }}
    </div>
@endif

@if (session('warning'))
    <div class="mb-4 rounded-lg bg-yellow-100 border border-yellow-300 text-yellow-800 px-4 py-3">
        <strong class="font-semibold">Warning!</strong> {{ session('warning') }}
    </div>
@endif

@if (session('info'))
    <div class="mb-4 rounded-lg bg-blue-100 border border-blue-300 text-blue-800 px-4 py-3">
        <strong class="font-semibold">Info:</strong> {{ session('info') }}
    </div>
@endif

{{-- Validation Errors --}}
@if ($errors->any())
    <div class="mb-4 rounded-lg bg-red-100 border border-red-300 text-red-800 px-4 py-3">
        <strong class="font-semibold">Please fix the following errors:</strong>
        <ul class="mt-2 list-disc list-inside text-sm">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
