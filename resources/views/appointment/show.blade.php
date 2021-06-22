@extends('layouts.master', ['title' => __('appointment.Appointment Details')])

@section('mainContent')

<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="box_header">
                    <div class="main-title d-flex justify-content-between w-100">
                        <h3 class="mb-0 mr-30">{{ __('appointment.Appointment Details') }}</h3>
                        
                    </div>
                </div>
            </div>
                <div class="col-12">
                    <div class="white_box_50px box_shadow_white">

                    <table>
                    <tbody>
                        <tr>
                            <td class="p-2">{{__('common.Title')}} </td>
                            <td>:</td>
                            <td>{{ $model->title }}</td>
                        </tr>

                        <tr>
                            <td class="p-2">{{__('appointment.Contact name')}} </td>
                            <td>:</td>
                            <td>{{ $model->contact->name }}</td>
                        </tr>


                        <tr>
                            <td class="p-2">{{__('appointment.Motive')}} </td>
                            <td>:</td>
                            <td>{{ $model->motive }}</td>
                        </tr>

                        <tr>
                            <td class="p-2">{{__('common.Date')}} </td>
                            <td>:</td>
                            <td>{{ formatDate($model->date) }}</td>
                        </tr>


                        
                        <tr>
                            <td class="p-2">{{__('appointment.Notes')}} </td>
                            <td>:</td>
                            <td>{!! $model->notes !!}</td>
                        </tr>
                    </tbody>
                    </table>

                  
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@stop
@push('admin.scripts')
<script>
$('.printMe').click(function(){
window.print();
});
</script>
@endpush