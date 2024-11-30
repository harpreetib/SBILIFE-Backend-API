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
                <h1>My Subscription</h1>
                <ul>
                  <li><a href="mysubscription">View</a></li>
                  <li>Package</li>
                </ul>

            </div>
            <div class="separator-breadcrumb border-top"></div>
            
           
            
            <div class="row mb-4">
              
                


                <div class="col-md-12 mb-4">
                    <div class="card text-left">

                        <div class="card-body">
                            <div class="table">
                              <div class="row ">
                                  <div class="col-md-12">

    
  <div class="table">
      <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    
                    <tr>
                        <th scope="col">#Feature List#</th>
                        @foreach($packagenamelist as $detail)
                        <th scope="col">{{$detail->pm_name}}
                        
                        @php
                        $video=''; $vstat='';
                        if($pm_id == $detail->pm_id){
                            $video='checked';
                            $vstat='disabled';
                        }
                        @endphp
                        <label class="float-center switch switch-success ml-3" <?php if($vstat!='disabled') { ?>onclick="UpgradePackage('{{$detail->pm_id}}','package_upgrade');" <?php }?>>
                            <input type="checkbox" {{$video}} {{$vstat}} id="package_upgrade{{$detail->pm_id}}">
                            <span class="slider"></span>
                        </label>
                        
                        </th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($pData as $key => $detail)
                    <tr>
                        <td class="font-weight-bold">{{$key}}</td>
                        <td>{!!$detail[0]!!}</td>
                        <td>{!!$detail[1]!!}</td>
                        <td>{!!$detail[2]!!}</td>
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




@endsection

@section('page-js')

   
  <script src="{{asset('assets/js/vendor/sweetalert2.min.js')}}"></script>
<script type="text/javascript">

function UpgradePackage(pm_id,mws_active_url){
                 var status='active';
                  var setText="set";

              swal({
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
               text: 'Are you sure you want to Change Package ?',
                title: 'Are You Sure !',
                
              }).then(function() {
                
                $.ajax({
                        headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        method:"POST",
                        url: "upgradepackage",
                        data: {'pm_id':pm_id},
                        success: function (data) {
                            var res = JSON.parse(data);
                            if(res.code==200)
                            {
                                setTimeout(function(){ 
                                    window.location.href = res.redirect_link; 
                                }, 1000);
                                return false;
                            }
                            else
                            {
                                $("#"+mws_active_url+pm_id).prop("checked", false); 
                                swal('Failed','Something went wrong, try again!','error');
                            }
                               
                        }
                });
            
              },function(dismiss){
                  
                      if(dismiss == 'cancel'){ 
                       
                         $("#"+mws_active_url+pm_id).prop("checked", false); 
                           
                                              
                          swal("Cancelled", "No data has been changed, Your data is safe :)", "error");

                      }
                      
                  });
                  
            }
</script>

  
@endsection
