<!-- sidebar part here -->
<nav id="sidebar" class="sidebar ">

    <div class="sidebar-header update_sidebar">
        <a class="large_logo" href="{{url('/home')}}">
            <img src="{{asset(config('configs')->where('key','site_logo')->first()->value) }}" alt="">
        </a>
        <a class="mini_logo" href="{{url('/home')}}">
            <img src="{{asset(config('configs')->where('key','site_logo')->first()->value) }}" alt="">
        </a>
        <a id="close_sidebar" class="d-lg-none">
            <i class="ti-close"></i>
        </a>
    </div>
    <ul id="sidebar_menu">
            <li>
                <a  class="{{ spn_active_link('home') }}" href="{{url('/home')}}" >
                    <div class="nav_icon_small">
                        <span class="fas fa-th"></span>
                    </div>
                    <div class="nav_title">
                        <span>{{__('dashboard.Dashboard')}}</span>
                    </div>
                </a>
            </li>



            @if(permissionCheck('contact.index'))

            @php
                $contact = ['contact.index', 'contact.create', 'contact.edit', 'contact.show'];
                $category = ['category.contact.index', 'category.contact.create', 'category.contact.edit', 'category.contact.show'];
                $nav = array_merge($contact, $category);
            @endphp

            <li class="{{ spn_nav_item_open($nav, 'mm-active') }}">
                <a href="javascript:;" class="has-arrow"  aria-expanded="{{ spn_nav_item_open($nav, 'true') }}">
                    <div class="nav_icon_small">

                        <span class="far fa-address-book"></span>
                    </div>
                    <div class="nav_title">
                        <span>{{ __('contact.Contact') }}</span>
                    </div>
                </a>
                <ul>
                    <li >
                        <a href="{{route('contact.index')}}" class="{{ spn_active_link($contact, 'active') }}">  {{ __('contact.Contact List') }}</a>
                    </li>
                    @if(permissionCheck('category.contact.index'))
                    <li >
                        <a href="{{ route('category.contact.index') }}" class="{{ spn_active_link($category, 'active') }}">{{ __('contact.Contact  Category') }}</a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif

            @if(permissionCheck('client.index'))
            @php

               $client = ['client.index', 'client.create', 'client.edit', 'client.show'];
                $category = ['category.client.index', 'category.client.create', 'category.client.edit', 'category.client.show'];
                $nav = array_merge($client, $category);

            @endphp

            <li class="{{ spn_nav_item_open($nav, 'mm-active') }}">

                <a href="javascript:;" class="has-arrow"  aria-expanded="{{ spn_nav_item_open($nav, 'true') }}">
                    <div class="nav_icon_small">
                        <span class="fas fa-users"></span>
                    </div>
                    <div class="nav_title">
                        <span>{{ __('client.Client') }}</span>
                    </div>
                </a>
                <ul>
                    <li>
                        <a href="{{route('client.index')}}" class="{{ spn_active_link($client, 'active') }}">  {{ __('client.Client List') }}</a>
                    </li>
                    @if(permissionCheck('category.client.index'))
                    <li>
                        <a href="{{ route('category.client.index') }}" class="{{ spn_active_link($category, 'active') }}">{{ __('client.Client Category') }}</a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif

            @if(permissionCheck('case.index'))
            @php
                $case = ['case.index', 'case.edit', 'case.show', 'date.create', 'date.edit', 'putlist.create', 'putlist.edit', 'judgement.create', 'judgement.edit', 'case.court.change' ];
                $category = ['category.case.index', 'category.case.create', 'category.case.edit', 'category.case.show'];

                $nav = array_merge($case, $category, ['causelist.index', 'case.create', 'judgement.index', 'judgement.closed', 'judgement.reopen', 'judgement.close']);
            @endphp

            <li class="{{ spn_nav_item_open($nav, 'mm-active') }}">

                <a href="javascript:;" class="has-arrow"  aria-expanded="{{ spn_nav_item_open($nav, 'true') }}">
                    <div class="nav_icon_small">

                        <span class="fas fa-list-ul"></span>
                    </div>
                    <div class="nav_title">
                        <span>{{ __('case.Cause') }}</span>
                    </div>
                </a>
                <ul>
                    @if(permissionCheck('causelist.index'))
                    <li>
                        <a href="{{route('causelist.index')}}" class="{{ spn_active_link('causelist.index', 'active') }}">  {{ __('case.Cause List') }}</a>
                    </li>
                    @endif

                    <li>
                        <a href="{{ route('case.index') }}" class="{{ spn_active_link($case, 'active') }}"> {{ __('case.All Case') }}</a>
                    </li>
                    @if(permissionCheck('case.store'))
                    <li>
                        <a href="{{ route('case.create') }}" class="{{ spn_active_link('case.create', 'active') }}"> {{ __('case.Add New Case') }}</a>
                    </li>
                    @endif
                    @if(permissionCheck('category.case.index'))
                    <li>
                        <a href="{{ route('category.case.index') }}" class="{{ spn_active_link($category, 'active') }}">{{ __('case.Case  Category') }}</a>
                    </li>
                    @endif
                    @if(permissionCheck('judgement.index'))
                    <li>
                        <a href="{{ route('judgement.index') }}" class="{{ spn_active_link(['judgement.index', 'judgement.reopen', 'judgement.close'], 'active') }}"> {{ __('case.Judgement Case') }}</a>
                    </li>
                    @endif
                    @if(permissionCheck('judgement.closed'))
                    <li>
                        <a href="{{ route('judgement.closed') }}" class="{{ spn_active_link(['judgement.closed'], 'active') }}"> {{ __('case.Closed Case') }}</a>
                    </li>
                    @endif

                </ul>
            </li>
            @endif

            @if(permissionCheck('lawyer.index'))
            @php
               $lawyer = ['lawyer.index', 'lawyer.create', 'lawyer.edit', 'lawyer.show'];
            @endphp

            <li class="{{ spn_active_link($lawyer, 'mm-active') }}">
                <a  href="{{route('lawyer.index')}}" >
                    <div class="nav_icon_small">
                        <span class="fas fa-users"></span>
                    </div>
                    <div class="nav_title">
                        <span> {{ __('lawyer.Opposite Lawyer') }}</span>
                    </div>
                </a>
            </li>
            @endif


            @if(permissionCheck('lobbying.index'))
            <li class="{{ spn_active_link(['lobbying.index', 'lobbying.edit', 'lobbying.show'], 'mm-active') }}">
                <a  href="{{route('lobbying.index')}}">
                    <div class="nav_icon_small">
                        <span class="fas fa-th"></span>
                    </div>
                    <div class="nav_title">
                        <span> {{ __('case.Lobbying List') }}</span>
                    </div>
                </a>
            </li>
            @endif
            @if(permissionCheck('putlist.index'))
            <li class="{{ spn_active_link('putlist.index', 'mm-active') }}">
                <a  href="{{route('putlist.index')}}">
                    <div class="nav_icon_small">
                        <span class="fas fa-th"></span>
                    </div>
                    <div class="nav_title">
                        <span> {{ __('case.Put Up Date List') }}</span>
                    </div>
                </a>
            </li>
            @endif



            @if(permissionCheck('master.court.index'))
            @php
                $court = ['master.court.index', 'master.court.edit', 'master.court.show', 'master.court.create'];
                $category = ['category.court.index', 'category.court.create', 'category.court.edit', 'category.court.show'];
                $nav = array_merge($court, $category);
            @endphp

            <li class="{{ spn_nav_item_open($nav, 'mm-active') }}">
                <a href="javascript:;" class="has-arrow"  aria-expanded="{{ spn_nav_item_open($nav, 'true') }}">
                    <div class="nav_icon_small">
                        <span class="fas fa-gavel"></span>
                    </div>
                    <div class="nav_title">
                        <span>{{ __('court.Court') }}</span>
                    </div>
                </a>
                <ul>
                     <li>
                        <a href="{{ route('master.court.index') }}" class="{{ spn_active_link($court, 'active') }}"> {{ __('court.Court List') }}</a>
                    </li>
                    <li>
                    @if(permissionCheck('category.court.index'))
                        <a href="{{ route('category.court.index') }}" class="{{ spn_active_link($category, 'active') }}"> {{ __('court.Court Category') }}</a>
                    </li>
                    @endif

                </ul>
            </li>

            @endif




            @if(permissionCheck('appointment.index'))
           @php
               $appoinment = ['appointment.index', 'appointment.create', 'appointment.edit', 'appointment.show'];
            @endphp

            <li class="{{ spn_active_link($appoinment, 'mm-active') }}">
                <a  href="{{route('appointment.index')}}">
                    <div class="nav_icon_small">
                        <span class="far fa-handshake"></span>
                    </div>
                    <div class="nav_title">
                        <span> {{ __('appointment.Appointment') }}</span>
                    </div>
                </a>
            </li>
            @endif




            @include('task::menu')
            @include('todo::menu')
            @include('partials.hr-menu')
            @include('leave::menu')

            @if(permissionCheck('setup'))
            @php
                $stage = ['master.stage.index', 'master.stage.edit', 'master.stage.show', 'master.stage.create'];
                $act = ['master.act.index', 'master.act.edit', 'master.act.show', 'master.act.create'];
                $city = ['setup.city.index', 'setup.city.edit', 'setup.city.show', 'setup.city.create'];
                $state = ['setup.state.index', 'setup.state.edit', 'setup.state.show', 'setup.state.create'];
                $country = ['setup.country.index', 'setup.country.edit', 'setup.country.show', 'setup.country.create'];

                $lang = ['languages.index', 'languages.edit', 'languages.show', 'languages.create' , 'language.translate_view'];

                $nav = array_merge($stage, $act, $lang, ['setting.updatesystem'], $city, $state, $country);
            @endphp

            <li class="{{ spn_nav_item_open($nav, 'mm-active') }}">
                <a href="javascript:;" class="has-arrow"  aria-expanded="{{ spn_nav_item_open($nav, 'true') }}">
                    <div class="nav_icon_small">
                        <span class="fas fa-user"></span>
                    </div>
                    <div class="nav_title">
                        <span>{{ __('common.Setup') }}</span>
                    </div>
                </a>
                <ul>
                    @if(permissionCheck('master.stage.index'))
                    <li>
                        <a href="{{ route('master.stage.index') }}" class="{{ spn_active_link($stage, 'active') }}">  {{ __('case.Case Stage') }}</a>
                    </li>
                    @endif
                    @if(permissionCheck('master.act.index'))
                    <li>
                        <a href="{{ route('master.act.index') }}" class="{{ spn_active_link($act, 'active') }}">{{ __('case.Act') }}</a>
                    </li>
                    @endif
                        @if(permissionCheck('setup.city.index'))
                            <li>
                                <a href="{{ route('setup.city.index') }}" class="{{ spn_active_link($city, 'active') }}">{{ __('setting.City') }}</a>
                            </li>
                        @endif

                        @if(permissionCheck('setup.state.index'))
                            <li>
                                <a href="{{ route('setup.state.index') }}" class="{{ spn_active_link($state, 'active') }}">{{ __('setting.State') }}</a>
                            </li>
                        @endif

                    @if(permissionCheck('setup.country.index'))
                    <li>
                        <a href="{{ route('setup.country.index') }}" class="{{ spn_active_link($country, 'active') }}">{{ __('court.Country') }}</a>
                    </li>
                    @endif



                    @if(permissionCheck('languages.index'))
                    <li>
                        <a href="{{ route('languages.index') }}" class="{{ spn_active_link($lang, 'active') }}">{{ __('common.Language') }}</a>
                    </li>
                    @endif

                    @if(permissionCheck('setting.updatesystem'))
                    <li>
                        <a href="{{ route('setting.updatesystem') }}" class="{{ spn_active_link('setting.updatesystem', 'active') }}">{{ __('setting.Update') }}</a>
                    </li>
                    @endif




                </ul>
            </li>
            @endif

            @include('setting::menu')

      </ul>

</nav>
<!-- sidebar part end -->
