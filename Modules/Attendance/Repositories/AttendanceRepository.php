<?php

namespace Modules\Attendance\Repositories;

use Modules\Attendance\Entities\Attendance;
use Carbon\Carbon;
use DateTime;
use App\User;
use Illuminate\Support\Facades\DB;
use Modules\Attendance\Entities\Holiday;

class AttendanceRepository implements AttendanceRepositoryInterface
{
    public function all()
    {
        //
    }

    public function create(array $data)
    {
        $total_today_attendace = Attendance::where('date', Carbon::parse($data['date']))->count();
        $update_user_attendance = count($data['user']);
        $day = new DateTime($data['date']);
        if ($total_today_attendace < $update_user_attendance) {
            foreach ($data['user'] as $key => $user_id) {
                $user_exist = Attendance::where('user_id', $user_id)->where('date', Carbon::parse($data['date']))->first();
                if ($user_exist == null) {
                    $attendance_user = new Attendance;
                    $attendance_user->user_id = $user_id;
                    $attendance_user->date = Carbon::parse($data['date']);
                    $attendance_user->day = $day->format('l');
                    $attendance_user->month = $day->format('F');
                    $attendance_user->year = now()->year;
                    $attendance_user->save();
                }
            }
        }
        foreach ($data['attendance'] as $key => $value) {
            $role = User::find($key)->role_id;
            $attendance = Attendance::where('user_id', $key)->where('date', Carbon::parse($data['date']))->first();
            $attendance->user_id = $key;
            $attendance->role_id = $role;
            $attendance->attendance = $value;
            $attendance->note = $data['note_' . $key];
            $attendance->save();
        }
    }

    public function get_user_by_role($id)
    {
        return User::where('role_id', $id)->get();
    }

    public function report(array $data)
    {
        return Attendance::where('role_id', $data['role_id'])->where('month', $data['month'])->where('year', $data['year'])->get();
    }

    public function date(array $data)
    {
        return Attendance::where('month', $data['month'])->where('year', $data['year'])->distinct()->get(['date']);
    }

    public function user(array $data)
    {
        return User::where('role_id', $data['role_id'])->get();
    }

    public function attendanceByDate($date,$type)
    {
        if ($type == 0)
            return Attendance::whereDate('date',$date)->delete();
        else
        {
            $date_range = explode(',',$date);
            $start_date = $date_range[0];
            $end_date = $date_range[1];
            return Attendance::whereBetween('date',[$start_date,$end_date])->delete();
        }

    }
}
