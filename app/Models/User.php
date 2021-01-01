<?php

namespace App\Models;

use Illuminate\Support\Arr;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function modelNotifications() {
        return $this->notifications()->get()->each(function($notification) {

            if(Arr::exists($notification->data, 'models')) {
                foreach($notification->data['models'] as $key => $id) {
                    $model = "\App\Models\\$key";
                    $models[$key] = $model::find((int)$id); // find() and findOrFail() need an integer to return one element.
                }
                $notification->models = $models;
            }
        });
    }
}
