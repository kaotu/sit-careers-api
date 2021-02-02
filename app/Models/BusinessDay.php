<?php

namespace App\Models;

use App\Traits\BusinessDayUuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessDay extends Model
{
    Use BusinessDayUuid;
    use SoftDeletes;

    protected $table = 'business_days';
    protected $primaryKey = 'business_day_id';
    public $incrementing = false;

    protected $keyType = 'uuid';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const DELETED_AT = 'deleted_at';

    public function company()
    {
        return $this->belongsTo('App\Models\Company', 'company_id');
    }
}
