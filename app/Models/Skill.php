<?php

namespace App\Models;

use App\Http\Filters\SkillFilter;
use App\Service\Filter\FilterAble;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Skill extends Model
{
    use HasFactory, SoftDeletes, FilterAble;

    protected $fillable = ['name' , 'description'];

    protected $filterClass = SkillFilter::class;

    public function selectMap()
    {
        return [$this->id => $this->name];
    }

    public function candidates()
    {
        return $this->belongsToMany(Candidate::class, 'pivot_candidate_skills');
    }
}
