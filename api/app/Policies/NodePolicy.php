<?php

namespace App\Policies;

use App\Models\Node;
use App\Models\User;

class NodePolicy
{
    public function update(User $user, Node $node): bool
    {
        return $node->user_id === $user->id;
    }

    public function delete(User $user, Node $node): bool
    {
        return $node->user_id === $user->id;
    }
}
