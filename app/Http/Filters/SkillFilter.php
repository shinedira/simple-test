<?php
namespace App\Http\Filters;

use App\Service\Filter\Filter;

class SkillFilter extends Filter
{
    public function search($value)
    {
        return $this->query->where('name', 'like', "%{$value}%");
    }
}