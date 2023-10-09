@extends('dashboard')
@section('content')
  
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
            <div style="position: relative; width: 100%; height: 0; padding-bottom: 112.5%;">
                <iframe width="600" height="675" src="https://lookerstudio.google.com/embed/reporting/8589f43b-9be6-43a0-98c0-184d1792d878/page/dsveD" frameborder="0" style="position: absolute; width: 100%; height: 100%;" allowfullscreen></iframe>
            </div>
            </div>
            <div class="tab-pane fade" id="enrollment" role="tabpanel" aria-labelledby="enrollment-tab">
              <h5 class="card-title">Student Enrollment</h5>
            <div style="position: relative; width: 100%; height: 0; padding-bottom: 112.5%;">
                <iframe width="600" height="675" src="https://lookerstudio.google.com/embed/reporting/9900fe02-0ebf-4796-8c84-6a56239234a5/page/dsveD" frameborder="0" style="position: absolute; width: 100%; height: 100%;" allowfullscreen></iframe>
            </div>
            </div>
            <div class="tab-pane fade" id="staff" role="tabpanel" aria-labelledby="staff-tab">
              <h5 class="card-title">Teaching Staff Data</h5>
            <div style="position: relative; width: 100%; height: 0; padding-bottom: 112.5%;">
                <iframe width="600" height="675" src="https://lookerstudio.google.com/embed/reporting/77e2af8f-70eb-4fa2-a379-a4ff2c7efbf3/page/dsveD" frameborder="0" style="position: absolute; width: 100%; height: 100%;" allowfullscreen></iframe>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

@endsection