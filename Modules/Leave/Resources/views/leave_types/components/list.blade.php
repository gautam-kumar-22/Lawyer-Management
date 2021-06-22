<div class="">
    <!-- table-responsive -->
    <table class="table Crm_table_active3">
        <thead>
        <tr>
            <th scope="col">{{ __('common.ID') }}</th>
            <th scope="col">{{ __('common.Name') }}</th>
            <th scope="col">{{ __('common.Status') }}</th>
            <th scope="col">{{ __('common.Action') }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($LeaveTypeList as $key => $item)
            <tr>
                <th>{{ $key + 1 }}</th>
                <td>{{ $item->name }}</td>
                <td class="pending">
                    @if ($item->status == 0)
                        <h6><span class="badge_4">{{__('common.DeActive')}}</span></h6>
                    @else
                        <h6><span class="badge_1">{{__('common.Active')}}</span></h6>
                    @endif
                </td>
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
                            @if(permissionCheck('leave_types.edit'))
                                <a href="#" class="dropdown-item edit_brand"
                                   onclick="editItem({{ $item }})">{{__('common.Edit')}}</a>
                            @endif
                            @if(permissionCheck('leave_types.delete'))
                                <a href="#" class="dropdown-item edit_brand"
                                   onclick="showDeleteModal({{ $item->id }})">{{__('common.Delete')}}</a>
                            @endif
                        </div>
                    </div>
                    <!-- shortby  -->
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
