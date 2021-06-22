<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ getConfigValueByKey(config('configs'), 'company_name') }}</title>
    <link rel="stylesheet" href="{{asset('public/backEnd/css/report/bootstrap.min.css')}}">

    <style>
        .invoice_heading {
            border-bottom: 1px solid black;
            padding: 20px;
            text-transform: capitalize;
        }

        .invoice_logo {
            width: 50%;
            float: left;
            text-align: left;
        }

        .invoice_logo_right {
            width: 50%;
            float: right;
            text-align: right;
        }

        .invoice_no {
            text-align: right;
            color: #415094;
        }

        .invoice_info {
            padding: 20px;
            text-transform: capitalize;
        }

        .billing_info {
            margin-top: 115px;
        }

        table {
            text-align: left;
        }

        td, th {
            color: #828bb2;
            font-size: 13px;
            font-weight: 400;
            font-family: "Poppins", sans-serif;
        }

        th {
            font-weight: 600;
        }

        li {
            list-style-type: none;
            text-align: left;
        }

        .sale_note {
            width: 45%;
            float: left;
            text-align: left;
        }

        .notes {
            color: #415094;
            font-size: 18px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .note_details {
            font-size: 14px;
            font-weight: 600;
            color: #828BB2 !important;
        }
    </style>
</head>
<body>
<div class="invoice_heading">
    <div class="invoice_logo">
        <img src="{{ getConfigValueByKey(config('configs'), 'site_logo') ?? asset('public/uploads/settings/logo.png')}}" width="100px" alt="">
    </div>
    <div class="invoice_no">
        <h4>{{ __('leave.Leave Application') }}</h4>
    </div>
</div>
<div class="invoice_info">
    <div class="invoice_logo">
        <table class="table-borderless">
            <tr>
                <td><b>{{__('sale.Company')}}</b></td>
                <td><b>:</b></td>
                <td>{{ getConfigValueByKey(config('configs'), 'company_name') }}</td>
            </tr>
            <tr>
                <td><b>{{__('common.Phone')}}</b></td>
                <td><b>:</b></td>
                <td><a href="tel:{{ getConfigValueByKey(config('configs'), 'phone')}}">{{getConfigValueByKey(config('configs'), 'phone')}}</a></td>
            </tr>
            <tr>
                <td><b>{{__('common.Email')}}</b></td>
                <td><b>:</b></td>
                <td><a href="mailto:{{getConfigValueByKey(config('configs'), 'email')}}">{{getConfigValueByKey(config('configs'), 'email')}}</a>
                </td>
            </tr>
            <tr>
                <td><b>{{__('payroll.Address')}}</b></td>
                <td><b>:</b></td>
                <td><a href="">{{getConfigValueByKey(config('configs'), 'address')}}</a></td>
            </tr>
        </table>
    </div>
    <div class="invoice_logo">
        <table class="table-borderless">
            <tr>
                <td><b>{{__('payroll.Prepared By')}}</b></td>
                <td><b>:</b></td>
                <td>{{ userName($apply_leave->created_by) }}</td>
            </tr>
            <tr>
                <td><b>{{__('payroll.Approved By')}}</b></td>
                <td><b>:</b></td>
                <td>{{$apply_leave->approved_by ? $apply_leave->approveUser->name : ''}}</td>
            </tr>
        </table>
    </div>
</div>
<div class="invoice_info">
    <table class="table table-bordered billing_info">
        <tr>
            <th scope="col">{{ __('leave.Type') }}</th>
            <td class="p-2">{{$apply_leave->leave_type->name}}</td>
        </tr>
        <tr>
            <th scope="col">{{ __('leave.Staff') }}</th>
            <td class="p-2">{{$apply_leave->user->name}}</td>
        </tr>

        <tr>
            <th scope="col">{{ __('common.Email') }}</th>
            <td class="p-2">{{$apply_leave->user->email}}</td>
        </tr>
        <tr>
            <th scope="col">{{ __('leave.From') }}</th>
            <td class="p-2">{{dateConvert($apply_leave->start_date)}}</td>
        </tr>
        <tr>
            <th scope="col">{{ __('leave.To') }}</th>
            <td class="p-2">{{dateConvert($apply_leave->end_date)}}</td>
        </tr>
        <tr>
            <th scope="col">{{ __('leave.Apply Date') }}</th>
            <td class="p-2">{{dateConvert($apply_leave->apply_date)}}</td>
        </tr>
        <tr>
            <th scope="col">{{ __('common.Status') }}</th>
            <td class="p-2"><span
                    class="pending"> {{$apply_leave->status == 0 ? __('leave.Pending') : ($apply_leave->status == 1 ? __('leave.Approved') :__('leave.Cancelled') )}}</span>
            </td>
        </tr>
        @if($apply_leave->approved_by)
            <tr>
                <th scope="col">{{ __('leave.Approved By') }}</th>
                <td class="p-2">{{$apply_leave->approveUser->name}}</td>
            </tr>
        @endif
        <tr>
            <th scope="col">{{ __('leave.Reason') }}</th>
            <td class="p-2">{{$apply_leave->reason}}</td>
        </tr>

        <tr>
            <th scope="col">{{ __('leave.Attachment') }}</th>
            <td class="p-2">
                @if ($apply_leave->attachment)
                    <a href="{{ asset($apply_leave->attachment) }}" download
                       target="_blank">{{ __('leave.See Attachment') }}
                    </a>
                @else {{ __('leave.Not Available') }}
                @endif
            </td>
        </tr>
        @php
            $remaining_leave_days = 0;
            $extra_leave_days =  0;
            if ($total_leave->sum('total_days') > $apply_leave_histories->sum('total_days')) {
                $remaining_leave_days = $total_leave->sum('total_days') - $apply_leave_histories->sum('total_days');
            }else {
                $extra_leave_days =  $apply_leave_histories->sum('total_days') - $total_leave->sum('total_days');
            }
        @endphp
        <tr>
            <th scope="col">{{ __('leave.Total Leave') }}</th>
            <td class="p-2">{{$total_leave->sum('total_days') }} {{__('leave.Days')}}</td>
        </tr>
        <tr>
            <th scope="col">{{ __('leave.Remaining Total Leave') }}</th>
            <td class="p-2">{{ $remaining_leave_days }} {{__('leave.Days')}}</td>
        </tr>
        <tr>
            <th scope="col">{{ __('leave.Extra Taken Leave') }}:</th>
            <td class="p-2">{{ $extra_leave_days }} {{__('leave.Days')}}</td>
        </tr>
    </table>
</div>
</body>
</html>
