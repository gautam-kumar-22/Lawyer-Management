<?php

namespace Modules\Attendance\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Attendance\Repositories\HolidayRepositoryInterface;


class HolidayController extends Controller
{
    public $holidayRepository;

    public function __construct(HolidayRepositoryInterface $holidayRepository)
    {
        $this->holidayRepository = $holidayRepository;
    }
    public function index()
    {
        $holidays = $this->holidayRepository->year(null);
        return view('attendance::holiday_setup.index',compact('holidays'));
    }

    public function create()
    {
        return view('attendance::create');
    }

    public function store(Request $request)
    {

        session()->put('holidays',$request->except('_token'));

        $validate_rules = [
            'holiday_name' => 'required',
            'type' => 'required',
            'date' => 'required_if:type,==,0',
            'start_date' => 'required_if:type,==,1',
            'end_date' => 'required_if:type,==,1',
        ];
        $request->validate($validate_rules, validationMessage($validate_rules));

        DB::beginTransaction();

        try {
            $this->holidayRepository->create($request->except('_token'));
            DB::commit();
            session()->forget('holidays');
            Toastr::success(trans('holiday.Holiday Settings Saved Successfully'));
            return back();
        } catch (\Exception $e) {
            DB::rollBack();

            Toastr::error(trans('common.Something Went Wrong'));
            return back();
        }

    }

    public function show($id)
    {
        return view('attendance::show');
    }

    public function edit($id)
    {
        return view('attendance::edit');
    }

    public function addRow(Request $request)
    {
        $year = $request->year ?? null;
        $holidays = $this->holidayRepository->year($year);
        if ($year)
            return view('attendance::holiday_setup.row',compact('year','holidays'));
        else
            return view('attendance::holiday_setup.row',compact('year','holidays'));
    }

    public function getLastYearData()
    {
        DB::beginTransaction();
        try {
            $holidays = $this->holidayRepository->copyYear();
            session()->forget('holidays');
            DB::commit();
            Toastr::success(trans('holiday.Holiday Settings Saved Successfully'));
            return back();
        } catch (\Exception $e) {
            DB::rollBack();

            Toastr::error(trans('common.Something Went Wrong'));
            return back();
        }
    }
}
