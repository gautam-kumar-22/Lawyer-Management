<?php

namespace Modules\Leave\Repositories;

interface HolidayRepositoryInterface
{
    public function all();

    public function create(array $data);

    public function find($id);

    public function copyYear($year);

    public function year($year);

    public function getHoliday($date);

    public function holidayYears();

    public function yearCreate(array $data);

    public function yearDelete($year);
}
