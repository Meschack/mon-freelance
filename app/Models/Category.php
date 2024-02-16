<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $name
 * @property string $label
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property Service[] $services
 */
class Category extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = ['name', 'label', 'deleted_at', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function services()
    {
        return $this->hasMany('App\Models\Service');
    }
}
