
<?php $__env->startSection('main-content'); ?>
           <div class="breadcrumb">
                <h1>Dashboard</h1>
                <ul>
                    <li><a href="">Dashboard</a></li>
                    <li>Dashboard</li>
                </ul>
            </div>

            <div class="separator-breadcrumb border-top"></div>

            <div class="row">
                <!-- ICON BG -->
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                        <div class="card-body text-center">
                            <i class="i-Add-User"></i>
                            <div class="content">
                                <p class="text-muted mt-2 mb-0">Total Customers</p>
                                <p class="text-primary text-24 line-height-1 mb-2"><?php echo e($totalLead); ?></p>
                            </div>
                        </div>
                    </div>
                </div>

               <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                        <div class="card-body text-center">
                            <i class="i-Add-User"></i>
                            <div class="content">
                                <p class="text-muted mt-2 mb-0">Today Customers</p>
                                <p class="text-primary text-24 line-height-1 mb-2"><?php echo e($todayLead); ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                        <div class="card-body text-center">
                            <i class="i-Add-User"></i>
                            <div class="content">
                                <p class="text-muted mt-2 mb-0">Prospect Customers</p>
                                <p class="text-primary text-24 line-height-1 mb-2"><?php echo e($prospect); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                        <div class="card-body text-center">
                            <i class="i-Money-2"></i>
                            <div class="content">
                                <p class="text-muted mt-2 mb-0">Trail Customers</p>
                                <p class="text-primary text-24 line-height-1 mb-2"><?php echo e($trail); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                        <div class="card-body text-center">
                            <i class="i-Money-2"></i>
                            <div class="content">
                                <p class="text-muted mt-2 mb-0">Paid Customers</p>
                                <p class="text-primary text-24 line-height-1 mb-2"><?php echo e($paid); ?></p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="card-title">Customer Source</div>
                             <!--<div id="simpleDonut3" style="min-height: 359px;"></div> -->
                             <div class="panel-body" align="center">
                                 <div id="pie_chart_leadsource" style="min-height: 359px;">

                                 </div>
                                </div>
                        </div>
                    </div>
                </div>
                <!--<div class="col-lg-6 col-sm-12">-->
                <!--    <div class="card mb-4">-->
                <!--        <div class="card-body">-->
                <!--            <div class="card-title">Daily Lead Count</div>-->
                             <!--<div id="simpleDonut3" style="min-height: 359px;"></div> -->
                <!--             <div class="panel-body" align="center">-->
                <!--                 <div id="Daily_Lead" style="min-height: 359px;">-->

                <!--                 </div>-->
                <!--                </div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
                 <div class="col-lg-6 col-sm-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="card-title">Daily Customer Count</div>
                             <!--<div id="simpleDonut3" style="min-height: 359px;"></div> -->
                             <div class="panel-body" align="center">
                                 <div id="basicLineC" style="min-height: 359px;">

                                 </div>
                                </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="col-lg-6 col-sm-12">-->
                <!--    <div class="card mb-4">-->
                <!--        <div class="card-body">-->
                <!--            <div class="card-title">Daily Lead Count</div>-->
                             <!--<div id="simpleDonut3" style="min-height: 359px;"></div> -->
                <!--             <div class="panel-body" align="center">-->
                <!--                 <div id="basicLine" style="min-height: 359px;">-->

                <!--                 </div>-->
                <!--                </div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
                <!--<div class="col-lg-8 col-md-12">-->
                <!--    <div class="card mb-4">-->
                <!--        <div class="card-body">-->
                <!--            <div class="card-title">This Year Sales</div>-->
                <!--            <div id="echartBar" style="height: 300px;"></div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
                <!--<div class="col-lg-4 col-sm-12">-->
                <!--    <div class="card mb-4">-->
                <!--        <div class="card-body">-->
                <!--            <div class="card-title">Sales by Countries</div>-->
                <!--            <div id="echartPie" style="height: 300px;"></div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
           
                    <!--<div class="col-md-6">-->
                    <!--    <div class="card mb-4">-->
                    <!--        <div class="card-body">-->
                    <!--            <div class="card-title">Basic Line</div>-->
                    <!--            <div id="basicLine" style="height: 300px;"></div>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-body">
                                <div class="card-title">Customer Stage</div>
                                <div id="Lead_Stage" style="height: 300px;"></div>
                            </div>
                        </div>
                    </div>

                    <!--<div class="col-md-6">-->
                    <!--    <div class="card mb-4">-->
                    <!--        <div class="card-body">-->
                    <!--            <div class="card-title">Stacked Pie Chart</div>-->
                    <!--            <div id="stackedPie" style="height: 300px;"></div>-->
                    <!--        </div>-->
                    <!--    </div>-->
                    <!--</div>-->
                </div>
             
               
                <!-- end of row -->
            <!--<div class="row">-->
            <!--    <div class="col-lg-6 col-md-12">-->

            <!--        <div class="row">-->
            <!--            <div class="col-lg-6 col-md-12">-->
            <!--                <div class="card card-chart-bottom o-hidden mb-4">-->
            <!--                    <div class="card-body">-->
            <!--                        <div class="text-muted">Last Month Sales</div>-->
            <!--                        <p class="mb-4 text-primary text-24">$40250</p>-->
            <!--                    </div>-->
            <!--                    <div id="echart1" style="height: 260px;"></div>-->
            <!--                </div>-->
            <!--            </div>-->

            <!--            <div class="col-lg-6 col-md-12">-->
            <!--                <div class="card card-chart-bottom o-hidden mb-4">-->
            <!--                    <div class="card-body">-->
            <!--                        <div class="text-muted">Last Week Sales</div>-->
            <!--                        <p class="mb-4 text-warning text-24">$10250</p>-->
            <!--                    </div>-->
            <!--                    <div id="echart2" style="height: 260px;"></div>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--        </div>-->

            <!--        <div class="row">-->
            <!--            <div class="col-md-12">-->
            <!--                <div class="card o-hidden mb-4">-->
            <!--                    <div class="card-header d-flex align-items-center border-0">-->
            <!--                        <h3 class="w-50 float-left card-title m-0">New Users</h3>-->
            <!--                        <div class="dropdown dropleft text-right w-50 float-right">-->
            <!--                            <button class="btn bg-gray-100" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
            <!--                                <i class="nav-icon i-Gear-2"></i>-->
            <!--                            </button>-->
            <!--                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">-->
            <!--                                <a class="dropdown-item" href="#">Add new user</a>-->
            <!--                                <a class="dropdown-item" href="#">View All users</a>-->
            <!--                                <a class="dropdown-item" href="#">Something else here</a>-->
            <!--                            </div>-->
            <!--                        </div>-->
            <!--                    </div>-->

            <!--                    <div class="">-->
            <!--                        <div class="table-responsive">-->
            <!--                            <table id="user_table" class="table  text-center">-->
            <!--                                <thead>-->
            <!--                                    <tr>-->
            <!--                                        <th scope="col">#</th>-->
            <!--                                        <th scope="col">Name</th>-->
            <!--                                        <th scope="col">Avatar</th>-->
            <!--                                        <th scope="col">Email</th>-->
            <!--                                        <th scope="col">Status</th>-->
            <!--                                        <th scope="col">Action</th>-->
            <!--                                    </tr>-->
            <!--                                </thead>-->
            <!--                                <tbody>-->
            <!--                                    <tr>-->
            <!--                                        <th scope="row">1</th>-->
            <!--                                        <td>Smith Doe</td>-->
            <!--                                        <td>-->

            <!--                                            <img class="rounded-circle m-0 avatar-sm-table " src="/assets/images/faces/1.jpg" alt="">-->

            <!--                                        </td>-->

            <!--                                        <td>Smith@gmail.com</td>-->
            <!--                                        <td><span class="badge badge-success">Active</span></td>-->
            <!--                                        <td>-->
            <!--                                            <a href="#" class="text-success mr-2">-->
            <!--                                                <i class="nav-icon i-Pen-2 font-weight-bold"></i>-->
            <!--                                            </a>-->
            <!--                                            <a href="#" class="text-danger mr-2">-->
            <!--                                                <i class="nav-icon i-Close-Window font-weight-bold"></i>-->
            <!--                                            </a>-->
            <!--                                        </td>-->
            <!--                                    </tr>-->
            <!--                                    <tr>-->
            <!--                                        <th scope="row">2</th>-->
            <!--                                        <td>Jhon Doe</td>-->
            <!--                                        <td>-->

            <!--                                            <img class="rounded-circle m-0 avatar-sm-table " src="/assets/images/faces/1.jpg" alt="">-->

            <!--                                        </td>-->

            <!--                                        <td>Jhon@gmail.com</td>-->
            <!--                                        <td><span class="badge badge-info">Pending</span></td>-->
            <!--                                        <td>-->
            <!--                                            <a href="#" class="text-success mr-2">-->
            <!--                                                <i class="nav-icon i-Pen-2 font-weight-bold"></i>-->
            <!--                                            </a>-->
            <!--                                            <a href="#" class="text-danger mr-2">-->
            <!--                                                <i class="nav-icon i-Close-Window font-weight-bold"></i>-->
            <!--                                            </a>-->
            <!--                                        </td>-->
            <!--                                    </tr>-->
            <!--                                    <tr>-->
            <!--                                        <th scope="row">3</th>-->
            <!--                                        <td>Alex</td>-->
            <!--                                        <td>-->

            <!--                                            <img class="rounded-circle m-0 avatar-sm-table " src="/assets/images/faces/1.jpg" alt="">-->

            <!--                                        </td>-->

            <!--                                        <td>Otto@gmail.com</td>-->
            <!--                                        <td><span class="badge badge-warning">Not Active</span></td>-->
            <!--                                        <td>-->
            <!--                                            <a href="#" class="text-success mr-2">-->
            <!--                                                <i class="nav-icon i-Pen-2 font-weight-bold"></i>-->
            <!--                                            </a>-->
            <!--                                            <a href="#" class="text-danger mr-2">-->
            <!--                                                <i class="nav-icon i-Close-Window font-weight-bold"></i>-->
            <!--                                            </a>-->
            <!--                                        </td>-->
            <!--                                    </tr>-->

            <!--                                    <tr>-->
            <!--                                        <th scope="row">4</th>-->
            <!--                                        <td>Mathew Doe</td>-->
            <!--                                        <td>-->

            <!--                                            <img class="rounded-circle m-0 avatar-sm-table " src="/assets/images/faces/1.jpg" alt="">-->

            <!--                                        </td>-->

            <!--                                        <td>Mathew@gmail.com</td>-->
            <!--                                        <td><span class="badge badge-success">Active</span></td>-->
            <!--                                        <td>-->
            <!--                                            <a href="#" class="text-success mr-2">-->
            <!--                                                <i class="nav-icon i-Pen-2 font-weight-bold"></i>-->
            <!--                                            </a>-->
            <!--                                            <a href="#" class="text-danger mr-2">-->
            <!--                                                <i class="nav-icon i-Close-Window font-weight-bold"></i>-->
            <!--                                            </a>-->
            <!--                                        </td>-->
            <!--                                    </tr>-->
            <!--                                </tbody>-->
            <!--                            </table>-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!--                </div>-->


            <!--            </div>-->
            <!--        </div>-->

            <!--    </div>-->


            <!--    <div class="col-lg-6 col-md-12">-->

            <!--        <div class="card mb-4">-->
            <!--            <div class="card-body">-->
            <!--                <div class="card-title">Top Selling Products</div>-->
            <!--                <div class="d-flex flex-column flex-sm-row align-items-center mb-3">-->
            <!--                    <img class="avatar-lg mb-3 mb-sm-0 rounded mr-sm-3" src="<?php echo e(asset('assets/images/products/headphone-4.jpg')); ?>" alt="">-->
            <!--                    <div class="flex-grow-1">-->
            <!--                        <h5 class=""><a href="">Wireless Headphone E23</a></h5>-->
            <!--                        <p class="m-0 text-small text-muted">Lorem ipsum dolor sit amet consectetur.</p>-->
            <!--                        <p class="text-small text-danger m-0">$450 <del class="text-muted">$500</del></p>-->
            <!--                    </div>-->
            <!--                    <div>-->
            <!--                        <button class="btn btn-outline-primary btn-rounded btn-sm">View details</button>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--                <div class="d-flex flex-column flex-sm-row align-items-center mb-3">-->
            <!--                    <img class="avatar-lg mb-3 mb-sm-0 rounded mr-sm-3" src="<?php echo e(asset('assets/images/products/headphone-2.jpg')); ?>" alt="">-->
            <!--                    <div class="flex-grow-1">-->
            <!--                        <h5 class=""><a href="">Wireless Headphone Y902</a></h5>-->
            <!--                        <p class="m-0 text-small text-muted">Lorem ipsum dolor sit amet consectetur.</p>-->
            <!--                        <p class="text-small text-danger m-0">$550 <del class="text-muted">$600</del></p>-->
            <!--                    </div>-->
            <!--                    <div>-->
            <!--                        <button class="btn btn-outline-primary btn-sm btn-rounded m-3 m-sm-0">View details</button>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--                <div class="d-flex flex-column flex-sm-row align-items-center mb-3">-->
            <!--                    <img class="avatar-lg mb-3 mb-sm-0 rounded mr-sm-3" src="<?php echo e(asset('assets/images/products/headphone-3.jpg')); ?>" alt="">-->
            <!--                    <div class="flex-grow-1">-->
            <!--                        <h5 class=""><a href="">Wireless Headphone E09</a></h5>-->
            <!--                        <p class="m-0 text-small text-muted">Lorem ipsum dolor sit amet consectetur.</p>-->
            <!--                        <p class="text-small text-danger m-0">$250 <del class="text-muted">$300</del></p>-->
            <!--                    </div>-->
            <!--                    <div>-->
            <!--                        <button class="btn btn-outline-primary btn-sm btn-rounded m-3 m-sm-0">View details</button>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--                <div class="d-flex flex-column flex-sm-row align-items-center mb-3">-->
            <!--                    <img class="avatar-lg mb-3 mb-sm-0 rounded mr-sm-3" src="<?php echo e(asset('assets/images/products/headphone-4.jpg')); ?>" alt="">-->
            <!--                    <div class="flex-grow-1">-->
            <!--                        <h5 class=""><a href="">Wireless Headphone X89</a></h5>-->
            <!--                        <p class="m-0 text-small text-muted">Lorem ipsum dolor sit amet consectetur.</p>-->
            <!--                        <p class="text-small text-danger m-0">$450 <del class="text-muted">$500</del></p>-->
            <!--                    </div>-->
            <!--                    <div>-->
            <!--                        <button class="btn btn-outline-primary btn-sm btn-rounded m-3 m-sm-0">View details</button>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--            </div>-->
            <!--        </div>-->

            <!--        <div class="card mb-4">-->
            <!--            <div class="card-body p-0">-->
            <!--                <div class="card-title border-bottom d-flex align-items-center m-0 p-3">-->
            <!--                    <span>User activity</span>-->
            <!--                    <span class="flex-grow-1"></span>-->
            <!--                    <span class="badge badge-pill badge-warning">Updated daily</span>-->
            <!--                </div>-->
            <!--                <div class="d-flex border-bottom justify-content-between p-3">-->
            <!--                    <div class="flex-grow-1">-->
            <!--                        <span class="text-small text-muted">Pages / Visit</span>-->
            <!--                        <h5 class="m-0">2065</h5>-->
            <!--                    </div>-->
            <!--                    <div class="flex-grow-1">-->
            <!--                        <span class="text-small text-muted">New user</span>-->
            <!--                        <h5 class="m-0">465</h5>-->
            <!--                    </div>-->
            <!--                    <div class="flex-grow-1">-->
            <!--                        <span class="text-small text-muted">Last week</span>-->
            <!--                        <h5 class="m-0">23456</h5>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--                <div class="d-flex border-bottom justify-content-between p-3">-->
            <!--                    <div class="flex-grow-1">-->
            <!--                        <span class="text-small text-muted">Pages / Visit</span>-->
            <!--                        <h5 class="m-0">1829</h5>-->
            <!--                    </div>-->
            <!--                    <div class="flex-grow-1">-->
            <!--                        <span class="text-small text-muted">New user</span>-->
            <!--                        <h5 class="m-0">735</h5>-->
            <!--                    </div>-->
            <!--                    <div class="flex-grow-1">-->
            <!--                        <span class="text-small text-muted">Last week</span>-->
            <!--                        <h5 class="m-0">92565</h5>-->
            <!--                    </div>-->
            <!--                </div>-->
            <!--                <div class="d-flex justify-content-between p-3">-->
            <!--                    <div class="flex-grow-1">-->
            <!--                        <span class="text-small text-muted">Pages / Visit</span>-->
            <!--                        <h5 class="m-0">3165</h5>-->
            <!--                    </div>-->
            <!--                    <div class="flex-grow-1">-->
            <!--                        <span class="text-small text-muted">New user</span>-->
            <!--                        <h5 class="m-0">165</h5>-->
            <!--                    </div>-->
            <!--                    <div class="flex-grow-1">-->
            <!--                        <span class="text-small text-muted">Last week</span>-->
            <!--                        <h5 class="m-0">32165</h5>-->
            <!--                    </div>-->
            <!--                </div>-->

            <!--            </div>-->
            <!--        </div>-->

            <!--    </div>-->

            <!--    <div class="col-md-12">-->
            <!--        <div class="card mb-4">-->
            <!--            <div class="card-body p-0">-->
            <!--                <h5 class="card-title m-0 p-3">Last 20 Day Leads</h5>-->
            <!--                <div id="echart3" style="height: 360px;"></div>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--    </div>-->

            <!--</div>-->
             <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  
            <script type="text/javascript">
                google.charts.load('current', {'packages':['corechart']});
                google.charts.setOnLoadCallback(drawChart);
                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                    ['Name', 'TotalCount'],
                  <?php
                                
                    foreach ($leadsource as $key => $value) {
                        echo "['".$value->Name.' ('.$value->TotalCount.')'."',".$value->TotalCount."],"; 
                    }          
                ?>  
                ]);
                var options = {
                 
                };//console.log(data);
                var chart = new google.visualization.PieChart(document.getElementById('pie_chart_leadsource'));
                chart.draw(data, options);
              }  
            </script>
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  
             <script type="text/javascript">
            //     google.charts.load('current', {'packages':['corechart']});
            //     google.charts.setOnLoadCallback(drawChart);
            //     function drawChart() {
            //         var data = google.visualization.arrayToDataTable([
            //         ['Name', 'TotalCount'],
            //       <?php
                                
            //         foreach ($lineChart as $key => $value) {
            //             echo "['".$value->Name.' ('.$value->TotalCount.')'."',".$value->TotalCount."],"; 
            //         }          
            //     ?>  
            //     ]);
            //     var options = {
                 
            //     };console.log(data);
            //     var chart = new google.visualization.LineChart(document.getElementById('Daily_Lead'));
            //     chart.draw(data, options);
            //   }  
            // </script>
            <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
            <script type="text/javascript">
            //     google.charts.load('current', {'packages':['corechart']});
            //     google.charts.setOnLoadCallback(drawChart);
            //     function drawChart() {
            //         var data = google.visualization.arrayToDataTable([
            //         ['Name', 'TotalCount'],
            //       <?php
                                
            //         foreach ($Lead_Stage as $key => $value) {
            //             echo "['".$value->Name.' ('.$value->TotalCount.')'."',".$value->TotalCount."],"; 
            //         }          
            //     ?>  
            //     ]);
            //     var options = {
                 
            //     };//console.log(data);
            //     var chart = new google.visualization.PieChart(document.getElementById('Lead_Stage'));
            //     chart.draw(data, options);
            //   } 
               
            var options = {
          series: [ <?php      $i=0 ;         
                    foreach ($Lead_Stage as $key => $value) {
          
                                echo $value->TotalCount; 
                        	if($i<count($Lead_Stage) ){ echo ','; } else { echo ''; }
                        	$i++;
                    }          
                    ?> ],
          chart: {
          width: 380,
          type: 'pie',
        },
        labels: [ <?php       $j=0;         
                    foreach ($Lead_Stage as $key => $value) {
          
                                echo "'".$value->Name."'"; 
                        	if(($j)< count($Lead_Stage)){ echo ','; } else { echo ''; }
                        	$j++;
                    }          
                    ?> ],//['prospect', 'trail', 'paid'],
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom'
            }
          }
        }]
        };
        console.log(options);
        var chart = new ApexCharts(document.querySelector("#Lead_Stage"), options);
        chart.render();
      
            </script>
            

<?php $__env->stopSection(); ?>

<?php $__env->startSection('page-js'); ?>

    <script src="<?php echo e(asset('assets/js/es5/echarts.script.min.js')); ?>"></script>

      <script src="<?php echo e(asset('assets/js/vendor/echarts.min.js')); ?>"></script>
     <script src="<?php echo e(asset('assets/js/es5/echart.options.min.js')); ?>"></script>
     <script src="<?php echo e(asset('assets/js/es5/dashboard.v1.script.js')); ?>"></script>
     <script>
      
          // line charts
    // ================= Basic Line ================
    var basicLineElem = document.getElementById('basicLineC');
    if (basicLineElem) {
        var basicLineC = echarts.init(basicLineElem);
        //console.log(basicLineC);
        basicLineC.setOption({
            tooltip: {
                show: true,
                trigger: 'axis',
                axisPointer: {
                    type: 'line',
                    animation: true
                }
            },
            grid: {
                top: '10%',
                left: '40',
                right: '40',
                bottom: '40'
            },
            xAxis: {
                type: 'category',
                data:[ <?php                
                    foreach ($Dtotal as $key => $value) {
          
                                echo "'".$value->createdate."'"; 
                        	if(($key+1)!= count($Dtotal)){ echo ','; } else { echo ''; }
                    }          
                    ?> ],
                axisLine: {
                    show: false
                },
                axisLabel: {
                    show: true
                },
                axisTick: {
                    show: false
                }
            },
            yAxis: {
                type: 'value',
                axisLine: {
                    show: false
                },
                axisLabel: {
                    show: true
                },
                axisTick: {
                    show: false
                },
                splitLine: {
                    show: true
                }
            },
            series: [{
                data: [<?php                
                    foreach ($Dtotal as $key => $value) {
                        echo "'".$value->TotalCount."'"; 
                        	if(($key+1)!= count($Dtotal)){ echo ','; } else { echo ''; }
                    }  ?>],
                type: 'line',
                showSymbol: true,
                smooth: true,
                color: '#f3993e',
                lineStyle: {
                    opacity: 1,
                    width: 2
                }
            }]
        });
        $(window).on('resize', function () {
            setTimeout(function () {
                basicLineC.resize();
            }, 500);
        });
    }
  </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/megaspace/public_html/admin/resources/views/dashboard/dashboardv1.blade.php ENDPATH**/ ?>