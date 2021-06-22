<?php

namespace Modules\Leave\Repositories;

interface LeaveRepositoryInterface
{
    public function all();

    public function approved_all();

    public function pending_all();

    public function create(array $data);

    public function find($id);

    public function user_leave_history($id);

    public function total_leave($id);

    public function change_approval(array $data);

    public function update(array $data, $id);

    public function delete($id);

    public function generate();
    public function updateCarryForward(array  $data);
}
