<script>
        $(document).ready(function(){
          $("#pagetemp").change(function(){
              var name = $(this).val(); 
        
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': '{{@csrf_token()}}'
                    },
                    type: "post",
                    url: 'getlpage',
                    data: {'name':name},
                    success: function (data) {
                                $('#simp').html(data);
                             }
                });
                
            });
        });
    $("#viewAll").click(function(){
        if(this.contentEditable =='inherit'){
         $(".lgx-banner-info").attr('contentEditable','false');   
        }
    })
</script>

<!--<script>-->
<!-- $( document ).ready(function() {-->
<!--    $("#addspeaker").click(function(){-->
<!--  console.log(new FormData($("#spkfrm")[0]));-->
<!--                            $.ajax({-->
<!--                                  headers: {-->
<!--                                      'X-CSRF-TOKEN': '{{@csrf_token()}}'-->
<!--                                      },-->
<!--                                    url:'Addspk',-->
<!--                                    type:'POST',-->
<!--                                    contentType: false,       -->
<!--                                    cache: false,             -->
<!--                                    processData:false,-->
<!--                                    data: new FormData($("#spkfrm")[0])-->
                                     <!--success: function (data) {-->
                                     <!--    console.log(data);-->
                                     <!--Swal.fire({-->
                                     <!--      type: 'success',-->
                                     <!--      title: 'Success!',-->
                                     <!--      text: "Question Added Successfully!",-->
                                     <!--      buttonsStyling: false,-->
                                     <!--      confirmButtonClass: 'btn btn-lg btn-success'-->
                                     <!--      });-->
                                     <!--      setTimeout(function(){ window.location.reload(); }, 3000);-->
                                     <!--      return false;-->
                                     <!--   } -->
<!--                                      });-->
<!--    });-->
<!-- });-->
<!--</script>-->

<script>

// $(document).keydown(function (e) {
//     if (e.shiftKey && e.keyCode == 39) { 

function saveAll(){
        
        var template = '<?php echo $_REQUEST['template']?>';
        
          var data = new FormData();
		  
    		data.append("template",template);
    		
		  //banner section
            data.append("baner_subtitle",$("#baner_subtitle").text());
            data.append("baner_title",$("#baner_title").text());
            data.append("baner_date",$("#baner_date").text());
            data.append("baner_location",$("#baner_location").text());
          
		  //about section 	
            data.append("about_head",$("#about_head").text());
            data.append("about_subhead",$("#about_subhead").text());
            data.append("about_content",$("#about_content").text());
			
		  //count section	
			data.append("count_one",$("#count_one").text());
            data.append("count_one_name",$("#count_one_name").text());
            data.append("count_two",$("#count_two").text());
            data.append("count_two_name",$("#count_two_name").text());
			data.append("count_three",$("#count_three").text());
            data.append("count_three_name",$("#count_three_name").text());
            data.append("count_four",$("#count_four").text());
            data.append("count_four_name",$("#count_four_name").text());
			
		  //speaker section	
			data.append("speaker_title",$("#speaker_title").text());
            data.append("speaker_subtitle",$("#speaker_subtitle").text());
			
		  //event section	
			data.append("event_title",$("#event_title").text());
            data.append("event_subtitle",$("#event_subtitle").text());
			
		  //sponsor section	
			data.append("sponsor_title",$("#sponsor_title").text());
            data.append("sponsor_subtitle",$("#sponsor_subtitle").text());
			
		  //gallery section	
			data.append("gallery_title",$("#gallery_title").text());
            data.append("gallery_subtitle",$("#gallery_subtitle").text());
			
		  //blog section	
			data.append("blog_title",$("#blog_title").text());
            data.append("blog_subtitle",$("#blog_subtitle").text());
			
		  //footer section	
			data.append("foo_title",$("#foo_title").text());
            data.append("foo_date",$("#foo_date").text());
			data.append("foo_address",$("#foo_address").text());
			
		  //socialMedia section	
			data.append("social_title",$("#social_title").text());
            data.append("social_subtitle",$("#social_subtitle").text());
            
            // for (var value of data.values()) {
            //   console.log(value);
            // }
        
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{@csrf_token()}}'
            },
            url:'Addcms',
            data: data,
            processData: false,
            contentType: false,
            type: 'POST',
                success: function (data) {
                console.log(data);
                Swal.fire({
                      type: 'success',
                      title: 'Success!',
                      text: "Added Successfully!",
                      buttonsStyling: false,
                      confirmButtonClass: 'btn btn-lg btn-success'
                      });
                    //   setTimeout(function(){ window.location.reload(); }, 3000);
                    //   return false;
                } 
        });
}
//     }
// });


   $( document ).ready(function() {
       $("#logodiv").click(function(e){
           e.preventDefault();
           
           $("#logoModalTitle").text("Upload Logo");
           
           $("#logo").attr('name', 'logo');
           
           $("#uploadBtn").attr('name', 'uploadlogo');
           
           $("#addLogoModal").modal('show');
        });
        
    });

   $( document ).ready(function() {
       $("#logodivfoo").click(function(e){
           e.preventDefault();
           
           $("#logoModalTitle").text("Upload Footer Logo");
           
           $("#logo").attr('name', 'logoFoo');
           
           $("#uploadBtn").attr('name', 'uploadlogoFoo');
           
           $("#addLogoModal").modal('show');
        });
        
    });
    
    
   $( document ).ready(function() {
       $("#addGallery").click(function(e){
           e.preventDefault();
           
           $("#galleryModalTitle").text("Upload Photo");
           
           $("#photo").attr('name', 'photo');
           
           $("#photoUploadBtn").attr('name', 'uploadphoto');
           
           $("#spk_name").hide();
    
           $("#spk_des").hide();
           
           $("#galleryModal").modal('show');
        });
        
    });

function gSponsor(){
    
    $("#galleryModalTitle").text("Upload Gold Sponsor");
           
    $("#photo").attr('name', 'gSponsorLogo');
    
    $("#photoUploadBtn").attr('name', 'uploadgSponsor');
    
    $("#spk_name").hide();
    
    $("#spk_des").hide();
    
    $("#galleryModal").modal('show');
    
}

function sSponsor(){
    
    $("#galleryModalTitle").text("Upload Silver Sponsor");
           
    $("#photo").attr('name', 'sSponsorLogo');
    
    $("#photoUploadBtn").attr('name', 'uploadsSponsor');
    
    $("#spk_name").hide();
    
    $("#spk_des").hide();
    
    $("#galleryModal").modal('show');
    
}

function video(){
    
    $("#socialModalTitle").text("Add New Video Link");
    
    $("#socialBtn").attr('name', 'uploadvideo');
    
    $("#socialForm").attr('action', 'photoUpload');
    
    $("#youtubeLink").show();
    
    $("#socialLink").hide();
    
    $("#socialModal").modal('show');
    
}

function social(){
    
    $("#socialModalTitle").text("Add Social Media Link");
    
    $("#socialBtn").attr('name', 'socialMedia');
    
    $("#socialForm").attr('action', 'logoUpload');
    
    $("#youtubeLink").hide();
    
    $("#socialLink").show();
    
    $("#socialModal").modal('show');
    
}

function addSpeaker(){
    
    $("#galleryModalTitle").text("Add New Speaker");
           
    $("#photo").attr('name', 'spk_img');
    
    $("#photoUploadBtn").attr('name', 'addSpeaker');
    
    $("#spk_name").show();
    
    $("#spk_des").show();
    
    $("#galleryModal").modal('show');
    
}



function removeGallery(lgm_id){
   
     $.ajax({
         headers: {
                'X-CSRF-TOKEN': '{{@csrf_token()}}'
            },
            method:"POST",
            url: "removegalleryitem",
            data: {lgm_id:lgm_id},
            success: function (data) {
                
                            Swal.fire({
                                type: 'success',
                                title: 'Success!',
                                text: 'Deleted Successfully',
                                buttonsStyling: false,
                                confirmButtonClass: 'btn btn-lg btn-success'
                            });
                          setTimeout(function(){ window.location.reload(); }, 3000);
                          return false;

            }
        });
    
}

</script>

<script>
function openNav() {
  document.getElementById("mySidebar").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
}

function closeNav() {
  document.getElementById("mySidebar").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
}
</script>


 <script type="text/javascript">
$(document).ready(function () {
        		$(".add-speaker").click(function(){
			var row_val= parseInt($('#row_count_speaker').val(), 10);
            row_val +=1;
			$('#row_count_speaker').val(row_val);
			var markup = "<tr><td><input class='form-control' type='text' name='stime-"+row_val+"' autocomplete='off' id='stime-"+row_val+"' value=''   placeholder='Session Time'></td><td><input class='form-control' type='text' name='scname-"+row_val+"' autocomplete='off' id='scname-"+row_val+"' value=''   placeholder='Company Name'></td><td><input class='form-control' type='text' name='sname-"+row_val+"' autocomplete='off' id='sname-"+row_val+"' value=''   placeholder='Full Name'></td><td><input class='form-control' type='text' name='sdesig-"+row_val+"' autocomplete='off' id='sdesig-"+row_val+"' value='' autocomplete='off' value=''   placeholder='designation' ></td><td><input class='form-control' type='text' name='sdesc-"+row_val+"' autocomplete='off' id='sdesc-"+row_val+"' value=''   placeholder='Description'></td><td><input class='form-control' type='file' name='spic-"+row_val+"' autocomplete='off' id='spic-"+row_val+"' value=''   ></td ><td class='text-danger'><a class='fa fa-trash delete-row'></a><input type='hidden' value=''></td></tr>";
            $("#speaker").append(markup);
            console.log(markup);
        });
		


											       
        // Find and remove selected table rows
        
		$(document).on("click", ".delete-row", function(e) {
			var del_id=$(this).next('input').val();
			if($.isNumeric(del_id)){
				if (confirm('Do You want to Delete')) {
					$(this).parents("tr").remove();
					$.ajax({
					type:"post",
					cache:false,
					url:'deletespeaker',
					data: "del_id="+del_id,
					success:function(data)
					{
					console.log("success");
						
					}					
					
				});
					
				} else {
					
				}
			}else{
				$(this).parents("tr").remove();
			}
        });
});			
 </script>

<script type="text/javascript">
$(document).ready(function () {
        		$(".add-nspeaker").click(function(){
			var row_val= parseInt($('#row_count_nspeaker').val(), 10);
            row_val +=1;
			$('#row_count_nspeaker').val(row_val);
			var markup = "<tr><td><input class='form-control' type='text' name='new_stime-"+row_val+"' autocomplete='off' id='new_stime-"+row_val+"' value=''   placeholder='Session Time'></td><td><input class='form-control' type='text' name='new_scname-"+row_val+"' autocomplete='off' id='new_scname-"+row_val+"' value=''   placeholder='Company Name'></td><td><input class='form-control' type='text' name='new_sname-"+row_val+"' autocomplete='off' id='new_sname-"+row_val+"' value=''   placeholder='Full Name'></td><td><input class='form-control' type='text' name='new_sdesig-"+row_val+"' autocomplete='off' id='new_sdesig-"+row_val+"' value='' autocomplete='off' value=''   placeholder='designation' ></td><td><input class='form-control' type='text' name='new_sdesc-"+row_val+"' autocomplete='off' id='new_sdesc-"+row_val+"' value=''   placeholder='Description'></td><td>&nbsp;</td><td><input class='form-control' type='file' name='new_spic-"+row_val+"' autocomplete='off' id='new_spic-"+row_val+"' value=''   ></td ><td class='text-danger'><a class='fa fa-trash delete-rowe'></a><input type='hidden' value=''></td></tr>";
            $("#nspeaker").append(markup);	
        });
});			

function AddCounselorSession(){
            	/*if($.trim($('#name').val())==''){
            $("#lcc_name").html('Pleae Enter Session Name');
            $("#lcc_name").fadeIn('fast');
            document.
            addcounselorSession.name.focus();
             $(window).scrollTop($('#lcc_name').offset().top);
                    return false;
	          }
	          
	      
	          if($.trim($('#picker3').val())==''){
            $("#lcc_start").html('Pleae Enter Start Date Time');
            $("#lcc_start").fadeIn('fast');
            document.addcounselorSession
            .picker3.focus();
             $(window).scrollTop($('#lcc_start').offset().top);
                    return false;
	          }
	          if($.trim($('#enddate').val())==''){
            $("#lcc_end").html('Pleae Enter End Date Time');
            $("#lcc_end").fadeIn('fast');
            document.
            addcounselorSession.enddate.focus();
             $(window).scrollTop($('#lcc_end').offset().top);
                    return false;
	          }*/

	          
              $("#addcounselorSession").on('submit', function(e){
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'add_career_sessions',
                    data: new FormData(this),
                    dataType: 'json',
                    contentType: false,
                    cache: false,
                    processData:false,
                    success: function(response){
                      if (response==true) {
                    Swal.fire({
                          type: 'success',
                          title: 'Success!',
                          text: ' Added Successfully',
                          buttonsStyling: false,
                          confirmButtonClass: 'btn btn-lg btn-success'
                      })
                  }
                      setTimeout(function(){ window.location.reload(); }, 3000);
                      return false;
                       
                    }
                });
            });

}


function editCounselor(lccs_id){
                //alert(lccs_id);return false;

                $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': '{{@csrf_token()}}'
                        },
                        method:"POST",
                        url: "edit_career_sessions",
                        data: {'lccs_id':lccs_id},
                        success: function (data) {
                            $('#careerSession').html(data);
                            $('#editCareerSession').modal('toggle')  
                                
                            }
                        });
            }
            
            
            
function deleteCounselor(lccs_id){
                
                Swal.fire({  
                  title: 'Do you want to delete ?',  
                  showDenyButton: true,
                //   showCancelButton: true,  
                  confirmButtonText: `Yes`,  
                  denyButtonText: `No`,
                }).then((result) => {  

                    if (result.isConfirmed) {    
                                    $.ajax({
                                    headers: {
                                            'X-CSRF-TOKEN': '{{@csrf_token()}}'
                                        },
                                    type: 'POST',
                                    url: 'delete_career_sessions',
                                    data: {'lccs_id':lccs_id},
                                    success: function (data) {
                                    	Swal.fire('Deleted !', '', 'success')    
                                        	setTimeout(function(){ window.location.reload(); }, 3000);
                                            return false;
                                            }
                                });
                    } else if (result.isDenied) {    
                    	Swal.fire('Cancelled', '', 'info')  
                 	}
                });
                
            }
            
    function updateCounselorSession(){
    
			
			
			  $("#editcounselorsession").on('submit', function(e){
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'update_career_sessions',
                data: new FormData(this),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData:false,
                success: function(response){
                 // if (response==updated) {
               
                   
                }
            });
            
             Swal.fire({
                      type: 'success',
                      title: 'Success!',
                      text: ' Session Updated Successfully',
                      buttonsStyling: false,
                      confirmButtonClass: 'btn btn-lg btn-success'
                  })
              //}
                  setTimeout(function(){ window.location.reload(); }, 3000);
                  return false;
        });
			
			
        }
        
        


/*  photo image crop */
$photoCrop = $('#photo-demo').croppie({
    enableExif: true,
    viewport: {
        width: 1920,
        height: 935,
        type: 'square'
    },
    boundary: {
        width: 1940,
        height: 945
    },enableResize: false
    
});


$('#upload_banner').on('change', function () {
  
	var reader = new FileReader();
    reader.onload = function (e) {
    	$photoCrop.croppie('bind', {
    		url: e.target.result
    	}).then(function(){
    		console.log('jQuery bind complete');
    	});
    }
    reader.readAsDataURL(this.files[0]);
    
	    
	    Swal.fire({
                              type: 'success',
                              title: 'Image Crop',
                              text: 'Please Click on "Crop button" to crop the image',
                              buttonsStyling: false,
                              confirmButtonClass: 'btn btn-lg btn-danger'
                             })
});



$('#bannerCrop-result').on('click', function (ev) {
	$photoCrop.croppie('result', {
		type: 'canvas',
		size: 'viewport'
	}).then(function (resp) {
	    
	    Swal.fire({
                              type: 'success',
                              title: 'Image Crop',
                              text: 'Cropped Successfully',
                              buttonsStyling: false,
                              confirmButtonClass: 'btn btn-lg btn-danger'
                             })

	});

});




/*  milestone photo image crop */
$photoCropMile = $('#mile-photo-demo').croppie({
    enableExif: true,
    viewport: {
        width: 1920,
        height: 478,
        type: 'square'
    },
    boundary: {
        width: 1940,
        height: 490
    },enableResize: false
    
});


$('#upload_mile').on('change', function () {
  
	var reader = new FileReader();
    reader.onload = function (e) {
    	$photoCropMile.croppie('bind', {
    		url: e.target.result
    	}).then(function(){
    		console.log('jQuery bind complete');
    	});
    }
    reader.readAsDataURL(this.files[0]);
    
	    
	    Swal.fire({
                              type: 'success',
                              title: 'Image Crop',
                              text: 'Please Click on "Crop button" to crop the image',
                              buttonsStyling: false,
                              confirmButtonClass: 'btn btn-lg btn-danger'
                             })
});



$('#mileCrop-result').on('click', function (ev) {
	$photoCropMile.croppie('result', {
		type: 'canvas',
		size: 'viewport'
	}).then(function (resp) {
	    
	    Swal.fire({
                              type: 'success',
                              title: 'Image Crop',
                              text: 'Cropped Successfully',
                              buttonsStyling: false,
                              confirmButtonClass: 'btn btn-lg btn-danger'
                             })

	});

});




/*  sponsor photo image crop */
$photoCropSpon = $('#spon-photo-demo').croppie({
    enableExif: true,
    viewport: {
        width: 1920,
        height: 935,
        type: 'square'
    },
    boundary: {
        width: 1940,
        height: 945
    },enableResize: false
    
});


$('#upload_spon').on('change', function () {
  
	var reader = new FileReader();
    reader.onload = function (e) {
    	$photoCropSpon.croppie('bind', {
    		url: e.target.result
    	}).then(function(){
    		console.log('jQuery bind complete');
    	});
    }
    reader.readAsDataURL(this.files[0]);
    
	    
	    Swal.fire({
                              type: 'success',
                              title: 'Image Crop',
                              text: 'Please Click on "Crop button" to crop the image',
                              buttonsStyling: false,
                              confirmButtonClass: 'btn btn-lg btn-danger'
                             })
});



$('#sponCrop-result').on('click', function (ev) {
	$photoCropSpon.croppie('result', {
		type: 'canvas',
		size: 'viewport'
	}).then(function (resp) {
	    
	    Swal.fire({
                              type: 'success',
                              title: 'Image Crop',
                              text: 'Cropped Successfully',
                              buttonsStyling: false,
                              confirmButtonClass: 'btn btn-lg btn-danger'
                             })

	});

});



function sectionToggle(template,sm_id,reqText){
                
                Swal.fire({  
                  title: 'Are you sure, you want to change status ?',  
                  showDenyButton: true,
                //   showCancelButton: true,  
                  confirmButtonText: `Yes`,  
                  denyButtonText: `No`,
                }).then((result) => {  

                    if (result.isConfirmed) {    
                                    $.ajax({
                                    headers: {
                                            'X-CSRF-TOKEN': '{{@csrf_token()}}'
                                        },
                                    type: 'POST',
                                    url: 'sectionToggle',
                                    data: {'template':template,'sm_id':sm_id,'reqText':reqText},
                                    success: function (data) {
                                    	Swal.fire('Changed !', '', 'success')    
                                        	setTimeout(function(){ window.location.reload(); }, 1000);
                                            return false;
                                            }
                                });
                    } else if (result.isDenied) {    
                    	Swal.fire('Cancelled', '', 'info')  
                    	if(reqText=='active'){
                                $("#sm_id_"+sm_id).prop("checked", false);
                              }else  if(reqText=='inactive'){
                                $("#sm_id_"+sm_id).prop("checked", true); 
                              }
                 	}
                });
                
            }



 </script>