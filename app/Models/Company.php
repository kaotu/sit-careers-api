<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CompanyUuid;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    Use CompanyUuid;
    use SoftDeletes;

    protected $table = 'companies';
    protected $primaryKey = 'company_id';
    public $incrementing = false;

    protected $keyType = 'uuid';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const DELETED_AT = 'deleted_at';

    public function address()
    {
        return $this->hasMany('App\Models\Address', 'company_id');
    }

    public function mou()
    {
        return $this->hasMany('App\Models\MOU', 'company_id');
    }

    public function announcement()
    {
        return $this->hasOne('App\Model\Announcement', 'announcement_id');
    }
}
