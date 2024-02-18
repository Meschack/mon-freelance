<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property integer $id
 * @property integer $role_id
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property string $sexe
 * @property string $birthdate
 * @property string $bio
 * @property string $profile_photo_path
 * @property string $password
 * @property string $email_verified_at
 * @property string $two_factor_code
 * @property string $two_factor_expires_at
 * @property string $remember_token
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property Message[] $messages
 * @property Message[] $messages
 * @property Notification[] $notifications
 * @property Order[] $orders
 * @property Service[] $services
 * @property Role $role
 */
class User extends AuthUser
{
    use HasApiTokens, HasFactory, Notifiable;

    public const ROLE_ADMIN = "admin";

    public const ROLE_SELLER = "seller";

    public const ROLE_CUSTOMER = "customer";

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @var array
     */
    protected $fillable = ['role_id', 'firstname', 'lastname', 'email', 'sexe', 'birthdate', 'bio', 'profile_photo_path', 'password', 'email_verified_at', 'two_factor_code', 'two_factor_expires_at', 'remember_token', 'created_at', 'updated_at', 'deleted_at'];

    public function generateTwoFactorCode()
    {
        $this->timestamps = false;
        $this->two_factor_code = rand(100000, 999999);
        $this->two_factor_expires_at = now()->addMinutes(10);
        $this->save();
    }

    public function resetTwoFactorCode(): void
    {
        $this->timestamps = false;
        $this->two_factor_code = null;
        $this->two_factor_expires_at = null;
        $this->save();
    }

    // Dans le modèle User
    /* public function conversations()
    {
        return $this->hasMany(Message::class, 'sender_id')->orWhere('receiver_id', $this->id)
            ->with(['sender', 'receiver'])
            ->latest('updated_at')
            ->get();
    } */

    // Dans le modèle User
    public function conversations()
    {
        $sentMessages = $this->hasMany(Message::class, 'sender_id');
        $receivedMessages = $this->hasMany(Message::class, 'receiver_id');

        $allMessages = $sentMessages->union($receivedMessages)
            ->with(['sender', 'receiver'])
            ->latest('updated_at')
            ->get();

        // Utilisez la méthode groupBy pour regrouper les messages par correspondant
        $groupedMessages = $allMessages->groupBy(function ($message) {
            // Utilisez l'ID de l'utilisateur avec lequel l'utilisateur actuel a échangé des messages
            return $message->sender_id == $this->id ? $message->receiver_id : $message->sender_id;
        });

        return $groupedMessages;
    }




    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sentMessages()
    {
        return $this->hasMany('App\Models\Message', 'sender_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function receivedMessages()
    {
        return $this->hasMany('App\Models\Message', 'receiver_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notifications()
    {
        return $this->hasMany('App\Models\Notification');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function services()
    {
        return $this->hasMany('App\Models\Service');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo('App\Models\Role');
    }
}
