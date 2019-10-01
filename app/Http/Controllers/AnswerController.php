<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Question;
use Illuminate\Http\Request;

class AnswerController extends Controller
{
    
    public function store(Question $question,Request $request)
    {
        $question->answers()->create($request->validate([

            'body' => 'required'

        ])+['user_id' => \Auth::id()]);//user must be login concept Auth

        return back()->with('success', 'Your Answer has been Sumitted');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function show(Answer $answer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question, Answer $answer)
    {
        $this->authorize('update', $answer);
        return view('answers.edit', compact('question' ,'answer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question, Answer $answer)
    {
         $this->authorize('update', $answer);
         $answer->update($request->validate([

            'body'=> 'required'
         ]));

         return redirect()->route('questions.show',$question->slug)->with('success', 'Answer Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Answer  $answer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question, Answer $answer)
    {
         $this->authorize('delete', $answer);

         $answer->delete();

         return back()->with('success', 'Your Answer DELETED');
    }
}
