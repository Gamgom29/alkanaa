<script type="text/javascript">
    function getProductTempDataType() {
        var dataTypeInput = document.getElementById('data_type');

        return dataTypeInput && dataTypeInput.value ? dataTypeInput.value : 'physical';
    }

    function clearTempdata() {
        var dataType = getProductTempDataType();

        try {
            localStorage.setItem('tempdataproduct_' + dataType, '{}');
            localStorage.setItem('tempload_' + dataType, 'no');
        } catch (e) {
            // Ignore storage failures so the product page stays usable.
        }

        window.location.reload();
    }
</script>
