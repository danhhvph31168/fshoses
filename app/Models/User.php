<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    protected $guarded = ['id'];


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role_id',
        'name',
        'email',
        'password',
        'avatar',
        'phone',
        'status',
        'address',
        'province',
        'district',
        'ward',
    ];
    
      // Accessor để lấy đường dẫn đầy đủ của avatar
      public function getAvatarUrlAttribute()
      {
          return asset($this->avatar ?: 'image-default/avatar.jpg');
      }

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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function permissions()
    {
        return [
            'users.index',
            'roles.index',
            'brands.index',
            'categories.index',
            'products.index',
            'banners.index',
            'orders.index',
            'reviews.index',
            'admin.index'
        ];
    }

    public function hasPermission($route)
    {
        $routes = $this->routes();

        // dd($routes);

        return  in_array($route, $routes) ? true : false;
    }

    public function routes()
    {
        return [
            'admin.users.index',
            'admin.roles.index',
            'admin.brands.index',
            'admin.categories.index',
            'admin.products.index',
            'admin.banners.index',
            'admin.orders.index',
            'admin.reviews.index',
            'admin.index'
        ];
    }
}
