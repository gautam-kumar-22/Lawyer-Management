
<!-- table-responsive -->
    <table class="table Crm_table_active3">
        <thead>
        <tr>
            
            <th scope="col">{{ __('common.ID') }}</th>
            <th scope="col">{{ __('role.Role') }}</th>
            <th scope="col">{{ __('leave.Leave Type') }}</th>
            <th scope="col">{{ __('leave.Total Days') }}</th>
            <th scope="col">{{ __('leave.Max Forward Balance') }} ({{__('leave.Days')}})</th>
            <th scope="col">{{ __('common.Action') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($LeaveDefineList as $key => $item)
            <tr>
               
                <th>{{ $key + 1 }}</th>
                <td>{{ $item->role->name }}</td>
                <td>{{ $item->leave_type->name }}</td>
                <td>{{ $item->total_days }}</td>
                <td>{{ $item->max_forward }}</td>
                <td>
                    <!-- shortby  -->
                    <div class="dropdown CRM_dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                id="dropdownMenu2" data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false">
                            {{ __('common.Select') }}
                        </button>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu2">
                            <a href="#" class="dropdown-item edit_brand" onclick="editLeaveDefine({{ $item}})">{{__('common.Edit')}}</a>
                            <a href="#" class="dropdown-item edit_brand" onclick="showDeleteModal({{ $item->id }})" >{{__('common.Delete')}}</a>
                        </div>
                    </div>
                    <!-- shortby  -->
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
