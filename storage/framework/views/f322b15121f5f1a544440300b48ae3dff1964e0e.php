

<?php $__env->startSection('page-css'); ?>
 <link rel="stylesheet" href="<?php echo e(asset('assets/styles/vendor/datatables.min.css')); ?>">

<?php $__env->stopSection(); ?>
<?php $__env->startSection('main-content'); ?>
       <div class="breadcrumb">
                <h1>Customer</h1>
                <ul>
                    <li><a href="">Dashboard</a></li>
                    <li>Customer</li>
                </ul>
            </div>
            <div class="separator-breadcrumb border-top"></div>

            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <!-- CARD ICON -->
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="card card-icon mb-4">
                                <div class="card-body text-center">
                                    <i class="i-Add-User"></i>
                                    <p class="text-muted mt-2 mb-2">Total Leads</p>
                                    <p class="text-primary text-24 line-height-1 m-0"><?php echo e($totalLead); ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="card card-icon mb-4">
                                <div class="card-body text-center">
                                    <i class="i-Add-User"></i>
                                    <p class="text-muted mt-2 mb-2">Today Leads</p>
                                    <p class="text-primary text-24 line-height-1 m-0"><?php echo e($todayLead); ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="card card-icon mb-4">
                                <div class="card-body text-center">
                                    <i class="i-Add-User"></i>
                                    <p class="text-muted mt-2 mb-2">Total Exhibitors</p>
                                    <p class="text-primary text-24 line-height-1 m-0"><?php echo e($totalExhib); ?></p>
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="card card-icon-big mb-4">
                                <div class="card-body text-center">
                                    <i class="i-Data-Upload"></i>
                                    <p class="text-muted mt-2 mb-2">Total Templates</p>
                                    <p class="line-height-1 text-title text-18 mt-2 mb-0"><?php echo e($totalTemp); ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6 d-none">
                            <div class="card card-icon-big mb-4">
                                <div class="card-body text-center">
                                    <i class="i-Gear"></i>
                                    <p class="line-height-1 text-title text-18 mt-2 mb-0">4021</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-6 d-none">
                            <div class="card card-icon-big mb-4">
                                <div class="card-body text-center">
                                    <i class="i-Bell"></i>
                                    <p class="line-height-1 text-title text-18 mt-2 mb-0">4021</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-sm-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="card-title">Lead Source</div>
                             <!--<div id="simpleDonut3" style="min-height: 359px;"></div> -->
                             <div class="panel-body" align="center">
                                 <div id="pie_chart_leadsource" style="min-height: 359px;">

                                 </div>
                                </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6 col-sm-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="card-title">Daily Lead Count</div>
                             <div class="panel-body" align="center">
                                 <div id="basicLineC" style="min-height: 359px;">

                                 </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- end of row-->
            <div class="row d-none">
                <div class="col-md-6">
                    <div class="card o-hidden mb-4">
                        <div class="card-header">
                            <h3 class="w-50 float-left card-title m-0">New Users</h3>
                            <div class="dropdown dropleft text-right w-50 float-right">
                                           <button class="btn bg-gray-100" type="button" id="dropdownMenuButton_table2"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="nav-icon i-Gear-2"></i>
                                        </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton_table2">
                                    <a class="dropdown-item" href="#">Add new user</a>
                                    <a class="dropdown-item" href="#">View All users</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">

                            <div class="table-responsive">

                                <table id="user_table" class=" table table-bordered text-center">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Avatar</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>Smith Doe</td>
                                            <td>

                                                <img class="rounded-circle m-0 avatar-sm-table " src="<?php echo e(asset('assets/images/faces/1.jpg')); ?>" alt="">

                                            </td>

                                            <td>Smith@gmail.com</td>
                                            <td><span class="badge badge-success">Active</span></td>
                                            <td>
                                                <a href="#" class="text-success mr-2">
                                                    <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                                </a>
                                                <a href="#" class="text-danger mr-2">
                                                    <i class="nav-icon i-Close-Window font-weight-bold"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">2</th>
                                            <td>Jhon Doe</td>
                                            <td>

                                                <img class="rounded-circle m-0 avatar-sm-table " src="<?php echo e(asset('assets/images/faces/1.jpg')); ?>" alt="">

                                            </td>

                                            <td>Jhon@gmail.com</td>
                                            <td><span class="badge badge-info">Pending</span></td>
                                            <td>
                                                <a href="#" class="text-success mr-2">
                                                    <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                                </a>
                                                <a href="#" class="text-danger mr-2">
                                                    <i class="nav-icon i-Close-Window font-weight-bold"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">3</th>
                                            <td>Alex</td>
                                            <td>

                                                <img class="rounded-circle m-0 avatar-sm-table " src="<?php echo e(asset('assets/images/faces/1.jpg')); ?>" alt="">

                                            </td>

                                            <td>Otto@gmail.com</td>
                                            <td><span class="badge badge-warning">Not Active</span></td>
                                            <td>
                                                <a href="#" class="text-success mr-2">
                                                    <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                                </a>
                                                <a href="#" class="text-danger mr-2">
                                                    <i class="nav-icon i-Close-Window font-weight-bold"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end of col-->

                <div class="col-md-6">
                    <div class="card o-hidden mb-4">
                        <div class="card-header">
                            <h3 class="w-50 float-left card-title m-0">Total Sales</h3>
                            <div class="dropdown dropleft text-right w-50 float-right">
                                           <button class="btn bg-gray-100" type="button" id="dropdownMenuButton_table_1"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="nav-icon i-Gear-2"></i>
                                        </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton_table_1">
                                    <a class="dropdown-item" href="#">Add new user</a>
                                    <a class="dropdown-item" href="#">View All users</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">

                            <div class="table-responsive">

                                <table id="sales_table" class="table  text-center">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Product</th>
                                            <th scope="col">Date</th>

                                            <th scope="col">Price</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">1</th>
                                            <td>Watch</td>
                                            <td>

                                                12-10-2019

                                            </td>

                                            <td>$30</td>
                                            <td><span class="badge badge-success">Delivered</span></td>
                                            <td>
                                                <a href="#" class="text-success mr-2">
                                                    <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                                </a>
                                                <a href="#" class="text-danger mr-2">
                                                    <i class="nav-icon i-Close-Window font-weight-bold"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">2</th>
                                            <td>Iphone</td>
                                            <td>

                                                23-10-2019

                                            </td>

                                            <td>$300</td>
                                            <td><span class="badge badge-info">Pending</span></td>
                                            <td>
                                                <a href="#" class="text-success mr-2">
                                                    <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                                </a>
                                                <a href="#" class="text-danger mr-2">
                                                    <i class="nav-icon i-Close-Window font-weight-bold"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">3</th>
                                            <td>Watch</td>
                                            <td>

                                                12-10-2019

                                            </td>

                                            <td>$30</td>
                                            <td><span class="badge badge-warning">Not Delivered</span></td>
                                            <td>
                                                <a href="#" class="text-success mr-2">
                                                    <i class="nav-icon i-Pen-2 font-weight-bold"></i>
                                                </a>
                                                <a href="#" class="text-danger mr-2">
                                                    <i class="nav-icon i-Close-Window font-weight-bold"></i>
                                                </a>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end of col-->
            </div>
            <!-- end of row-->
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
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
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
<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/megaspace/public_html/sbilife/console/resources/views/dashboard/dashboardv2.blade.php ENDPATH**/ ?>