<!DOCTYPE html>
<html lang="en">
   <head>
      <title>@lang('common.Staff') @lang('common.Attendance')  </title>
      <meta charset="utf-8">
   </head>
   <style>
      table,th,tr,td{
      font-size: 11px !important;
      padding: 0px !important;
      text-align: center !important;
      }
      #attendance.th,#attendance.tr,#attendance.td{
      font-size: 10px !important;
      padding: 0px !important;
      text-align: center !important;
      border:1px solid #ddd;
      vertical-align: middle !important;
      }
      #attendance th{
      background: #ddd;
      text-align: center;
      }
      #attendance{
      border: 1px solid black;
      border-collapse: collapse;
      }
      #attendance tr{
      border: 1px solid black;
      border-collapse: collapse;
      }
      #attendance th{
      border: 1px solid black;
      border-collapse: collapse;
      text-align: center !important;
      font-size: 11px;
      }
      #attendance td{
      border: 1px solid black;
      border-collapse: collapse;
      text-align: center;
      font-size: 10px;
      }
   </style>
   <body>
   
      <div class="container-fluid">
         <table  cellspacing="0" width="100%">
            <tr>
            
                <td>
                  <img class="logo-img" src="{{asset(config('configs')->where('key','site_logo')->first()->value)}}" alt="">
               </td>
               <td>
                  <h3 style="font-size:22px !important" class="text-white"> {{config('configs')->where('key','site_title')->first()->value}} </h3>
                  <p style="font-size:18px !important" class="text-white mb-0"> {{ config('configs')->where('key','address')->first()->value }} </p>
               </td>

               <td style="text-aligh:center">
                  <p style="font-size:14px !important; border-bottom:1px solid gray" align="left" class="text-white">@lang('role.Role'): {{ $role->name}} </p>
                  <p style="font-size:14px !important; border-bottom:1px solid gray" align="left" class="text-white">@lang('attendance.Month'): {{ $m }} </p>
                  <p style="font-size:14px !important; border-bottom:1px solid gray" align="left" class="text-white">@lang('attendance.Year'): {{ $y }} </p>
               </td>
            </tr>
         </table>
         <h3 style="text-align:center">@lang('common.Staff') @lang('attendance.Attendance Report')</h3>
         <table id="attendance" style="width: 100%; table-layout: fixed">
            <tr>
               <th width="7%">{{ __('common.Staff') }}</th>
               <th>{{ __('attendance.P') }}</th>
               <th>{{ __('attendance.L') }}</th>
               <th>{{ __('attendance.A') }}</th>
               <th>{{ __('attendance.F') }}</th>
               <th width="7%">{{ __('attendance.Present') }}</th>
               @foreach ($report_dates as $report_date)
                   <th>
                      {{ substr ($report_date->date, -2) }}
                   </th>
               @endforeach
            </tr>
            @foreach ($users as $key => $user)
                @php
                    $total_attendance = 0;
                    $total_days_of_month = count($report_dates);
                    $absent = count($user->attendances->where('month', $m)->where('year', $y)->where('attendance', 'A'));
                    $late = count($user->attendances->where('month', $m)->where('year', $y)->where('attendance', 'L'));
                    $half_day = count($user->attendances->where('month', $m)->where('year', $y)->where('attendance', 'F'));
                    $present = count($user->attendances->where('month', $m)->where('year', $y)->where('attendance', 'P'));
                    $Totalpresent = ($late + $half_day + $present);
                    if ($total_days_of_month > 0) {
                        $total_attendance = ($Totalpresent * 100) / $total_days_of_month;
                    }
                    if (count($report_dates) > count($user->attendances->where('month', $m)->where('year', $y))) {
                        $difference = count($report_dates) - count($user->attendances->where('month', $m)->where('year', $y));
                    }else {
                        $difference = null;
                    }
                @endphp
                <tr>
                   <td>{{ $user->name }}</td>
                   <td>{{ count($user->attendances->where('month', $m)->where('year', $y)->where('attendance', 'P')) }}</td>
                   <td>{{ count($user->attendances->where('month', $m)->where('year', $y)->where('attendance', 'L')) }}</td>
                   <td>{{ count($user->attendances->where('month', $m)->where('year', $y)->where('attendance', 'A')) }}</td>
                   <td>{{ count($user->attendances->where('month', $m)->where('year', $y)->where('attendance', 'F')) }}</td>
                   <td>{{ number_format($total_attendance, 2) }} %</td>
                   @foreach($user->attendances->where('month', $m)->where('year', $y) as $attendance)
                   <td>{{ $attendance->attendance }}</td>
                   @endforeach
                   @if ($difference != null)
                       @for ($i=0; $i < $difference; $i++)
                           <td>-</td>
                       @endfor
                   @endif
                </tr>
            @endforeach
         </table>
      </div>
   </body>
</html>
