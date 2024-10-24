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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
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
        $blog->subtitle = $request->subtitle;
        Log::info('AMIGO ESTOU AQUI');
        if ($request->hasFile('photo')) {
            $path = $request->photo->storePublicly('photos/blog', 'public', $request->photo->hashName());
            // $path = $request->file('photo')->store('photos', 'public');

            if($blog->photo != asset('storage/default.png')){
                $url = parse_url($blog->photo);
                $path = ltrim($url['path'], '/storage\/');
                if(Storage::disk('public')->exists($path)){
                    Storage::disk('public')->delete($path);
                }
            }
            $blog->photo = $path;
            Log::info('AQUI O '.$path);
        }
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
            'subtitle' => 'required|string',
            'photo' => 'nullable|image|max:2048',
        ]);
        $user = Auth::user();
        // dd($user->id);
        $blog = new BlogNew();
        $blog->user_id = $user->id;
        $blog->title =$request->title;
        $blog->content =$request->content;
        $blog->subtitle =$request->subtitle;
        // Se houver uma foto, armazene-a
        if ($request->hasFile('photo')) {
            $path = $request->photo->storePublicly('photos/blog', 'public', $request->photo->hashName());
            // $path = $request->file('photo')->store('photos', 'public');

            // if($blog->photo != asset('storage/default.png')){
            //     $url = parse_url($blog->photo);
            //     $path = ltrim($url['path'], '/storage\/');
            //     if(Storage::disk('public')->exists($path)){
            //         Storage::disk('public')->delete($path);
            //     }
            // }
            $blog->photo = $path;
            Log::info('AQUI O '.$path);
        }
        $blog->hash_id =Hashids::encode(now()->timestamp, $random);
        $blog->saveOrFail();

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
