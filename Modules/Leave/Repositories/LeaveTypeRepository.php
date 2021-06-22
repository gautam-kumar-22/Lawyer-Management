<?php

namespace Modules\Leave\Repositories;

use Modules\Leave\Entities\LeaveType;

class LeaveTypeRepository implements LeaveTypeRepositoryInterface
{
    public function all()
    {
        return LeaveType::latest()->get();
    }

    public function create(array $data)
    {
        $variant = new LeaveType();
        $variant->fill($data)->save();
    }

    public function find($id)
    {
        return LeaveType::findOrFail($id);
    }

    public function update(array $data, $id)
    {

        $variant = LeaveType::findOrFail($id);
        $variant->update($data);
    }

    public function delete($id)
    {
        return LeaveType::destroy($id);
    }
}
