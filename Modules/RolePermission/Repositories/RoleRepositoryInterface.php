<?php

namespace Modules\RolePermission\Repositories;

interface RoleRepositoryInterface
{
    public function all();

    public function create(array $data);

    public function update(array $data, $id);

    public function delete($id);

    public function normalRoles();
    
    public function regularRoles();

}
