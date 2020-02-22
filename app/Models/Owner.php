<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\hasMany;

class Owner extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'avatar',
    ];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Disable incrementing for model id
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * Relation with model: Repo
     *
     * @return hasMany
     */
    public function repos(): hasMany
    {
        return $this->hasMany(Repo::class);
    }
}
