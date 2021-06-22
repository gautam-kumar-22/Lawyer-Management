@php
    Illuminate\Support\Facades\Cache::rememberForever('languages', function() {
       return \Modules\Localization\Entities\Language::where('status', 1)->get();
    });
@endphp
<div class="container-fluid no-gutters d-print-none">
    <div class="row">
        <div class="col-lg-12 p-0">
            <div class="header_iner d-flex justify-content-between align-items-center">
                <div class="small_logo_crm d-lg-none">
                    <a href="{{url('/home')}}"> <img
                            src="{{asset(config('configs')->where('key', 'site_logo')->first()->value)}}" alt=""></a>
                </div>
                <div id="sidebarCollapse" class="sidebar_icon  d-lg-none">
                    <i class="ti-menu"></i>
                </div>
                <div class="collaspe_icon open_miniSide">
                    <i class="ti-menu"></i>
                </div>
                <div class="serach_field-area ml-40">
                    <div class="search_inner">
                        <form action="#">
                            <div class="search_field">
                                <input type="text" placeholder="SEARCH" id="search" onkeyup="showResult(this.value)">
                            </div>
                            <button type="button"><i class="ti-search"></i></button>
                        </form>
                    </div>
                    <div id="livesearch"></div>
                </div>
                <div class="header_middle d-none d-md-block">
                    <div class="select_style d-flex">

                        @php
                            if(session()->has('locale')){
                                $locale = session()->get('locale');
                            }
                            else{

                                session()->put('locale', config('configs')->where('key','language_name')->first()->value);
                                $locale = session()->get('locale');
                            }
                        @endphp

                        <select name="code" id="language_code" class="nice_Select bgLess mb-0"
                                onchange="change_Language()">
                            @foreach (Illuminate\Support\Facades\Cache::get('languages') as $key => $language)
                                <option value="{{ $language->code }}"
                                        @if ($locale == $language->code) selected @endif>{{ $language->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="header_right d-flex justify-content-between align-items-center">
                    <div class="header_notification_warp d-flex align-items-center">


                    </div>


                    <div class="profile_info">
                        <img src="{{asset('public\backEnd/img/staff.jpg')}}" alt="#">

                        <div class="profile_info_iner">
                            <div class="use_info d-flex align-items-center">
                                <div class="thumb">
                                    <img src="{{asset('public\backEnd/img/staff.jpg')}}" alt="#">
                                </div>
                                <div class="user_text">
                                    <h5><a href="{{ route('profile_view') }}">{{ auth()->user()->name }}</a></h5>
                                    <span>{{ auth()->user()->email }}</span>

                                </div>
                            </div>

                            <div class="profile_info_details">
                                @if(permissionCheck('setting.index'))
                                    <a href="{{ route('setting.index')}}"> <i
                                            class="ti-settings"></i>
                                        <span>{{ __('common.Setting') }}</span>
                                    </a>
                                @endif
                                    <a href="{{ route('profile_view') }}">
                                        <i class="ti-user"></i>
                                        <span>{{ __('common.Profile') }}</span>
                                    </a>

                                <a href="{{ route('change_password') }}">
                                    <i class="ti-key"></i>
                                    <span>{{ __('common.Change Password') }}</span>
                                </a>

                                <a href="{{ route('logout') }}" id="logout">
                                    <i class="ti-unlock"></i>
                                    <span>{{__('common.Logout')}}</span>
                                </a>

                            </div>
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript">
        function change_Language() {
            var code = $('#language_code').val();
            $.post('{{ route('language.change') }}', {_token: '{{ csrf_token() }}', code: code}, function (data) {

                if (data.success) {
                    location.reload();
                    toastr.success(data.success);
                } else {
                    toastr.error(data.error);
                }
            });
        }
    </script>
@endpush

