<table class="table Crm_table_active3">
    <thead>
    <tr>
        <th>#</th>
        <th>{{__('attendance.Year')}}</th>
        <th>{{__('common.Action')}}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($years as $key=> $year)
        <tr>
            <td>{{$key+1}}</td>
            <td>{{$year->year}}</td>
            <td>
                <div class="dropdown CRM_dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button"
                            id="dropdownMenu2" data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false">
                        {{ __('common.Select') }}
                    </button>
                    <div class="dropdown-menu dropdown-menu-right"
                         aria-labelledby="dropdownMenu2">
                         @if(permissionCheck('view.year.data'))
                        <a href="{{route('view.year.data',$year->id)}}"
                           class="dropdown-item edit_brand">{{__('common.View')}}</a>
                           @endif
                            @if(permissionCheck('year.data'))
                        <a href="{{route('year.data',$year->id)}}"
                           class="dropdown-item edit_brand">{{__('common.Edit')}}</a>
                           @endif
                            @if(permissionCheck('holiday.delete'))
                        <a onclick="confirm_modal('{{route('holiday.delete', $year->year)}}');"
                           class="dropdown-item">{{__('common.Delete')}}</a>
                           @endif
                    </div>
                </div>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
