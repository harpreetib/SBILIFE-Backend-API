  <thead>
                                        <tr>
                                            <th scope="col">SR. No.</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email
                                                <div class="divider">Mobile</div>
                                            </th>
                                            <th scope="col">Company Website
                                             <div class="divider">Company Name</div>
                                            </th>
                                            <th scope="col">Front-End URL</th>
                                            <th scope="col">Login URL
                                            <div class="divider">Login Id</div>
                                            <div class="divider">Password</div>
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
                                    <?php $i=1;?>
                                    @forelse($Alldata as $list)
                                        <tr>
                                            
                                            <td scope="row">{{$i++}}.</td>
                                            <td>{{$list->cd_full_name}}</td>
                                            <td>{{$list->cd_email}}
                                                <div>{{$list->cd_mobile}}</div>
                                            </td>
                                            <td>{{$list->cd_company_website}}
                                               <div> {{$list->cd_company_name}}</div>
                                            </td>
                                            <td>
                                                @if(!empty($list->bm_nickname))
                                                <span class="text-primary">
                                                    <a href="https://lifeverse.megaspace.ai/{{$list->bm_nickname}}" title="View" target="_blank">
                                                        https://lifeverse.megaspace.ai/{{$list->bm_nickname}}
                                                    </a>
                                                </span> 
                                                @endif
                                            </td>
                                            <td>
                                                @if(!empty($list->bm_nickname))
                                                   <span class="text-primary">https://lifeverse.megaspace.ai/console/{{$list->bm_nickname}}</span> 
                                                @endif
                                               <div>{{$list->login_id}}</div>
                                               <div>{{$list->password}}</div>
                                            </td>
                                            <td scope="row">{{date('d-M,Y',strtotime($list->created_at))}}
                                                <div class="divide"> {{date('h:i A',strtotime($list->created_at))}}</div>
                                            </td>
                                            <td>{{$list->cd_ipAddress}}</td>
                                            <td>@if ($list->lead_stage != 'prospect')
                                                <a href="{{url('/settings',$list->id) }}"><button type="button"class="btn btn-primary m-1">setting</button></a>
                                            @endif
                                          </td>
                                            <td>
                                                <a href="javascript:void(0);" class="text-success mr-2 edit1" data-id="{{$list->id}}" onclick="addeditprospect('{{$list->id}}');"><i class="nav-icon i-Pen-2 font-weight-bold"></i></a>
                                                <a href="javascript:void(0);" class="text-danger mr-2"><i class="nav-icon i-Close-Window font-weight-bold" onclick="statusProspect('{{$list->id}}');"></i></a>
                                                 
                                            </td>
                                            <td> 
                                                <select class="from-control ledStage" data-id="{{$list->id}}">
                                                     <option value="prospect" {{$list->lead_stage == 'prospect'  ? 'selected' : ''}}>Prospect</option>
                                                     <option value="paid" {{$list->lead_stage == 'paid'  ? 'selected' : ''}}>Paid</option>
                                                     <option value="trail" {{$list->lead_stage == 'trail'  ? 'selected' : ''}}>Trail</option>
                                                </select>
                                             </td>
                                            <td>
                                                <a href="javascript:void(0);"><button type="button"class="btn btn-primary m-1"  data-id="{{$list->id}}" onclick="mailcontent('{{$list->id}}');" data-toggle="modal" data-target="#MailModal">Send credentials</button></a>
                                            </td>
                                            
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="11" style="text-align:center">No customers to display.</td>
                                        </tr> 
                                    @endforelse
                                         </tbody>
