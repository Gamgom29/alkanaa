<!-- New Address Modal -->
<style>
    #new-address-modal .modal-dialog,
    #edit-address-modal .modal-dialog {
        max-width: 560px;
    }

    #new-address-modal .modal-content,
    #edit-address-modal .modal-content {
        color: #1f2937;
        background: #fff;
        border: 0;
        border-radius: 8px;
        box-shadow: 0 24px 70px rgba(15, 23, 42, .28);
        overflow: hidden;
    }

    #new-address-modal .modal-header,
    #edit-address-modal .modal-header {
        padding: 18px 24px;
        border-bottom: 1px solid #e7eaf0;
    }

    #new-address-modal .modal-title,
    #edit-address-modal .modal-title {
        color: #111827;
        font-size: 18px;
        font-weight: 700;
    }

    #new-address-modal .modal-body,
    #edit-address-modal .modal-body {
        max-height: calc(100vh - 120px);
        padding: 22px 24px 24px;
        overflow-y: auto;
    }

    #new-address-modal .modal-body .p-3,
    #edit-address-modal .modal-body .p-3 {
        padding: 0 !important;
    }

    #new-address-modal .row,
    #edit-address-modal .row {
        margin-right: 0;
        margin-left: 0;
    }

    #new-address-modal .col-md-2,
    #new-address-modal .col-md-10,
    #edit-address-modal .col-md-2,
    #edit-address-modal .col-md-10 {
        flex: 0 0 100%;
        max-width: 100%;
        padding-right: 0;
        padding-left: 0;
    }

    #new-address-modal label,
    #edit-address-modal label {
        color: #374151;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 7px;
    }

    #new-address-modal .form-control,
    #edit-address-modal .form-control,
    #new-address-modal .bootstrap-select > .dropdown-toggle,
    #edit-address-modal .bootstrap-select > .dropdown-toggle {
        min-height: 46px;
        color: #111827;
        background-color: #fff;
        border: 1px solid #d9dee8;
        border-radius: 4px !important;
    }

    #new-address-modal textarea.form-control,
    #edit-address-modal textarea.form-control {
        min-height: 86px;
    }

    #new-address-modal .bootstrap-select,
    #edit-address-modal .bootstrap-select,
    #new-address-modal .iti,
    #edit-address-modal .iti {
        width: 100%;
    }

    #new-address-modal .form-group.text-right,
    #edit-address-modal .form-group.text-right {
        margin-top: 16px;
    }

    #new-address-modal .btn-primary,
    #edit-address-modal .btn-primary {
        min-width: 160px;
        min-height: 46px;
        border-radius: 4px !important;
        font-weight: 700;
    }
</style>

<div class="modal fade" id="new-address-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ translate('New Address') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="form-default" role="form" action="{{ route('addresses.store') }}" method="POST">
                @csrf
                <div class="modal-body c-scrollbar-light">
                    <div class="p-3">
                        <!-- Address -->
                        <div class="row">
                            <div class="col-md-2">
                                <label>{{ translate('Address')}}</label>
                            </div>
                            <div class="col-md-10">
                                <textarea class="form-control mb-3 rounded-0" placeholder="{{ translate('Your Address')}}" rows="2" name="address" required></textarea>
                            </div>
                        </div>

                        <!-- Country -->
                        <div class="row">
                            <div class="col-md-2">
                                <label>{{ translate('Country')}}</label>
                            </div>
                            <div class="col-md-10">
                                <div class="mb-3">
                                    <select class="form-control aiz-selectpicker rounded-0" data-live-search="true" data-placeholder="{{ translate('Select your country') }}" name="country_id" required>
                                        <option value="">{{ translate('Select your country') }}</option>
                                        @foreach (get_active_countries() as $key => $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- State -->
                        <div class="row">
                            <div class="col-md-2">
                                <label>{{ translate('State')}}</label>
                            </div>
                            <div class="col-md-10">
                                <select class="form-control mb-3 aiz-selectpicker rounded-0" data-live-search="true" name="state_id" required>
                                    <option value="">{{ translate('Select State') }}</option>
                                </select>
                            </div>
                        </div>

                        <!-- City -->
                        <div class="row">
                            <div class="col-md-2">
                                <label>{{ translate('City')}}</label>
                            </div>
                            <div class="col-md-10">
                                <select class="form-control mb-3 aiz-selectpicker rounded-0" data-live-search="true" name="city_id" required>
                                    <option value="">{{ translate('Select City') }}</option>
                                </select>
                            </div>
                        </div>

                        @if (get_setting('google_map') == 1)
                            <!-- Google Map -->
                            <div class="row mt-3 mb-3">
                                <input id="searchInput" class="controls" type="text" placeholder="{{translate('Enter a location')}}">
                                <div id="map"></div>
                                <ul id="geoData">
                                    <li style="display: none;">Full Address: <span id="location"></span></li>
                                    <li style="display: none;">Postal Code: <span id="postal_code"></span></li>
                                    <li style="display: none;">Country: <span id="country"></span></li>
                                    <li style="display: none;">Latitude: <span id="lat"></span></li>
                                    <li style="display: none;">Longitude: <span id="lon"></span></li>
                                </ul>
                            </div>
                            <!-- Longitude -->
                            <div class="row">
                                <div class="col-md-2" id="">
                                    <label for="exampleInputuname">{{ translate('Longitude')}}</label>
                                </div>
                                <div class="col-md-10" id="">
                                    <input type="text" class="form-control mb-3 rounded-0" id="longitude" name="longitude" readonly="">
                                </div>
                            </div>
                            <!-- Latitude -->
                            <div class="row">
                                <div class="col-md-2" id="">
                                    <label for="exampleInputuname">{{ translate('Latitude')}}</label>
                                </div>
                                <div class="col-md-10" id="">
                                    <input type="text" class="form-control mb-3 rounded-0" id="latitude" name="latitude" readonly="">
                                </div>
                            </div>
                        @endif

                        <!-- Postal code -->
                        <div class="row">
                            <div class="col-md-2">
                                <label>{{ translate('Postal code')}}</label>
                            </div>
                            <div class="col-md-10">
                                <input type="text" class="form-control mb-3 rounded-0" placeholder="{{ translate('Your Postal Code')}}" name="postal_code" value="" required>
                            </div>
                        </div>

                        <!-- Phone -->
                        <div class="row mb-3">
                            <div class="col-md-2">
                                <label>{{ translate('Phone')}}</label>
                            </div>
                            <div class="col-md-10">
                                <input type="tel" id="phone-code" class="form-control rounded-0" placeholder="" name="phone" autocomplete="off" required>
                                <input type="hidden" name="country_code" value="">
                            </div>
                        </div>

                        <!-- Save button -->
                        <div class="form-group text-right">
                            <button type="submit" class="btn btn-primary rounded-0 w-150px">{{translate('Save')}}</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Address Modal -->
<div class="modal fade" id="edit-address-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ translate('New Address') }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body c-scrollbar-light" id="edit_modal_body">

            </div>
        </div>
    </div>
</div>
