<?php

namespace Modules\Leave\Repositories;

use Carbon\CarbonPeriod;
use DateTime;
use Modules\Attendance\Entities\Attendance;
use Carbon\Carbon;
use Modules\Attendance\Repositories\AttendanceRepository;
use Modules\Leave\Entities\Holiday;
use Modules\RolePermission\Repositories\RoleRepository;

class HolidayRepository implements HolidayRepositoryInterface
{
    public function all()
    {
        return Holiday::all();
    }

    public function create(array $data)
    {
        Holiday::where('year', $data['year'])->delete();
        foreach ($data['holiday_name'] as $key => $name) {
            if ($data['holiday_name'][$key]) {
                Holiday::create([
                    'year' => $data['year'],
                    'name' => $data['holiday_name'][$key],
                    'type' => $data['type'][$key],
                    'date' => $data['type'][$key] == 0 ? Carbon::parse($data['date'][$key])->format('Y-m-d') : Carbon::parse($data['start_date'][$key])->format('Y-m-d') . ',' . Carbon::parse($data['end_date'][$key])->format('Y-m-d'),
                ]);
            }
            $date = $data['type'][$key] == 0 ? $data['date'][$key] : $data['start_date'][$key] . ',' . $data['end_date'][$key];
            $attendance_repo = new AttendanceRepository();
            $role_repo = new RoleRepository();
            $attendance_repo->attendanceByDate($date,$data['type'][$key]);
            $roles = $role_repo->all()->where('type', '!=', 'system_user');
            foreach ($roles as $role) {
                $users = $attendance_repo->get_user_by_role($role->id);
                $dates =[];

                if ($data['type'][$key] == 1)
                {
                   $period =  CarbonPeriod::create(Carbon::parse($data['start_date'][$key])->format('Y-m-d'), Carbon::parse($data['end_date'][$key])->format('Y-m-d'));
                  foreach ($period as $date)
                      $dates[] = $date->format('Y-m-d');
                }

                foreach ($users as $k => $user) {

                    if ($data['type'][$key] == 0)
                    {
                        $attendance_user = new Attendance;
                        $attendance_user->user_id = $user->id;
                        $attendance_user->date = Carbon::parse($data['date'][$key]);
                        $attendance_user->day = Carbon::parse($data['date'][$key])->format('l');
                        $attendance_user->month = Carbon::parse($data['date'][$key])->format('F');
                        $attendance_user->year = Carbon::parse($data['date'][$key])->year;
                        $attendance_user->role_id = $role->id;
                        $attendance_user->attendance = 'H';
                        $attendance_user->note = "Holiday for {$name}";
                        $attendance_user->save();
                    }
                    else{
                        foreach ($dates as $date)
                        {
                            $attendance_user = new Attendance;
                            $attendance_user->user_id = $user->id;
                            $attendance_user->date = $date;
                            $attendance_user->day = Carbon::parse($date)->format('l');
                            $attendance_user->month = Carbon::parse($date)->format('F');
                            $attendance_user->year = Carbon::parse($date)->year;
                            $attendance_user->role_id = $role->id;
                            $attendance_user->attendance = 'H';
                            $attendance_user->note = "Holiday for {$name}";
                            $attendance_user->save();
                        }
                    }

                }

            }
        }

    }

    public function find($id)
    {
        return Holiday::find($id);
    }

    public function year($year)
    {
        $year = isset($year) ? $year : Carbon::now()->year;
        return Holiday::where('year', $year)->get();
    }

    public function specificYear($year)
    {
        return Holiday::where('year', $year)->get();
    }

    public function copyYear($year)
    {
        return Holiday::where('year', $year)->get();
    }

    public function getHoliday($date)
    {
        return Holiday::where('date', $date)->latest()->first();
    }

    public function holidayYears()
    {
        return Holiday::groupBy('year')->orderBy('year','desc')->get();
    }

    public function yearCreate(array $data)
    {
        return Holiday::create([
            'year' => $data['year'],
        ]);
    }

    public function yearDelete($year)
    {
        return Holiday::where('year',$year)->delete();
    }

}
