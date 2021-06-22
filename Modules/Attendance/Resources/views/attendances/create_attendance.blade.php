@if (count($users) > 0)
    <form class="" action="{{ route('attendances.store') }}" method="post">
        @csrf
        <input type="hidden" name="date" value="{{$date}}">
        <div class="col-lg-12 mb-2 mt-3">
            <div class="d-flex">
                <button type="submit" class="primary-btn btn-sm fix-gr-bg" id="save_button_parent"><i class="ti-check"></i>{{ __('common.Save') }}</button>
            </div>
        </div>
        <div class="common_QA_section QA_section_heading_custom th_padding_l0">
            <div class="QA_table ">
                <!-- table-responsive -->
                <div class="">
                    <table class="table Crm_table_active2 pt-0 shadow_none pt-0 pb-0">
                        <thead>
                            <tr>
                                <th scope="col">{{ __('common.SL') }}</th>
                                <th scope="col">{{ __('attendance.Name') }}</th>
                                <th scope="col">{{ __('attendance.Attendance') }}</th>
                                <th scope="col">{{ __('attendance.Note') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $key => $user)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>
                                        <input type="hidden" name="user[]" value="{{ $user->id }}">
                                        <div class="d-flex radio-btn-flex">
                                            <div class="mr-20">
                                                <input type="radio" name="attendance[{{$user->id}}]" id="attendanceP{{$user->id}}" value="P" checked class="common-radio attendanceP">
                                                <label for="attendanceP{{$user->id}}">{{__('attendance.Present')}}</label>
                                            </div>
                                            <div class="mr-20">
                                                <input type="radio" name="attendance[{{$user->id}}]" id="attendanceL{{$user->id}}" value="L" @if (attendanceCheck($user->id, 'L',$date)) checked @endif class="common-radio">
                                                <label for="attendanceL{{$user->id}}">{{__('attendance.Late')}}</label>
                                            </div>
                                            <div class="mr-20">
                                                <input type="radio" name="attendance[{{$user->id}}]" id="attendanceA{{$user->id}}" value="A" @if (attendanceCheck($user->id, 'A',$date)) checked @endif class="common-radio">
                                                <label for="attendanceA{{$user->id}}">{{__('attendance.Absent')}}</label>
                                            </div>
                                            <div>
                                                <input type="radio" name="attendance[{{$user->id}}]" id="attendanceH{{$user->id}}" value="F" @if (attendanceCheck($user->id, 'H',$date)) checked @endif class="common-radio">
                                                <label for="attendanceH{{$user->id}}">{{__('attendance.Holiday')}}</label>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="primary_input mb-25">
                                            <input name="note_{{ $user->id }}" class="primary_input_field name" @if (attendanceNote($user->id)) value="{{ Note($user->id) }}" @else value="" @endif placeholder="Note" type="text">
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>
@endif
