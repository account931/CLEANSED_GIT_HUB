<?php
//main User table model
//It was generated by CLI=> php artisan make:auth
//is used for authentication (login/password)
namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
//use Illuminate\Database\Eloquent\Model; //Added by me
//use Zizaco\Entrust\Traits\EntrustUserTrait; //Zizaco\Entrust is not used here, reassigned to Spatie Laravel Permission
//use Tymon\JWTAuth\Contracts\JWTSubject; //JWT
use Spatie\Permission\Traits\HasRoles; //Spatie Laravel RBAC Permission
use Laravel\Passport\HasApiTokens;  //Passport


class User extends Authenticatable //implements JWTSubject
{
    //use EntrustUserTrait; //use Zizaco Entrust //Zizaco\Entrust is not used here, reassigned to Spatie Laravel Permission
	use HasRoles; //Spatie Laravel RBAC Permission
     use HasApiTokens;//, HasFactory; //Passport
    use Notifiable;
	

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'fb_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    
    
    
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    /*
    public function getJWTIdentifier() {
        return $this->getKey();
    }
    */
    
    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    /*
    public function getJWTCustomClaims() {
        return [];
    } 
    */    
}
