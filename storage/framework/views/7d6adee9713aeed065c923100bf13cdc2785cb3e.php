<?php
$session=Session::get('session');

set_time_limit(4000); 
header('Set-Cookie: fileDownload=true; path=/');
header('Cache-Control: max-age=60, must-revalidate');
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=AttendanceReport.xls");
header("Pragma: no-cache");
header("Expires: 0"); 
?>

<table id="user_table" border="1" class="table table-bordered  text-center">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Date Of Visit</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Mobile</th>
                                                    <th>Designation</th>
                                                    <th>Organisation</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $__currentLoopData = $leadlist; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($list->lemma_datetime); ?></td>
                                                    <td><?php echo e(ucwords($list->lm_fullname)); ?></td>
                                                    <td><?php echo e($list->lm_email); ?></td>
                                                    <td><?php echo e($list->lm_mobile); ?></td>
                                                    <td><?php echo e($list->lm_designation); ?></td>
                                                    <td><?php echo e($list->lm_company_name); ?></td>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table><?php /**PATH /home/megaspace/public_html/admin/resources/views/customers/download_attendence_report.blade.php ENDPATH**/ ?>