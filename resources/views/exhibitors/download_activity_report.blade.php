<?php
$session=Session::get('session');

set_time_limit(4000); 
header('Set-Cookie: fileDownload=true; path=/');
header('Cache-Control: max-age=60, must-revalidate');
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=ActivityReport.xls");
header("Pragma: no-cache");
header("Expires: 0"); 
?>

<table id="user_table" border="1" class="table table-bordered  text-center">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Mobile</th>
                                                    <th>Designation</th>
                                                    <th>Company Name</th>
                                                    <th>Activity</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $i=1; ?>
                                                @foreach($leadList as $list)
                                                <tr>
                                                    <td>{{$i++}}</td>
                                                    <td>{{ucwords($list->lm_fullname)}}</td>
                                                    <td>{{ucfirst($list->lm_email)}}</td>
                                                    <td>{{ucfirst($list->lm_mobile)}}</td>
                                                    <td>{{ucfirst($list->lm_designation)}}</td>
                                                    <td>{{ucfirst($list->lm_company_name)}}</td>
                                                    <td style="font-size: 11px;">
                                                        {!! $list->activity !!}</li>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>