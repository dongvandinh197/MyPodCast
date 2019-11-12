<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    protected $table = 'music';

    protected $fillable = ['id', 'name', 'desc', 'single', 'link','created_time','updated_time'];

    public $timestamps = true;

    public function index($request){
        $builder=  $this->select('*');
        $builder=  $builder->get();


        return $builder;
    }
    public function get_ready($request){
        $builder=  $this->select('*');
        $builder=  $builder->get();


        return $builder;
    }

    public function checkName($name, $id = null)
    {
        $builder = $this->select('*')
            ->where('name', $name);
        if ($id) {
            $builder->where('id', '!=', $id);
        }
        return $builder->first();
    }
}
