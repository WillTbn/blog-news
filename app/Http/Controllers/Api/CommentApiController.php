<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogNewRequest;
use App\Http\Requests\CreateCommentRequest;
use Illuminate\Support\Facades\Redirect;
use App\Models\BlogNew;
use App\Models\Comment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Vinkla\Hashids\Facades\Hashids;

class CommentApiController extends Controller
{
    /**
     * Handle an incoming registration request.
     * @param CreateCommentRequest $request
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(CreateCommentRequest $request):JsonResponse
    {
        $random = rand(1, 10000);
        $comment = new Comment();
        $comment->name =$request->name;
        $comment->content =$request->content;
        $comment->blog_new_id =$request->blog_new_id;
        $comment->hash_id =Hashids::encode(now()->timestamp, $random);
        $comment->saveOrFail();

        return new JsonResponse(
            [
                'message' =>'Comentario criado com sucesso!',
                'comment' => $comment
            ],
            200
        );
    }
}
