<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\belongsTo;

class Repo extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'link', 'created_at',
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
     * Relation with model: Owner
     *
     * @return belongsTo
     */
    public function owner(): belongsTo
    {
        return $this->belongsTo(Owner::class);
    }
}
