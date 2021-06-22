<?php

namespace Modules\Localization\Repositories;

use Modules\Localization\Entities\Language;

use Modules\Localization\Repositories\LanguageRepositoryInterface;

class LanguageRepository implements LanguageRepositoryInterface
{
    public function all()
    {
        return Language::orderBy('status', 'desc')->get();
    }

    public function serachBased($search_keyword)
    {
        return Language::whereLike(['name', 'native', 'code'], $search_keyword)->get();
    }

    public function create(array $data)
    {
        
        if(isset($data['rtl'])){
            $data['rtl'] = 1;
        }else{
            $data['rtl'] = 0;
        }

        $language = new Language();
        $language->fill($data)->save();
    }

    public function find($id)
    {
        return Language::findOrFail($id);
    }

    public function update(array $data, $id)
    {
        if(isset($data['rtl'])){
            $data['rtl'] = 1;
        }else{
            $data['rtl'] = 0;
        }
        return Language::findOrFail($id)->update($data);
    }

    public function delete($id)
    {
        return Language::findOrFail($id)->delete();
    }

    public function findByCode($code)
    {
        return Language::where('code', $code)->first();
    }
}
