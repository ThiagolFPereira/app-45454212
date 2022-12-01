<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['category_id', 'name', 'description', 'sku', 'quantity', 'image'];


    public function getResults($data, $total)
    {
        if (!isset($data['filter']) && !isset($data['name']) && !isset($data['description']) && !isset($data['sku']) && !isset($data['quantity']) && !isset($data['category_id']))
            return $this->orderBy('id', 'DESC')->paginate($total);

        return $this->where(function ($query) use ($data) {
                    if (isset($data['filter'])) {
                        $filter = $data['filter'];
                        $query->where('name', $filter);
                        $query->where('sku', $filter);
                        $query->where('quantity', $filter);
                        $query->orWhere('description', 'LIKE', "%{$filter}%");
                    }

                    if (isset($data['name']))
                        $query->where('name', $data['name']);

                    if (isset($data['sku']))
                        $query->where('sku', $data['sku']);

                    if (isset($data['quantity']))
                        $query->where('quantity', $data['quantity']);

                    if (isset($data['category_id']))
                        $query->where('category_id', $data['category_id']);
                    
                    if (isset($data['description'])) {
                        $description = $data['description'];
                        $query->where('description', 'LIKE', "%{$description}%");
                    }
                })//->toSql();dd($results);
                ->orderBy('id', 'DESC')
                ->paginate($total);
    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
