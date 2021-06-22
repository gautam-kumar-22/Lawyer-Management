@php
    $to_dos = ['to_dos.index', 'to_dos.create', 'to_dos.edit', 'to_dos.show'];
@endphp

<li class="{{ spn_active_link($to_dos, 'mm-active') }}">

    <a  href="{{route('to_dos.index')}}" >
        <div class="nav_icon_small">
            <span class="fas fa-list-ul"></span>
        </div>
        <div class="nav_title">
            <span> {{ __('Todo List') }}</span>
        </div>
    </a>
</li>