 
                           
                                    @foreach($commonFields as $rfm)
                                        @if($rfm->rfm_type == 'text')
                                        <input name="rfm_id{{$rfm->rfm_id}}" value="" class="wpcf7-form-control form-control" placeholder="Enter {{$rfm->rfm_name}}" type="{{$rfm->rfm_type}}">
                                        @endif
                                        
                                        @if($rfm->rfm_type == 'select')
                                            
                                            <?php
                                                $optionsCom = array();
                                                if($rfm->rfm_values != null){
                                                    $strCom = $rfm->rfm_values;
                                                    $optionsCom = explode('^',$rfc->rfc_values);
                                                }
                                                
                                            ?>
                                           <select name="rfm_id{{$rfm->rfm_id}}" class="wpcf7-form-control wpcf7-select lgx-select">
                                               <option value="">{{$rfm->rfm_name}}</option>
                                               @foreach($optionsCom as $optCom)
                                                <option value="{{$optCom}}">{{$optCom}}</option>
                                               @endforeach
                                            </select> 
                                        @endif
                                        
                                        @if($rfm->rfm_type == 'checkbox')
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>
                                                <input name="rfm_id{{$rfm->rfm_id}}" value="" class="" type="{{$rfm->rfm_type}}">
                                                </label>
                                            </div>
                                            <div class="col-md-10">
                                                <p style="color:#fff;">{{$rfm->rfm_label}}</p>
                                            </div>
                                        </div>
                                        @endif
                                        
                                    @endforeach
                                    
                                    @foreach($customFields as $rfc)
                                        @if($rfc->rfc_type == 'text')
                                        <input name="rfc_id{{$rfc->rfc_id}}" value="" class="wpcf7-form-control form-control" placeholder="Enter {{$rfc->rfc_label}}" type="{{$rfc->rfc_type}}">
                                        @endif
                                        
                                        @if($rfc->rfc_type == 'select')
                                            
                                            <?php
                                                $options = array();
                                                if($rfc->rfc_values != null){
                                                    $str = $rfc->rfc_values;
                                                    $options = explode('^',$rfc->rfc_values);
                                                }
                                                
                                            ?>
                                           <select name="rfc_id{{$rfc->rfc_id}}" class="wpcf7-form-control wpcf7-select lgx-select">
                                               <option value="">{{$rfc->rfc_label}}</option>
                                               @foreach($options as $opt)
                                                <option value="{{$opt}}">{{$opt}}</option>
                                               @endforeach
                                            </select> 
                                        @endif
                                        
                                        @if($rfc->rfc_type == 'checkbox')
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>
                                                <input name="rfc_id{{$rfc->rfc_id}}" value="" class="" type="{{$rfc->rfc_type}}">
                                                </label>
                                            </div>
                                            <div class="col-md-10">
                                                <p style="color:#fff;">{{$rfc->rfc_label}}</p>
                                            </div>
                                        </div>
                                        @endif
                                         @if($rfc->rfc_type == 'radio')
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>
                                                <input name="field_{{$rfc->rfc_id}}" value="{{$rfc->rfc_values}}" class="" showAttr ="{{$rfc->rfc_label}}" idAttr ="field_{{$rfc->rfc_id}}" type="{{$rfc->rfc_type}}" {{($rfc->is_mandatory == 'on') ? 'required':''}}/>
                                                </label>
                                            </div>
                                            <div class="col-md-10">
                                                <p style="color:#fff;">{{$rfc->rfc_label}}</p>
                                            </div>
                                        </div>
                                        @endif
                                        
                                        @if($rfc->rfc_type == 'file')
                                        <input name="field_{{$rfc->rfc_id}}" id="field_{{$rfc->rfc_id}}" showAttr="{{$rfc->rfc_label}}" idAttr ="field_{{$rfc->rfc_id}}" class="wpcf7-form-control form-control" placeholder="Enter {{$rfc->rfc_label}}" type="{{$rfc->rfc_type}}" {{($rfc->is_mandatory == 'on') ? 'required':''}}/>
                                        @endif
                                         @if($rfc->rfc_type == 'textarea')
                                        <input name="field_{{$rfc->rfc_id}}" id="field_{{$rfc->rfc_id}}" showAttr="{{$rfc->rfc_label}}" idAttr ="field_{{$rfc->rfc_id}}" class="wpcf7-form-control form-control" placeholder="Enter {{$rfc->rfc_label}}" type="{{$rfc->rfc_type}}" {{($rfc->is_mandatory == 'on') ? 'required':''}}/>
                                        @endif
                                        
                                         @if($rfc->rfc_type == 'date')
                                        <input name="field_{{$rfc->rfc_id}}" id="field_{{$rfc->rfc_id}}" showAttr="{{$rfc->rfc_label}}" idAttr ="field_{{$rfc->rfc_id}}" class="wpcf7-form-control form-control" placeholder="Enter {{$rfc->rfc_label}}" type="{{$rfc->rfc_type}}" {{($rfc->is_mandatory == 'on') ? 'required':''}}/>
                                        @endif
                                        @if($rfc->rfc_type == 'datetime-local')
                                        <input name="field_{{$rfc->rfc_id}}" id="field_{{$rfc->rfc_id}}" showAttr="{{$rfc->rfc_label}}" idAttr ="field_{{$rfc->rfc_id}}" class="wpcf7-form-control form-control" placeholder="Enter {{$rfc->rfc_label}}" type="{{$rfc->rfc_type}}" {{($rfc->is_mandatory == 'on') ? 'required':''}}/>
                                        @endif
                                         @if($rfc->rfc_type == 'time')
                                        <input name="field_{{$rfc->rfc_id}}" id="field_{{$rfc->rfc_id}}" showAttr="{{$rfc->rfc_label}}" idAttr ="field_{{$rfc->rfc_id}}" class="wpcf7-form-control form-control" placeholder="Enter {{$rfc->rfc_label}}" type="{{$rfc->rfc_type}}" {{($rfc->is_mandatory == 'on') ? 'required':''}}/>
                                        @endif

                                    @endforeach
                                    
                                    <input value="Registration Now" class="wpcf7-form-control wpcf7-submit lgx-submit" type="submit">
                                
                           
                            
                            
                            {{--@foreach($commonFields as $rfm)
                                        @if($rfm->rfm_type == 'text')
                                        <input name="rfm_id{{$rfm->rfm_id}}" value="" class="wpcf7-form-control form-control" placeholder="Enter {{$rfm->rfm_name}}" type="{{$rfm->rfm_type}}">
                                        @endif
                                        
                                        @if($rfm->rfm_type == 'select')
                                            
                                            <?php
                                                $optionsCom = array();
                                                if($rfm->rfm_values != null){
                                                    $strCom = $rfm->rfm_values;
                                                    $optionsCom = explode('^',$rfc->rfc_values);
                                                }
                                                
                                            ?>
                                           <select name="rfm_id{{$rfm->rfm_id}}" class="wpcf7-form-control wpcf7-select lgx-select">
                                               <option value="">{{$rfm->rfm_name}}</option>
                                               @foreach($optionsCom as $optCom)
                                                <option value="{{$optCom}}">{{$optCom}}</option>
                                               @endforeach
                                            </select> 
                                        @endif
                                        
                                        @if($rfm->rfm_type == 'checkbox')
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>
                                                <input name="rfm_id{{$rfm->rfm_id}}" value="" class="" type="{{$rfm->rfm_type}}">
                                                </label>
                                            </div>
                                            <div class="col-md-10">
                                                <p style="color:#fff;">{{$rfm->rfm_label}}</p>
                                            </div>
                                        </div>
                                        @endif
                                        
                                    @endforeach
                                    
                                    @foreach($customFields as $rfc)
                                        @if($rfc->rfc_type == 'text')
                                        <input name="rfc_id{{$rfc->rfc_id}}" value="" class="wpcf7-form-control form-control" placeholder="Enter {{$rfc->rfc_label}}" type="{{$rfc->rfc_type}}">
                                        @endif
                                        
                                        @if($rfc->rfc_type == 'select')
                                            
                                            <?php
                                                $options = array();
                                                if($rfc->rfc_values != null){
                                                    $str = $rfc->rfc_values;
                                                    $options = explode('^',$rfc->rfc_values);
                                                }
                                                
                                            ?>
                                           <select name="rfc_id{{$rfc->rfc_id}}" class="wpcf7-form-control wpcf7-select lgx-select">
                                               <option value="">{{$rfc->rfc_label}}</option>
                                               @foreach($options as $opt)
                                                <option value="{{$opt}}">{{$opt}}</option>
                                               @endforeach
                                            </select> 
                                        @endif
                                        
                                        @if($rfc->rfc_type == 'checkbox')
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label>
                                                <input name="rfc_id{{$rfc->rfc_id}}" value="" class="" type="{{$rfc->rfc_type}}">
                                                </label>
                                            </div>
                                            <div class="col-md-10">
                                                <p style="color:#fff;">{{$rfc->rfc_label}}</p>
                                            </div>
                                        </div>
                                        @endif
                                        
                                    @endforeach--}}
                                
                                <!--<input value="Registration Now" class="wpcf7-form-control wpcf7-submit lgx-submit" type="submit">-->