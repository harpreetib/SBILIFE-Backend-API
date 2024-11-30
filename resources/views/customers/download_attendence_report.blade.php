<?php
$session=Session::get('session');

set_time_limit(4000); 
header('Set-Cookie: fileDownload=true; path=/');
header('Cache-Control: max-age=60, must-revalidate');
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=AttendanceReport.xls");
header("Pragma: no-cache");
header("Expires: 0"); 
?>

<table id="user_table" border="1" class="table table-bordered  text-center">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Date Of Visit</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Mobile</th>
                                                    <th>Designation</th>
                                                    <th>Organisation</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($leadlist as $list)
                                                <tr>
                                                    <td>{{$list->lemma_datetime}}</td>
                                                    <td>{{ucwords($list->lm_fullname)}}</td>
                                                    <td>{{$list->lm_email}}</td>
                                                    <td>{{$list->lm_mobile}}</td>
                                                    <td>{{$list->lm_designation}}</td>
                                                    <td>{{$list->lm_company_name}}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>