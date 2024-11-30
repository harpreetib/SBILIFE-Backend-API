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
                                    
                                    @forelse($Alldata as $list)
                                        <tr>
                                            
                                            <td scope="row">{{$list->pm_name}}</td>
                                            <td>{{$list->pum_name}}</td>
                                            <td><button class="btn {{$list->pm_custom_landing_page=='yes' ? 'btn-success':'btn-danger'}}">{{ucfirst($list->pm_custom_landing_page)}}</button></td>
                                            <td><button class="btn {{$list->pm_unique_url=='yes' ? 'btn-success':'btn-danger'}}">{{ucfirst($list->pm_unique_url)}}</button></td>
                                            <td>{{ucfirst($list->pm_templates)}}</td>
                                            <td scope="row"><button class="btn {{$list->pm_branding_personalized_content=='yes' ? 'btn-success':'btn-danger'}}">{{ucfirst($list->pm_branding_personalized_content)}}</button></td>
                                            <td><button class="btn {{$list->pm_custom_avatars=='yes' ? 'btn-success':'btn-danger'}}">{{ucfirst($list->pm_custom_avatars)}}</button></td>
                                            <td><button class="btn {{$list->pm_npc=='yes' ? 'btn-success':'btn-danger'}}">{{ucfirst($list->pm_npc)}}</button></td>
                                            <td>{{$list->pvm_name}}</td>
                                            <td>{{$list->pam_name}}</td>
                                            <td><button class="btn {{$list->pm_live_voice_text_interaction=='yes' ? 'btn-success':'btn-danger'}}">{{ucfirst($list->pm_live_voice_text_interaction)}}</button></td>
                                            <td><button class="btn {{$list->pm_breakout_room=='yes' ? 'btn-success':'btn-danger'}}">{{ucfirst($list->pm_breakout_room)}}</button></td>
                                            <td>{!! $list->ppam_name !!}</td>
                                            <td><button class="btn {{$list->pm_analytics=='yes' ? 'btn-success':'btn-danger'}}">{{ucfirst($list->pm_analytics)}}</button></td>
                                            <td><button class="btn {{$list->pm_preferred_support=='yes' ? 'btn-success':'btn-danger'}}">{{ucfirst($list->pm_preferred_support)}}</button></td>
                                            <td>
                                                <a href="javascript:void(0);" class="text-success mr-2 edit1" data-id="{{$list->pm_id}}" onclick="addeditprospect('{{$list->pm_id}}');"><i class="nav-icon i-Pen-2 font-weight-bold"></i></a>
                                                <a href="javascript:void(0);" class="text-danger mr-2"><i class="nav-icon i-Close-Window font-weight-bold" onclick="statusProspect('{{$list->pm_id}}');"></i></a>
                                                 
                                            </td>
                                            
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="11" style="text-align:center">No Packages to display.</td>
                                        </tr> 
                                    @endforelse
                                         </tbody>
