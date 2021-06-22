<?php

namespace Modules\Setting\Repositories;

use Modules\Setting\Model\GeneralSetting;

use Modules\Setting\Repositories\GeneralSettingRepositoryInterface;

class GeneralSettingRepository implements GeneralSettingRepositoryInterface
{
    public function all()
    {
        return GeneralSetting::first();
    }

    public function update(array $data)
    {
        return GeneralSetting::first()->update($data);
    }
}
