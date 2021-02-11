<?php


namespace App\Traits;

use Illuminate\Support\Str;

trait ApplicationUuid
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            try {
                $model->application_id = (string) Str::uuid();
            } catch (UnsatisfiedDependencyException $e) {
                abort(500, $e->getMessage());
            }
        });
    }
}