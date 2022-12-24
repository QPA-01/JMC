<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LoanDetail
 *
 * @property $id
 * @property $uuid
 * @property $equipament_id
 * @property $description
 * @property $quantity
 * @property $user_loan_id
 * @property $status
 * @property $created_at
 * @property $user_creator
 * @property $updated_at
 * @property $user_last_update
 *
 * @property Equipment $equipment
 * @property User $user
 * @property User $user
 * @property User $user
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class LoanDetail extends Model
{

    /**
     * table
     *
     * @var string
     */
    protected $table = 'loan_detail';

    static $rules = [
        'quantity' => 'required|integer',
    ];

    protected $perPage = 20;

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['uuid', 'equipament_id', 'description', 'quantity', 'user_loan_id', 'status', 'user_creator', 'user_last_update'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function equipment()
    {
        return $this->hasOne('App\Models\Equipment', 'id', 'equipament_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user_last_update()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_last_update');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user_loan()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_loan_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user_creator()
    {
        return $this->hasOne('App\Models\User', 'id', 'user_creator');
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
