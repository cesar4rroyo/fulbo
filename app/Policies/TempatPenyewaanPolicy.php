<?php

namespace App\Policies;

use App\Enums\UserLevel;
use App\TempatPenyewaan;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TempatPenyewaanPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return $user->level == UserLevel::ADMIN_UTAMA;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\User  $user
     * @param  \App\TempatPenyewaan  $tempatPenyewaan
     * @return mixed
     */
    public function view(User $user, TempatPenyewaan $tempatPenyewaan)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\User  $user
     * @param  \App\TempatPenyewaan  $tempatPenyewaan
     * @return mixed
     */
    public function update(User $user, TempatPenyewaan $tempatPenyewaan)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\TempatPenyewaan  $tempatPenyewaan
     * @return mixed
     */
    public function delete(User $user, TempatPenyewaan $tempatPenyewaan)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\User  $user
     * @param  \App\TempatPenyewaan  $tempatPenyewaan
     * @return mixed
     */
    public function restore(User $user, TempatPenyewaan $tempatPenyewaan)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\User  $user
     * @param  \App\TempatPenyewaan  $tempatPenyewaan
     * @return mixed
     */
    public function forceDelete(User $user, TempatPenyewaan $tempatPenyewaan)
    {
        //
    }
}
