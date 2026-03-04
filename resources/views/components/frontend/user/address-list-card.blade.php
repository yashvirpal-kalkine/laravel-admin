@props(['item' => null])
<div class="col-md-6 mb-4">
    <div class="address-card">
        <span class="badge">Default</span>
        <h5 id="savedName">Yog Raj</h5>
        <p class="text-muted" id="savedCountry">India</p>

        <div class="address-actions">
            <a href="{{ route('profile.addresses.edit',$item->id) }}" class="edit-address-btn"><i class="fas fa-edit"></i></a>
            <a href="{{ route('profile.addresses.destroy',$item->id) }}"><i class="fas fa-trash"></i></a>
        </div>
    </div>
</div>