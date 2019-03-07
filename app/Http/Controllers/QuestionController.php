<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuestionResource;
use App\Model\Question;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;


/**
 * Class QuestionController
 *
 * @package App\Http\Controllers
 */
class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::latest()->get();
        return QuestionResource::collection($questions);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        auth()->user()->question()->create($request->all());
        Question::create($request->all());
        return response('Created!',Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Model\Question $question
     *
     * @return \App\Http\Resources\QuestionResource|\Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = Question::find($id);
        return new QuestionResource($question);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Model\Question $question
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Question::find($id)->delete();
        return response('Deleted',Response::HTTP_NO_CONTENT);
    }
}
