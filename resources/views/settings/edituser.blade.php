
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle-2"><h4>Edit User Detail</h4></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form  name="edituser" id="edituser" class="" action="" method="post">
                        {{ csrf_field() }}

                              <input class="form-control" type="hidden" name="edituser" id="edituser" value="adduser" />
                        <div class="modal-body">
                            

                    <div class="card mb-4">
                        <div class="card-body">
                           
                                <div class="row">
                                    
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="course_duration">User Name</label>
                                        <input type="text" class="form-control" name="edit_user_name" id="edit_user_name" placeholder="User Name"
                                        value="{{(isset($dataList->user_name) ? $dataList->user_name : '')}}">
                                        <span class="text-danger" id="err_msg_cnn" name="err_msg_cnn"  style="display:none;"></span>
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label for="course_duration">Login ID</label>
                                        <input type="text" class="form-control" name="edit_user_login" id="edit_user_login" placeholder="Login ID"
                                        value="{{(isset($dataList->login_id) ? $dataList->login_id : '')}}">
                                        <span class="text-danger" id="err_msg_cnn" name="err_msg_cnn"  style="display:none;"></span>
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label for="course_fee_sem">E-mail</label>
                                        <input type="email" class="form-control" name="edit_user_email" id="edit_user_email" placeholder="E-mail Address" 
                                         value="{{(isset($dataList->email_id) ? $dataList->email_id : '')}}"
                                       
                                         >
                                        <span class="text-danger" id="err_msg_eu" name="err_msg_eu"  style="display:none;"></span>
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label for="course_fee_year">Mobile No</label>
                                        <input type="number" class="form-control" name="edit_user_phone" id="edit_user_phone"  placeholder="Mobile"
                                         value="{{(isset($dataList->mobile_no) ? $dataList->mobile_no : '')}}">
                                        <span class="text-danger" id="err_msg_eup" name="err_msg_eup"  style="display:none;"></span>

                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label for="course_fee_year">Video Url</label>
                                        <input type="text" class="form-control" name="edit_user_video" id="edit_user_video"  placeholder="Video Url"
                                         value="{{(isset($dataList->video_url) ? $dataList->video_url : '')}}">
                                        <span class="text-danger" id="err_msg_eup" name="err_msg_eup"  style="display:none;"></span>

                                    </div>
                                    <div class="col-md-6 form-group mb-3">
                                        <label for="acccess_type">Access Type</label>
                                        <select class="form-control" name="edit_access_type" id="edit_access_type">
                                            <option value="">Select Access Type</option>
                                            @foreach($accesType as $type)
                                              <option value="{{$type->at_id}}" {{$type->at_id == $dataList->at_id  ? 'selected' : ''}}>{{$type->at_name}}</option>
                                            @endforeach                           

                                        </select>
                                        <span class="text-danger" id="edit_err_at" name="edit_err_at"  style="display:none;"></span>
                                    </div>
                                    
  
                                    
                                </div>
                        </div>
                    </div>


                        </div>
                        <div class="modal-footer">
                           
                            <input type="hidden" class="form-control" value="{{$dataList->map_id}}" name="map_id" id="map_id">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary ladda-button basic-ladda-button" data-style="expand-right" onclick="updateuser()">Update User</button>
                        </div>
                      </form>
                    