<div class="modal-header">
                            <h5 class="modal-title" id="verifyModalContent_title">Edit Prospects</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form name="editprospectsForm" id="editprospectsForm" action="" method="post">
                                {!! csrf_field() !!}
                        <div class="modal-body">
                            
                                <div class="form-row">
                                <div class="col-md-6 mb-3">
                                        <label for="recipient-name-2" class="col-form-label">Full Name:</label>
                                        <input type="text" class="form-control" name="ed_full_name" id="ed_full_name" value="{{$dataList->cd_full_name}}">
                                       <span class="text-danger" id="ed_msg_name" name="ed_msg_name"  style="display:none;"></span>
                                    </div>
                                     <div class="col-md-6 mb-3">
                                         <label for="recipient-name-2" class="col-form-label">Email:</label>
                                        <input type="email" class="form-control" name="ed_email" id="ed_email" value="{{$dataList->cd_email}}">
                                         <span class="text-danger" id="ed_msg_email" name="ed_msg_email"  style="display:none;"></span>
                                    </div>
                                    </div>
                               
                                 <div class="form-row">
                                     <div class="col-md-6 mb-3">
                                          <label for="recipient-name-2" class="col-form-label">Select Country:</label>
                                        <select class="form-control" name="ed_country" id="ed_country">
                                            @foreach($Allcountry as $country)
                                             <option value="{{$country->counm_id}}" data-id="{{$country->counm_code}}" {{$dataList->counm_id == $country->counm_id  ? 'selected' : ''}}>{{$country->counm_name}}</option>
                                            @endforeach
                                        </select>
                                      </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="recipient-name-2" class="col-form-label">Mobile:</label>
                                        	<div class="input-group form-group position-relative">
                                        	<div class="input-group-prepend" >
                    									<div class="input-group-text" style="padding: unset;
                                                                                            border: unset;
                                                                                            background: #fff;
                                                                                            /*border-top-left-radius: 50px;
                                                                                            border-bottom-left-radius: 50px;*/
                                                                                            font-size: 14px;
                                                                                            height: 35px;">
                    											<select class="custom-select" style="border: unset; margin-left: 0px;"  name="ed_country_code" id="ed_country_code" data-text="Select current state!" required>
                                                                <?php        
                                                                    if(!empty($Allcountry)){
                                                                        foreach($Allcountry as $key => $countryData){
                                                                            echo '<option value="'.$countryData->counm_code.'">+'.$countryData->counm_code.'</option>';
                                                                        }
                                                                    }
                                                                ?>
                    											</select>
                    									</div>
                    								</div>
                    								 <input type="number" class="form-control" name="ed_phone_number" id="ed_phone_number" value="{{$dataList->cd_phone}}">
                    					    </div>
                                        <!--<input type="text" class="form-control" name="phone_number" id="phone_number">-->
                                      </div>
                                </div>
                                
                                 <div class="form-row">
                                     <div class="col-md-6 mb-3">
                                    <label for="recipient-name-2" class="col-form-label">Company Website:</label>
                                    <input type="text" class="form-control" name="ed_company_website" id="ed_company_website" placeholder="Website Name" value="{{$dataList->cd_company_website}}">
                                    </div>
                                     <div class="col-md-6 mb-3">
                                        <label for="recipient-name-2" class="col-form-label">Event Name:</label>
                                        <input type="text" class="form-control" name="ed_event_name" id="ed_event_name" value="{{$dataList->cd_event_name}}">
                                    </div>
                                   
                                </div>
                               <div class="form-row">
                                     <div class="col-md-6 mb-3">
                                        <label for="recipient-name-2" class="col-form-label">Event Date:</label>
                                        <input type="date" class="form-control" name="ed_event_date" id="ed_event_date" value="{{$dataList->cd_event_date}}">
                                        
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="message-text-1" class="col-form-label">Event Type:</label>
                                        <select class="form-control" name="ed_event_type" id="ed_event_type">
                                            <option>---</option>
                                            <option value="Virtual" {{$dataList->event_type == 'Virtual' ? 'selected' : ''}}>Virtual</option>
                                            <option value="Hybrid" {{$dataList->event_type == 'Hybrid' ? 'selected' : ''}}>Hybrid</option>
                                        </select>
                                    </div>
                                </div>
                            
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" class="form-control" value="{{$dataList->id}}" name="exhim_id" id="exhim_id">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" onclick="updateProspect()">Update </button>
                        </div>
                        </form>
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                        <script>
                             $("select#ed_country").change(function(){ 
                            var selectedCountryCode = $(this).children("option:selected").attr("data-id");
                            $('#country_code option[value='+selectedCountryCode+']').attr('selected', true);
         });
                        </script>