@extends('admin.admin_dashboard')
@section('admin')

<h1>{{ $countryName ?? 'Country Profile' }}</h1>


<div class="col-lg-12 col-xl-12">
    <div class="card">
      <div class="card-body">
        <div id="chart-combination"></div>
      </div>
    </div>
</div>
<div id="chart-social-referrals"></div>
@if($gdpData->isEmpty())
    <p>No GDP data available for this country.</p>
@else
    <h2>GDP Data</h2>
    @foreach($gdpData as $data)
        <p>Year: {{ $data->Year }} | Series: {{ $data->Series }} | Value: {{ $data->Value }}</p>
    @endforeach
@endif

@if($educationData->isEmpty())
    <p>No Education Public Expenditure data available for this country.</p>
@else
    <h2>Education Public Expenditure</h2>
    @foreach($educationData as $data)
        <p>Year: {{ $data->Year }} | Series: {{ $data->Series }} | Value: {{ $data->Value }}</p>
    @endforeach
@endif

@if($enrollmentData->isEmpty())
    <p>No Student Enrollment data available for this country.</p>
@else
    <h2>Student Enrollment</h2>
    @foreach($enrollmentData as $data)
        <p>Year: {{ $data->Year }} | Series: {{ $data->Series }} | Value: {{ $data->Value }}</p>
    @endforeach
@endif

@if($staffData->isEmpty())
    <p>No Teaching Staff data available for this country.</p>
@else
    <h2>Teaching Staff</h2>
    @foreach($staffData as $data)
        <p>Year: {{ $data->Year }} | Series: {{ $data->Series }} | Value: {{ $data->Value }}</p>
    @endforeach
@endif

@if($crimeData->isEmpty())
    <p>No Crime data available for this country.</p>
@else
    <h2>Crime Data</h2>
    @foreach($crimeData as $data)
        <p>Year: {{ $data->Year }} | Series: {{ $data->Series }} | Value: {{ $data->Value }}</p>
    @endforeach
@endif

<script>
    // Convert Laravel data to JavaScript variable
    let educationData = @json($educationData);
    let series = [];

    // Populate the series array with your database data
    educationData.forEach(data => {
        let existingSeries = series.find(s => s.name === data.Series);
        if (existingSeries) {
            existingSeries.data.push(data.Value);
        } else {
            series.push({
                name: data.Series,
                data: [data.Value]
            });
        }
    });

    // Extract the unique years for the x-axis categories
    let years = Array.from(new Set(educationData.map(data => data.Year)));

    // Initialize the ApexCharts
    document.addEventListener("DOMContentLoaded", function () {
        new ApexCharts(document.getElementById('chart-combination'), {
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
                    padding: 4
                },
            },
            colors: [tabler.getColor("green"), tabler.getColor("pink"), tabler.getColor("green"), tabler.getColor("primary")],
            legend: {
                show: false,
            },
        }).
        
        render();
    });
</script>

<script>
    // Convert Laravel data to JavaScript variable
    let educationData = @json($educationData);
    let series = [];

    // Populate the series array with your database data
    educationData.forEach(data => {
        let existingSeries = series.find(s => s.name === data.Series);
        if (existingSeries) {
            existingSeries.data.push(data.Value);
        } else {
            series.push({
                name: data.Series,
                data: [data.Value]
            });
        }
    });

    // @formatter:off
    document.addEventListener("DOMContentLoaded", function () {
        window.ApexCharts && (new ApexCharts(document.getElementById('chart-social-referrals'), {
            chart: {
                type: "line",
                fontFamily: 'inherit',
                height: 288,
                parentHeightOffset: 0,
                toolbar: {
                    show: false,
                },
                animations: {
                    enabled: false
                },
            },
            fill: {
                opacity: 1,
            },
            stroke: {
                width: 2,
                lineCap: "round",
                curve: "smooth",
            },
            series: series, // Use the dynamically generated series data
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
                type: 'datetime',
            },
            yaxis: {
                labels: {
                    padding: 4
                },
            },
            labels: educationData.map(data => data.Year), // Use the same years from the first script
            colors: [tabler.getColor("facebook"), tabler.getColor("twitter"), tabler.getColor("dribbble")],
            legend: {
                show: true,
                position: 'bottom',
                offsetY: 12,
                markers: {
                    width: 10,
                    height: 10,
                    radius: 100,
                },
                itemMargin: {
                    horizontal: 8,
                    vertical: 8
                },
            },
        })).render();
    });
    // @formatter:on
</script>





@endsection