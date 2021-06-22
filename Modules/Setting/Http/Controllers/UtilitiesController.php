<?php

namespace Modules\Setting\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Modules\Setting\Repositories\UtilitiesRepository;

class UtilitiesController extends Controller
{
    /**
     * @var Request
     */
    private $request;
    /**
     * @var UtilitiesRepository
     */
    private $utilitiesRepository;

    public function __construct(
        Request $request,
        UtilitiesRepository $utilitiesRepository
    )
    {
        $this->middleware(['auth']);
        $this->request = $request;
        $this->utilitiesRepository = $utilitiesRepository;
    }

    public function index(){
        if ($this->request->ajax() and $this->request->wantsJson()){
            throw_if(env('APP_SYNC'), ValidationException::withMessages(['message' => 'Restricted in demo mode']));
            $utilities = $this->request->utilities;
            throw_if(!$utilities, ValidationException::withMessages(['message' => 'setting.no_utilities_provide']));

            $response = $this->utilitiesRepository->action($utilities);

            throw_if(!gv($response, 'status'), ValidationException::withMessages(['message' => gv($response, 'message')]));

            return $this->success($response);

        }
        return view('setting::utilities.index');
    }
}
