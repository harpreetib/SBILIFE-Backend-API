@extends('layouts.master')
@section('page-css')
     <link rel="stylesheet" href="{{asset('assets/styles/vendor/pickadate/classic.css')}}">
 <link rel="stylesheet" href="{{asset('assets/styles/vendor/pickadate/classic.date.css')}}">
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/quill.bubble.css')}}">
    <link rel="stylesheet" href="{{asset('assets/styles/vendor/quill.snow.css')}}">

<style>
    .divide{
        border-top: 1px solid #dee2e6;
    }
</style>

@endsection
@section('main-content')

        <div class="breadcrumb">
                <h1>&nbsp;</h1>
                <ul>
                    <li><strong>Attendance Report </strong></li>
                    @if(Session::get('AllEvent')==false)
                     <li>{{ (isset(Session::get('selectedEvent')->aem_name) ? Session::get('selectedEvent')->aem_name : '') }}</li>
                    @else
                    <li>All Locations</li>
                    @endif
                    
                </ul>
            </div>
                
            <div class="separator-breadcrumb border-top"></div>
            
                        <div class="row mb-4">
                <div class="col-md-12">
                    <h4><i class="fa fa-filter"></i>Filter</h4>
                    
  <!-- Start filter -->
 <form name="check" id="check" method="post" action="{{$_SERVER['REQUEST_URI']}}" onsubmit="return validateForm()">
    {{@csrf_field()}}
            <div class="card mb-4">
                <div class="card-body">          
                        <div class="row">                        
                         <div class="col-md-3 form-group mb-3 d-none"> 
                          <label for="qualifications">Search by Qualification</label>
                                                   
                            </div>
                            <div class="col-md-3 form-group mb-3 d-none">
                                 <label for="course">Search by Courses</label>
                                
                           </div>
                           
                            <div class="col-md-3 form-group mb-3 d-none">
                                  <label for="leadsource">Select Lead Source</label>
                                <select class="form-control" id="leadsource" name="leadsource">
                                  <option value=""> All Lead Source</option>
                                    <?php foreach($leadsources_list as $source){ ?>
                                    <option value="{{$source->ls_id}}" <? if($source->ls_id==$leadsrc){ echo 'selected'; } ?> >{{$source->ls_text}}</option>
                                    <?php } ?>
                                   </select>
                           </div>
                           
                           <div class="col-md-3 form-group mb-3">
                                        <label for="picker3">Date From</label>
                                        <div class="input-group">
                                            <input id="picker3" class="form-control" placeholder="yyyy-mm-dd"    name="datefrom" value="{{empty($datefrom) ? ''  : $datefrom}}">
                                            <div class="input-group-append">
                                                <button class="btn btn-secondary"  type="button">
                                                    <i class="icon-regular i-Calendar-4"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-3 form-group mb-3">
                                        <label for="picker4">Date To</label>
                                        <div class="input-group">
                                            <input id="picker3" class="form-control" placeholder="yyyy-mm-dd"    name="dateto" value="{{empty($dateto) ? ''  : $dateto}}">
                                            <div class="input-group-append">
                                                <button class="btn btn-secondary"  type="button">
                                                    <i class="icon-regular i-Calendar-4"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                            


                            
                         
                             <input type="hidden" name="leadtype" id="leadtype" value="{{empty($leadtype) ? ''  : $leadtype}}">
                             <div class="col-md-2 form-group mt-4">
                                <button type="submit" id="searchbtn" class="btn btn-primary" >Search</button>
                                <!--  <button type="button" id="reset-btn" class="btn btn-success">Remove Filter</button> -->
                            </div>


                        </div>
                    </div>
                </div>
    </form> 

<!-- End filter -->
                </div>
            </div> 
             <div class="row">                                                             
                             <div class="col-md-6 form-group mb-3">     
                                 <a href="attendancereport?action=download&leadsource=<?php if(isset($leadsrc)) echo $leadsrc; ?>&course=<?php if(isset($courses)) echo $courses->ppm_id;?>&datefrom=<?php if(isset($datefrom)) echo $datefrom; ?>&dateto=<?php if(isset($dateto)) echo $dateto; ?>">
                                    <button type="button" class="btn btn-outline-success btn-excel" >Download Excel</button></a>                
                            </div>
                         </div>
         

            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                        <div class="card-body text-center">
                            <i class="i-Add-User"></i>
                            <div class="content">
                                  
                                <p class="text-muted mt-2 mb-0">Total Visits</p>
                                <p class="text-primary text-24 line-height-1 mb-2">{{$total_visitors}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                

                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                        <div class="card-body text-center">
                            <i class="i-Add-User"></i>
                            <div class="content">
                                  
                                <p class="text-muted mt-2 mb-0">Total Pre-registered</p>
                                <p class="text-primary text-24 line-height-1 mb-2">{{$prereg_visitors}} </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                        <div class="card-body text-center">
                            <i class="i-Add-User"></i>
                            <div class="content">
                                  
                                <p class="text-muted mt-2 mb-0">Total During Event</p>
                                <p class="text-primary text-24 line-height-1 mb-2">{{$tduringevent_visitors}} </p>
                            </div>
                        </div>
                    </div>
                </div>
                
                             
            </div>



            <div class="row">
                
                
                <div class="col-lg-12 col-sm-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="card-title">Attendence Data</div>
                             <div class="panel-body" align="center">
                                 <form method="post" action="{{$_SERVER['REQUEST_URI']}}" id="pageInput">
                                            <div class="row pagination-bar">
                                                <div class="col-12 col-md-7">
                                                    <div class="form-group mt-3">
                                                        @csrf
                                                        <div class="d-flex flex-row">
                                                            <div class="mr-2">
                                                            <select class="custom-select" name="pagination" id="pagination"
                                                                        onchange="this.form.submit();">
                                                                        <option value="10" @if($leadlist->perPage() == 10) selected @endif>
                                                                            10
                                                                        </option>
                                                                    <option value="25" @if($leadlist->perPage() == 25) selected @endif>
                                                                        25
                                                                    </option>
                                                                    <option value="50" @if($leadlist->perPage() == 50) selected @endif >
                                                                        50
                                                                    </option>
                                                                    <option value="75" @if($leadlist->perPage() == 75) selected @endif >
                                                                        75
                                                                    </option>
                                                                    <option value="100"
                                                                            @if($leadlist->perPage() == 100) selected @endif >100
                                                                    </option>
                                                                    <option value="200"
                                                                            @if($leadlist->perPage() == 200) selected @endif >200
                                                                    </option>
                                                                    <option value="500"
                                                                            @if($leadlist->perPage() == 500) selected @endif >500
                                                                    </option>
                                                                    <option value="1000"
                                                                            @if($leadlist->perPage() == 1000) selected @endif >1000
                                                                    </option>
                                                                      <option value="2000"
                                                                            @if($leadlist->perPage() == 2000) selected @endif >2000
                                                                    </option>
                                                                    <option value="2500"
                                                                            @if($leadlist->perPage() == 2500) selected @endif >2500
                                                                    </option>
                                                                </select>
                                                            </div>
                                                          <!-- code goes here -->

                                                        </div>

                                                    </div>
                                                </div>
                                            <div class="col-md-3">
                                            &nbsp;
                                            </div>
                                                <div class="col-md-2 mt-3">
                                              <div class="form-group ">
                                                  <i class="seacrh-icon"></i>
                                                  <input type="text" class="form-control seacrh-field pl-4" name="search_text" placeholder="Search"  autocomplete="off" value="<?php if(isset($_REQUEST['search_text']) && !empty($_REQUEST['search_text'])){ echo$_REQUEST['search_text']; } ?>" onchange="this.form.submit();">

                                              </div>
                                          </div>

                                            </div>
                                        </form>
                                 
                                 <div id="tabledata" class="table-responsive" style="min-height: 359px;">
                                         <table id="user_table" class="table table-bordered  text-center">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Date of Visit</th>
                                                    <th scope="col">Name <div class="divide">Email</div>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(count($leadlist) > 0)
                                                    <?php $i=1; ?>
                                                    @foreach($leadlist as $list)
                                                    <tr>
                                                        <td>{{$i++}}</td>
                                                        <td>{{$list->lemma_datetime}}</td>
                                                        <td>
                                                            {{ucwords($list->lm_fullname)}}
                                                            <div class="divide">{{$list->lm_email}}</div>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                @else
                                                <tr>
                                                    <td colspan="3" class="text-danger">No data available</td>
                                                </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                 </div>
                                    
                                   
                                  <div class="col-md-12">
                                       @if(count($leadlist) > 0)
                                        <nav aria-label="Page navigation example">
                                        <ul class="pagination flex-wrap pagination-sm">
                                            <li class="page-item">
                                                <a class="page-link" href="{{$leadlist->previousPageUrl()}}" tabindex="-1">Previous</a>
                                            </li>
                                             @for($i=1;$i<=$leadlist->lastPage();$i++)
                                            <li class="page-item {{$leadlist->currentPage() ==  $i ? 'active' : ''}}">
                                                <a class="page-link" href="{{$leadlist->url($i)}}">{{$i}} <span class="sr-only">(current)</span></a>
                                            </li>
                                             @endfor
                                            
                                            <li class="page-item">
                                                <a class="page-link" href="{{$leadlist->nextPageUrl()}}">Next</a>
                                            </li>
                                        </ul>
                                    </nav>
                                        <p>
                                        Displaying {{$leadlist->count()}} of {{ $leadlist->total() }} customer(s).
                                        </p>
                                      @endif
                                  </div>
                                </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-sm-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="card-title">Total Attendance</div>
                            <div class="panel-body" align="center">
                                 <div id="pie_chart" style="min-height: 359px;">

                                 </div>
                                </div>
                        </div>
                    </div>
                </div>

                
                
                 <div class="col-lg-6 col-sm-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="card-title">Attendence Lead Source</div>
                             <div class="panel-body" align="center">
                                 <div id="pie_chart1" style="min-height: 359px;">

                                 </div>
                                </div>
                        </div>
                    </div>
                </div>
                 <div class="col-lg-6 col-sm-12 d-none">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="card-title">Attendence City Wise</div>
                             <div class="panel-body" align="center">
                                 <div id="pie_city" style="min-height: 359px;">

                                 </div>
                                </div>
                        </div>
                    </div>
                </div>
                 <div class="col-lg-6 col-sm-12 d-none">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="card-title">Attendence Products Interested In</div>
                             <div class="panel-body" align="center">
                                 <div id="pie_course" style="min-height: 359px;">

                                 </div>
                                </div>
                        </div>
                    </div>
                </div>
                 <div class="col-lg-6 col-sm-12 d-none">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="card-title">Attendence Current Education</div>
                             <div class="panel-body" align="center">
                                 <div id="pie_education" style="min-height: 359px;">

                                 </div>
                                </div>
                        </div>
                    </div>
                </div>
               

            </div>
      
@endsection





@section('page-js')
<script src="{{asset('assets/js/vendor/pickadate/picker.js')}}"></script>
<script src="{{asset('assets/js/vendor/pickadate/picker.date.js')}}"></script>



@endsection

@section('bottom-js')
<script src="{{asset('assets/js/form.basic.script.js')}}"></script>






<script src="{{asset('assets/js/vendor/echarts.min.js')}}"></script>

   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   
   <script>
       
       function leadtypeFormSubmit(leadType){
$('#leadtype').val(leadType);
$('#searchbtn').click();
}
   </script>

   <script type="text/javascript">
                google.charts.load('current', {'packages':['corechart']});
                google.charts.setOnLoadCallback(drawChart);
                function drawChart() {
                    var data = google.visualization.arrayToDataTable([
                    ['Name', 'TotalCount'],
                  <?php                
                    foreach ($pre_with_du as $key => $value) {
                        echo "['".ucwords($value->lemm_reg_type).' ('.$value->TotalCount.')'."',".$value->TotalCount."],"; 
                    }          
                    ?>  
                ]);
                var options = {                
                };
                var chart = new google.visualization.PieChart(document.getElementById('pie_chart'));
                chart.draw(data, options);
              }  
            </script>
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
                 
                };
                var chart = new google.visualization.PieChart(document.getElementById('pie_chart1'));
                chart.draw(data, options);
              }  
            </script>

@endsection
