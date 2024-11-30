<div class="modal-header">
   <h5 class="modal-title" id="exampleModalCenterTitle-2">
      <h4>Edit Event Details</h4>
   </h5>
   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   <span aria-hidden="true">&times;</span>
   </button>
</div>
<form  name="editexhibitor" id="editexhibitor" action="addevent" method="post" enctype="multipart/form-data">
   <?php echo e(csrf_field()); ?>

   <div class="modal-body">
      <div class="card mb-4">
         <div class="card-body">
            <div class="row">
               <div class="col-md-12 form-group mb-3">
                  <label for="course_fee_sem">Event Name</label>
                  <input type="text" class="form-control" name="el_name" id="el_name" placeholder="Event Name" 
                     value="<?php echo e($dataList->el_name); ?>">
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="modal-footer">
      <input type="hidden" class="form-control" value="<?php echo e($dataList->el_id); ?>" name="el_id" id="el_id">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <button type="submit" class="btn btn-primary ladda-button basic-ladda-button" data-style="expand-right" >Save</button>
   </div>
</form>
<script type="text/javascript">
   $(document).ready(function (e) {
       $('#editexhibitor').on('submit',(function(e) {
           e.preventDefault();
           var formData = new FormData(this);
           var urlAction = $(this).attr('action');
           AddEventData(urlAction, formData);
       }));
   });
</script><?php /**PATH /home/megaspace/public_html/admin/resources/views/superadmin/manage-stream/edit_stream.blade.php ENDPATH**/ ?>