@extends('layouts.master', ['title' => 'Permission'])
@section('mainContent')

<link rel="stylesheet" href="{{asset('public/backEnd/css/role_module_style.css')}}">

    <div class="role_permission_wrap">
            <div class="permission_title">
                <h4>@lang('role.Assign Permission') ({{@$role->name}})</h4>
            </div>
    </div>
    {{ Form::open(['class' => 'form-horizontal', 'files' => true, 'route' => 'permission.permissions.store','method' => 'POST']) }}
    <div class="erp_role_permission_area ">
    <!-- single_permission  -->
    <input type="hidden" name="role_id" value="{{@$role->id}}">
    <div  class="mesonary_role_header">
        @foreach ($MainMenuList as $key => $Module)
            @include('rolepermission::page-components.permissionModule',[ 'key' =>$key, 'Module' =>$Module ])
        @endforeach
    </div>


        <div class="row mt-40">
            <div class="col-lg-12 text-center">
                <button class="primary-btn fix-gr-bg">
                    <span class="ti-check"></span>
                    @lang('common.Submit')
                </button>
            </div>
        </div>

    </div>
{{ Form::close() }}
@endsection



@push('scripts')
<script type="text/javascript">


    $('.permission-checkAll').on('click', function () {
       if($(this).is(":checked")){
            $( '.module_id_'+$(this).val() ).each(function() {
              $(this).prop('checked', true);
            });
       }else{
            $( '.module_id_'+$(this).val() ).each(function() {
              $(this).prop('checked', false);
            });
       }
    });

    $('.module_link').on('click', function () {
       var module_id = $(this).parents('.single_permission').attr("id");
       var module_link_id = $(this).val();
       if($(this).is(":checked")){
            $(".module_option_"+module_id+'_'+module_link_id).prop('checked', true);
        }else{
            $(".module_option_"+module_id+'_'+module_link_id).prop('checked', false);
        }
       var checked = 0;
       $( '.module_id_'+module_id ).each(function() {
          if($(this).is(":checked")){
            checked++;
          }
        });

        if(checked > 0){
            $(".main_module_id_"+module_id).prop('checked', true);
        }else{
            $(".main_module_id_"+module_id).prop('checked', false);
        }
     });

    $('.module_link_option').on('click', function () {
       var module_id = $(this).parents('.single_permission').attr("id");
       var module_link = $(this).parents('.module_link_option_div').attr("id");
       // module link check
        var link_checked = 0;
       $( '.module_option_'+module_id+'_'+ module_link).each(function() {
          if($(this).is(":checked")){
            link_checked++;
          }
        });

        if(link_checked > 0){
            $("#Sub_Module_"+module_link).prop('checked', true);
        }else{
            $("#Sub_Module_"+module_link).prop('checked', false);
        }

       // module check
       var checked = 0;

       $( '.module_id_'+module_id ).each(function() {
          if($(this).is(":checked")){
            checked++;
          }
        });

        if(checked > 0){
            $(".main_module_id_"+module_id).prop('checked', true);
        }else{
            $(".main_module_id_"+module_id).prop('checked', false);
        }
     });

</script>

@endpush
