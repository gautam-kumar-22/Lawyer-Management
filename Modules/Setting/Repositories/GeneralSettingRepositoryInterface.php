<?php

namespace Modules\Setting\Repositories;

interface GeneralSettingRepositoryInterface
{
    public function all();

    public function update(array $data);

}
