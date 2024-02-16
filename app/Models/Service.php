<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $category_id
 * @property string $title
 * @property string $miniature
 * @property string $description
 * @property integer $price
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property Order[] $orders
 * @property User $user
 * @property Category $category
 */
class Service extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'category_id', 'title', 'miniature', 'description', 'price', 'deleted_at', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
}
