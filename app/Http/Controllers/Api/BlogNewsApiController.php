<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogNewRequest;
use Illuminate\Support\Facades\Redirect;
use App\Models\BlogNew;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Vinkla\Hashids\Facades\Hashids;

class BlogNewsApiController extends Controller
{
    public function getAll(Request $request):JsonResponse
    {
        $countLastet = !empty((int)$request['quantity']) ? (int)$request['quantity'] : 6;
        if(!empty($request['search'])){
            $blog = BlogNew::where('title', 'LIKE', '%'.$request['search'].'%');
            return new JsonResponse(
                [
                    'message' =>'Lista de noticias do blog!',
                    'blog_news' => $blog->paginate($countLastet)
                ],
                200
            );
        }

        $blog = BlogNew::paginate($countLastet);
        return new JsonResponse(
            [
                'message' =>'Lista de noticias do blog!',
                'blog_news' => $blog
            ],
            200
        );
    }
    public function getLast(Request $request): JsonResponse
    {
        $countLastet = !empty((int)$request['quantity']) ? (int)$request['quantity'] : 5;
        $blogs = DB::table('blog_news')->latest()->limit($countLastet)->get();
        return new JsonResponse(
            [
                'message' => 'Lista com ultimas noticias do blog!',
                'blog_news' => $blogs
            ],
            200
        );
    }
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function getOne(BlogNew $blogNew): JsonResponse
    {
        $getArtigo = BlogNew::where('hash_id',$blogNew->hash_id)->with(['comments'])->first();
        return new JsonResponse(
            [
                'message' => 'Artigo capturado com sucesso!',
                'blog_news' => $getArtigo
            ],
            200
        );
    }
}
