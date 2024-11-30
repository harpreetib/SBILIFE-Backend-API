<?php
$i=1
?>
<?php $__currentLoopData = $leadList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

  <tr>
      <th scope="row"><?php echo e($i++); ?></th>

      <td scope="row"><?php echo e(date('d-M,Y',strtotime($list->leem_datetime))); ?>

      <div class="divide"> <?php echo e(date('h:i A',strtotime($list->leem_datetime))); ?></div></td>
      <td><?php echo e(ucfirst($list->lm_fullname)); ?></td>
      <td><?php echo e($list->lm_email); ?></td>
        <td><?php echo e($list->lm_mobile); ?></td>
        
        <td><?php echo e($list->lm_designation); ?>

            <div class="divide"><?php echo e($list->lm_company_name); ?></div>
        </td>
      
      <td> 
        <span class="btn p-1 m-0 " onclick="showEnquiry('<?php echo e($list->lm_mobile); ?>','<?php echo e($list->lm_email); ?>');" > View Enquiry</span>
      </td>
  </tr>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH /home/megaspace/public_html/admin/resources/views/exhibitors/exhibitor_visitor_content.blade.php ENDPATH**/ ?>