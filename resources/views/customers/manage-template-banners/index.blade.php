@extends('layouts.master')
@section('page-css')

<link rel="stylesheet" href="{{asset('assets/styles/vendor/ladda-themeless.min.css')}}">

<link rel="stylesheet" href="{{asset('assets/styles/vendor/quill.bubble.css')}}">
<link rel="stylesheet" href="{{asset('assets/styles/vendor/quill.snow.css')}}">
<link rel="stylesheet" href="{{asset('assets/styles/vendor/sweetalert2.min.css')}}">


<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.js" integrity="sha512-vUJTqeDCu0MKkOhuI83/MEX5HSNPW+Lw46BA775bAWIp1Zwgz3qggia/t2EnSGB9GoS2Ln6npDmbJTdNhHy1Yw==" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css" integrity="sha512-zxBiDORGDEAYDdKLuYU9X/JaJo/DPzE42UubfBw9yg8Qvb2YRRIQ8v4KsGHOx2H1/+sdSXyXxLXv5r7tHc9ygg==" crossorigin="anonymous" />

<style>
    .divide{
        border-top: 1px solid #dee2e6;
        padding-top: 5px;
    }
</style>
<style>
    .multiselect-container .checkbox input{    position: inherit;
    opacity: 1;
    height: auto;
    width: auto;}
    
    .my-multiselect .btn-default {
      background: #f8f9fa;
    border: 1px solid #ced4da;
    color: #47404f;
    padding: 6px 10px 2px 10px;
    height: auto;
    width:100%;

    border-radius: 4px !important;
}
.breadcrumb ul li {
    display: inline;
    position: relative;
    padding: 0 0.5rem;
    line-height: 1;
    vertical-align: bottom;
    color: #70657b;
}
</style>
@endsection

@section('main-content')

<div id="spinner" style="display:none;z-index: 99999;position: fixed;background: black;width: 100%;height: 100%;opacity: 0.39;">
		<div class="spinner-border text-success" style="margin-top: 20%;margin-left: 44%;"></div>
</div>

            <div class="breadcrumb">
                <h1>Template Banners List</h1>
                <ul>
                  <li><a href="managetemplatebanners">View List</a></li>
                  <li>{{ (isset(Session::get('selectedEvent')->aem_name) ? Session::get('selectedEvent')->aem_name : '') }}</li>
                </ul>

            </div>
            <div class="separator-breadcrumb border-top"></div>
            
            <div class="row mb-4">
                <div class="col-md-12 mb-4">
                    <div class="card text-left">

                        <div class="card-body">
                            <div class="table-responsive">
                              <div class="row ">
                                  <div class="col-md-12">

    <form method="post" action="{{$_SERVER['REQUEST_URI']}}" id="pageInput">
        <div class="row pagination-bar">
            <div class="col-12 col-md-7">
                <div class="form-group mt-3">
                    @csrf
                    <div class="d-flex flex-row">
                       <div class="mr-2">
                        <select class="custom-select" name="pagination" id="pagination" onchange="this.form.submit();">
                            <option value="10"  @if($leadList->perPage() == 10) selected    @endif > 10 </option>
                            <option value="25"  @if($leadList->perPage() == 25) selected    @endif > 25 </option>
                            <option value="50"  @if($leadList->perPage() == 50) selected    @endif > 50 </option>
                            <option value="75"  @if($leadList->perPage() == 75) selected    @endif > 75 </option>
                            <option value="100" @if($leadList->perPage() == 100) selected   @endif  > 100 </option>
                            <option value="200" @if($leadList->perPage() == 200) selected   @endif > 200 </option>
                            <option value="500" @if($leadList->perPage() == 500) selected   @endif > 500 </option>
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
    
    

  <div class="table-responsive">
      <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Location</th>
                    <th scope="col">File</th>
                    <th scope="col">File Type</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                  
				 @php
				    $eventNickName=(isset(Session::get('selectedEvent')->aem_event_nickname) ? Session::get('selectedEvent')->aem_event_nickname : 'v1');
                    $i=1
                    @endphp
                    @if(isset($leadList) && !empty($leadList))
                        @foreach($leadList as $list)
                        
                    <tr>
                        <th scope="row">{{$i++}}</th>
                        <td>Location {{$list->location_id}}</td>
                        <td>
                            @if($list->type=='image')
                            <img src="{{$list->filename}}" style="width:250px;height:150px;">
                            @else
                            <a href="{{$list->filename}}" target="_blank">View</a>
                            @endif
                        </td>
                        <td>{{ucfirst($list->type)}}</td>
                        <td>
                            <a href="{{$list->filename}}" target="_blank" class="btn btn-primary mr-2">
                            View</a>
                        </td>
                    </tr>
                    @endforeach
                    @else
                        <tr><th scope="row" >Empty record!</th></tr>
                   @endif
                </tbody>
             </table>
             
  </div>
</div>
   <div class="col-md-12">

     <div class="col-md-12">

                                    <!--<div class="col-md-6  text-right">{{$leadList->onEachSide(2)->appends(request()->except('page'))->links()}}</div>-->
                                     <nav aria-label="Page navigation example">
                                        <ul class="pagination">
                                            <li class="page-item">
                                                <a class="page-link" href="{{$leadList->previousPageUrl()}}" tabindex="-1">Previous</a>
                                            </li>
                                             @for($i=1;$i<=$leadList->lastPage();$i++)
                                            <li class="page-item {{$leadList->currentPage() ==  $i ? 'active' : ''}}">
                                                <a class="page-link" href="{{$leadList->url($i)}}">{{$i}} <span class="sr-only">(current)</span></a>
                                            </li>
                                             @endfor
                                            
                                            <li class="page-item">
                                                <a class="page-link" href="{{$leadList->nextPageUrl()}}">Next</a>
                                            </li>
                                        </ul>
                                    </nav>
                                        <p>
                                        Displaying {{$leadList->count()}} of {{ $leadList->total() }} banner(s).
                                        </p>
                                  </div>
   </div>


</div>
</div>

</div>
</div>
</div>

@endsection

@section('page-js')

   <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.js" integrity="sha512-Gs+PsXsGkmr+15rqObPJbenQ2wB3qYvTHuJO6YJzPe/dTLvhy0fmae2BcnaozxDo5iaF8emzmCZWbQ1XXiX2Ig==" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.js" integrity="sha512-vUJTqeDCu0MKkOhuI83/MEX5HSNPW+Lw46BA775bAWIp1Zwgz3qggia/t2EnSGB9GoS2Ln6npDmbJTdNhHy1Yw==" crossorigin="anonymous"></script>



  <script src="{{asset('assets/js/vendor/sweetalert2.min.js')}}"></script>
 <script type="text/javascript">
 
    $(document).on({
        //submit: function() { $('#spinner').show(); },
        ajaxStart: function() { $('#spinner').show(); },
        ajaxStop: function() { $('#spinner').hide(); }
    });
    
    function SubmitBannerDetails(tmpId,index){
        
        if(tmpId!='') {
            
            var position_x = $('#position_x_'+index).val();
            var position_y = $('#position_y_'+index).val();
            var position_z = $('#position_z_'+index).val();
            
            var rotation_x = $('#rotation_x_'+index).val();
            var rotation_y = $('#rotation_y_'+index).val();
            var rotation_z = $('#rotation_z_'+index).val();
            
            var scale_x = $('#scale_x_'+index).val();
            var scale_y = $('#scale_y_'+index).val();
            var scale_z = $('#scale_z_'+index).val();
            
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "post",
                url: 'updatetemplatebannerdata',
                data: 'tmpId='+tmpId+
                        '&position_x='+position_x+'&position_y='+position_y+'&position_z='+position_z+
                        '&rotation_x='+rotation_x+'&rotation_y='+rotation_y+'&rotation_z='+rotation_z+
                        '&scale_x='+scale_x+'&scale_y='+scale_y+'&scale_z='+scale_z,
                success: function (data) {
                    var result = JSON.parse(data);
                    if(result.code == 200)
                    {
                        swal('Success','Template Banner Data Updated Successfully !','success');
                        setTimeout(function(){
                            window.location.reload();
                        },2000);
                    }
                    else{
                        swal('Failed','Something goes wrong, please try again!','error');
                    }
                }      
        
            });
        }
    }
 </script>
@endsection
