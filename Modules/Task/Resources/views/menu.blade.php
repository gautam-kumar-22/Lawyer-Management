@php
    $task = ['task.index', 'task.edit', 'task.show', 'task.create'];
    
    $nav = array_merge($task, ['my-task', 'completed-task']);
@endphp

<li class="{{ spn_nav_item_open($nav, 'mm-active') }}">

    <a href="javascript:;" class="has-arrow"  aria-expanded="{{ spn_nav_item_open($nav, 'true') }}">
        <div class="nav_icon_small">
            <span class="fas fa-th"></span>
        </div>
        <div class="nav_title">
            <span>{{ __('task.Task') }}</span>
        </div>
    </a>
    <ul>
        @if(permissionCheck('task.index'))
        <li>
            <a href="{{route('task.index')}}" class="{{ spn_active_link($task, 'active') }}">  {{ __('task.Task List') }}</a>
        </li>
        @endif
        <li>
            <a href="{{ route('my-task') }}" class="{{ spn_active_link('my-task', 'active') }}">{{ __('task.My Task') }}</a>
        </li>

        <li>
            <a href="{{ route('completed-task') }}" class="{{ spn_active_link('completed-task', 'active') }}">{{ __('task.Completed Task') }}</a>
        </li>
    </ul>
</li>