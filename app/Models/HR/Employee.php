<?php

namespace App\Models\HR;

use App\User;
use Carbon\Carbon;
use App\Models\Project;
use Illuminate\Database\Eloquent\Model;
use App\Models\HR\EmployeeTimelineEvent;

class Employee extends Model
{
    protected $guarded = [];

    protected $dates = ['joined_on'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeActive($query)
    {
        return $query->whereNotNull('user_id');
    }

    public function getEmploymentDurationAttribute()
    {
        if (is_null($this->user_id)) {
            return null;
        } else {
            $now = Carbon::now();
            return ($this->joined_on->diff($now)->days < 1) ? '0 days' : $this->joined_on->diffForHumans($now, true);
        }
    }

    /**
     * Get the projects for the employees.
     */
    public function projects()
    {
        return $this->belongsToMany(Project::class)->withPivot('contribution_type');
    }

    public function timelineEvents()
    {
        return $this->hasMany(EmployeeTimelineEvent::class);
    }
}
