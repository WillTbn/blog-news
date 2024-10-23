<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogNewRequest;
use Illuminate\Support\Facades\Redirect;
use App\Models\BlogNew;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Vinkla\Hashids\Facades\Hashids;

class BlogNewController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Dashboard', [
            'blog_new' => BlogNew::with(['user'])->get()
        ]);
    }
    public function getOne(BlogNew $blog)
    {
        return Inertia::render('Blog/EditBlogPage', [
            'blog_new' => $blog
        ]);
    }
    public function update(BlogNewRequest $request)
    {
        $blog = BlogNew::where('hash_id', $request->hash_id)->first();
        $blog->title = $request->title;
        $blog->content = $request->content;
        $blog->updateOrFail();
        // return Redirect::route('profile.edit');
        return redirect()->back()->with('success', 'Noticia  alterada sucesso!');
    }
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Blog/CreateBlogPage');
    }
     /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $random = rand(1, 10000);
        $request->validate([
            'title' => 'required|string|max:100',
            'content' => 'required',
            // 'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $user = Auth::user();
        // dd($user->id);
        $blog = new BlogNew();
        $blog->user_id = $user->id;
        $blog->title =$request->title;
        $blog->content =$request->content;
        $blog->hash_id =Hashids::encode(now()->timestamp, $random);
        $blog->saveOrFail();

        // BlogNew::create([
        //     'user_id' => $user->id,
        //     'title' => $request->title,
        //     'content' => $request->content,
        //     'hash_id' => Hashids::encode(now())
        // ]);

        // event(new Registered($user));

        // Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
    /**
     * Delete the user's account.
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'hash_id' => ['required', 'exists:blog_news,hash_id'],
        ]);
        $blog = BlogNew::where('hash_id', $request->hash_id)->first();
        $blog->deleteOrFail();
        return redirect()->back()->with('success', 'Noticia excluida com sucesso!');
    }
}
