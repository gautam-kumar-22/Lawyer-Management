<div class="row">
    <div class="col-md-6">
        <h4 class="border-bottom pb-2">{{__('holiday.Holidays of')}} {{$holiday->year}}</h4>
    </div>
    <div class="col-md-6 text-right">
        <a href="{{route('year.data',$holiday->id)}}"
           class="primary-btn small fix-gr-bg text-uppercase bord-rad">
            {{__('common.Edit')}} <span class="ti-pencil"></span>
        </a>
    </div>
    <div class="col-md-12">
        <div class="QA_section QA_section_heading_custom check_box_table">
            <div class="QA_table ">
                <!-- table-responsive -->
                <div class="apply_leave_list">
                    <table class="table Crm_table_active">
                        <thead>
                        <tr>
                            <th scope="col">{{ __('holiday.Purpose') }}</th>
                            <th scope="col">{{ __('holiday.Days') }}</th>
                            <th scope="col">{{ __('holiday.Date') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php
                            $day = 0;
                        @endphp
                        @foreach($holidays as $holiday)
                            @if($holiday->name)
                                @php
                                    if ($holiday->type == 0)
                                        {
                                            $date = $holiday->date;
                                            $day = 1;
                                        }
                                    else
                                        {
                                            $date = str_replace(","," - ",$holiday->date);
                                            $dates = explode(',',$holiday->date);
                                            $from = \Carbon\Carbon::parse($dates[0]);
                                            $to = \Carbon\Carbon::parse($dates[1]);
                                            $day = $to->diffInDays($from);
                                        }
                                @endphp
                                <tr>
                                    <td>{{ $holiday->name }}</td>
                                    <td>{{ $day }}</td>
                                    <td>{{ $date }}</td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
