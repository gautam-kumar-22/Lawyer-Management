<!DOCTYPE html>

@if(rtl())
    <html dir="rtl"  class="rtl">
@else
    <html>
@endif
<head>

    <!-- Required meta tags -->
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link rel="icon" href="{{asset(config('configs')->where('key','favicon_logo')->first()->value) }}" type="image/png" />

    <title>{{ isset($title) ? $title .' | '. config('configs')->where('key','site_title')->first()->value :  config('configs')->where('key','site_title')->first()->value }}</title>
    
    <meta name="_token" content="{!! csrf_token() !!}"/>


    <!-- Bootstrap CSS -->

    
    @if(rtl())
    <link rel="stylesheet" href="{{asset('public/backEnd/css/rtl/bootstrap.min.css')}}"/>
    @else
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/bootstrap.css"/>
    @endif

    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/jquery-ui.css"/>
    <link rel="stylesheet" href="{{asset('public/frontend/')}}/vendors/text_editor/summernote-bs4.css" />
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/jquery.data-tables.css">
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/rowReorder.dataTables.min.css">
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/bootstrap-datepicker.min.css"/>
    <link rel="stylesheet" href="{{asset('public/frontend/')}}/vendors/font_awesome/css/all.min.css" />
    
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/themify-icons.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/flaticon.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/nice-select.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/magnific-popup.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/fastselect.min.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/css/toastr.min.css"/>
    <link rel="stylesheet" href="{{asset('public/backEnd/')}}/vendors/js/select2/select2.css"/>

    <link rel="stylesheet" href="{{asset('public/backEnd/vendors/css/fullcalendar.min.css')}}">

   
    <!-- color picker  -->
    
    <!-- metis menu  -->
    <link rel="stylesheet" href="{{asset('public/frontend/')}}/css/metisMenu.css">

    @yield('css')
    <link rel="stylesheet" href="{{asset('public/backEnd/css/loade.css')}}"/> 
    

   
        @if(rtl())
            <link rel="stylesheet" href="{{asset('public/backEnd/css/rtl/style.css')}}"/>
            <link rel="stylesheet" href="{{asset('public/backEnd/css/rtl/infix.css')}}"/>
        @else
            <link rel="stylesheet" href="{{asset('public/backEnd/css/style.css')}}"/>
            <link rel="stylesheet" href="{{asset('public/backEnd/css/infix.css')}}"/>
        @endif

        <link rel="stylesheet" href="{{asset('public/frontend/')}}/css/style.css" />
        <!--  -->
        @stack('css_before')


     
         <script>
            const SET_DOMAIN="{{ url('/')}}"
        </script>
</head>

<body class="admin">

<div class="preloader">
    <h3 data-text="{{ config('configs')->where('key','preloader')->first()->value }}..">{{ config('configs')->where('key','preloader')->first()->value }}..</h3>
</div>

<div class="main-wrapper" style="min-height: 600px">
    <!-- Sidebar  -->
@include('partials.sidebar')

<!-- Page Content  -->
    <div id="main-content">
@include('partials.menu')
