@if(permissionCheck('setting.index'))

<li class="{{ spn_active_link('setting.index', 'mm-active') }}">
<a href="{{url('setting')}}" class="{{request()->is('setting') ? 'active' : ''}}" aria-expanded="false">
    <div class="nav_icon_small">
        <span class="fas fa-cog"></span>
    </div>
    <div class="nav_title">
        <span>{{ __('setting::setting.Settings') }}</span>
    </div>
</a>
</li>
@endif
@if(permissionCheck('utilities'))
    <li class="{{ spn_active_link('utilities', 'mm-active') }}">
        <a href="{{ route('utilities') }}">
            <div class="nav_icon_small">
                <span class="fas fa-store"></span>
            </div>
            <div class="nav_title">
                <span>{{ __('setting.Utilities') }}</span>
            </div>
        </a>
    </li>
@endif
