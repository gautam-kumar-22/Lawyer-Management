<?php

namespace Modules\Leave\Http\Controllers;

use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Leave\Repositories\HolidayRepositoryInterface;


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
        $data = [
            'years' => $this->holidayRepository->holidayYears(),
            'view' => 1,
            'holidays' => $holidays,
            'holiday' => $holidays->first(),
        ];
        return view('leave::holiday_setup.index')->with($data);
    }

    public function yearData($id)
    {
        $holiday = $this->holidayRepository->find($id);
        $data = [
            'years' => $this->holidayRepository->holidayYears(),
            'holidays' => $this->holidayRepository->year($holiday->year),
            'holiday' => $holiday,
            'edit' => 1,
        ];
        return view('leave::holiday_setup.index')->with($data);
    }

    public function viewYearData($id)
    {
        $holiday = $this->holidayRepository->find($id);
        $data = [
            'years' => $this->holidayRepository->holidayYears(),
            'holidays' => $this->holidayRepository->year($holiday->year),
            'holiday' => $holiday,
            'view' => 1,
        ];
        return view('leave::holiday_setup.index')->with($data);
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
            Toastr::success(trans('Holiday Settings Saved Successfully'));
            return redirect()->route('holidays.index');
        } catch (\Exception $e) {
            DB::rollBack();
            Toastr::error(trans('common.Something Went Wrong'));
            return back();
        }

    }

    public function addRow(Request $request)
    {
        $year = $request->year ?? null;
        $holidays = $this->holidayRepository->year($year);
        if ($year)
            return view('leave::holiday_setup.row',compact('year','holidays'));
        else
            return view('leave::holiday_setup.row',compact('year','holidays'));
    }

    public function getLastYearData(Request $request)
    {
        try {
            $holidays = $this->holidayRepository->copyYear($request->year);
            $data = [
                'years' => $this->holidayRepository->holidayYears(),
                'holidays' => $holidays,
                'holiday' => $holidays->first(),
                'edit' => 1,
            ];
            return view('leave::holiday_setup.components.edit')->with($data);

        } catch (\Exception $e) {
            Toastr::error(trans('common.Something Went Wrong'));
            return trans('common.Something Went Wrong');
        }
    }

    public function holidayAdd(Request $request)
    {

        try {
            $this->holidayRepository->yearCreate($request->except('_token'));
            Toastr::success(trans('holiday.Year Created Successfully'));
            return back();
        } catch (\Exception $e) {
            Toastr::success(trans('common.Something Went Wrong'));
            return back();
        }
    }

    public function holidayDelete(Request $request)
    {
        try {
            $this->holidayRepository->yearDelete($request->year);
            Toastr::success(trans('holiday.Year Deleted Successfully'));
            return redirect()->route('holidays.index');
        } catch (\Exception $e) {
            Toastr::success(trans('common.Something Went Wrong'));
            return back();
        }
    }
}
