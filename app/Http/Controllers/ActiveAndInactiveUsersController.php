<?php

namespace App\Http\Controllers;

use App\Models\User;
use DB;

class ActiveAndInactiveUsersController extends Controller
{
    public function __invoke()
    {
        $statusCount = User::query()
            ->addSelect(DB::raw('count(*) as count'))
            ->groupBy('active')
            ->get();

        $users = User::select('name', DB::raw("SUBSTRING(name, 1, 1) as first_letter"))
            ->orderBy('name')
            ->get()
            ->groupBy('first_letter');

        return view('users.active-count', ['statusCount' => $statusCount]);
    }
}
