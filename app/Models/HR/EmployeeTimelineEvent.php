<?php

namespace App\Models\HR;

use Illuminate\Database\Eloquent\Model;

class EmployeeTimelineEvent extends Model
{
    protected $fillable = ['name', 'description', 'employee_id', 'occurred_at', 'document_url'];

    protected $dates = ['occurred_at'];

    public function getOccurredOnAttribute()
    {
        return $this->occurred_at->toDateString();
    }
}
