<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReplyResource;
use App\Model\Question;
use App\Model\Reply;
use App\Notifications\NewReplyNotification;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReplyController extends Controller
{

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('jwt', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param \App\Model\Question $question
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Question $question)
    {
        return ReplyResource::collection($question->replies);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Question $question, Request $request)
    {
        $reply = $question->replies()->create($request->all());
        $user = $question->user;

        //Inform creator of the question about new reply
        $user->notify(new NewReplyNotification($reply));
        return response(['reply' => new ReplyResource($reply)], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Model\Question $question
     * @param  \App\Model\Reply   $reply
     *
     * @return \App\Http\Resources\ReplyResource
     */
    public function show(Question $question, Reply $reply)
    {
        return new ReplyResource($reply);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function update(Question $question, Reply $reply, Request $request)
    {
        $reply->update($request->all());
//        $reply->update(
//            [
//                'body' => $request->body,
//                'question_id' => $question->id,
//                'user_id' => $request->user_id
//            ]
//        );
        return response('Updated', Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Model\Question $question
     * @param  \App\Model\Reply   $reply
     *
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Question $question, Reply $reply)
    {
        $reply->delete();
        return response('Deleted', Response::HTTP_NO_CONTENT);
    }
}
