@extends('layouts.master', ['title' => __('court.Court')])

@section('mainContent')

<section class="admin-visitor-area up_st_admin_visitor">
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="box_header">
                    <div class="main-title d-flex justify-content-between w-100">
                        <h3 class="mb-0 mr-30">{{ __('court.Court Details') }}</h3>
                        
                    </div>
                </div>
            </div>
                <div class="col-12">
                    <div class="white_box_50px box_shadow_white">

                    <table>
                    <tbody>
                        <tr>
                            <td class="p-2">{{__('court.Category Name')}} </td>
                            <td>:</td>
                            <td> 
                                @if($model->court_category)
                                <a href="{{ route('category.court.show', $model->court_category->id) }}"> {{ $model->court_category->name }} </a>
                                @else
                                <span class="badge_4">{{ __('court.No Category') }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td class="p-2">{{__('court.Name')}} </td>
                            <td>:</td>
                            <td>{{ $model->name }}</td>
                        </tr>

                        <tr>
                            <td class="p-2">{{__('court.Room No')}} </td>
                            <td>:</td>
                            <td>{{ $model->room_number ? $model->room_number : '' }}</td>
                        </tr>

                        <tr>
                            <td class="p-2">{{__('court.Location')}} </td>
                            <td>:</td>
                            <td>
                                {{ $model->state ? $model->state->name .', ' : '' }}
                                {{ $model->city ? $model->city->name .', ' : ''}}
                                {{ $model->location }}    
                            </td>
                        </tr>

                        <tr>
                            <td class="p-2">{{__('court.Description')}} </td>
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
