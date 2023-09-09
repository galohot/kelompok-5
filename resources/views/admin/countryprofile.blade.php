@extends('admin.admin_dashboard')
@section('admin')


<div class="container">
    <div class="col">
      <div class="input-group mb-3">
        <div class="input-group-prepend">
          <label class="input-group-text" for="countryDropdown">Select Country</label>
        </div>
        <select class="custom-select form-control-sm col-sm-10" id="countryDropdown"> @foreach ($countries as $country) <option value="{{ $country->CountryCode }}" {{ $countryCode == $country->CountryCode ? 'selected' : '' }}>
            {{ $country->Country }}
          </option> @endforeach </select>
      </div>
    </div> @php $countryLowerCase = \App\Models\CountryMaster::where('CountryCode', $countryCode)->value('CCLower'); @endphp <div class="text-center">
      <span class="flag flag-country-{{ $countryLowerCase }} display-4 mb-4" style="font-size: 3rem;"></span>
      <h1>{{ $countryName ?? 'Country Profile' }}</h1>
    </div>
    <div class="col-12">
      <div class="row row-cards"> @foreach($perwakilanData as $data) <div class="col-sm-6 col-lg-3">
          <div class="card card-sm mb-2">
            <div class="card-body">
              <div class="row align-items-center">
                <div class="col-auto">
                  <span class="flag flag-country-id display-4 mb-4" style="font-size: 3rem;"></span>
                </div>
                <div class="col">
                  <div class="font-weight-medium">
                    {{ $data->Office }}
                  </div>
                  <div class="text-secondary">
                    {{ $data->Region }}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div> @endforeach </div>
    </div>
    <div class="row">
      <div class="col-md-6 col-lg-6 mx-auto">
        <div class="card mb-4">
          <div class="card-body">
            <h5 class="card-title">GDP Constant Prices</h5>
            <div id="chart-gdp-constant"></div>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-lg-6 mx-auto">
        <div class="card mb-4">
          <div class="card-body">
            <h5 class="card-title">GDP Per Capita</h5>
            <div id="chart-gdp-per-capita"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card mb-4">
          <div class="card-body">
            <h5 class="card-title">Comparison Between Current Price and Constant/Real 2010 Price</h5>
            <div id="chart-gdp-comparison"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="card mb-4">
          <div class="card-body">
            <h5 class="card-title">Crime Data</h5>
            <div id="chart-combination-crime"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs nav-fill" id="myTabs" role="tablist">
              <li class="nav-item" role="presentation">
                <a class="nav-link active" id="education-tab" data-bs-toggle="tab" href="#education" role="tab" aria-controls="education" aria-selected="true">Education Expenditure</a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link" id="enrollment-tab" data-bs-toggle="tab" href="#enrollment" role="tab" aria-controls="enrollment" aria-selected="false">Student Enrollment</a>
              </li>
              <li class="nav-item" role="presentation">
                <a class="nav-link" id="staff-tab" data-bs-toggle="tab" href="#staff" role="tab" aria-controls="staff" aria-selected="false">Teaching Staff Data</a>
              </li>
            </ul>
          </div>
          <div class="card-body">
            <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="education" role="tabpanel" aria-labelledby="education-tab">
                <h5 class="card-title">Education Expenditure</h5>
                <div id="chart-combination"></div>
              </div>
              <div class="tab-pane fade" id="enrollment" role="tabpanel" aria-labelledby="enrollment-tab">
                <h5 class="card-title">Student Enrollment</h5>
                <div id="chart-combination-enrollment"></div>
              </div>
              <div class="tab-pane fade" id="staff" role="tabpanel" aria-labelledby="staff-tab">
                <h5 class="card-title">Teaching Staff Data</h5>
                <div id="chart-combination-staff"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="container my-4">
    <!-- GDP Data -->
    <div class="card mb-4">
      <div class="card-header">
        <h2>GDP Data</h2>
      </div>
      <div class="card-body"> @if($gdpData->isEmpty()) <p>No GDP data available for this country.</p> @else <table id="gdpDataTable" class="table table-hover">
          <thead>
            <tr>
              <th>Year</th>
              <th>Series</th>
              <th>Value</th>
            </tr>
          </thead>
          <tbody> @foreach($gdpData as $data) <tr>
              <td>{{ $data->Year }}</td>
              <td>{{ $data->Series }}</td>
              <td>{{ number_format($data->Value) }}</td>
            </tr> @endforeach </tbody>
        </table> @endif </div>
    </div>
    <!-- Education Public Expenditure -->
    <div class="card mb-4">
      <div class="card-header">
        <h2>Education Public Expenditure</h2>
      </div>
      <div class="card-body"> @if($educationData->isEmpty()) <p>No Education Public Expenditure data available for this country.</p> @else <table id="educationDataTable" class="table table-hover">
          <thead>
            <tr>
              <th>Year</th>
              <th>Series</th>
              <th>Value</th>
            </tr>
          </thead>
          <tbody> @foreach($educationData as $data) <tr>
              <td>{{ $data->Year }}</td>
              <td>{{ $data->Series }}</td>
              <td>{{ number_format($data->Value) }}</td>
            </tr> @endforeach </tbody>
        </table> @endif </div>
    </div>
    <!-- Student Enrollment -->
    <div class="card mb-4">
      <div class="card-header">
        <h2>Student Enrollment</h2>
      </div>
      <div class="card-body"> @if($enrollmentData->isEmpty()) <p>No Student Enrollment data available for this country.</p> @else <table id="enrollmentDataTable" class="table table-hover">
          <thead>
            <tr>
              <th>Year</th>
              <th>Series</th>
              <th>Value</th>
            </tr>
          </thead>
          <tbody> @foreach($enrollmentData as $data) <tr>
              <td>{{ $data->Year }}</td>
              <td>{{ $data->Series }}</td>
              <td>{{ number_format($data->Value) }}</td>
            </tr> @endforeach </tbody>
        </table> @endif </div>
    </div>
    <!-- Teaching Staff -->
    <div class="card mb-4">
      <div class="card-header">
        <h2>Teaching Staff</h2>
      </div>
      <div class="card-body"> @if($staffData->isEmpty()) <p>No Teaching Staff data available for this country.</p> @else <table id="staffDataTable" class="table table-hover">
          <thead>
            <tr>
              <th>Year</th>
              <th>Series</th>
              <th>Value</th>
            </tr>
          </thead>
          <tbody> @foreach($staffData as $data) <tr>
              <td>{{ $data->Year }}</td>
              <td>{{ $data->Series }}</td>
              <td>{{ number_format($data->Value) }}</td>
            </tr> @endforeach </tbody>
        </table> @endif </div>
    </div>
    <!-- Crime Data -->
    <div class="card mb-4">
      <div class="card-header">
        <h2>Crime Data</h2>
      </div>
      <div class="card-body"> @if($crimeData->isEmpty()) <p>No Crime data available for this country.</p> @else <table id="crimeDataTable" class="table table-hover">
          <thead>
            <tr>
              <th>Year</th>
              <th>Series</th>
              <th>Value</th>
            </tr>
          </thead>
          <tbody> @foreach($crimeData as $data) <tr>
              <td>{{ $data->Year }}</td>
              <td>{{ $data->Series }}</td>
              <td>{{ number_format((float)$data->Value) }}</td>
            </tr> @endforeach </tbody>
        </table> @endif </div>
    </div>
  </div>
  
  <script>
  $(document).ready(function () {
      $('#gdpDataTable').DataTable();
      $('#educationDataTable').DataTable();
      $('#enrollmentDataTable').DataTable();
      $('#staffDataTable').DataTable();
      $('#crimeDataTable').DataTable();
  });
  </script>
{{-- global download --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/PapaParse/5.3.0/papaparse.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Add a click event listener to the download button
        document.getElementById("download-csv").addEventListener("click", function () {
            // Initialize an empty CSV string
            let csvData = '';

            // Helper function to gather data from a table and append it to the CSV string
            function gatherTableData(tableSelector, headerSelector) {
                const table = document.querySelector(tableSelector);
                if (table) {
                    const headers = Array.from(table.querySelectorAll(headerSelector)).map(header => header.textContent.trim());
                    const rows = Array.from(table.querySelectorAll("tbody tr")).map(row => {
                        return Array.from(row.querySelectorAll("td")).map(cell => cell.textContent.trim());
                    });

                    csvData += Papa.unparse({
                        fields: headers,
                        data: rows
                    });

                    // Debugging: Log the extracted data
                    console.log(`Extracted data from ${tableSelector}:`);
                    console.log(headers);
                    console.log(rows);
                }
            }

            // Gather data from all tables
            gatherTableData("#gdp-data-table", "thead th");
            gatherTableData("#education-data-table", "thead th");
            gatherTableData("#enrollment-data-table", "thead th");
            gatherTableData("#staff-data-table", "thead th");
            gatherTableData("#crime-data-table", "thead th");

            // Debugging: Log the final CSV data
            console.log("Final CSV Data:");
            console.log(csvData);

            // Create a Blob containing the CSV data
            let blob = new Blob([csvData], { type: "text/csv;charset=utf-8;" });

            // Create a link element and trigger a download
            let link = document.createElement("a");
            link.href = window.URL.createObjectURL(blob);
            link.download = "country_data.csv";
            link.style.display = "none";
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        });
    });
</script>



{{-- non dynamic template --}}

{{-- template --}}
{{-- GDP constant --}}
<script>
    // Convert Laravel data to JavaScript variables for GDP data (Constant Prices)
    let gdpDataConstant = @json(array_merge($gdpConstantPricesData));
    let series_gdpConstant = [];

    // Organize data by series and year for gdpData (Constant Prices)
    let seriesData_gdpConstant = {};
    gdpDataConstant.forEach(data => {
        if (!seriesData_gdpConstant[data.Series]) {
            seriesData_gdpConstant[data.Series] = {};
        }
        seriesData_gdpConstant[data.Series][data.Year] = data.Value;
    });

    // Extract the unique years for the x-axis categories and sort them in ascending order for gdpData (Constant Prices)
    let years_gdpConstant = Array.from(new Set(gdpDataConstant.map(data => data.Year))).sort((a, b) => a - b);

    // Populate the series array with data or empty values for gdpData (Constant Prices)
    Object.keys(seriesData_gdpConstant).forEach(seriesName => {
        let seriesValues_gdpConstant = [];
        years_gdpConstant.forEach(year => {
            seriesValues_gdpConstant.push(seriesData_gdpConstant[seriesName][year] || null);
        });
        series_gdpConstant.push({
            name: seriesName,
            data: seriesValues_gdpConstant
        });
    });

    // Initialize the ApexCharts for gdpData (Constant Prices)
    document.addEventListener("DOMContentLoaded", function () {
        new ApexCharts(document.getElementById('chart-gdp-constant'), {
            chart: {
                type: "line",
                fontFamily: 'inherit',
                height: 240,
                parentHeightOffset: 0,
                toolbar: {
                    show: false,
                },
                animations: {
                    enabled: false
                },
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
            series: series_gdpConstant,
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
                categories: years_gdpConstant,
            },
            yaxis: {
                labels: {
                    padding: 4,
                    formatter: (val) => {
                        return Number(val).toLocaleString(); // this will format numbers with thousands separators
                    }
                },
            },
            colors: ["#3BB4E9","#FF6B6B"],
            legend: {
                show: false,
            },
        }).render();
    });

</script>
{{-- GDP Per Capita --}}
<script>
    // Convert Laravel data to JavaScript variables for GDP per capita data
    let gdpDataPerCapita = @json(array_merge($gdpPerCapitaData));
    let series_gdpPerCapita = [];

    // Organize data by series and year for GDP per capita data
    let seriesData_gdpPerCapita = {};
    gdpDataPerCapita.forEach(data => {
        if (!seriesData_gdpPerCapita[data.Series]) {
            seriesData_gdpPerCapita[data.Series] = {};
        }
        seriesData_gdpPerCapita[data.Series][data.Year] = data.Value;
    });

    // Extract the unique years for the x-axis categories and sort them in ascending order for GDP per capita data
    let years_gdpPerCapita = Array.from(new Set(gdpDataPerCapita.map(data => data.Year))).sort((a, b) => a - b);

    // Populate the series array with data or empty values for GDP per capita data
    Object.keys(seriesData_gdpPerCapita).forEach(seriesName => {
        let seriesValues_gdpPerCapita = [];
        years_gdpPerCapita.forEach(year => {
            seriesValues_gdpPerCapita.push(seriesData_gdpPerCapita[seriesName][year] || null);
        });
        series_gdpPerCapita.push({
            name: seriesName,
            data: seriesValues_gdpPerCapita
        });
    });

    // Initialize the ApexCharts for GDP per capita data
    document.addEventListener("DOMContentLoaded", function () {
        new ApexCharts(document.getElementById('chart-gdp-per-capita'), {
            chart: {
                type: "line",
                fontFamily: 'inherit',
                height: 240,
                parentHeightOffset: 0,
                toolbar: {
                    show: false,
                },
                animations: {
                    enabled: false
                },
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
            series: series_gdpPerCapita,
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
                categories: years_gdpPerCapita,
            },
            yaxis: {
                labels: {
                    padding: 4,
                    formatter: (val) => {
                        return Number(val).toLocaleString(); // this will format numbers with thousands separators
                    }
                },
            },
            colors: ["#FF6B6B"],
            legend: {
                show: false,
            },
        }).render();
    });

</script>


{{-- GDP Comparispm --}}
<script>
    // Convert Laravel data to JavaScript variables for GDP data (Comparison)
    let gdpDataComparison = @json(array_merge($gdpCurrentPricesData, $gdpConstantPricesData));
    let series_gdpComparison = [];

    // Organize data by series and year for gdpData (Comparison)
    let seriesData_gdpComparison = {};
    gdpDataComparison.forEach(data => {
        if (!seriesData_gdpComparison[data.Series]) {
            seriesData_gdpComparison[data.Series] = {};
        }
        seriesData_gdpComparison[data.Series][data.Year] = data.Value;
    });

    // Extract the unique years for the x-axis categories and sort them in ascending order for gdpData (Comparison)
    let years_gdpComparison = Array.from(new Set(gdpDataComparison.map(data => data.Year))).sort((a, b) => a - b);

    // Populate the series array with data or empty values for gdpData (Comparison)
    Object.keys(seriesData_gdpComparison).forEach(seriesName => {
        let seriesValues_gdpComparison = [];
        years_gdpComparison.forEach(year => {
            seriesValues_gdpComparison.push(seriesData_gdpComparison[seriesName][year] || null);
        });
        series_gdpComparison.push({
            name: seriesName,
            data: seriesValues_gdpComparison
        });
    });

    // Initialize the ApexCharts for gdpData (Comparison)
    document.addEventListener("DOMContentLoaded", function () {
        new ApexCharts(document.getElementById('chart-gdp-comparison'), {
            chart: {
                type: "area",
                fontFamily: 'inherit',
                height: 240,
                parentHeightOffset: 0,
                toolbar: {
                    show: false,
                },
                animations: {
                    enabled: false
                },
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
            series: series_gdpComparison,
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
                categories: years_gdpComparison,
            },
            yaxis: {
                labels: {
                    padding: 4,
                    formatter: (val) => {
                        return Number(val).toLocaleString(); // this will format numbers with thousands separators
                    }
                },
            },
            colors: ["#3BB4E9","#FF6B6B"],
            legend: {
                show: true,
            },
        }).render();
    });

</script>
{{-- Edu Expenditure --}}
<script>
    // Convert Laravel data to JavaScript variable
    let educationData = @json($educationData);
    let series = [];

    // Organize data by series and year
    let seriesData = {};
    educationData.forEach(data => {
        if (!seriesData[data.Series]) {
            seriesData[data.Series] = {};
        }
        seriesData[data.Series][data.Year] = data.Value;
    });

    // Extract the unique years for the x-axis categories and sort them in descending order
    let years = Array.from(new Set(educationData.map(data => data.Year))).sort((a, b) => a - b);

    // Populate the series array with data or empty values
    Object.keys(seriesData).forEach(seriesName => {
        let seriesValues = [];
        years.forEach(year => {
            seriesValues.push(seriesData[seriesName][year] || null);
        });
        series.push({
            name: seriesName,
            data: seriesValues
        });
    });

    // Initialize the ApexCharts
    document.addEventListener("DOMContentLoaded", function () {
        new ApexCharts(document.getElementById('chart-combination'), {
            chart: {
                type: "bar",
                fontFamily: 'inherit',
                height: 400,
                parentHeightOffset: 0,
                toolbar: {
                    show: false,
                },
                animations: {
                    enabled: false
                },
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
            series: series,
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
                categories: years,
            },
            yaxis: {
                labels: {
                    padding: 4,
                    formatter: (val) => {
                        return Number(val).toLocaleString(); // this will format numbers with thousands separators
                    }
                },
            },

            colors: ["#FF6B6B", "#FFD166", "#06D6A0", "#118AB2", "#073B4C", "#F4A261", "#2A9D8F", "#E76F51", "#ADEFD1", "#FAD02E"],
            legend: {
                show: true,
                
            },
        }).render();
    });
</script>
{{-- Edu Enrollment --}}
<script>
    // Convert Laravel data to JavaScript variable for enrollmentData
    let enrollmentData = @json($enrollmentData);
    let series_enrollment = [];

    // Organize data by series and year for enrollmentData
    let seriesData_enrollment = {};
    enrollmentData.forEach(data => {
        if (!seriesData_enrollment[data.Series]) {
            seriesData_enrollment[data.Series] = {};
        }
        seriesData_enrollment[data.Series][data.Year] = data.Value;
    });

    // Extract the unique years for the x-axis categories and sort them in descending order for enrollmentData
    let years_enrollment = Array.from(new Set(enrollmentData.map(data => data.Year))).sort((a, b) => a - b);

    // Populate the series array with data or empty values for enrollmentData
    Object.keys(seriesData_enrollment).forEach(seriesName => {
        let seriesValues_enrollment = [];
        years_enrollment.forEach(year => {
            seriesValues_enrollment.push(seriesData_enrollment[seriesName][year] || null);
        });
        series_enrollment.push({
            name: seriesName,
            data: seriesValues_enrollment
        });
    });

    // Initialize the ApexCharts for enrollmentData
    document.addEventListener("DOMContentLoaded", function () {
        new ApexCharts(document.getElementById('chart-combination-enrollment'), {
            chart: {
                type: "bar",
                fontFamily: 'inherit',
                height: 400,
                parentHeightOffset: 0,
                toolbar: {
                    show: false,
                },
                animations: {
                    enabled: false
                },
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
            series: series_enrollment,
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
                categories: years_enrollment,
            },
            yaxis: {
                labels: {
                    padding: 4,
                    formatter: (val) => {
                        return Number(val).toLocaleString(); // this will format numbers with thousands separators
                    }
                },
            },

            colors: ["#FF6B6B", "#FFD166", "#06D6A0", "#118AB2", "#073B4C", "#F4A261", "#2A9D8F", "#E76F51", "#ADEFD1", "#FAD02E"],
            legend: {
                show: true,
            },
        }).render();
    });
</script>
{{-- edu staff data --}}
<script>
    // Convert Laravel data to JavaScript variable for staffData
    let staffData = @json($staffData);
    let series_staff = [];

    // Organize data by series and year for staffData
    let seriesData_staff = {};
    staffData.forEach(data => {
        if (!seriesData_staff[data.Series]) {
            seriesData_staff[data.Series] = {};
        }
        seriesData_staff[data.Series][data.Year] = data.Value;
    });

    // Extract the unique years for the x-axis categories and sort them in descending order for staffData
    let years_staff = Array.from(new Set(staffData.map(data => data.Year))).sort((a, b) => a - b);

    // Populate the series array with data or empty values for staffData
    Object.keys(seriesData_staff).forEach(seriesName => {
        let seriesValues_staff = [];
        years_staff.forEach(year => {
            seriesValues_staff.push(seriesData_staff[seriesName][year] || null);
        });
        series_staff.push({
            name: seriesName,
            data: seriesValues_staff
        });
    });

    // Initialize the ApexCharts for staffData
    document.addEventListener("DOMContentLoaded", function () {
        new ApexCharts(document.getElementById('chart-combination-staff'), {
            chart: {
                type: "bar",
                fontFamily: 'inherit',
                height: 500,
                parentHeightOffset: 0,
                toolbar: {
                    show: false,
                },
                animations: {
                    enabled: false
                },
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
            series: series_staff,
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
                categories: years_staff,
            },
            yaxis: {
                labels: {
                    padding: 4,
                    formatter: (val) => {
                        return Number(val).toLocaleString(); // this will format numbers with thousands separators
                    }
                },
            },

            colors: ["#FF6B6B", "#FFD166", "#06D6A0", "#118AB2", "#073B4C", "#F4A261", "#2A9D8F", "#E76F51", "#ADEFD1", "#FAD02E"],
            legend: {
                show: true,
            },
        }).render();
    });
</script>

{{-- crime --}}
<script>
    // Convert Laravel data to JavaScript variable
    let crimeData = @json($crimeData);
    let crimeSeries = [];

    // Organize data by series and year for crime data
    let crimeSeriesData = {};
    crimeData.forEach(data => {
        if (!crimeSeriesData[data.Series]) {
            crimeSeriesData[data.Series] = {};
        }
        crimeSeriesData[data.Series][data.Year] = data.Value;
    });

    // Extract the unique years for the x-axis categories and sort them in descending order for crime data
    let crimeYears = Array.from(new Set(crimeData.map(data => data.Year))).sort((a, b) => a - b);

    // Populate the crimeSeries array with data or empty values
    Object.keys(crimeSeriesData).forEach(seriesName => {
        let seriesValues = [];
        crimeYears.forEach(year => {
            seriesValues.push(crimeSeriesData[seriesName][year] || null);
        });
        crimeSeries.push({
            name: seriesName,
            data: seriesValues
        });
    });

    // Initialize the ApexCharts for crime data
    document.addEventListener("DOMContentLoaded", function () {
        new ApexCharts(document.getElementById('chart-combination-crime'), {
            chart: {
                type: "bar",
                fontFamily: 'inherit',
                height: 400,
                parentHeightOffset: 0,
                toolbar: {
                    show: false,
                },
                animations: {
                    enabled: false
                },
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
            series: crimeSeries,
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
                categories: crimeYears,
            },
            yaxis: {
                labels: {
                    padding: 4,
                    formatter: (val) => {
                        return Number(val).toLocaleString(); // this will format numbers with thousands separators
                    }
                },
            },

            colors: ["#FF6B6B", "#FFD166", "#06D6A0", "#118AB2", "#073B4C", "#F4A261", "#2A9D8F", "#E76F51", "#ADEFD1", "#FAD02E"],
            legend: {
                show: true,
            },
        }).render();
    });
</script>


{{-- dropdown --}}
<script>
    const countryDropdown = document.getElementById('countryDropdown');
    countryDropdown.addEventListener('change', function () {
        const selectedCountryCode = this.value;
        window.location.href = `/admin/countryprofile/${selectedCountryCode}`;
    });
</script>


@endsection