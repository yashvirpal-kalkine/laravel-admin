<!-- Profile Page -->
<div id="profile-page" class="page-content" style="display:none;">
    <h2 class="page-title">My profile</h2>
    <form>
        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">First name</label>
                <input type="text" class="form-control" value="Yog">
            </div>
            <div class="col-md-6">
                <label class="form-label">Last name</label>
                <input type="text" class="form-control" value="Raj">
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-6">
                <label class="form-label">Email address</label>
                <input type="email" class="form-control" value="yograjwebdesigner123@gmail.com">
            </div>
            <div class="col-md-6">
                <label class="form-label">Mobile</label>
                <input type="tel" class="form-control" value="+918628898414">
            </div>
        </div>
        <button type="submit" class="btn btn-primary-custom">Update info</button>
    </form>

    <h3 class="page-title mt-5 mb-4">Addresses</h3>
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="address-card">
                <span class="badge">Default</span>
                <h5 id="savedName">Yog Raj</h5>
                <p class="text-muted" id="savedCountry">India</p>

                <div class="address-actions">
                    <button class="edit-address-btn"><i class="fas fa-edit"></i></button>
                    <button><i class="fas fa-trash"></i></button>
                </div>
            </div>
        </div>

        <!-- Add New Address Card -->
        <div class="col-md-6 mb-4">
            <div class="add-address-card" id="addNewAddressBtn">
                <i class="fas fa-map-marker-alt"></i>
                <p class="text-muted mb-0">+ Add new address</p>
            </div>
        </div>

    </div>

    <div id="addressFormWrapper" class="mt-4" style="display:none;">

        <h4 class="mb-3" id="formTitle">Add Address</h4>

        <form id="addressForm">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>First name</label>
                    <input type="text" class="form-control" id="firstName" placeholder="Enter First Name">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Last name</label>
                    <input type="text" class="form-control" id="lastName" placeholder="Enter Last Name">
                </div>

                <div class="col-md-12 mb-3">
                    <label>Company</label>
                    <input type="text" class="form-control" placeholder="Company name">
                </div>

                <div class="col-md-12 mb-3">
                    <label>Address</label>
                    <input type="text" class="form-control" placeholder="Enter address">
                </div>

                <div class="col-md-12 mb-3">
                    <label>Apartment, suite, etc.</label>
                    <input type="text" class="form-control" placeholder="Enter apartment, suite, etc.">
                </div>

                <div class="col-md-4 mb-3">
                    <label>City</label>
                    <input type="text" class="form-control" placeholder="Enter city">
                </div>

                <div class="col-md-4 mb-3">
                    <label>Country/Region</label>
                    <select class="form-control" id="country">
                        <option>Select country/region</option>
                        <option value="India">India</option>
                        <option value="USA">USA</option>
                    </select>
                </div>

                <div class="col-md-4 mb-3">
                    <label>Postal/Zip code</label>
                    <input type="text" class="form-control" placeholder="Enter postal/zip code">
                </div>

                <div class="col-md-12 mb-3">
                    <label>Phone</label>
                    <input type="text" class="form-control" placeholder="Enter phone number with country code">
                </div>

                <div class="col-md-12 mb-3">
                    <label><input type="checkbox"> Set as default address</label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Save address</button>
            <button type="button" class="btn btn-outline-secondary" id="cancelFormBtn">Cancel</button>
        </form>

    </div>

</div>