@foreach ($holidays as $holiday)
    @if($holiday->name)
        <tr class="add_row">
            <td>
                <div class="primary_input mb-15">
                    <label class="primary_input_label"
                           for="">{{__('holiday.Holiday Name')}}</label>
                    <input type="text" name="holiday_name[]"
                           class="primary_input_field"
                           placeholder="{{__('holiday.Holiday Name')}}"
                           value="{{$holiday->name}}">
                    <span
                        class="text-danger">{{$errors->first('holiday_name')}}</span>
                </div>
            </td>
            <td>
                <div class="primary_input mb-15">
                    <label class="primary_input_label"
                           for="">{{__('holiday.Select Type')}} *</label>
                    <select class="primary_select mb-15 type" name="type[]">
                        <option
                            value="0" {{$holiday->type == 0 ? 'selected' : ''}}>{{__('holiday.Single Day')}}</option>
                        <option
                            value="1" {{$holiday->type == 1 ? 'selected' : ''}}>{{__('holiday.Multiple Day')}}</option>
                    </select>
                    <span
                        class="text-danger">{{$errors->first('type')}}</span>
                </div>
            </td>
            <td>
                <div class="single_date" @if ($holiday->type == 1)
                style="display: none"
                    @endif>
                    <div class="primary_input mb-15">
                        <label class="primary_input_label"
                               for="">{{ __('sale.Date') }}
                            *</label>
                        <div class="primary_datepicker_input">
                            <div class="no-gutters input-right-icon">
                                <div class="col">
                                    <div class="">
                                        <input placeholder="Date"
                                               class="primary_input_field primary-input date form-control"
                                               type="text" name="date[]"
                                               value="{{date('Y-m-d',strtotime($holiday->date)) }}"
                                               autocomplete="off">
                                    </div>
                                </div>
                                <button class="" type="button">
                                    <i class="ti-calendar"></i>
                                </button>
                            </div>
                        </div>
                        <span class="text-danger">{{$errors->first('date')}}</span>
                    </div>
                </div>
                @php
                    $start_date = '';
                    $end_date = '';
                    $date = [];
                    if ($holiday->type == 1)
                        {
                            $date = explode(',',$holiday->date);
                            $start_date = $date[0];
                            $end_date = $date[1];
                        }
                @endphp
                <div class="multiple_date" @if ($holiday->type == 0)
                style="display: none"
                    @endif>
                    <div class="primary_input mb-15">
                        <label class="primary_input_label"
                               for="">{{ __('holiday.Start Date') }}
                            *</label>
                        <div class="primary_datepicker_input">
                            <div class="no-gutters input-right-icon">
                                <div class="col">
                                    <div class="">
                                        <input placeholder="Date"
                                               class="primary_input_field primary-input date form-control"
                                               type="text"
                                               name="start_date[]"
                                               value="{{!empty($date) ? date('Y-m-d',strtotime($date[0]))  : date('Y-m-d')}}"
                                               autocomplete="off">
                                    </div>
                                </div>
                                <button class="" type="button">
                                    <i class="ti-calendar"></i>
                                </button>
                            </div>
                        </div>
                        <span
                            class="text-danger">{{$errors->first('start_date')}}</span>
                    </div>
                    <div class="primary_input mb-15">
                        <label class="primary_input_label"
                               for="">{{ __('holiday.End Date') }}
                            *</label>
                        <div class="primary_datepicker_input">
                            <div class="no-gutters input-right-icon">
                                <div class="col">
                                    <div class="">
                                        <input placeholder="Date"
                                               class="primary_input_field primary-input date form-control"
                                               type="text" name="end_date[]"
                                               value="{{!empty($date) ? date('Y-m-d',strtotime($date[1])) : date('Y-m-d')}}"
                                               autocomplete="off">
                                    </div>
                                </div>
                                <button class="" type="button">
                                    <i class="ti-calendar"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <span
                        class="text-danger">{{$errors->first('end_date')}}</span>
                </div>
            </td>
            <td>
                <a class="primary-btn mt-30 primary-circle delete_row fix-gr-bg"
                   href="javascript:void(0)"> <i
                        class="ti-trash" onclick="removeRow()"></i></a>
            </td>
        </tr>
    @endif
@endforeach
