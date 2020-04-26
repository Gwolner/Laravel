<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'price', 'description', 'photo'];


    //Filtro de Produtos
    public function search($filter = null){
        $result = $this->where(function($query) use($filter){
            if($filter){
                // $query->where('name', '=', $filter);
                $query->where('name', 'LIKE', "%{$filter}%");
            }
        })//->toSql(); 
        ->paginate();
        
        // dd($result);
        return $result;
    }
}
