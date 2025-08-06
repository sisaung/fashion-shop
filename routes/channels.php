<?php
use Illuminate\Support\Facades\Broadcast;



// Broadcast::channel('admin.orders', function ($user) {
//     return $user->is_admin === 'admin';
// });
Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
