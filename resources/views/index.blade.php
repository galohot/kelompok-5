@extends('dashboard')
@section('content')
  

<div class="page-body">

  <div class="container-xl">
    <div class="row row-deck row-cards">

      <div class="modal modal-blur fade" id="modal-scrollable" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Selamat datang pada Project Taskapok Kami</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <h1>RANCANGAN VISUALISASI DATA PENDUDUK DAN EKONOMI SEBAGAI SARANA DUKUNGAN STRATEGI KEBIJAKAN KEMENTERIAN LUAR NEGERI</h1>
              <ul>
                <li>
                  M. Dedi Irawan
                </li>
                <li>
                  Alfindio Muhammad Abdallah
                </li>
                <li>
                  Nuria Kusuma Ilmawati
                </li>
              </ul>

            </div>
            <div class="modal-footer">
              <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      <div class="col-12">
        <div class="row row-cards">
          <div class="col-sm-6 col-lg-4">
            <div class="card card-sm">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col-auto">
                    <span class="flag flag-country-id"></span>
                  </div>
                  <div class="col">
                    <div class="font-weight-medium">
                      <a>{{ count($perwakilanData) }} Perwakilan</a>
                    </div>
                    <div class="text-secondary">
                      {{ $uniqueRegionsCount }} Negara
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4">
            <div class="card card-sm">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col-auto">
                  </div>
                  <div class="col">
                    <div class="font-weight-medium">
                      United Nations
                    </div>
                    <div class="text-secondary">
                      <a href="https://data.un.org/" class="link-secondary">Datasets</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-4">
            <div class="card card-sm">
              <div class="card-body">
                <div class="row align-items-center">
                  <div class="col-auto">
                  </div>
                  <div class="col">
                    <div class="font-weight-medium">
                      World Bank
                    </div>
                    <div class="text-secondary">
                      <a href="https://databank.worldbank.org/" class="link-secondary">Datasets</a>
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card">
          <div class="card-body">
            <h3 class="card-title">World Exports and Imports</h3>
            <div id="index-trade-chart" class="chart-lg"></div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="card">
          <div class="card-body">
            <h3 class="card-title">Locations</h3>
            <div class="ratio ratio-21x9">
              <div>
                <div id="map-world-merc" class="w-100 h-100"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12">
        <div class="card card-md">
          <div class="card-stamp card-stamp-lg">
            <div class="card-stamp-icon bg-primary">
              <!-- Download SVG icon from http://tabler-icons.io/i/ghost -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 11a7 7 0 0 1 14 0v7a1.78 1.78 0 0 1 -3.1 1.4a1.65 1.65 0 0 0 -2.6 0a1.65 1.65 0 0 1 -2.6 0a1.65 1.65 0 0 0 -2.6 0a1.78 1.78 0 0 1 -3.1 -1.4v-7" /><path d="M10 10l.01 0" /><path d="M14 10l.01 0" /><path d="M10 14a3.5 3.5 0 0 0 4 0" /></svg>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12 col-lg-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Most Visited Pages</h3>
          </div>
          <div class="card-table table-responsive">
            <table id="yourFirstTableID" class="table table-vcenter">
              <thead>
                <tr>
                  <th>Office</th>
                  <th>Country</th>
                  <th>Region</th>
                </tr>
              </thead>
              @foreach($perwakilanData as $data)
              <tr>
                <td class="text-secondary"><a href="{{ route('countryprofile', ['countryCode' => $data['CountryCode']]) }}">{{ $data['Office'] }}</a></td>
                <td class="text-secondary"><a href="{{ route('countryprofile', ['countryCode' => $data['CountryCode']]) }}">{{ $data['Country'] }}</a></td>
                <td class="text-secondary">{{ $data['Region'] }}</td>
              </tr>
              @endforeach
            </table>
          </div>
        </div>
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
                              @foreach ($geoChartData as $countryCode => $gdp)
                                  @php
                                      $countryName = \App\Models\CountryMaster::where('CountryCode', $countryCode)->value('Country');
                                      $countryLowerCase = \App\Models\CountryMaster::where('CountryCode', $countryCode)->value('CCLower');
                                      $perwakilans = \App\Models\PerwakilanMaster::where('CountryCode', $countryCode)->value('Office');
                                  @endphp
                                  <tr>
                                      <td><span class="flag flag-country-{{ $countryLowerCase }}"></span></td>
                                      <td class="text-wrap"><a href="{{ route('countryprofile', ['countryCode' => $data['CountryCode']]) }}">{{ $countryName }}</a></td>
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
</div>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    // Check if the cookie 'visited' is set
    if (document.cookie.indexOf('visited=') === -1) {
      // If not set, show the modal
      $('#modal-scrollable').modal('show');

      // Set the cookie to expire in 30 minutes
      var now = new Date();
      now.setTime(now.getTime() + 15 * 60 * 1000); 
      document.cookie = 'visited=true; expires=' + now.toUTCString() + '; path=/';
    }
  });
</script>


<script>
  $(document).ready(function() {
      $('#yourFirstTableID').DataTable({
            "paging": true,
            "searching": true,
            "info": true,
            "lengthChange": true,
            "pageLength": 8,
            "lengthMenu": [10, 25, 50, 100]
        });
  });
</script>

<script>
  const countryProfileRoute = "{{ route('countryprofile', ['countryCode' => ':code']) }}";
</script>

<script>
  $(document).ready(function() {
        $('#dataTable').DataTable({
            "paging": true,
            "searching": true,
            "info": true,
            "lengthChange": true,
            "pageLength": 8,
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
              values: {!! json_encode($geoChartData) !!}, // Echo the PHP data as JSON directly
          },
          onRegionTipShow: function(event, code, region) {
              const value = map.params.visualizeData.values[code];
              event.html = region + ': ' + value; 
          },
          onRegionClick: function(event, code, region) {
            // Redirect to the country profile page with the clicked region's CountryCode
            window.location.href = countryProfileRoute.replace(':code', code);
            },
      });
      window.addEventListener("resize", () => {
          map.updateSize();
      });
  });
</script>

<script>
  document.addEventListener("DOMContentLoaded", function() {
      const tradeChartDataSeries = @json($series);  // Fetching series data from the controller.
      const tradeChartLabels = @json($labels);     // Fetching labels from the controller.
  
      window.ApexCharts && (new ApexCharts(document.getElementById('index-trade-chart'), {
          chart: {
              type: "bar",
              fontFamily: 'inherit',
              height: 240,
              parentHeightOffset: 0,
              toolbar: {
                  show: false,
              },
              animations: {
                  enabled: false
              },
              stacked: true,
          },
          plotOptions: {
              bar: {
                  columnWidth: '50%',
              }
          },
          dataLabels: {
              enabled: false,
          },
          fill: {
              opacity: 1,
          },
          series: tradeChartDataSeries,
          tooltip: {
              theme: 'dark'
          },
          grid: {
              padding: {
                  top: -20,
                  right: 0,
                  left: -4,
                  bottom: -4
              },
              strokeDashArray: 4,
              xaxis: {
                  lines: {
                      show: true
                  }
              },
          },
          xaxis: {
              labels: {
                  padding: 0,
              },
              tooltip: {
                  enabled: false
              },
              axisBorder: {
                  show: false,
              },
              categories: tradeChartLabels
          },
          yaxis: {
              labels: {
                  padding: 4
              },
          },
          colors: [tabler.getColor("primary"), tabler.getColor("primary", 0.8), tabler.getColor("green", 0.8)],
          legend: {
              show: false,
          },
      })).render();
  });
  </script>
  
  

@endsection