@if (permissionCheck('human_resource'))
@php
    $staffs = ['staffs.index', 'staffs.edit', 'staffs.view', 'staffs.create'];
    $roles = ['permission.roles.index', 'permission.roles.edit', 'permission.roles.view', 'permission.roles.create', 'permission.permissions.index'];
    $events = ['events.index', 'events.edit', 'events.view', 'events.create'];
    $payroll = ['payroll.index', 'payroll.edit', 'payroll.view', 'payroll.create', 'genrate_payroll', 'staff_search_for_payroll'];
    
    
    $nav = array_merge($staffs, $roles, $events, $payroll, ['attendances.index', 'attendance_report.index', 'payroll_reports.index', 'payroll_reports.search', 'attendance_report.search']);
@endphp

<li class="{{ spn_nav_item_open($nav, 'mm-active') }}">
        <a href="javascript:;" class="has-arrow" aria-expanded="{{ spn_nav_item_open($nav, 'true') }}">
            <div class="nav_icon_small">
                <span class="fas fa-users"></span>
            </div>
            <div class="nav_title">
                <span>{{ __('common.Human Resource') }}</span>
            </div>
        </a>
        <ul>
            @if (permissionCheck('staffs.index'))
                <li>
                    <a href="{{ route('staffs.index') }}" class="{{ spn_active_link($staffs, 'active') }}">{{ __('common.Staff') }}</a>
                </li>
            @endif
            @if (permissionCheck('permission.roles.index'))
                <li>
                    <a href="{{ route('permission.roles.index') }}" class="{{ spn_active_link($roles, 'active') }}">{{ __('role.Role') }}</a>
                </li>
            @endif
          
            @if (permissionCheck('attendances.index'))
                <li>
                    <a href="{{ route('attendances.index') }}" class="{{ spn_active_link('attendances.index', 'active') }}">{{ __('attendance.Attendance') }}</a>
                </li>
            @endif
            @if (permissionCheck('attendance_report.index'))
                <li>
                    <a href="{{ route('attendance_report.index') }}" class="{{ spn_active_link(['attendance_report.index', 'attendance_report.search'], 'active') }}">{{ __('attendance.Attendance Report') }}</a>
                </li>
            @endif
            @if (permissionCheck('events.index'))
                <li>
                    <a href="{{ route('events.index') }}" class="{{ spn_active_link($events, 'active') }}">{{ __('event.Event') }}</a>
                </li>
            @endif
            
            @if (permissionCheck('payroll.index'))
                <li>
                    <a href="{{ route('payroll.index') }}" class="{{ spn_active_link($payroll, 'active') }}">{{ __('payroll.Payroll') }}</a>
                </li>
            @endif
            @if (permissionCheck('payroll_reports.index'))
                <li>
                    <a href="{{ route('payroll_reports.index') }}" class="{{ spn_active_link(['payroll_reports.index', 'payroll_reports.search'], 'active') }}">{{ __('payroll.Payroll Reports') }}</a>
                </li>
            @endif
        
        </ul>
    </li>
    @endif