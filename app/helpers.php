<?php

use App\Models\User;

/**
 * @return User
 */
function appUser() : User {
    return auth()->user();
}
