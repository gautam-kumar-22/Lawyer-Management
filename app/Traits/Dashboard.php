<?php

namespace App\Traits;


use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Modules\Attendance\Entities\Holiday;

trait Dashboard
{
    public function calendarEvents()
    {
        $holidays = $this->holidayRepository->all();

        if (Auth::user()->role->type == 'system_user')
            $events = $this->eventRepository->all();
        else
            $events = $this->eventRepository->roleWiseEvents();

        $calendar_events = [];
        $count_event = 0;
        foreach ($holidays as $k => $holiday) {

            $calendar_events[$k]['title'] = $holiday->name;
            $calendar_events[$k]['url'] = $holiday->name;
            $calendar_events[$k]['description'] = $holiday->name;

            if ($holiday->type == 0)
                $calendar_events[$k]['date'] = $holiday->date;
            else {
                $types = explode(',', $holiday->date);
                $calendar_events[$k]['start'] = $types[0];
                $calendar_events[$k]['end'] = Carbon::parse($types[1])->addDays(1)->format('Y-m-d');
            }
            $count_event = $k;
            $count_event++;
        }

        foreach ($events as $k => $event) {

            $calendar_events[$count_event]['title'] = $event->title;

            $calendar_events[$count_event]['start'] = $event->from_date;

            $calendar_events[$count_event]['end'] = Carbon::parse($event->to_date)->addDays(1)->format('Y-m-d');
            $calendar_events[$count_event]['description'] = $event->description;
            $calendar_events[$count_event]['url'] = $event->image;

            $count_event++;
        }

        return $calendar_events;
    }

    
}
