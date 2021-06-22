<?php


namespace Modules\Setting\Repositories;


use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

class UtilitiesRepository
{

    public function action($command)
    {
        $method = 'handle'.Str::studly(str_replace('.', '_', $command));

        if (method_exists($this, $method)) {
            return $this->{$method}();
        }

        return $this->missingMethod();
    }

    protected function handleOptimizeClear(){
        try {
            Artisan::call('optimize:clear');
            return [
                'status' => true,
                'message' => __('setting.cache_cleared')
            ];
        } catch (\Exception $e){
            report($e);
            return [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }

    }

    protected function handleChangeDebug(){
        try {
            envu([
                'APP_DEBUG' => env('APP_DEBUG') ? "false" : "true"
            ]);
            return [
                'status' => true,
                'message' => __('setting.app_debug_'. (env('APP_DEBUG') ? 'disabled' : 'enabled')),
                'goto' => route('utilities')
            ];
        } catch (\Exception $e){
            report($e);
            return [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }

    }

    protected function handleClearLog(){
        try {
            array_map('unlink', array_filter((array) glob(storage_path('logs/*.log'))));
            array_map('unlink', array_filter((array) glob(storage_path('debugbar/*.json'))));
            return [
                'status' => true,
                'message' => __('setting.log_cleared')
            ];
        } catch (\Exception $e){
            report($e);
            return [
                'status' => false,
                'message' => $e->getMessage()
            ];
        }

    }


    protected function missingMethod(): array
    {
        return [
            'status' => false,
            'message' => __('setting.invalid_command')
        ];
    }

}
