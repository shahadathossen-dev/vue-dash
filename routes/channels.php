<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('App.Models.Backend.User.{id}', function ($admin, $id) {
    return (int) $admin->id === (int) $id;
}, ['guards' => ['admin']]);

Broadcast::channel('App.Models.Backend.User', function ($admin) {
    return $admin;
    // return (int) $admin->id === (int) $id;
}, ['guards' => ['admin']]);

Broadcast::channel('chat', function ($user) {
    return $user;
}, ['guards' => ['admin']]);
