<?php

namespace App\Policies;

use App\Lapangan;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LapanganPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User $user
     * @param Lapangan $lapangan
     * @return mixed
     */
    public function view(User $user, Lapangan $lapangan)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User $user
     * @return mixed
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User $user
     * @param Lapangan $lapangan
     * @return mixed
     */
    public function update(User $user, Lapangan $lapangan)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User $user
     * @param Lapangan $lapangan
     * @return mixed
     */
    public function delete(User $user, Lapangan $lapangan)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param User $user
     * @param Lapangan $lapangan
     * @return mixed
     */
    public function restore(User $user, Lapangan $lapangan)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param User $user
     * @param Lapangan $lapangan
     * @return mixed
     */
    public function forceDelete(User $user, Lapangan $lapangan)
    {
        //
    }
}
