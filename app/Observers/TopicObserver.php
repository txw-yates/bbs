<?php

namespace App\Observers;

use App\Models\Topic;
use App\Models\User;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class TopicObserver
{
    public function destroy(User $user, Topic $topic)
    {
        return $user->isAuthOf($topic);
    }

    public function update(User $user, Topic $topic)
    {
        return $user->isAuthOf($topic);
    }

    public function saving(Topic $topic)
    {
        $topic->body = clean($topic->body, 'user_topic_body');
        $topic->excerpt = make_excerpt($topic->body);
    }
}
