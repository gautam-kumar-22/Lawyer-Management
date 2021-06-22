<?php

namespace Modules\Setting\Http\Controllers;
use Illuminate\Routing\Controller;

use Illuminate\Http\Request;
use Modules\Setting\Model\Currency;
use Brian2694\Toastr\Facades\Toastr;
use Modules\Setting\Repositories\CurrencyRepositoryInterface;

class CurrencyController extends Controller
{
    protected $currencyRepository;

    public function __construct(CurrencyRepositoryInterface $currencyRepository)
    {
        $this->middleware(['auth']);
        $this->currencyRepository = $currencyRepository;
    }

    public function index(Request $request)
    {
        try{
            $search_keyword = null;
            if ($request->input('search_keyword') != null) {
                $search_keyword = $request->input('search_keyword');
                $currencies = $this->currencyRepository->serachBased($search_keyword);
            }
            else {
                $currencies = $this->currencyRepository->all();
            }

            return view('setting::currencies.index', [
                "currencies" => $currencies,
                "search_keyword" => $search_keyword
            ]);
        }catch (\Exception $e) {

            Toastr::error(__('common.Something Went Wrong'));
            return back();
        }

    }

    public function store(Request $request)
    {
        $validate_rules = [
            "name" => "required",
            "code" => "required",
            "symbol" => "required"
        ];
        $request->validate($validate_rules, validationMessage($validate_rules));

        try {
            $this->currencyRepository->create($request->except("_token"));
            Toastr::success(__('setting.Currency Added Successfully'));
            return back();
        } catch (\Exception $e) {

            Toastr::error(__('common.Something Went Wrong'));
            return back();
        }
    }

    public function update(Request $request, $id)
    {
        $validate_rules = [
            "name" => "required",
            "code" => "required",
            "symbol" => "required"
        ];
        $request->validate($validate_rules, validationMessage($validate_rules));

        try {
            $currency = $this->currencyRepository->update($request->except("_token"), $id);
            Toastr::success(__('setting.Currency Updated Successfully'));
            return back();
        } catch (\Exception $e) {

            Toastr::error(__('common.Something Went Wrong'));
            return back();
        }
    }

    public function destroy($id)
    {
        try {
            $currency = $this->currencyRepository->delete($id);
            Toastr::success(__('setting.Currency has been deleted Successfully'));
            return back();
        } catch (\Exception $e) {

            Toastr::error(__('common.Something Went Wrong'));
            return back();
        }
    }

    public function edit_modal(Request $request)
    {
        try {
            $currency = $this->currencyRepository->find($request->id);
            return view('setting::currencies.edit_modal', [
                "currency" => $currency
            ]);
        } catch (\Exception $e) {

            return $e->getMessage();
        }
    }
}
