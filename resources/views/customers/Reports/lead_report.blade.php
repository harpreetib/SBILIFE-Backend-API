<?php

set_time_limit(4000); 
header('Set-Cookie: fileDownload=true; path=/');
header('Cache-Control: max-age=60, must-revalidate');
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=Lead_Report.xls");
header("Pragma: no-cache");
header("Expires: 0"); 
 if (!empty($leadList[0])) {
    ?>
<table id="example" class="table table-striped table-bordered" style="width:100%" border="1">
        <thead>
            <tr>
                <th>#</th>
                <th>Register Date</th>
                <th>Register Time</th>
                <th>Name</th>
                <th>Email</th>
                <!--<th>Mobile</th>-->
                <th>Company Name</th>
                <th>Designation</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $i=1; 
            foreach ($leadList as $list) { ?>

                <tr>
                    <th> <?php echo $i++; ?></th>
                    <td>{{date('d-M,Y',strtotime($list->lemm_insert_date))}}</td>
                    <td>{{date('h:i A',strtotime($list->lemm_insert_date))}}</td>
                    <td>{{ucfirst($list->lm_fullname)}}</td>
                    <td>{{$list->lm_email}}</td>
                    <!--<td>{{$list->lm_mobile}}</td>-->
                    <td>{{ucfirst($list->lm_company_name)}}</td>
                    <td>{{$list->lm_designation}}</td>
                </tr>

             <?php } ?>

        </tbody>
        <!--tfoot>
           
        </tfoot-->
</table>
<?php } ?>