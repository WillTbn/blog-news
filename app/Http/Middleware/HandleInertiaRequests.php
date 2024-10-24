<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Tighten\Ziggy\Ziggy;
class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        // return [
        //     ...parent::share($request),
        //     'auth' => [
        //         'user' => $request->user(),
        //     ],
        // ];
        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $request->user(),
                'account' => $request->user() ? $request->user()->account : "",
            ],
            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy())->toArray(), [
                    'location' => $request->url(),
                ]);
            },
            'flash' =>[
                'success' => session()->has('success'),
                'message' => session('success')
            ],
            // 'permissions' =>function () use ($request){
            //     return $request->user() ? [
            //         'can_access' =>  $request->user()->role->abilities->pluck('name'),
            //         'role'=> $request->user()->role->name,
            //         'account' => $request->user()->account,
            //     ]:null;
            // }
            // 'permissions' => [
            //     'can_access' =>  $request->user() ? $request->user()->role->abilities->pluck('name'):"",
            //     'role' =>  $request->user() ? $request->user()->role->name:"",
            //     'account' =>$request->user() ? $request->user()->account:""
            //     // $user = $request->user(),
            //     // return $user ? [
            //     //     'can_access' =>  $user->role->abilities->pluck('name'),
            //     //     'role'=> $user->role->name,
            //     //     'account' => $user->account,
            //     // ]:null;
            // ],
        ]);
    }
}
