<?php

namespace App\Models;

use App\Http\Filters\CandidateFilter;
use App\Service\Filter\FilterAble;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Candidate extends Model
{
    use HasFactory, SoftDeletes, FilterAble;

    const REPLACE_FILE     = true;
    const STORAGE_PATH     = 'public/files/';
    protected $filterClass = CandidateFilter::class;

    protected $fillable = [
        'name',
        'education',
        'last_position',
        'applied_position',
        'birth_date',
        'experience',
        'email',
        'phone',
    ];

    protected $appends = [
        'birth_date_format',
        'resume'
    ];

    public function getBirthDateFormatAttribute()
    {
        return Carbon::parse($this->birth_date)->format('M d, Y');
    }

    public function getResumeAttribute()
    {
        return [
            'filename' => optional($this->file)->name,
            'url'      => $this->file ? asset('storage/files/' . optional($this->file)->name) : null
        ];
    }

    public function skills()
    {
        return $this->belongsToMany(Skill::class, 'pivot_candidate_skills');
    }

    public function file()
    {
        return $this->morphOne(File::class, 'fileable');
    }
}
