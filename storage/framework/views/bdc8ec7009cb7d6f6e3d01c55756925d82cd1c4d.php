  <thead>
                                        <tr>
                                            <th scope="col">UTM Source</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email
                                                <div class="divider">Mobile</div>
                                            </th>
                                            <th scope="col">Company Website
                                             <div class="divider">Company Name</div>
                                            </th>
                                            <!--<th scope="col">Event Name-->
                                            <!--<div class="divider">Event Date</div>-->
                                            <!--</th>-->
                                            <th scope="col">Front-End URL</th>
                                            <th scope="col">Login Id
                                            <div class="divider">Password</div>
                                            <div class="divider">Login URL</div>
                                            </th>
                                            <th scope="col">Register Date
                                                <div class="divide"> Register Time </div>
                                            </th>
                                            <th scope="col">Ip Address</th>
                                            <th>Project Modules</th>
                                            <th scope="col">Action</th>
                                            <th scope="col">Lead Stage</th>
                                            <th scope="col">Credentials</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                    <?php $__empty_1 = true; $__currentLoopData = $Alldata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            
                                            <td scope="row"><?php echo e($list->utm_source); ?></td>
                                            <td><?php echo e($list->cd_full_name); ?></td>
                                            <td><?php echo e($list->cd_email); ?>

                                                <div><?php echo e($list->cd_phone); ?></div>
                                            </td>
                                            <td><?php echo e($list->cd_company_website); ?>

                                               <div> <?php echo e($list->cd_company_name); ?></div>
                                            </td>
                                            <!--<td scope="row"><?php echo e($list->cd_event_name); ?>-->
                                            <!--   <div> <?php echo e($list->cd_event_date); ?></div>-->
                                            <!--</td>-->
                                            <td>
                                                <?php if(!empty($list->bm_nickname)): ?>
                                                <span class="text-primary">
                                                    <a href="https://induction.ibentos.com/<?php echo e($list->bm_nickname); ?>" title="View" target="_blank">
                                                        https://induction.ibentos.com/<?php echo e($list->bm_nickname); ?>

                                                    </a>
                                                </span> 
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo e($list->login_id); ?>

                                               <div><?php echo e($list->password); ?> </div>
                                               <div>
                                                   <?php if(!empty($list->bm_nickname)): ?>
                                                   <span class="text-primary">https://induction.ibentos.com/admin/<?php echo e($list->bm_nickname); ?></span> 
                                                   <?php endif; ?>
                                               </div>
                                            </td>
                                            <td scope="row"><?php echo e(date('d-M,Y',strtotime($list->created_at))); ?>

                                                <div class="divide"> <?php echo e(date('h:i A',strtotime($list->created_at))); ?></div>
                                            </td>
                                            <td><?php echo e($list->cd_ipAddress); ?></td>
                                            <td><?php if($list->lead_stage != 'prospect'): ?>
                                                <a href="<?php echo e(url('/settings',$list->id)); ?>"><button type="button"class="btn btn-primary m-1">setting</button></a>
                                            <?php endif; ?>
                                          </td>
                                            <td>
                                                <a href="javascript:void(0);" class="text-success mr-2 edit1" data-id="<?php echo e($list->id); ?>" onclick="addeditprospect('<?php echo e($list->id); ?>');"><i class="nav-icon i-Pen-2 font-weight-bold"></i></a>
                                                <a href="javascript:void(0);" class="text-danger mr-2"><i class="nav-icon i-Close-Window font-weight-bold" onclick="statusProspect('<?php echo e($list->id); ?>');"></i></a>
                                                 
                                            </td>
                                            <td> 
                                                <select class="from-control ledStage" data-id="<?php echo e($list->id); ?>">
                                                     <option value="prospect" <?php echo e($list->lead_stage == 'prospect'  ? 'selected' : ''); ?>>Prospect</option>
                                                     <option value="paid" <?php echo e($list->lead_stage == 'paid'  ? 'selected' : ''); ?>>Paid</option>
                                                     <option value="trail" <?php echo e($list->lead_stage == 'trail'  ? 'selected' : ''); ?>>Trail</option>
                                                </select>
                                             </td>
                                            <td>
                                                <a href="javascript:void(0);"><button type="button"class="btn btn-primary m-1"  data-id="<?php echo e($list->id); ?>" onclick="mailcontent('<?php echo e($list->id); ?>');" data-toggle="modal" data-target="#MailModal">Send credentials</button></a>
                                            </td>
                                            
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="11" style="text-align:center">No customers to display.</td>
                                        </tr> 
                                    <?php endif; ?>
                                         </tbody>
                                    <!--<tfoot>-->
                                    <!--    <tr>-->
                                    <!--        <th>Name</th>-->
                                    <!--        <th>Email</th>-->
                                    <!--        <th>Number</th>-->
                                    <!--        <th>Company Website</th>-->
                                    <!--        <th>Event Name</th>-->
                                    <!--        <th>Event Date</th>-->
                                    <!--    </tr>-->
                                    <!--</tfoot>-->
<?php /**PATH /home/metagraha/public_html/induction_testing/admin/resources/views/datatables/table_content.blade.php ENDPATH**/ ?>