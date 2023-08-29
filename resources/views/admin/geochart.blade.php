@extends('admin.admin_dashboard')
@section('admin')

<!-- Add DataTables CSS and JS links if they are not included in your project yet -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>

<div class="container" style="height: 60vh">
    <div id="map-world-merc"></div>
</div>

<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Countries</h3>
        </div>
        
        <div id="dataTable_wrapper" class="dataTables_wrapper dt-bootstrap4">
            <div class="row">
                <div class="col-sm-12">
                    <div class="table-responsive">
                        <table id="dataTable" class="table card-table table-vcenter text-nowrap datatable dataTable" role="grid">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Country</th>
                                    <th>GDP real rates of growth</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $countryCode => $gdp)
                                    @php
                                        $countryName = \App\Models\CountryMaster::where('CountryCode', $countryCode)->value('Country');
                                        $countryLowerCase = \App\Models\CountryMaster::where('CountryCode', $countryCode)->value('CCLower');
                                    @endphp
                                    <tr>
                                        <td><span class="flag flag-country-{{ $countryLowerCase }}"></span></td>
                                        <td class="text-wrap"><a href="/admin/countryprofile/{{ $countryCode }}">{{ $countryName }}</a></td>
                                        <td>{{ $gdp }} %</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Initialize DataTable with search, pagination, and entry length options
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "paging": true,
            "searching": true,
            "info": true,
            "lengthChange": true,
            "pageLength": 10,
            "lengthMenu": [10, 25, 50, 100]
        });
    });

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
</script>

@endsection
