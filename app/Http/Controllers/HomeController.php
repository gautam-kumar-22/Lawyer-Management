<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Modules\Todo\Entities\ToDo;
use App\Traits\Dashboard;
use Modules\Attendance\Repositories\HolidayRepositoryInterface;
use Modules\Attendance\Repositories\EventRepositoryInterface;
use App\Models\Appointment;
use App\Models\Cases;
use Auth;
use Brian2694\Toastr\Facades\Toastr;

class HomeController extends Controller
{
    protected$eventRepository,
        $holidayRepository;

    public function __construct(EventRepositoryInterface $eventRepository,HolidayRepositoryInterface $holidayRepository)
    {
        $this->eventRepository = $eventRepository;
        $this->holidayRepository = $holidayRepository;
    }

    use Dashboard;


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = [
            'toDos' => ToDo::where('created_by', Auth::id())->get(),
            'calendar_events' => $this->calendarEvents(),
            'appointments' => Appointment::orderBy('id', 'desc')->take(10)->get(),
            'upcommingdate' => Cases::where(['status' => 'Open'])->where('hearing_date','>=', date('Y-m-d'))->orderBy('hearing_date', 'asc')->take(10)->get()
        ];
        return view('home')->with($data);

    }

    public function change_password()
    {
        return view('backEnd.profiles.password');
    }

    public function post_change_password (Request $request)
    {
        if($this->demoCheck() == true){
            Toastr::warning('This Features is disabled for demo.');
            return back();
        }
        $validation_rules = [
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ];

        $validator = Validator::make($request->all(), $validation_rules, validationMessage($validation_rules));
        $user = User::where(['email' => auth()->user()->email])->first();

        $validator->after(function ($validator) use ($user, $request) {
            if ($user and Hash::check($request->current_password, $user->password)) {
                return true;
            }
            $validator->errors()->add(
                'current_password', __('auth.failed')
            );
        });

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        $user->password = bcrypt($request->password);
        $user->save();
        Toastr::success(__('common.Password change successful'), __('common.success'));
        return redirect()->route('home');

    }
}
