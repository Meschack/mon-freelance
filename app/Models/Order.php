<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $user_id
 * @property integer $service_id
 * @property integer $price
 * @property string $status
 * @property string $review_type
 * @property string $review_content
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property Service $service
 */
class Order extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = ['user_id', 'service_id', 'price', 'status', 'review_type', 'review_content', 'deleted_at', 'created_at', 'updated_at'];

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
    public function service()
    {
        return $this->belongsTo('App\Models\Service');
    }
}
