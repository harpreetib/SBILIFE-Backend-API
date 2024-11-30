 
                           
                                    <?php $__currentLoopData = $commonFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rfm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($rfm->rfm_type == 'text'): ?>
                                        <input name="rfm_id<?php echo e($rfm->rfm_id); ?>" value="" class="wpcf7-form-control form-control" placeholder="Enter <?php echo e($rfm->rfm_name); ?>" type="<?php echo e($rfm->rfm_type); ?>">
                                        <?php endif; ?>
                                        
                                        <?php if($rfm->rfm_type == 'select'): ?>
                                            
                                            <?php
                                                $optionsCom = array();
                                                if($rfm->rfm_values != null){
                                                    $strCom = $rfm->rfm_values;
                                                    $optionsCom = explode('^',$rfc->rfc_values);
                                                }
                                                
                                            ?>
                                           <select name="rfm_id<?php echo e($rfm->rfm_id); ?>" class="wpcf7-form-control wpcf7-select lgx-select">
                                               <option value=""><?php echo e($rfm->rfm_name); ?></option>
                                               <?php $__currentLoopData = $optionsCom; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optCom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($optCom); ?>"><?php echo e($optCom); ?></option>
                                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select> 
                                        <?php endif; ?>
                                        
                                        <?php if($rfm->rfm_type == 'checkbox'): ?>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>
                                                <input name="rfm_id<?php echo e($rfm->rfm_id); ?>" value="" class="" type="<?php echo e($rfm->rfm_type); ?>">
                                                </label>
                                            </div>
                                            <div class="col-md-10">
                                                <p style="color:#fff;"><?php echo e($rfm->rfm_label); ?></p>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    
                                    <?php $__currentLoopData = $customFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rfc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($rfc->rfc_type == 'text'): ?>
                                        <input name="rfc_id<?php echo e($rfc->rfc_id); ?>" value="" class="wpcf7-form-control form-control" placeholder="Enter <?php echo e($rfc->rfc_label); ?>" type="<?php echo e($rfc->rfc_type); ?>">
                                        <?php endif; ?>
                                        
                                        <?php if($rfc->rfc_type == 'select'): ?>
                                            
                                            <?php
                                                $options = array();
                                                if($rfc->rfc_values != null){
                                                    $str = $rfc->rfc_values;
                                                    $options = explode('^',$rfc->rfc_values);
                                                }
                                                
                                            ?>
                                           <select name="rfc_id<?php echo e($rfc->rfc_id); ?>" class="wpcf7-form-control wpcf7-select lgx-select">
                                               <option value=""><?php echo e($rfc->rfc_label); ?></option>
                                               <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $opt): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($opt); ?>"><?php echo e($opt); ?></option>
                                               <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select> 
                                        <?php endif; ?>
                                        
                                        <?php if($rfc->rfc_type == 'checkbox'): ?>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>
                                                <input name="rfc_id<?php echo e($rfc->rfc_id); ?>" value="" class="" type="<?php echo e($rfc->rfc_type); ?>">
                                                </label>
                                            </div>
                                            <div class="col-md-10">
                                                <p style="color:#fff;"><?php echo e($rfc->rfc_label); ?></p>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                         <?php if($rfc->rfc_type == 'radio'): ?>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>
                                                <input name="field_<?php echo e($rfc->rfc_id); ?>" value="<?php echo e($rfc->rfc_values); ?>" class="" showAttr ="<?php echo e($rfc->rfc_label); ?>" idAttr ="field_<?php echo e($rfc->rfc_id); ?>" type="<?php echo e($rfc->rfc_type); ?>" <?php echo e(($rfc->is_mandatory == 'on') ? 'required':''); ?>/>
                                                </label>
                                            </div>
                                            <div class="col-md-10">
                                                <p style="color:#fff;"><?php echo e($rfc->rfc_label); ?></p>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        
                                        <?php if($rfc->rfc_type == 'file'): ?>
                                        <input name="field_<?php echo e($rfc->rfc_id); ?>" id="field_<?php echo e($rfc->rfc_id); ?>" showAttr="<?php echo e($rfc->rfc_label); ?>" idAttr ="field_<?php echo e($rfc->rfc_id); ?>" class="wpcf7-form-control form-control" placeholder="Enter <?php echo e($rfc->rfc_label); ?>" type="<?php echo e($rfc->rfc_type); ?>" <?php echo e(($rfc->is_mandatory == 'on') ? 'required':''); ?>/>
                                        <?php endif; ?>
                                         <?php if($rfc->rfc_type == 'textarea'): ?>
                                        <input name="field_<?php echo e($rfc->rfc_id); ?>" id="field_<?php echo e($rfc->rfc_id); ?>" showAttr="<?php echo e($rfc->rfc_label); ?>" idAttr ="field_<?php echo e($rfc->rfc_id); ?>" class="wpcf7-form-control form-control" placeholder="Enter <?php echo e($rfc->rfc_label); ?>" type="<?php echo e($rfc->rfc_type); ?>" <?php echo e(($rfc->is_mandatory == 'on') ? 'required':''); ?>/>
                                        <?php endif; ?>
                                        
                                         <?php if($rfc->rfc_type == 'date'): ?>
                                        <input name="field_<?php echo e($rfc->rfc_id); ?>" id="field_<?php echo e($rfc->rfc_id); ?>" showAttr="<?php echo e($rfc->rfc_label); ?>" idAttr ="field_<?php echo e($rfc->rfc_id); ?>" class="wpcf7-form-control form-control" placeholder="Enter <?php echo e($rfc->rfc_label); ?>" type="<?php echo e($rfc->rfc_type); ?>" <?php echo e(($rfc->is_mandatory == 'on') ? 'required':''); ?>/>
                                        <?php endif; ?>
                                        <?php if($rfc->rfc_type == 'datetime-local'): ?>
                                        <input name="field_<?php echo e($rfc->rfc_id); ?>" id="field_<?php echo e($rfc->rfc_id); ?>" showAttr="<?php echo e($rfc->rfc_label); ?>" idAttr ="field_<?php echo e($rfc->rfc_id); ?>" class="wpcf7-form-control form-control" placeholder="Enter <?php echo e($rfc->rfc_label); ?>" type="<?php echo e($rfc->rfc_type); ?>" <?php echo e(($rfc->is_mandatory == 'on') ? 'required':''); ?>/>
                                        <?php endif; ?>
                                         <?php if($rfc->rfc_type == 'time'): ?>
                                        <input name="field_<?php echo e($rfc->rfc_id); ?>" id="field_<?php echo e($rfc->rfc_id); ?>" showAttr="<?php echo e($rfc->rfc_label); ?>" idAttr ="field_<?php echo e($rfc->rfc_id); ?>" class="wpcf7-form-control form-control" placeholder="Enter <?php echo e($rfc->rfc_label); ?>" type="<?php echo e($rfc->rfc_type); ?>" <?php echo e(($rfc->is_mandatory == 'on') ? 'required':''); ?>/>
                                        <?php endif; ?>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    
                                    <input value="Registration Now" class="wpcf7-form-control wpcf7-submit lgx-submit" type="submit">
                                
                           
                            
                            
                            
                                
                                <!--<input value="Registration Now" class="wpcf7-form-control wpcf7-submit lgx-submit" type="submit">--><?php /**PATH /home/eventsibentos/public_html/admin/resources/views/lpage/landingPageform.blade.php ENDPATH**/ ?>