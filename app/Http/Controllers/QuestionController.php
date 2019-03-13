<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuestionResource;
use App\Model\Question;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


/**
 * Class QuestionController
 *
 * @package App\Http\Controllers
 */
class QuestionController extends Controller
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
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
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
        $question = auth()->user()->question()->create($request->all());
        $questionResource = new QuestionResource($question);

        return response($questionResource ,Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  string $slugOrId
     *
     * @return \App\Http\Resources\QuestionResource|\Illuminate\Http\Response
     */
    public function show($slugOrId)
    {
        $id = '';
        $slug = '';

        //Make decision its slug or id
        (strlen($slugOrId) <= 5) ? $id = $slugOrId : $slug = $slugOrId;

        //Using one of two method for finding right model
        $question = ($id) ? Question::find($id) : Question::where('slug', $slug)->first();

        //Checking if it returning good data
        if ($question instanceof Question) {
            return new QuestionResource($question);
        }

        return response('Bad request', Response::HTTP_BAD_REQUEST);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slugOrId)
    {
        $id = '';
        $slug = '';

        //Make decision its slug or id
        (strlen($slugOrId) <= 5) ? $id = $slugOrId : $slug = $slugOrId;

        //Using one of two method for finding right model
        $question = ($id) ? Question::find($id) : Question::where('slug', $slug)->first();

        //Checking if it returning good data
        if ($question instanceof Question) {
            $question->update($request->all());
            return response('OK', Response::HTTP_ACCEPTED);
        }

        return response('Bad request', Response::HTTP_BAD_REQUEST);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($slugOrId)
    {
        $id = '';
        $slug = '';

        //Make decision its slug or id
        (strlen($slugOrId) <= 5) ? $id = $slugOrId : $slug = $slugOrId;

        //Using one of two method for finding right model
        $question = ($id) ? Question::find($id) : Question::where('slug', $slug)->first();

        //Checking if it returning good data
        if ($question instanceof Question) {
            $question->delete();
            return response('Deleted',Response::HTTP_NO_CONTENT);
        }

        return response('Bad request', Response::HTTP_BAD_REQUEST);
    }
}
