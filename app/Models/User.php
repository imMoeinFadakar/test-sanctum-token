<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Http\Request;
use Laravel\Sanctum\HasApiTokens;

use App\Http\Requests\registerRequest;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // CRUD operation

    /**
     * Summary of store
     * @param mixed $registerRequest
     * @return object
     */
    public function store($registerRequest)
    {
        return $this->query()->create([
         'name' => $registerRequest->name,
        'username' => $registerRequest->username,
        'national_id' => $registerRequest->national_id,
        'numbers' => $registerRequest->numbers,
        'age' => $registerRequest->age,
        'gender' => $registerRequest->gender,
        'email' => $registerRequest->email,
        'password' => $registerRequest->password,
        ]);

    }


    public function attemptToFindUser(Request $request)
    {
        
        return $this->query()
        ->where('national_id',bcrypt($request->national_id))->first();

    }
  
    public function findUserByNationalId(Request $request)
    {
        return $this->query()
        ->where('national_id',$request->national_id)->first();
    }

    public function passwordCheck($user,$request)
    {
        
        return Hash::check($request->password, $user->password);

    }

}
