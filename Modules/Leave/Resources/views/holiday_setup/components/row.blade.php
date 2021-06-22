<tr>
    <td>
        <div class="primary_input mb-15">
            <label class="primary_input_label"
                   for="">{{__('holiday.Holiday Name')}}</label>
            <input type="text" name="holiday_name[]"
                   class="primary_input_field"
                   placeholder="{{__('holiday.Holiday Name')}}">
            <span
                class="text-danger">{{$errors->first('holiday_name')}}</span>
        </div>
    </td>
    <td>
        <div class="primary_input mb-15">
            <label class="primary_input_label"
                   for="">{{__('holiday.Select Type')}} *</label>
            <select class="primary_select mb-15 type"
                    name="type[]">
                <option value="0">{{__('holiday.Single Day')}}</option>
                <option value="1">{{__('holiday.Multiple Day')}}</option>
            </select>
            <span class="text-danger">{{$errors->first('type')}}</span>
        </div>
    </td>
    <td>
        <div class="single_date">
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
                                       type="text"
                                       name="date[]"
                                       value="{{date('Y-m-d')}}"
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
        <div class="multiple_date" style="display: none">
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
                                       value="{{date('Y-m-d')}}"
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
                                       type="text"
                                       name="end_date[]"
                                       value="{{date('Y-m-d')}}"
                                       autocomplete="off">
                            </div>
                        </div>
                        <button class="" type="button">
                            <i class="ti-calendar"></i>
                        </button>
                    </div>
                </div>
                <span
                    class="text-danger">{{$errors->first('end_date')}}</span>
            </div>
        </div>
    </td>
    <td>
        <a class="primary-btn mt-30 primary-circle fix-gr-bg"
           href="javascript:void(0)" onclick="addRow()"> <i
                class="ti-plus"></i></a>

    </td>
</tr>
