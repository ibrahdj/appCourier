        </div>
        <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<footer class="main-footer text-center">
    <!-- <div class="float-right d-none d-sm-block">
      <b>Version</b> 0.0.0
    </div> -->
    <strong>Copyright &copy; 2023-2024 <a href="#">Certification</a>.</strong> Tous droits réservés.
</footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E=" crossorigin="anonymous"></script>
<!-- <script src="<?= base_url('assets/templates') ?>/plugins/jquery/jquery.min.js"></script> -->
<!-- Bootstrap 4 -->
<script src="<?= base_url('assets/templates') ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="<?= base_url('assets/templates') ?>/plugins/select2/js/select2.full.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="<?= base_url('assets/templates') ?>/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/templates') ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/templates') ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url('assets/templates') ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/templates') ?>/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url('assets/templates') ?>/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/templates') ?>/plugins/jszip/jszip.min.js"></script>
<script src="<?= base_url('assets/templates') ?>/plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url('assets/templates') ?>/plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url('assets/templates') ?>/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url('assets/templates') ?>/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url('assets/templates') ?>/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/templates') ?>/dist/js/adminlte.min.js"></script>
<!-- InputMask -->
<script src="<?= base_url('assets/templates') ?>/plugins/moment/moment.min.js"></script>
<script src="<?= base_url('assets/templates') ?>/plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- Page specific script -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.js"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
</script> -->
 <!-- javascript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": true,
      "text": ["Copier"],
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });

    //Initialize Select2 Elements
    $('.select2').select2(
      {
        theme: "bootstrap4",
        width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
        placeholder: $( this ).data( 'placeholder' ),
      }
    )

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()
    
  });

</script>

<script>
  function load_monthwise_data(year)
  {
    $.ajax({
        url:"<?php echo base_url(); ?>DashboardController/fetch_data",
        method:"POST",
        data:{year:year},
        dataType:"JSON",
        success:function(data)
        {
          //alert(data)
          drawMonthwiseChart(data);
        }
    })
    //alert("Je suis ici "+year);
  }
  function drawMonthwiseChart(data_chart)
  {
    var ticksStyle = {
      fontColor: '#495057',
      fontStyle: 'bold'
    }

    var mode = 'index'
    var intersect = true
    var cP = JSON.parse(`<?php echo $dataPas; ?>`)
    var cData = data_chart;

    var arrivers = $('#arriver-chart')
    // eslint-disable-next-line no-unused-vars
    var arriver_Chart = new Chart(arrivers, {
      type: 'bar',
      data: {
        labels: cData.label,
        datasets: [
          {
            backgroundColor: '#007bff',
            borderColor: '#007bff',
            data: cData.data,
          },
          {
            backgroundColor: '#ced4da',
            borderColor: '#ced4da',
            data: cP.data2,
          }
        ]
      },
      options: {
        maintainAspectRatio: false,
        tooltips: {
          mode: mode,
          intersect: intersect
        },
        hover: {
          mode: mode,
          intersect: intersect
        },
        legend: {
          display: false
        },
        scales: {
          yAxes: [{
            // display: false,
            gridLines: {
              display: true,
              lineWidth: '4px',
              color: 'rgba(0, 0, 0, .2)',
              zeroLineColor: 'transparent'
            },
            ticks: $.extend({
              beginAtZero: true,

              // Include a dollar sign in the ticks
              callback: function (value) {
                if (value >= 1000) {
                  value /= 100
                  value += '0 c'
                }

                return value
              }
            }, ticksStyle)
          }],
          xAxes: [{
            display: true,
            gridLines: {
              display: false
            },
            ticks: ticksStyle
          }]
        }
      }
    })
  }
</script>
<script>
  $(document).ready(function(){
    $('#year').change(function(){
        var year = $(this).val();
        if(year != '')
        {
          //alert(year);
          load_monthwise_data(year);
        }
    });
  });
</script>


<script>
  function load_monthwise_data1(year1)
  {
    $.ajax({
        url:"<?php echo base_url(); ?>DashboardController/fetch_data1",
        method:"POST",
        data:{year1:year1},
        dataType:"JSON",
        success:function(data)
        {
          //alert(data);
          drawMonthwiseChart1(data);
        }
    })
    //alert("Je suis ici!"+year1);
  }
  function drawMonthwiseChart1(data_chart)
  {
    var ticksStyle = {
      fontColor: '#495057',
      fontStyle: 'bold'
    }

    var mode = 'index'
    var intersect = true
    var Data = data_chart;
    var cN = JSON.parse(`<?php echo $dat; ?>`);
    var salesCharts = $('#depart-chart')
    // eslint-disable-next-line no-unused-vars
    var salesChart = new Chart(salesCharts, {
      type: 'bar',
      data: {
        labels: Data.label1,
        datasets: [
          {
            backgroundColor: '#007bff',
            borderColor: '#007bff',
            data: Data.data1,
          },
          {
            backgroundColor: '#ced4da',
            borderColor: '#ced4da',
            data: cN.data1,
          }
        ]
      },
      options: {
        maintainAspectRatio: false,
        tooltips: {
          mode: mode,
          intersect: intersect
        },
        hover: {
          mode: mode,
          intersect: intersect
        },
        legend: {
          display: false
        },
        scales: {
          yAxes: [{
            display: false,
            gridLines: {
              display: true,
              lineWidth: '4px',
              color: 'rgba(0, 0, 0, .2)',
              zeroLineColor: 'transparent'
            },
            ticks: $.extend({
              beginAtZero: true,

              // Include a dollar sign in the ticks
              callback: function (value) {
                if (value >= 1000) {
                  value /= 1000
                  value += '0 c'
                }

                return value
              }
            }, ticksStyle)
          }],
          xAxes: [{
            display: true,
            gridLines: {
              display: false
            },
            ticks: ticksStyle
          }]
        }
      }
    })
  }
</script>
<script>
  $(document).ready(function(){
    $('#year1').change(function(){
        var year1 = $(this).val();
        if(year1 != '')
        {
          //alert(year);
          load_monthwise_data1(year1);
        }
    });
  });
</script>


<script>
  $(function () {
    'use strict'

    var ticksStyle = {
      fontColor: '#495057',
      fontStyle: 'bold'
    }

    var mode = 'index'
    var intersect = true
    var cData = JSON.parse(`<?php echo $chartAR; ?>`);
    var cP = JSON.parse(`<?php echo $dataPas; ?>`)
    var arrivers = $('#arriver-chart')
    // eslint-disable-next-line no-unused-vars
    var arriver = new Chart(arrivers, {
      type: 'bar',
      data: {
        labels: cData.label,
        datasets: [
          {
            backgroundColor: '#007bff',
            borderColor: '#007bff',
            data: cData.data,
          },
          {
            backgroundColor: '#ced4da',
            borderColor: '#ced4da',
            data: cP.data2,
          }
        ]
      },
      options: {
        maintainAspectRatio: false,
        tooltips: {
          mode: mode,
          intersect: intersect
        },
        hover: {
          mode: mode,
          intersect: intersect
        },
        legend: {
          display: false
        },
        scales: {
          yAxes: [{
            display: true,
            gridLines: {
              display: true,
              lineWidth: '4px',
              color: 'rgba(0, 0, 0, .2)',
              zeroLineColor: 'transparent'
            },
            ticks: $.extend({
              beginAtZero: true,

              // Include a dollar sign in the ticks
              callback: function (value) {
                if (value >= 1000) {
                  value /= 1000
                  value += '0 c'
                }

                return value
              }
            }, ticksStyle)
          }],
          xAxes: [{
            display: true,
            gridLines: {
              display: false
            },
            ticks: ticksStyle
          }]
        }
      }
    })

    var Datad = JSON.parse(`<?php echo $chartDE; ?>`);
    var cN = JSON.parse(`<?php echo $dat; ?>`);
    var $salesChart = $('#depart-chart')
    // eslint-disable-next-line no-unused-vars
    var salesChart = new Chart($salesChart, {
      type: 'bar',
      data: {
        labels: Datad.label,
        datasets: [
          {
            backgroundColor: '#007bff',
            borderColor: '#007bff',
            data: Datad.data,
          },
          {
            backgroundColor: '#ced4da',
            borderColor: '#ced4da',
            data: cN.data1,
          }
        ]
      },
      options: {
        maintainAspectRatio: false,
        tooltips: {
          mode: mode,
          intersect: intersect
        },
        hover: {
          mode: mode,
          intersect: intersect
        },
        legend: {
          display: false
        },
        scales: {
          yAxes: [{
            // display: false,
            gridLines: {
              display: true,
              lineWidth: '4px',
              color: 'rgba(0, 0, 0, .2)',
              zeroLineColor: 'transparent'
            },
            ticks: $.extend({
              beginAtZero: true,

              // Include a dollar sign in the ticks
              callback: function (value) {
                if (value >= 1000) {
                  value /= 1000
                  value+=' C'
                }

                return value
              }
            }, ticksStyle)
          }],
          xAxes: [{
            display: true,
            gridLines: {
              display: false
            },
            ticks: ticksStyle
          }]
        }
      }
    })
  })
// lgtm [js/unused-local-variable]
</script>
<script>
  $(document).ready( function () {
      $('#datatable1').DataTable();
  } );
</script>
<script>
  function myFunction() {
    var input, filter, cards, cardContainer, span, title, i;
    input = document.getElementById("myFilter");
    filter = input.value.toUpperCase();
    cardContainer = document.getElementById("myItems");
    cards = cardContainer.getElementsByClassName("direct-chat-msg");
    for (i = 0; i < cards.length; i++) {
      title = cards[i].querySelector(".direct-chat-infos span.direct-chat-name");
      if (title.innerText.toUpperCase().indexOf(filter) > -1) {
        cards[i].style.display = "";
      } else {
        cards[i].style.display = "none";
      }
    }
  }

  function myFunction1() {
    var input, filter, cards, cardContainer, span, title, i;
    input = document.getElementById("myFilter1");
    filter = input.value.toUpperCase();
    cardContainer = document.getElementById("myItems1");
    cards = cardContainer.getElementsByClassName("direct-chat-msg");
    for (i = 0; i < cards.length; i++) {
      title = cards[i].querySelector(".direct-chat-infos span.direct-chat-name");
      if (title.innerText.toUpperCase().indexOf(filter) > -1) {
        cards[i].style.display = "";
      } else {
        cards[i].style.display = "none";
      }
    }
  }

  function myFunction2() {
    var input, filter, cards, cardContainer, span, title, i;
    input = document.getElementById("myFilter2");
    filter = input.value.toUpperCase();
    cardContainer = document.getElementById("myItems2");
    cards = cardContainer.getElementsByClassName("direct-chat-msg");
    for (i = 0; i < cards.length; i++) {
      title = cards[i].querySelector(".direct-chat-infos span.direct-chat-name");
      if (title.innerText.toUpperCase().indexOf(filter) > -1) {
        cards[i].style.display = "";
      } else {
        cards[i].style.display = "none";
      }
    }
  }
</script>
</body>
</html>
