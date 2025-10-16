@extends('layouts.admin')

@section('content')
    <div class="card card-primary card-outline mb-4">
        <div class="card-header">
            <h5>Settings</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Tabs -->
                <ul class="nav nav-tabs" id="settingsTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="general-tab" data-bs-toggle="tab" data-bs-target="#general"
                            type="button" role="tab">General</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="payment-tab" data-bs-toggle="tab" data-bs-target="#payment"
                            type="button" role="tab">Payment</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="smtp-tab" data-bs-toggle="tab" data-bs-target="#smtp" type="button"
                            role="tab">SMTP</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="script-tab" data-bs-toggle="tab" data-bs-target="#script" type="button"
                            role="tab">Script</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="social-tab" data-bs-toggle="tab" data-bs-target="#social" type="button"
                            role="tab">Social</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="assets-tab" data-bs-toggle="tab" data-bs-target="#assets" type="button"
                            role="tab">Assets</button>
                    </li>
                </ul>

                <div class="tab-content mt-3" id="settingsTabContent">
                    <!-- General Tab -->
                    <div class="tab-pane fade show active" id="general" role="tabpanel">
                        <div class="row mb-3">
                            <div class="col-md-3 mb-3">
                                <label>Favicon</label>
                                <input type="file" name="favicon" class="form-control">
                                @if(!empty($settings['favicon']))
                                    <img src="{{ asset('storage/' . $settings['favicon']) }}" class="mt-2" height="30">
                                @endif
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>Header Logo</label>
                                <input type="file" name="header_logo" class="form-control">
                                @if(!empty($settings['header_logo']))
                                    <img src="{{ asset('storage/' . $settings['header_logo']) }}" class="mt-2" height="50">
                                @endif
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>Footer Logo</label>
                                <input type="file" name="footer_logo" class="form-control">
                                @if(!empty($settings['footer_logo']))
                                    <img src="{{ asset('storage/' . $settings['footer_logo']) }}" class="mt-2" height="50">
                                @endif
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>Currency</label>
                                <select name="currency" class="form-control">
                                    @foreach($currencies as $code => $symbol)
                                        <option value="{{ $code . ',' . $symbol }}" {{ old('currency', $settings['currency'] ?? '') == $code . ',' . $symbol ? 'selected' : '' }}>
                                            {{ $code }} ({{ $symbol }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-3 mb-3">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control"
                                    value="{{ old('email', $settings['email'] ?? '') }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>Email 2</label>
                                <input type="email" name="email2" class="form-control"
                                    value="{{ old('email2', $settings['email2'] ?? '') }}">
                            </div>


                            <div class="col-md-3 mb-3">
                                <label>Phone</label>
                                <input type="text" name="phone" class="form-control"
                                    value="{{ old('phone', $settings['phone'] ?? '') }}">
                            </div>
                            <div class="col-md-3 mb-3">
                                <label>Phone 2</label>
                                <input type="text" name="phone2" class="form-control"
                                    value="{{ old('phone2', $settings['phone2'] ?? '') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Address</label>
                                <textarea name="address"
                                    class="form-control">{{ old('address', $settings['address'] ?? '') }}</textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label>Map Embed</label>
                                <textarea name="map"
                                    class="form-control">{{ old('map', $settings['map'] ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Tab -->
                    <div class="tab-pane fade" id="payment" role="tabpanel">
                        <div class="mb-3">
                            <label>Payment Gateways</label>
                            <div class="form-check form-check-inline">
                                @foreach(['payu', 'razorpay', 'stripe', 'paypal'] as $pg)
                                    <input class="form-check-input" type="checkbox" name="payment_gateway[]" value="{{ $pg }}"
                                        @if(in_array($pg, json_decode($settings['payment_gateway'] ?? '[]', true))) checked
                                        @endif>
                                    <label class="form-check-label">{{ ucfirst($pg) }}</label>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <!-- SMTP Tab -->
                    <div class="tab-pane fade" id="smtp" role="tabpanel">
                        <div class="row mb-3">
                            <div class="col-md-4 mb-3">
                                <label>SMTP Host</label>
                                <input type="text" name="smtp_host" class="form-control"
                                    value="{{ old('smtp_host', $settings['smtp_host'] ?? '') }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>SMTP Port</label>
                                <input type="number" name="smtp_port" class="form-control"
                                    value="{{ old('smtp_port', $settings['smtp_port'] ?? '') }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>SMTP Username</label>
                                <input type="text" name="smtp_username" class="form-control"
                                    value="{{ old('smtp_username', $settings['smtp_username'] ?? '') }}">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label>SMTP Password</label>
                                <input type="text" name="smtp_password" class="form-control"
                                    value="{{ old('smtp_password', $settings['smtp_password'] ?? '') }}">
                            </div>
                        </div>
                    </div>

                    <!-- Script Tab -->
                    <div class="tab-pane fade" id="script" role="tabpanel">
                        <div class="mb-3">
                            <label>Head Script</label>
                            <textarea name="head_script"
                                class="form-control">{{ old('head_script', $settings['head_script'] ?? '') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label>Body Script</label>
                            <textarea name="body_script"
                                class="form-control">{{ old('body_script', $settings['body_script'] ?? '') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label>Footer Script</label>
                            <textarea name="footer_script"
                                class="form-control">{{ old('footer_script', $settings['footer_script'] ?? '') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label>Footer Content</label>
                            <textarea name="footer_content"
                                class="form-control">{{ old('footer_content', $settings['footer_content'] ?? '') }}</textarea>
                        </div>
                    </div>

                    <!-- Social Tab -->
                    <div class="tab-pane fade" id="social" role="tabpanel">
                        <h6>Social Links</h6>
                        <div class="row">
                            @foreach($socialPlatforms as $platform)
                                <div class="col-md-6 mb-3">
                                    <label>{{ ucfirst($platform) }} URL</label>
                                    <input type="url" name="social[{{ $platform }}]" class="form-control"
                                        value="{{ old('social.' . $platform, json_decode($settings['social'] ?? '{}', true)[$platform] ?? '') }}">
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Assets Tab -->
                    <div class="tab-pane fade" id="assets" role="tabpanel">
                        <div class="row mb-3">

                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Save Settings</button>
            </form>
        </div>
    </div>
@endsection