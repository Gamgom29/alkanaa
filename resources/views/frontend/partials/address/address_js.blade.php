<script type="text/javascript">
    function submitShippingInfoForm(el) {
        var email = $("input[name='email']").val();
        var phone = $("input[name='country_code']").val() + $("input[name='phone']").val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('guest_customer_info_check') }}",
            type: 'POST',
            data: {
                email: email,
                phone: phone
            },
            success: function(response) {
                if (response == 1) {
                    $('#login_modal').modal();
                    AIZ.plugins.notify('warning',
                        '{{ translate('You already have an account with this information. Please Login first.') }}'
                        );
                } else {
                    $('#shipping_info_form').submit();
                }
            }
        });
    }

    function add_new_address() {
        $('#new-address-modal').modal('show');
    }

    function edit_company() {
        $("#edit-company-modal").modal('show');
    }

    function edit_address(address) {
        var url = '{{ route('addresses.edit', ':id') }}';
        url = url.replace(':id', address);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            type: 'GET',
            success: function(response) {
                $('#edit_modal_body').html(response.html);
                $('#edit-address-modal').modal('show');
                AIZ.plugins.bootstrapSelect('refresh');

                @if (get_setting('google_map') == 1)
                    var lat = -33.8688;
                    var long = 151.2195;

                    if (response.data.address_data.latitude && response.data.address_data.longitude) {
                        lat = parseFloat(response.data.address_data.latitude);
                        long = parseFloat(response.data.address_data.longitude);
                    }

                    initialize(lat, long, 'edit_');
                @endif
            }
        });
    }

    $(document).on('change', '[name=country_id]', function() {
        var country_id = $(this).val();
        get_states(country_id, $(this).closest('form'));
    });

    $(document).on('change', '[name=state_id]', function() {
        var state_id = $(this).val();
        get_city(state_id, $(this).closest('form'));
    });

    function parseAddressSelectResponse(response) {
        return typeof response === 'string' ? JSON.parse(response) : response;
    }

    function refreshAddressSelects() {
        if (typeof AIZ !== 'undefined' && AIZ.plugins && AIZ.plugins.bootstrapSelect) {
            AIZ.plugins.bootstrapSelect('refresh');
        }
    }

    function get_states(country_id, $scope) {
        $scope = $scope && $scope.length ? $scope : $(document);
        var $state = $scope.find('[name="state_id"]');
        var $city = $scope.find('[name="city_id"]');

        $state.html('<option value="">{{ translate('Loading...') }}</option>');
        $city.html('<option value="">{{ translate('Select City') }}</option>');
        refreshAddressSelects();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('get-state') }}",
            type: 'POST',
            data: {
                country_id: country_id
            },
            success: function(response) {
                var obj = parseAddressSelectResponse(response);
                $state.html(obj || '<option value="">{{ translate('Select State') }}</option>');
                $city.html('<option value="">{{ translate('Select City') }}</option>');
                refreshAddressSelects();
            }
        });
    }

    function get_city(state_id, $scope) {
        $scope = $scope && $scope.length ? $scope : $(document);
        var $city = $scope.find('[name="city_id"]');

        $city.html('<option value="">{{ translate('Loading...') }}</option>');
        refreshAddressSelects();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "{{ route('get-city') }}",
            type: 'POST',
            data: {
                state_id: state_id
            },
            success: function(response) {
                var obj = parseAddressSelectResponse(response);
                $city.html(obj || '<option value="">{{ translate('Select City') }}</option>');
                refreshAddressSelects();
            }
        });
    }
</script>
