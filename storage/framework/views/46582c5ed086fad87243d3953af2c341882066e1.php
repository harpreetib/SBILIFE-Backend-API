<!----------------------------------->
<style>
hr {
    margin-top: unset;
    margin-bottom: unset;
    border: 0;
    border-top: 1px solid rgba(0, 0, 0, .1);
    height: 0;
}
</style>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card mb-5">
                                    
            <div class="card-body">
                <div class="row row-xs">


                        <div class="col-md-12 mt-3 mt-md-0">
                        <!--h4 class="modal-title text-blue" id="modelTile"> # Akhilesh Yadav ( 9891787418 )</h4-->
                        <div class="card-body">

                            <h6 class="yelloworder text-white px-2 py-1 rounded d-inline-block">Messages</h6>
                            <div class="row" style="max-height: 225px;overflow: auto;">
                            <div class="col-md-12">

                                <?php if(!empty($showEnquirys)): ?>
                                 <div>
                                 <table>
                                        <tr >
                                            <th style="border: 1px solid;">Full Name</th>
                                            <th style="border: 1px solid;">Email</th>
                                            <th style="border: 1px solid;">Designation<hr> Company Name</th>
                                            <th style="border: 1px solid;">Enquiry Message</th>
                                        </tr>
                                        <?php $__currentLoopData = $showEnquirys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $enquiryData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        
          
        
                                               
                                                
                                                        <tr style="border-top: 1px solid #ced4db;" >
                                                            <td style="border: 1px solid;" class="text-grey bg-light p-2 mb-2 rounded border"><?php echo e(ucfirst($enquiryData->ind_fullname)); ?></td>
                                                            <td style="border: 1px solid;" class="text-grey bg-light p-2 mb-2 rounded border">
                                                                <?php echo e($enquiryData->ind_email); ?>

                                                            </td>
                                                            <td style="border: 1px solid;" class="text-grey bg-light p-2 mb-2 rounded border">
                                                                
                                                                <strong><?php echo e($enquiryData->ind_designation); ?> </strong> 
                                                                <hr>
                                                               <?php echo e($enquiryData->ind_company_name); ?>

                                                                
                                                                </td>
                                                            <td style="border: 1px solid;" class="text-grey bg-light p-2 mb-2 rounded border"><?php echo e($enquiryData->ind_message); ?></td>
                                                        </tr>
                                                        
                                                   
                                               
        
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                 </table>
                                <!--<span class=""> <strong>   </strong></span>-->
                                <!--<div class="media-body pl-1" style="border-top: 1px solid #ced4db;"></div>-->
                                 </div>
                                <?php endif; ?>

                            </div>
                            </div>

                        </div>
                        </div>


                                
                         
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
            
<!-----------------------------------><?php /**PATH /home/megaspace/public_html/admin/resources/views/exhibitors/showEnquiry.blade.php ENDPATH**/ ?>