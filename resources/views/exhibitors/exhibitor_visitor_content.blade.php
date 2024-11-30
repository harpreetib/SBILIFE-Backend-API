@php
$i=1
@endphp
@foreach($leadList as $list)

  <tr>
      <th scope="row">{{$i++}}</th>

      <td scope="row">{{date('d-M,Y',strtotime($list->leem_datetime))}}
      <div class="divide"> {{date('h:i A',strtotime($list->leem_datetime))}}</div></td>
      <td>{{ucfirst($list->lm_fullname)}}</td>
      <td>{{$list->lm_email}}</td>
        <td>{{$list->lm_mobile}}</td>
        
        <td>{{$list->lm_designation}}
            <div class="divide">{{$list->lm_company_name}}</div>
        </td>
      
      <td> 
        <span class="btn p-1 m-0 " onclick="showEnquiry('{{$list->lm_mobile}}','{{$list->lm_email}}');" > View Enquiry</span>
      </td>
  </tr>

@endforeach
