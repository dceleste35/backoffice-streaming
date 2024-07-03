<?php

use App\Models\Role;
use App\Models\User;

it('can have a user', function () {
    $role = Role::factory()->create(['name' => 'user']);
    $user = User::factory()->create(['role_id' => $role->id, 'name' => 'test']);

    expect($role->users()->first()->name)->toBe('test');
});

it('can have many users', function () {
    $role = Role::factory()->create(['name' => 'user']);
    $users = User::factory(3)->create(['role_id' => $role->id]);

    expect($role->users)->toHaveCount(3);
});
