<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ArticlePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    /*public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
   /* public function view(User $user, Article $article): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
   /* public function create(User $user): bool
    {
        //
    }*/

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Article $article)
    {
        // Only the owner of the article can update it
        return $user->id === $article->author_id;
    }

    /**
     * @param \App\Models\User $user
     * * @param \App\Models\Article $article
     * * @return mixed
 */
    public function delete(User $user, Article $article)
    {
        return $user->id === $article->author_id || $user->userRole->role_name == 'admin';
    }

    /**
     * Determine whether the user can restore the model.
     */
    /*public function restore(User $user, Article $article): bool
    {
        //
    }/*

    /**
     * Determine whether the user can permanently delete the model.
     */
    /*public function forceDelete(User $user, Article $article): bool
    {
        //
    }*/
}
