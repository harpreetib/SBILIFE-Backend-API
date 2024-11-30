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
                <h1>Choose Template</h1>
                <ul>
                  <li><a href="choosetemplates">View List</a></li>
                  <li>{{ (isset(Session::get('A_Session')->bm_name) ? Session::get('A_Session')->bm_name : '') }}</li>
                </ul>

            </div>
            <div class="separator-breadcrumb border-top"></div>
            
            <div class="row mb-4">
                <div class="col-md-12">
                    <!--<h4><i class="fa fa-filter"></i>Choose Template</h4>-->
                    
  <!-- Start filter -->
 <form name="check" id="check" method="post" action="managetemplatebanners" onsubmit="return validateForm()">
    {{@csrf_field()}}
            <div class="card mb-4">
                <div class="card-body">          
                        <div class="row">
                            @foreach($cuList as $list)
                            <div class="col-md-3 form-group mb-3">
                                <h3 class="font-weight-bold">{{$list->etm_name}}</h3>
                                <img src="{{$list->image}}">
                                <div class="mt-2 d-flex align-items-center">
                                   
                                    <?php
                                    
                                    $video='';
                                    $vstat='';
                                    
                                    if($list->eid == $list->etm_id){
                                        $video='checked';
                                        $vstat='disabled';
                                    }
                                    
                                    ?>
                                    
                                    <label class="switch switch-success mr-3"  <?php if($vstat!='disabled') { ?>onclick="ActivateTemplate('{{$list->etm_id}}','live_video');" <?php }?>>
                                    <input type="checkbox" {{$video}} {{$vstat}} id="live_video{{$list->etm_id}}">
                                    <span class="slider"></span>
                                    </label>
                                   <div class="ml-auto"><a href="javascript:void(0)" onclick="showPreview('{{asset($list->etm_video)}}')" class="btn btn-info">Preview</a></div>    
                                </div>
                           </div>
                           @endforeach
                        </div>
                    </div>
                </div>
    </form> 

<!-- End filter -->
                </div>
            </div> 
            
           
            
            <div class="row mb-4">
              
            <div class="col-md-12 mb-3 d-none">

                    <h4>  <a href="#" class="float-right"  data-toggle="modal" onclick="uploadphotoEvnt()" data-target="#photosmodal" ><button type="button" class="btn btn-info btn-rounded m-1">Add Banner</button></a><h4> 
            </div>
            
            <div class="modal fade" id="previewVideoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centerd">
                  <div class="modal-content">
                    <div class="modal-body">
                      <button type="button" class="close mb-2 text-danger" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <iframe width="100%" id="preview_id" height="350" src="" frameborder="0" allowfullscreen></iframe> 
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
    
    function ActivateTemplate(etm_id,mws_active_url){
                 var status='active';
                  var setText="set";

              swal({
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
               text: 'Are you sure you want to Changed ?',
                title: 'Are You Sure !',
                
              }).then(function() {
                
                $.ajax({
                        headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        method:"POST",
                        url: "ActivateTemplate",
                        data: {'etm_id':etm_id},
                        success: function (data) {
                              swal({
                                  type: 'success',
                                  title: 'Success!',
                                  text: 'Changed Successfully',
                                  buttonsStyling: false,
                                  confirmButtonClass: 'btn btn-lg btn-success'
                                 })
                                setTimeout(function(){ window.location.reload(); }, 1000);
                                return false;
                               
                            }
                        });
            
              },function(dismiss){
                      if(dismiss == 'cancel'){ 
                   
                       
                         $("#"+mws_active_url+etm_id).prop("checked", false); 
                           
                                              
                          swal("Cancelled", "No data has been changed, Your data is safe :)", "error");

                      }
                      
                  });
                  
            }
            
    function showPreview(videoUrl)
    {
       $('#preview_id').attr('src',videoUrl);
      $('#previewVideoModal').modal('show'); 
    }
 </script>
@endsection
