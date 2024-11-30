<?php

$user=Session::get('userid');

if(empty($user)){
    
    $url='https://'.request()->getHost().'/registration';
	header("Location: $url");
	exit;
    
}
?>

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
                  <li>Step Two</li>
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
      <form name="pass-form-{{$packageDetail->pm_id}}" id="pass-form-{{$packageDetail->pm_id}}"  method="post" action="#" >
      <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Package Name</th>
                        <th scope="col">Amount ($)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td>{{ucwords(strtolower($packageDetail->pm_name))}}</td>
                        <td>{{$packageDetail->pm_amount_display}}</td>
                    </tr>
                    <tr>
                        <td colspan="3" align="right">Total : $<span id="spanamount-{{$packageDetail->pm_id}}">{{$packageDetail->pm_amount_display}}</span>.00</td>
                    </tr>
                </tbody>
            </table>
            <div class="float-right">
                <input type="hidden" name="amount-{{$packageDetail->pm_id}}" id="amount-{{$packageDetail->pm_id}}" value="0">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="SavePass('{{$packageDetail->pm_id}}');">Confirm</button>
          </div>
        </form>
    
             
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

function Addbanner()
{    	
    $.ajax({
        type: 'POST',
        url: 'addhomepagecontent',
        data: new FormData(ele),
        //dataType: 'json',
        contentType: false,
        cache: false,
        processData:false,
        success: function(data){
              
            swal({
                type: 'success',
                title: 'Success!',
                text: ' Added Successfully',
                buttonsStyling: false,
                confirmButtonClass: 'btn btn-lg btn-success'
            }).then(function(){
                $('#courseofferedmodal').modal('toggle');
            });
                    setTimeout(function(){
                        window.location.reload(); 
                    }, 2000);
            		return false;
        }
    });
}

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
                        url: "upgrade_package",
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

<script>
$(document).ready( function(){
    var extamnt=($('#amount-'+{{$packageDetail->pm_id}}).val());
    var amnt='{{$packageDetail->pm_amount}}'
    $('#amount-'+{{$packageDetail->pm_id}}).val(parseInt(extamnt)+parseInt(amnt));
    $('#spanamount-'+{{$packageDetail->pm_id}}).html(parseInt(extamnt)+parseInt(amnt));
});

function SavePass(pmid){
	    
	    $.ajax({
            headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
            type: "post",
            cache: false,
            url: './savepackage',
            data: $('#pass-form-'+pmid).serialize()+'&pmid='+pmid,
            success: function(data) {
                var res = JSON.parse(data);
                console.log('data-->>>>', data);
                console.log(data.code);
                if(res.code==200)
                {
                    window.location.href = res.redirect_link;
                }
                else
                {
                    alert('Something went wrong, Please try again');
                }
               
            }
        });
	    
	}
</script>

  
@endsection
