<div class="main-title mb-25">
    <h3 class="mb-0">{{ __('setting.Activation') }}</h3>
</div>

<div class="common_QA_section QA_section_heading_custom">
    <div class="QA_table ">
        <!-- table-responsive -->
        <div class="">
            <table class="table Crm_table_active2">
                <thead>
                    <tr>
                        <th scope="col">{{ __('SL') }}</th>
                        <th scope="col">{{ __('setting.Type') }}</th>
                        <th scope="col" class="text-right">{{ __('setting.Activate') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($business_settings as $key => $business_setting)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ strtoupper(str_replace("_"," ",$business_setting->type)) }}</td>
                            <td class="text-right">
                                <label class="switch_toggle" for="checkbox{{ $business_setting->id }}">
                                    <input type="checkbox" id="checkbox{{ $business_setting->id }}" @if ($business_setting->status == 1) checked @endif value="{{ $business_setting->id }}" onchange="update_active_status(this)">
                                    <div class="slider round"></div>
                                </label>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
