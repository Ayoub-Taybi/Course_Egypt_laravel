<tr class='offerRow{{$offer -> id}}'>
    <th scope="row">{{$offer -> id}}</th>
    <td>{{$offer -> name}}</td>
    <td>{{$offer -> price}}</td>
    <td>{{$offer -> details}}</td>
    <td>
        <img  style="width: 90px; height: 90px;" src="{{asset($offer->photo)}}">
    </td>
    <td>

        <a href="{{route('ajax.offers.edit',$offer -> id)}}"  class="edit_btn btn btn-success"> {{__('messages.update')}}</a>
        <a href="#" offer_id="{{$offer -> id}}"  class="delete_btn btn btn-danger"> حذف اجاكس     </a>
    
    </td>

</tr>