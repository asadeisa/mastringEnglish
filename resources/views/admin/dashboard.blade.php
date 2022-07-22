@extends('admin.short-cat')

@section('drop-data')
<style>
  .overfly-scroll-y{
    overflow: auto;
  }
</style>

      <div class="d-flex gap-3 mt-4">
        <div class="col-lg-7">
          <div class="card z-index-2">
            <div class="card-header pb-0">
              <h6>joining student</h6>
              <p class="text-sm">
                <i class="fa fa-arrow-up text-success"></i>
                <span class="font-weight-bold">4% more</span> in 2022
              </p>
            </div>
            <div class="card-body p-3">
              <div class="chart">
                <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
              </div>
            </div>
          </div>
        </div>
        <div class="">
          <div class="card z-index-2">
            <div class="card-header pb-0">
              <h6>Membership Request</h6>
              <p class="text-sm">
                <span class="font-weight-bold">latest Teacher joining </span>
              </p>
            </div>
            <div class="card-body p-3 overfly-scroll-y">
           @forelse ($Teacherjoiningreq as $teacherReq)
           <div class="d-flex gap-4  my-2 mb-3">
            <span class="">
              <img class="avatar avatar-sm me-3" width="75" height="75" src="{{ asset($teacherReq->user->img) }}" alt="no image found ">
            </span>
            <span>
              {{ $teacherReq->user->name }}
            </span>
            <span class="flex-1">
              {{ $teacherReq->user->email }}
            </span>
           <span>
            <form method="post" action="{{ route("teacher-membershep") }}">
              @csrf
              <input type="hidden" name="teacher_id" value="{{ $teacherReq->id }}">
              <button class="btn btn-sm btn-success px-3" type="submit" >accept</button>
            </form>
           </span>
           </div>
               
           @empty
               
           @endforelse
            </div>
          </div>
        </div>
      </div>
    

      <script  src="{{ asset("admin/js/plugins/chartjs.min.js") }}"></script>
      <script>
        
            var ctx2 = document.getElementById("chart-line").getContext("2d");

            var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

            gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
            gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
            gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

            var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

            gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
            gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
            gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors


            new Chart(ctx2, {
              type: "line",
              data: {
                labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                datasets: [{
                    label: "joined user",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#cb0c9f",
                    borderWidth: 3,
                    backgroundColor: gradientStroke1,
                    data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                    maxBarThickness: 6

                  },
                  // {
                  //   label: "joined student",
                  //   tension: 0.4,
                  //   borderWidth: 0,
                  //   pointRadius: 0,
                  //   borderColor: "#3A416F",
                  //   borderWidth: 3,
                  //   backgroundColor: gradientStroke2,
                  //   data: [30, 90, 40, 140, 290, 290, 340, 230, 400],
                  //   maxBarThickness: 6

                  // },
                ],
              },
              options: {
                responsive: true,
                maintainAspectRatio: false,
                legend: {
                  display: false,
                },
                tooltips: {
                  enabled: true,
                  mode: "index",
                  intersect: false,
                },
                scales: {
                  yAxes: [{
                    gridLines: {
                      borderDash: [2],
                      borderDashOffset: [2],
                      color: '#dee2e6',
                      zeroLineColor: '#dee2e6',
                      zeroLineWidth: 1,
                      zeroLineBorderDash: [2],
                      drawBorder: false,
                    },
                    ticks: {
                      suggestedMin: 0,
                      suggestedMax: 500,
                      beginAtZero: true,
                      padding: 10,
                      fontSize: 11,
                      fontColor: '#adb5bd',
                      lineHeight: 3,
                      fontStyle: 'normal',
                      fontFamily: "Open Sans",
                    },
                  }, ],
                  xAxes: [{
                    gridLines: {
                      zeroLineColor: 'rgba(0,0,0,0)',
                      display: false,
                    },
                    ticks: {
                      padding: 10,
                      fontSize: 11,
                      fontColor: '#adb5bd',
                      lineHeight: 3,
                      fontStyle: 'normal',
                      fontFamily: "Open Sans",
                    },
                  }, ],
                },
              },
            });
      </script> 
  @endsection