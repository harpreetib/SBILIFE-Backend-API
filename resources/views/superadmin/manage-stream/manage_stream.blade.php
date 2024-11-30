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
                <h1>Manage Events</h1>
                <ul>
                  <li><a href="managestream">View List</a></li>
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

    
    
    

  <div class="table-responsive">
      <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i=1;
                    @endphp
                    @foreach($eventLaunch as $eDetail)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$eDetail->el_name}}</td>
                        <td>
                            
                            <label class="switch switch-success mr-3" onclick="ChangeEventStatus('{{$eDetail->el_id}}','{{$eDetail->el_status}}')">
                                <input type="checkbox" @if($eDetail->el_status=='active') checked @endif id="live_video{{$eDetail->el_id}}">
                                <span class="slider"></span>
                            </label>
                  
                        </td>
                        <td>
                            <a href="javascript:void(0);" class="text-success mr-2" onclick="editEventData('{{$eDetail->el_id}}');">
                                            <i class="nav-icon i-Pen-4 font-weight-bold"></i></a>
                        </td>
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




<!-- start Edit User modal -->
        <div class="modal fade" id="EditEventLaunchModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle-2" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                    <div class="modal-content" id="edit">
                        
                        
                        
                    </div>
                </div>
            </div>
 <!--End Edit User modal -->
@endsection

@section('page-js')

 <script src="{{asset('assets/js/vendor/sweetalert2.min.js')}}"></script>
 <script type="text/javascript">
 
    $(document).on({
        //submit: function() { $('#spinner').show(); },
        ajaxStart: function() { $('#spinner').show(); },
        ajaxStop: function() { $('#spinner').hide(); }
    });
    
    function editEventData(el_id)
    {
            $('#edit').html('');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "post",
                url: 'editevent',
                data: 'el_id='+el_id,
                success: function (data) {           
                    $('#edit').html(data);
                    $('#EditEventLaunchModal').modal('toggle')
                    }      
            });
    }
    
    function AddEventData(setUrl, forData){
                $.ajax({
                    type:'POST',
                    url: setUrl,
                    data:forData,
                    cache:false,
                    contentType: false,
                    processData: false,
                    success:function(data){
                              swal({
                                  type: 'success',
                                  title: 'Success!',
                                  text: 'Event Added Successfully',
                                  buttonsStyling: false,
                                  confirmButtonClass: 'btn btn-lg btn-success'
                              })
                             setTimeout(function(){ window.location.reload(); }, 3000);
                             return false;
                    },
                    error: function(data){
                        console.log("error");
                        console.log(data);
                    }
                });
        }
        
        function ChangeEventStatus(el_id,elstatus){
            
              var status='active';
              var setText="set";
              
              if(elstatus=='active')
              {
                  status='inactive';
              }

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
                        url: "update-event-status",
                        data: {'el_id':el_id,'el_status':status},
                        success: function (data) {
                              swal({
                                  type: 'success',
                                  title: 'Success!',
                                  text: 'Status Updated Successfully',
                                  buttonsStyling: false,
                                  confirmButtonClass: 'btn btn-lg btn-success'
                                 })
                                setTimeout(function(){ window.location.reload(); }, 1000);
                                return false;
                               
                            }
                        });
            
              },function(dismiss){
                      if(dismiss == 'cancel'){ 
                   
                       
                         $("#live_video"+el_id).prop("checked", false); 
                           
                                              
                          swal("Cancelled", "No data has been changed, Your data is safe :)", "error");

                      }
                      
                  });
                  
            }
 </script>

  
@endsection
