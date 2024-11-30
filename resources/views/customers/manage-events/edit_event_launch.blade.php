		<div class="modal-header">
		            <h5 class="modal-title" id="exampleModalCenterTitle-2"><h4>Edit Stream Details</h4></h5>
		            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		                <span aria-hidden="true">&times;</span>
		            </button>
		        </div>
		<form  name="editexhibitor" id="editexhibitor" action="addEventLaunch" method="post" enctype="multipart/form-data">
		 {{ csrf_field() }}
            <div class="modal-body">
    		    <div class="card mb-4">
    		        <div class="card-body">
    	                <div class="row">
    	                    <div class="col-md-12 form-group mb-3">
    	                        <select class="custom-select" id="elm_active_url" name="elm_active_url" onchange="ChangeActiveUrl(this.value)">
                                    <option value=""> Select Url Type</option>
                                    <option value="youtube" @if($dataList->elm_active_url=='youtube') selected  @endif >Youtube</option>
                                    <option value="daily-co" @if($dataList->elm_active_url=='daily-co') selected  @endif >Daily-co</option>
                                </select>
    	                    </div>
                              
                            <div class="col-md-12 form-group mb-3 youtube-div" style="<?=$dataList->elm_active_url!='youtube' ? 'display:none':''?>">
                                <label for="course_fee_sem">YouTube URL</label>
                                <input type="text" class="form-control" name="elm_youtube_url" id="elm_youtube_url" placeholder="Youtube embed url" 
                                 value="{{isset($dataList->elm_youtube_url) ? $dataList->elm_youtube_url : '' }}">
                            </div>
                            
                            <div class="col-md-12 form-group mb-3 dailyco-div" style="<?=$dataList->elm_active_url!='daily-co' ? 'display:none':''?>">
                                <label for="course_fee_sem"><a href="javascript:void(0)" class="btn btn-outline-success" onclick="GenerateMeetingLink()">Generate New Meeting Link</a></label>
                            </div>
                            
                            <div class="col-md-12 form-group mb-3 dailyco-div" style="<?=$dataList->elm_active_url!='daily-co' ? 'display:none':''?>">
                                <label for="course_fee_sem">Daily-Co Meeting Name</label>
                                <input type="text" class="form-control" disabled name="elm_daily_co_name" id="elm_daily_co_name" value="{{isset($dataList->elm_daily_co_name) ? $dataList->elm_daily_co_name : '' }}" placeholder="Enter Daily-Co Meeting Name">
                            </div>
                            
                            <div class="col-md-12 form-group mb-3 dailyco-div" style="<?=$dataList->elm_active_url!='daily-co' ? 'display:none':''?>">
                                <label for="course_fee_sem">Daily-Co URL</label>
                                <input type="text" class="form-control" disabled name="elm_daily_co_url" id="elm_daily_co_url" placeholder="Daily-Co url" 
                                 value="{{isset($dataList->elm_daily_co_url) ? $dataList->elm_daily_co_url : '' }}">
                            </div>
                            
    	                </div>
    		        </div>
    		    </div>
            </div>
	        <div class="modal-footer">
	             <input type="hidden" class="form-control" value="{{isset($dataList->elm_id)?$dataList->elm_id:''}}" name="elm_id" id="elm_id">
	             <input type="hidden" class="form-control" value="{{$elId}}" name="el_id" id="el_id">
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
                        
                        AddVideoData(urlAction, formData);
                    }));
                
            });
            
            function ChangeActiveUrl(fieldVal)
            {
                console.log(fieldVal);
                if(fieldVal=='youtube')
                {
                    $('.dailyco-div').hide();
                    $('.youtube-div').show();
                }
                else
                {
                    $('.dailyco-div').show();
                    $('.youtube-div').hide();
                }
                
            }
            
           function GenerateMeetingLink()
           {
               $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type:'POST',
                    url: "generate-meeting-link",
                    data: "status=success",
                    success:function(data){
                       alert('Meeting link generated');
                       $('#elm_daily_co_name').val(data.name);
                       $('#elm_daily_co_url').val(data.url);
                    },
                    error: function(data){
                        console.log(data);
                    }
                });
           }
    </script>