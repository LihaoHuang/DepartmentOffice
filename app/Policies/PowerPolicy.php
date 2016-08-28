<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\User;
class PowerPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    public function show(User $user){
        return $user->super_user === 'manager' || $user->super_user === 'member';
    }


    public function member(User $user){
        return $user->super_user === 'member';
    }

    // public function manager(User $user){
    //     return $user->super_user === 'Y';
    // }
}
