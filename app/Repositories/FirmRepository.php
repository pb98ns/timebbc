<?php

namespace App\Repositories;
use App\Firm;
use DB;

class FirmRepository extends BaseRepository{
    public function __construct(Firm $model)
    {
        $this->model = $model;
    }
    public function getAllFirms()
    {
        return $this->model->orderBy('name', 'asc')->get();
    }
    public function getAllFirmsActive()
    {
        return $this->model->where('status','=','Aktywny')->orderBy('name', 'asc')->get();
    }
    public function getAllFirmsNoActive()
    {
        return $this->model->where('status','=','Nieaktywny')->orderBy('name', 'asc')->get();
    
}
public function getAllKpir()
{
    return $this->model->where('kpir','=','KPiR')->get();
}
}
?>