  <thead>
                                        <tr>
                                            <th scope="col">Package Name</th>
                                            <th scope="col">No. Of Users</th>
                                            <th scope="col">Custom Landing Page</th>
                                            <th scope="col">Unique URL</th>
                                            <th scope="col">Templates</th>
                                            <th scope="col">Branding & Personalized Content</th>
                                            <th scope="col">Custom Avatars</th>
                                            <th scope="col">NPCs</th>
                                            <th scope="col">Videos</th>
                                            <th scope="col">Access</th>
                                            <th scope="col">Live Voice & Text Interactions</th>
                                            <th scope="col">Breakout rooms for one to one Interactions</th>
                                            <th scope="col">Platforms</th>
                                            <th scope="col">Analytics</th>
                                            <th scope="col">Preferred Support</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                    <?php $__empty_1 = true; $__currentLoopData = $Alldata; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            
                                            <td scope="row"><?php echo e($list->pm_name); ?></td>
                                            <td></td>
                                            <td><button class="btn btn-success"><?php echo e(ucfirst($list->pm_custom_landing_page)); ?></button></td>
                                            <td><button class="btn btn-success"><?php echo e(ucfirst($list->pm_unique_url)); ?></button></td>
                                            <td></td>
                                            <td scope="row"><button class="btn btn-success"><?php echo e(ucfirst($list->pm_branding_personalized_content)); ?></button></td>
                                            <td><button class="btn btn-success"><?php echo e(ucfirst($list->pm_custom_avatars)); ?></button></td>
                                            <td><button class="btn <?php echo e($list->pm_npc=='yes' ? 'btn-success':'btn-danger'); ?>"><?php echo e(ucfirst($list->pm_npc)); ?></button></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <a href="javascript:void(0);" class="text-success mr-2 edit1" data-id="<?php echo e($list->id); ?>" onclick="addeditprospect('<?php echo e($list->id); ?>');"><i class="nav-icon i-Pen-2 font-weight-bold"></i></a>
                                                <a href="javascript:void(0);" class="text-danger mr-2"><i class="nav-icon i-Close-Window font-weight-bold" onclick="statusProspect('<?php echo e($list->id); ?>');"></i></a>
                                                 
                                            </td>
                                            
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="11" style="text-align:center">No Packages to display.</td>
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
<?php /**PATH /home/metagraha/public_html/induction/admin/resources/views/datatables/package_table_content.blade.php ENDPATH**/ ?>