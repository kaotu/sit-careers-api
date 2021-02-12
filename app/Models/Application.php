<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ApplicationUuid;
use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Model
{
    Use ApplicationUuid;
    use SoftDeletes;

    protected $table = 'applications';
    protected $primaryKey = 'application_id';
    public $incrementing = false;

    protected $keyType = 'uuid';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const DELETED_AT = 'deleted_at';
}
