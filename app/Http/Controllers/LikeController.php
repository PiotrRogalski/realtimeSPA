<?php

namespace App\Http\Controllers;

use App\Model\Reply;
use App\Model\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('jwt');
    }

    public function likeIt(Reply $reply)
    {
        $reply->likes()->create([
                'user_id' => auth()->id()
            ]);
    }

    public function unlikeIt(Reply $reply)
    {
        $reply->likes()->where('user_id', '=', auth()->id())->first()->delete();
    }
}
