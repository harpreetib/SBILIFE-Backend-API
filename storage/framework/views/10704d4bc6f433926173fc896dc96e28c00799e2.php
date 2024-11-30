
<?php $__env->startSection('page-css'); ?>
     <link rel="stylesheet" href="<?php echo e(asset('assets/styles/vendor/pickadate/classic.css')); ?>">
 <link rel="stylesheet" href="<?php echo e(asset('assets/styles/vendor/pickadate/classic.date.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/styles/vendor/quill.bubble.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/styles/vendor/quill.snow.css')); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('main-content'); ?>

        <div class="breadcrumb">
                <h1>&nbsp;</h1>
                <ul>
                    <li><strong>Treasure Hunt Report </strong></li>
                    <li><a href="treasurehuntreport">List</a></li>
                    <?php if(Session::get('AllEvent')==false): ?>
                     <li><?php echo e((isset(Session::get('selectedEvent')->aem_name) ? Session::get('selectedEvent')->aem_name : '')); ?></li>
                    <?php else: ?>
                    <li>All Locations</li>
                    <?php endif; ?>
                    
                </ul>
            </div>
                
            <div class="separator-breadcrumb border-top"></div>

    <div class="row mb-4">
                <div class="col-md-12">
                    <h4><i class="fa fa-filter"></i>Filter</h4>
                    
  <!-- Start filter -->
 <form name="check" id="check" method="post" action="<?php echo e($_SERVER['REQUEST_URI']); ?>" onsubmit="return validateForm()">
    <?php echo e(@csrf_field()); ?>

            <div class="card mb-4">
                <div class="card-body">          
                        <div class="row">                        
 
                            <div class="col-md-3 form-group mb-3">
                                <label for="picker2">Date From</label>
                                <input id="picker2" class="form-control" placeholder="yyyy-mm-dd"    name="datefrom" value="<?php echo e(empty($datefrom) ? ''  : $datefrom); ?>">
                            </div>

                            <div class="col-md-4 form-group mb-3">
                                <label for="picker3">Date To</label>
                                <input id="picker3" class="form-control" placeholder="yyyy-mm-dd"    name="dateto" value="<?php echo e(empty($dateto) ? ''  : $dateto); ?>">
                            </div>
                    
                                <div class="col-md-1 form-group mt-4">
                                <button type="submit" id="searchbtn" class="btn btn-primary" >Search</button>
                            </div>

                        </div>
                    </div>
                </div>
    </form> 

<!-- End filter -->
                </div>
            </div> 
            
            <div class="row">
                
                <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="card card-icon mb-4">
                                <div class="card-body text-center">
                                    <i class="i-Add-User"></i>
                                    <p class="text-muted mt-2 mb-2">Total Users</p>
                                    <p class="text-primary text-24 line-height-1 m-0"><?php echo e($TotalSelfieUploaded); ?></p>
                                </div>
                            </div>
                        </div>
            </div>

            <div class="row">

                <div class="col-lg-12 col-sm-12">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="card-title">Selfie Data</div>
                             <div class="panel-body" align="center">
                                 <form method="post" action="<?php echo e($_SERVER['REQUEST_URI']); ?>" id="pageInput">
                                            <div class="row pagination-bar">
                                                <div class="col-12 col-md-7">
                                                    <div class="form-group mt-3">
                                                        <?php echo csrf_field(); ?>
                                                        <div class="d-flex flex-row">
                                                            <div class="mr-2">
                                                            <select class="custom-select" name="pagination" id="pagination"
                                                                        onchange="this.form.submit();">
                                                                        <option value="10" <?php if($leadlist->perPage() == 10): ?> selected <?php endif; ?>>
                                                                            10
                                                                        </option>
                                                                    <option value="25" <?php if($leadlist->perPage() == 25): ?> selected <?php endif; ?>>
                                                                        25
                                                                    </option>
                                                                    <option value="50" <?php if($leadlist->perPage() == 50): ?> selected <?php endif; ?> >
                                                                        50
                                                                    </option>
                                                                    <option value="75" <?php if($leadlist->perPage() == 75): ?> selected <?php endif; ?> >
                                                                        75
                                                                    </option>
                                                                    <option value="100"
                                                                            <?php if($leadlist->perPage() == 100): ?> selected <?php endif; ?> >100
                                                                    </option>
                                                                    <option value="200"
                                                                            <?php if($leadlist->perPage() == 200): ?> selected <?php endif; ?> >200
                                                                    </option>
                                                                    <option value="500"
                                                                            <?php if($leadlist->perPage() == 500): ?> selected <?php endif; ?> >500
                                                                    </option>
                                                                    <option value="1000"
                                                                            <?php if($leadlist->perPage() == 1000): ?> selected <?php endif; ?> >1000
                                                                    </option>
                                                                      <option value="2000"
                                                                            <?php if($leadlist->perPage() == 2000): ?> selected <?php endif; ?> >2000
                                                                    </option>
                                                                    <option value="2500"
                                                                            <?php if($leadlist->perPage() == 2500): ?> selected <?php endif; ?> >2500
                                                                    </option>
                                                                    <option value="4000"
                                                                            <?php if($leadlist->perPage() == 4000): ?> selected <?php endif; ?> >4000
                                                                    </option>
                                                                    <option value="4500"
                                                                            <?php if($leadlist->perPage() == 4500): ?> selected <?php endif; ?> >4500
                                                                    </option>
                                                                    <option value="6000"
                                                                            <?php if($leadlist->perPage() == 6000): ?> selected <?php endif; ?> >6000
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
                                 
                                 <div id="tabledata" class="table-responsive">
                                         <table id="user_table" class="table table-bordered  text-center">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#Rank</th>
                                                    <th scope="col">User Name</th>
                                                    <th scope="col">Email Id</th>
                                                    <th scope="col">Total Time Spent (in Second)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if(count($leadlist) > 0): ?>
                                                    <?php $i=1; ?>
                                                    <?php $__currentLoopData = $leadlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td><?php echo e($i++); ?></td>
                                                        <td><?php echo e(ucfirst($list->lm_fullname)); ?></td>
                                                        <td><?php echo e($list->lm_email); ?></td>
                                                        <td><?php echo e(round($list->total_points,1)); ?></td>
                                                    </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php else: ?>
                                                <tr>
                                                    <td colspan="4" class="text-danger">No data available</td>
                                                </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                 </div>

                                    <?php if(count($leadlist) > 0): ?>
                                        <div class="col-md-12">
                                            <nav aria-label="Page navigation example">
                                                <ul class="pagination">
                                                    <li class="page-item">
                                                        <a class="page-link" href="<?php echo e($leadlist->previousPageUrl()); ?>" tabindex="-1">Previous</a>
                                                    </li>
                                                     <?php for($i=1;$i<=$leadlist->lastPage();$i++): ?>
                                                    <li class="page-item <?php echo e($leadlist->currentPage() ==  $i ? 'active' : ''); ?>">
                                                        <a class="page-link" href="<?php echo e($leadlist->url($i)); ?>"><?php echo e($i); ?> <span class="sr-only">(current)</span></a>
                                                    </li>
                                                     <?php endfor; ?>
                                                    
                                                    <li class="page-item">
                                                        <a class="page-link" href="<?php echo e($leadlist->nextPageUrl()); ?>">Next</a>
                                                    </li>
                                                </ul>
                                            </nav>
                                            <p class="float-left">
                                            Displaying <?php echo e($leadlist->count()); ?> of <?php echo e($leadlist->total()); ?> user(s).
                                            </p>
                                        </div>
                                    <?php endif; ?>
                                </div>
                        </div>
                    </div>
                </div>
                             
            </div>
            
  
  <!--------Group List Modal --->
    <div class="modal fade" id="groupMemberModal" role="dialog">
        <div class="modal-dialog modal-lg" style="width:1100px;">
        
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Group Member List</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
                </div>
                <div class="modal-body">
                    <div id="tabledata" class="table-responsive" style="min-height: 359px;">
                        <table id="user_table" class="table table-bordered  text-center">
                            <thead>
                            <tr>
                            <th scope="col">#</th>
                                <th scope="col">User Name</th>
                                <th scope="col">Student Id</th>
                                <th scope="col">Group Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Degree</th>
                            </tr>
                            </thead>
                            <tbody id="group_member_id"></tbody>
                        </table>
                    </div>
                </div>
            </div>
        
        </div>
    </div>
      
<?php $__env->stopSection(); ?>


<?php $__env->startSection('page-js'); ?>
<script src="<?php echo e(asset('assets/js/vendor/pickadate/picker.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/vendor/pickadate/picker.date.js')); ?>"></script>



<?php $__env->stopSection(); ?>

<?php $__env->startSection('bottom-js'); ?>
<script src="<?php echo e(asset('assets/js/form.basic.script.js')); ?>"></script>

<script src="<?php echo e(asset('assets/js/vendor/echarts.min.js')); ?>"></script>

   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
               
              
              function ViewBoothServeyPointList(boothId)
              {
                  console.log(boothId);
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "post",
                        url: 'get-question-score',
                        data: 'boothId='+boothId,
                        success: function (data) {
                            var result = JSON.parse(data);
                            console.log(result.code);
                            if(result.code == 200)
                            {
                                console.log('check11');
                                $('#point_id').html(result.html);
                                $('#myModal').modal('show');
                            }
                            else{
                                console.log(result.code);
                            }
                        }      
                
                    });
              }
              
              
              function GroupMemberModal(groupId,userId)
              {
                  //console.log(groupId);
                  $('#group_member_id').html('');
                  $('#groupMemberModal').modal('show');
                  $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "post",
                        url: 'get-group-member-list',
                        data: 'group_id='+groupId+'&user_id='+userId,
                        success: function (data) {
                            var result = JSON.parse(data);
                            console.log(result.code);
                            if(result.code == 200)
                            {
                                $('#group_member_id').html(result.html);
                                //$('#groupMemberModal').modal('show');
                            }
                            else{
                                console.log(result.code);
                            }
                        }      
                
                    });
              }
              
              function UpdateQAResult(userId,index)
              {
                  return false;
                  var qa_result = $('#qa_result_'+index).val();
                  if(qa_result!='')
                  {
                      $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "post",
                        url: 'update-avatar-qa-result',
                        data: 'user_id='+userId+'&qa_result='+qa_result,
                        success: function (data) {
                            var result = JSON.parse(data);
                            console.log(result.code);
                            if(result.code == 200)
                            {
                                swal('Success','Student QA Result Updated Successfully!','success');
                                setTimeout(function() {
                                    location.reload(true);
                                }, 2000);
                    
                                
                            }
                            else{
                                console.log(result.code);
                            }
                        }      
                
                    });
                  }
              }
              
              
              function submitQA(userId,index)
              {
                  var qa_result = $('#qa_result_'+index).val();
                  var qa_remark = $('#qa_remark_'+index).val();
                  
                  if(qa_result=='')
                  {
                      $('#qa_result_'+index).focus();
                      return false;
                  }
                  else if(qa_remark=='')
                  {
                      $('#qa_remark_'+index).focus();
                      return false;
                  }
                  else {
                      $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "post",
                        url: 'update-avatar-qa-result',
                        data: 'user_id='+userId+'&qa_result='+qa_result+'&qa_remark='+qa_remark,
                        success: function (data) {
                            var result = JSON.parse(data);
                            console.log(result.code);
                            if(result.code == 200)
                            {
                                swal('Success','Student QA Result Updated Successfully!','success');
                                setTimeout(function() {
                                    location.reload(true);
                                }, 2000);
                    
                                
                            }
                            else{
                                console.log(result.code);
                            }
                        }      
                
                    });
                  }
              }
    
    function SendAvatarMail(lemmId,indexId) 
    {
        //return false;
        $('#recreate_btn_'+indexId).prop("disabled", true);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: 'avatar-mail-sent',
            data: 'lemmId='+lemmId,
            success: function (data) {
                var result = JSON.parse(data);
                if(result.code == 200)
                {
                    swal('Success','Avatar Mail Sent Successfully!','success');
                    $('#recreate_btn_'+indexId).removeClass('btn-outline-danger').addClass('btn-outline-success').text('Avatar Mail Sent');
                    setTimeout(function() {
                        //location.reload(true);
                        swal.close();
                    }, 2000);
                }
                else{
                    console.log(result.code);
                    $('#recreate_btn_'+indexId).prop("disabled", false);
                }
            }      
    
        });
    }
    
    
    
    function SendReminderAvatarMail(lemmId,indexId) 
    {
        //return false;
        $('#recreate_reminder_btn_'+indexId).prop("disabled", true);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: 'avatar-mail-sent',
            data: 'lemmId='+lemmId,
            success: function (data) {
                var result = JSON.parse(data);
                if(result.code == 200)
                {
                    swal('Success','Reminder Avatar Mail Sent Successfully!','success');
                    $('#recreate_reminder_btn_'+indexId).prop("disabled", false);
                    setTimeout(function() {
                        swal.close();
                    }, 2000);
                }
                else{
                    console.log(result.code);
                    $('#recreate_reminder_btn_'+indexId).prop("disabled", false);
                }
            }      
    
        });
    }
    
    function GenerateUserVoice(lemmId,indexId) 
    {
        $('#generateVoice_btn_'+indexId).prop("disabled", true);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "post",
            url: 'generate-user-voice',
            data: 'lemmId='+lemmId,
            success: function (data) {
                var result = JSON.parse(data);
                if(result.code == 200)
                {
                    swal('Success','Voice Generated Successfully!','success');
                    $('#generateVoice_btn_'+indexId).prop('disabled',false);
                    setTimeout(function() {
                        location.reload(true);
                    }, 2000);
                }
                else{
                    console.log(result.code);
                    $('#generateVoice_btn_'+indexId).prop("disabled", false);
                }
            }      
    
        });
    }
    
    function ReUploadSelfie(userId,index)
    {
        var reupload_selfie = $('#reupload_selfie_'+index)[0];
                  
        if(reupload_selfie.files.length < 1)
        {
            $('#reupload_selfie_'+index).focus();
            return false;
        }
                 
        else {
            
            var formdata = new FormData();
            formdata.append("re_selfie", reupload_selfie.files[0]);
            formdata.append("user_id", userId);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "post",
                url: 'update-avatar-selfie',
                data: formdata,
                processData: false,
                contentType: false,
                success: function (data) {
                    var result = JSON.parse(data);
                    console.log(result.code);
                    if(result.code == 200)
                    {
                        swal('Success','Student Selfie Updated Successfully!','success');
                        setTimeout(function() {
                            location.reload(true);
                        }, 2000);
                    }
                    else{
                        console.log(result.code);
                    }
                }      
        
            });
        }
    }
            
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/megaspace/public_html/admin/resources/views/customers/Reports/treasure_hunt_report.blade.php ENDPATH**/ ?>