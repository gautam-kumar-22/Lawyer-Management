@extends('layouts.master', ['title' => __('client.Update Client Category')])

@section('mainContent')


<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="box_header">
                    <div class="main-title d-flex justify-content-between w-100">
                        <h3 class="mb-0 mr-30">{{ __('client.Client Category') }}</h3>
                        
                    </div>
                </div>
            </div>
                <div class="col-12">
                    <div class="white_box_50px box_shadow_white">

                    <table>
                    <tbody>
                        <tr>
                            <td class="p-2">{{__('client.Category Name')}} </td>
                            <td>:</td>
                            <td>{{ $model->name }}</td>
                        </tr>
                        <tr>
                            <td class="p-2">{{__('client.On Behalf of')}} </td>
                            <td>:</td>
                            <td>{!! $model->plaintiff ? '<span class="badge_1"> {{__('client.Plaintiff')}} </span>' : '<span class="badge_4"> {{__('client.Opposite')}} </span>' !!}</td>
                        </tr>
                        <tr>
                            <td class="p-2">{{__('client.Description')}} </td>
                            <td>:</td>
                            <td>{!! $model->description !!}</td>
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
@endpush