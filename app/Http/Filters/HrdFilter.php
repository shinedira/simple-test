<?php
namespace App\Http\Filters;

use App\Service\Filter\Filter;

class HrdFilter extends Filter
{
    public function search($value)
    {
        return $this->query
                    ->where(function($query) use ($value) {
                        $query->where('name', 'like', "%{$value}%")
                                ->orWhere('username', 'like', "%{$value}%");
                    });
    }
}