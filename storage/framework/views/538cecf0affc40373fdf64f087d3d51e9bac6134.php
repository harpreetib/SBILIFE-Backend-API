<?php
$i=1
?>
<?php $__currentLoopData = $leadList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                      <tr>
                                          <th scope="row"><?php echo e($i++); ?></th>

                                          <!--<td scope="row"><?php echo e(date('d-M,Y',strtotime($list->leem_datetime))); ?>-->
                                          <!--      <div class="divide"> <?php echo e(date('h:i A',strtotime($list->leem_datetime))); ?></div></td>-->

                                         
                                          <td>
                                                <?php echo e(ucfirst($list->lm_fullname)); ?>

                                                <div class="divide"><?php echo e($list->lm_email); ?> </div>
                                                <div class="divide"><?php echo e($list->lm_mobile); ?>

                                          </td>

                                         
                                          <td style="font-size: 11px;"><?php echo $list->activity; ?></td>

                                          
                                          <td> 
                                                <?php if(Session::has('profileDetail') && in_array(Session::get('profileDetail')->at_id, array('4','3','8'))): ?>
                                                      <!--<a href="javascript:void(0);" class="text-success mr-2" onclick="addcate('<?php echo e($list->leem_id); ?>');">-->
                                                      <!--<span class="badge badge-pill badge-outline-primary p-1 m-0" id="status<?php echo e($list->leem_id); ?>" ><?php echo e($list->lc_text); ?> &nbsp;<i class="nav-icon i-Pen-2 font-weight-bold"></i> </span></a>-->
                                                      
                                                <?php endif; ?>     
                                                <span class="btn p-1 m-0" onclick="showhistory('<?php echo e($list->leem_id); ?>');" >View</span>
                                                 <?php if(strpos($list->activity,'Send Inquiry')==true): ?>
                                                <span class="btn p-1 m-0 " onclick="showEnquiry('<?php echo e($list->lm_mobile); ?>','<?php echo e($list->lm_email); ?>');" > / View Enquiry</span>
                                                <?php endif; ?>
                                                <?php if(strpos($list->activity,'Send Quotation')==true): ?>
                                                <span class="btn p-1 m-0" onclick="showQuotation('<?php echo e($list->lm_mobile); ?>','<?php echo e($list->lm_email); ?>');" > / View Quotation</span>
                                                <?php endif; ?>


                                                <div class="divide">
                                                <span  ><?php echo e(ucwords($list->last_interaction_by)); ?></span></div>
                                          </td>
                                          
                                           <td>
                                                                                                    <!--<a href="javascript:void(0);" onclick="whatsappCall(this, `<?php echo e(Session::get('session')[0]->exhim_id); ?>`);" data-id="+<?php echo e($list->lm_country_code); ?><?php echo e($list->lm_mobile); ?>" data-link="<?php echo e(config('app.siteBaseUrl')); ?>/<?php echo e(Session::get('selectedEvent')->aem_event_nickname); ?>.php?reg=<?php echo e(base64_encode($list->lemmid)); ?>&univsty=<?php echo e(base64_encode($profileDetail->exhim_id)); ?>" data-text="<?php echo e($list->lm_fullname); ?>">-->
                                                                                                    <!--    <button class="btn btn-secondary">-->
                                                                                                    <!--        <svg  width="19" height="19" viewBox="0 0 39 39">-->
                                                                                                    <!--        <path fill="#00E676" d="M10.7 32.8l.6.3c2.5 1.5 5.3 2.2 8.1 2.2 8.8 0 16-7.2 16-16 0-4.2-1.7-8.3-4.7-11.3s-7-4.7-11.3-4.7c-8.8 0-16 7.2-15.9 16.1 0 3 .9 5.9 2.4 8.4l.4.6-1.6 5.9 6-1.5z"></path><path fill="#FFF" d="M32.4 6.4C29 2.9 24.3 1 19.5 1 9.3 1 1.1 9.3 1.2 19.4c0 3.2.9 6.3 2.4 9.1L1 38l9.7-2.5c2.7 1.5 5.7 2.2 8.7 2.2 10.1 0 18.3-8.3 18.3-18.4 0-4.9-1.9-9.5-5.3-12.9zM19.5 34.6c-2.7 0-5.4-.7-7.7-2.1l-.6-.3-5.8 1.5L6.9 28l-.4-.6c-4.4-7.1-2.3-16.5 4.9-20.9s16.5-2.3 20.9 4.9 2.3 16.5-4.9 20.9c-2.3 1.5-5.1 2.3-7.9 2.3zm8.8-11.1l-1.1-.5s-1.6-.7-2.6-1.2c-.1 0-.2-.1-.3-.1-.3 0-.5.1-.7.2 0 0-.1.1-1.5 1.7-.1.2-.3.3-.5.3h-.1c-.1 0-.3-.1-.4-.2l-.5-.2c-1.1-.5-2.1-1.1-2.9-1.9-.2-.2-.5-.4-.7-.6-.7-.7-1.4-1.5-1.9-2.4l-.1-.2c-.1-.1-.1-.2-.2-.4 0-.2 0-.4.1-.5 0 0 .4-.5.7-.8.2-.2.3-.5.5-.7.2-.3.3-.7.2-1-.1-.5-1.3-3.2-1.6-3.8-.2-.3-.4-.4-.7-.5h-1.1c-.2 0-.4.1-.6.1l-.1.1c-.2.1-.4.3-.6.4-.2.2-.3.4-.5.6-.7.9-1.1 2-1.1 3.1 0 .8.2 1.6.5 2.3l.1.3c.9 1.9 2.1 3.6 3.7 5.1l.4.4c.3.3.6.5.8.8 2.1 1.8 4.5 3.1 7.2 3.8.3.1.7.1 1 .2h1c.5 0 1.1-.2 1.5-.4.3-.2.5-.2.7-.4l.2-.2c.2-.2.4-.3.6-.5s.4-.4.5-.6c.2-.4.3-.9.4-1.4v-.7s-.1-.1-.3-.2z">-->
                                                                                                                
                                                                                                    <!--        </path>-->
                                                                                                    <!--        </svg>-->
                                                                                                    <!--        </button>-->
                                                                                                    <!--</a><br>-->
                                                                                                     <a  class="d-none" href="javascript:void(0);" onclick="sendMail22('<?php echo e(ucfirst($list->lm_fullname)); ?>','<?php echo e(base64_encode($list->lemmid)); ?>','<?php echo e($list->lm_email); ?>');" ><button class="btn btn-secondary"><i class="icon-regular i-Mail-2"></i></button></a><br>
                                                                                                       <button type="button" onclick="startChat('<?php echo e($list->lemmid); ?>','<?php echo e($list->lm_fullname); ?>','<?php echo e($list->lm_email); ?>')" class="btn btn-outline-success btn-excel" >Start Chat</button>
                                                                                                        <!-- <a href="#" onclick="sendMail('<?php echo e(ucfirst($list->lm_fullname)); ?>','<?php echo e(base64_encode($list->lemmid)); ?>','<?php echo e($list->lm_email); ?>')" ><button class="btn btn-secondary"><i class="icon-regular i-Mail-2"></i></button></a><br>-->
                                                                                                        <!--<a href="#" onclick="SendSMS('<?php echo e(ucfirst($list->lm_fullname)); ?>','<?php echo e(base64_encode($list->lemmid)); ?>','<?php echo e($list->lm_mobile); ?>')" ><button class="btn btn-secondary"><svg  width="19" height="19" viewBox="0 0 24 24"><path d="M2.001 9.352c0 1.873.849 2.943 1.683 3.943.031 1 .085 1.668-.333 3.183 1.748-.558 2.038-.778 3.008-1.374 1 .244 1.474.381 2.611.491-.094.708-.081 1.275.055 2.023-.752-.06-1.528-.178-2.33-.374-1.397.857-4.481 1.725-6.649 2.115.811-1.595 1.708-3.785 1.661-5.312-1.09-1.305-1.705-2.984-1.705-4.695-.001-4.826 4.718-8.352 9.999-8.352 5.237 0 9.977 3.484 9.998 8.318-.644-.175-1.322-.277-2.021-.314-.229-3.34-3.713-6.004-7.977-6.004-4.411 0-8 2.85-8 6.352zm20.883 10.169c-.029 1.001.558 2.435 1.088 3.479-1.419-.258-3.438-.824-4.352-1.385-.772.188-1.514.274-2.213.274-3.865 0-6.498-2.643-6.498-5.442 0-3.174 3.11-5.467 6.546-5.467 3.457 0 6.546 2.309 6.546 5.467 0 1.12-.403 2.221-1.117 3.074zm-7.424-2.429c0-.206-.061-.378-.184-.517-.125-.139-.318-.255-.584-.349-.242-.085-.393-.155-.455-.208-.129-.108-.133-.292.018-.394.075-.051.18-.077.312-.077.217 0 .428.046.627.14l.15-.524c-.221-.1-.475-.149-.768-.149-.336 0-.605.082-.807.244s-.303.37-.303.622c0 .39.273.675.822.858.184.061.311.121.385.179.156.123.146.338-.012.446-.082.056-.195.083-.342.083-.255 0-.504-.062-.752-.188l-.137.542c.244.123.527.184.846.184.371 0 .662-.083.869-.248.211-.164.315-.379.315-.644zm3.656.846l-.154-2.875h-.906l-.613 1.983-.508-1.983h-.895l-.184 2.875h.615l.102-2.321h.008s.352 1.439.59 2.273h.516c.396-1.209.631-1.968.699-2.273h.014c0 .406.021 1.18.067 2.321h.649zm2.451-.846c0-.209-.064-.386-.189-.527-.124-.14-.322-.259-.59-.353-.237-.084-.389-.154-.449-.205-.123-.103-.125-.273.016-.369.072-.049.176-.074.305-.074.232 0 .435.052.637.147l.158-.556-.012-.006c-.221-.1-.48-.15-.774-.15-.338 0-.612.083-.815.248-.205.165-.311.379-.311.634 0 .396.281.688.836.872.179.061.306.12.379.177.146.115.14.318-.012.42-.078.054-.19.081-.333.081-.274 0-.521-.072-.761-.195l-.145.574c.273.136.559.19.863.19.374 0 .67-.084.879-.251.211-.167.318-.388.318-.657z"/></svg></button>-->
                                                                                                        <!--</a>-->
                                                                                                </td>
                                          <!-- <?php if($profileDetail->exhim_NoPaperForms=='yes'): ?>-->
                                                
                                          <!--      <td>-->
                                          <!--          <?php if($list->leem_nopaper_sync=='Y'): ?>-->
                                          <!--          <a href="#" id="sync<?php echo e($list->leem_id); ?>" class="btn btn-success">-->
                                          <!--              Synced-->
                                          <!--              </a>-->
                                          <!--              <?php else: ?>-->
                                          <!--              <a href="#" id="sync<?php echo e($list->leem_id); ?>"  onclick="SynctoNoPaperForms('<?php echo e($list->leem_id); ?>')" class="btn btn-primary">-->
                                          <!--              Sync-->
                                          <!--              </a>-->
                                          <!--              <?php endif; ?>-->
                                          <!--       </td>-->
                                          <!--  <?php endif; ?>-->
                                            
                                      </tr>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH /home/megaspace/public_html/admin/resources/views/datatables/visitor_content.blade.php ENDPATH**/ ?>