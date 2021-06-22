@if (permissionCheck('leave'))
    @php
        $leave = false;

        if(request()->is('leave') || request()->is('leave/*'))
        {
            $leave = true;
        }

    @endphp

    <li class="{{ $leave ?'mm-active' : '' }}">
        <a href="javascript:void(0);" class="has-arrow" aria-expanded="false">
            <div class="nav_icon_small">
                <span class="fas fa-print"></span>
            </div>
            <div class="nav_title">
                <span>{{ __('leave.Leave') }}</span>
            </div>
        </a>
        <ul>
            @if(permissionCheck('leave_types.index'))
                <li>
                    <a href="{{ route('leave_types.index') }}"
                       class="{{request()->is('leave/types') ? 'active' : ''}}">{{ __('leave.Leave Type') }}</a>
                </li>
            @endif
            @if(permissionCheck('leave_define.index'))
                <li>
                    <a href="{{ route('leave_define.index') }}"
                       class="{{request()->is('leave/define-lists') ? 'active' : ''}}">{{ __('leave.Leave Define') }}</a>
                </li>
            @endif
            @if(permissionCheck('apply_leave.index'))
                <li>
                    <a href="{{ route('apply_leave.index') }}"
                       class="{{request()->is('leave') ? 'active' : ''}}">{{ __('leave.Apply Leave') }}</a>
                </li>
            @endif
            @if(permissionCheck('approved_index'))
                <li>
                    <a href="{{ route('approved_index') }}"
                       class="{{request()->is('leave/approved') ? 'active' : ''}}">{{ __('leave.Approve Leave Request') }}</a>
                </li>
            @endif
            

            @if(permissionCheck('pending_index'))
                <li>
                    <a href="{{ route('pending_index') }}"
                       class="{{request()->is('leave/pending') ? 'active' : ''}}">{{ __('leave.Pending Leave') }}</a>
                </li>
            @endif

            @if (permissionCheck('holiday.setup'))
                <li>
                    <a href="{{ route('holidays.index') }}"
                       class="{{request()->is('leave/holidays') ? 'active' : ''}}">{{ __('holiday.Holiday Setup') }}</a>
                </li>
            @endif

            @if(permissionCheck('carry.forward'))
                <li>
                    <a href="{{ route('carry.forward') }}"
                       class="{{request()->is('leave/carry-forward') ? 'active' : ''}}">{{ __('leave.Carry Forward') }}</a>
                </li>
            @endif
        </ul>
    </li>
@endif
