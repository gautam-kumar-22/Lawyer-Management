<?php

namespace Modules\Leave\Repositories;

use Modules\Leave\Entities\LeaveDefine;

class LeaveDefineRepository implements LeaveDefineRepositoryInterface
{
    public function all()
    {
        return LeaveDefine::latest()->get();
    }

    public function create(array $data)
    {
        $variant = new LeaveDefine();
        $variant->fill($data)->save();
    }

    public function find($id)
    {
        return LeaveDefine::findOrFail($id);
    }

    public function update(array $data, $id)
    {
        $variant = LeaveDefine::findOrFail($id);
        $variant->update($data);
    }

    public function delete($id)
    {
        return LeaveDefine::destroy($id);
    }
}
