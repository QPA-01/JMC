<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * Class User
 *
 * @property $id
 * @property $name
 * @property $email
 * @property $email_verified_at
 * @property $password
 * @property $rol_id
 * @property $document_type_id
 * @property $document_number
 * @property $phone
 * @property $date_birth
 * @property $address
 * @property $remember_token
 * @property $status
 * @property $created_at
 * @property $user_creator
 * @property $updated_at
 * @property $user_last_update
 *
 * @property DocumentType $documentType
 * @property DocumentType[] $documentTypes
 * @property DocumentType[] $documentTypes
 * @property Role[] $roles
 * @property Role[] $roles
 * @property Role $role
 * @property User $user
 * @property User[] $users
 * @property User $user
 * @property User[] $users
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    const PROFILES = ['admin' => 1];


    static $rules = [
        'name' => 'required',
        'email' => 'required|email',
        'rol_id' => 'required|integer',
        'document_type_id' => 'required|integer',
        'document_number' => 'required|integer',
        'phone' => 'required|integer',
        'address' => 'required',
        'date_birth' => 'required|date'
    ];

    /**
     * perPage
     *
     * @var int
     */
    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['uuid', 'name', 'email', 'rol_id', 'document_type_id', 'document_number', 'phone', 'date_birth', 'address', 'status', 'password', 'user_creator', 'user_last_update'];


    /**
     * hidden
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function documentType()
    {
        return $this->hasOne('App\Models\DocumentType', 'id', 'document_type_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function role()
    {
        return $this->hasOne('App\Models\Role', 'id', 'rol_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user_creator()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_creator');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user_last_update()
    {
        return $this->hasMany('App\Models\User', 'user_last_update', 'id');
    }

    /**
     * boot
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $uuid = \Ramsey\Uuid\Uuid::uuid4();
            $model->uuid = $uuid->toString();
            $model->user_creator = auth()->id();
            return $model;
        });

        self::created(function ($model) {
            // ... code here
        });

        self::updating(function ($model) {
            $model->user_last_update = auth()->id();
            $model->updated_at = date('Y-m-d H:i:s');
            return $model;
        });

        self::updated(function ($model) {
            // ... code here
        });

        self::deleting(function ($model) {
            // ... code here
        });

        self::deleted(function ($model) {
            // ... code here
        });
    }
}
