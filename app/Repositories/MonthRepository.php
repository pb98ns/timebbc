<?php

namespace App\Repositories;
use App\Month;
use DB;

class MonthRepository extends BaseRepository{
    public function __construct(Month $model)
    {
        $this->model = $model;
    }
    public function getAllMonths()
    {
        return $this->model->get();
    }
    public function getAllMonthsinRealization()
    {
        return $this->model->where('status1','=','W trakcie realizacji')->get();
    }
}
?>