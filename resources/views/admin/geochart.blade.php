@extends('admin.admin_dashboard')
@section('admin')
<div class="container" style="height: 80vh">
    <div id="map-world-merc"></div>
</div>
<script>
    // @formatter:on
    document.addEventListener("DOMContentLoaded", function() {
        const map = new jsVectorMap({
            selector: '#map-world-merc',
            map: 'world_merc',
            backgroundColor: 'transparent',
            regionStyle: {
                initial: {
                    fill: tabler.getColor('body-bg'),
                    stroke: tabler.getColor('border-color'),
                    strokeWidth: 2,
                }
            },
            zoomOnScroll: true,
            zoomButtons: true,
            // -------- Series --------
            visualizeData: {
                scale: [tabler.getColor('bg-surface'), tabler.getColor('primary')],
                values: {!! json_encode($data) !!}, // Echo the PHP data as JSON directly
            },
            onRegionTipShow: function(event, code, region) {
                // Get the value for the hovered country from the `values` object
                const value = map.params.visualizeData.values[code];
                event.html = region + ': ' + value; // Display the value in the tooltip
            },
            onRegionClick: function(event, code, region) {
            // Redirect to the country profile page with the clicked region's CountryCode
            window.location.href = '/admin/countryprofile/' + code;
        },
        });
        window.addEventListener("resize", () => {
            map.updateSize();
        });
    });
    // @formatter:off
</script>

@endsection