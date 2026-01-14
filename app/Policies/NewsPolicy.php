<?php

namespace App\Policies;

use App\Models\News;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class NewsPolicy
{
    public function delete(User $user, News $news): bool
    {
        if ($user->role === 'admin') {
            return true;
        }

        return $user->role === 'author'
            && $news->user_id === $user->id;
    }

    public function update(User $user, News $news): bool
    {
        return $this->delete($user, $news);
    }
}