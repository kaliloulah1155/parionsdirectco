<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\User;
use Illuminate\Support\Facades\Auth;

class PermissionController extends Controller
{
    public function view()
    {
        // get current logged in user
        //$user = Auth::user();

        $user=Auth::loginUsingId(2);

        // load post
        $perm = Permission::find(1);

        if ($user->can('view', $perm)) {
            echo "Current logged in user is allowed to update the Permission: {$perm->id}";
        } else {
            echo 'Not Authorized.';
        }
    }

    public function create()
    {
        // get current logged in user
        $user = Auth::user();

        if ($user->can('create', Permission::class)) {
            echo 'Current logged in user is allowed to create new posts.';
        } else {
            echo 'Not Authorized';
        }

        exit;
    }

    public function update()
    {
        // get current logged in user
        $user = Auth::user();

        // load post
        $perm = User::find(1);

        if ($user->can('update', $perm)) {
            echo "Current logged in user is allowed to update the Post: {$perm->id}";
        } else {
            echo 'Not Authorized.';
        }
    }

    public function delete()
    {
        // get current logged in user
        $user = Auth::user();

        // load post
        $perm = Permission::find(1);

        if ($user->can('delete', $perm)) {
            echo "Current logged in user is allowed to delete the Post: {$perm->id}";
        } else {
            echo 'Not Authorized.';
        }
    }
}
