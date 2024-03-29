<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NoteController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(),[
            'id' => 'required|number',
            'categoryId' => 'required|number',
            'noteName' => 'required|string',
            'noteContent' => 'required',
        ]);
        if ($validator){
            $note = Note::create(['name' => $request->input('noteName'), 'notes' => $request->input('noteContent'), 'user_id' => auth()->user()->id, 'category_id' => $request->input('categoryId')]);
            if($note){
                return response()->json(['status'=> "success", 'data'=> $note->id]);
            }
            return response()->json(['status'=> "error", 'message'=>  $request->input('noteName')]);
        }
        return response()->json(['status'=> "error", 'message'=> 'paini']);

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request): \Illuminate\Http\JsonResponse
    {
        if($request->ajax()){
            $note = Note::findOrfail($request->input('id'));
            return response()->json(['status'=> "success", 'data'=> $note]);
        }
        return response()->json(['status'=> "error", 'message'=> 'Error']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(),[
            'id' => 'required|numeric|gt:0',
            'categoryId' => 'required|numeric',
            'noteName' => 'required|string',
            'noteContent' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => "error", 'message' => $validator->errors()->first()]);
        }

        $note = Note::findOrfail($request->input('id'));
        if( $note->user_id == auth()->user()->id ){
            $note = $note->update(['name' => $request->input('noteName'), 'notes' => $request->input('noteContent'), 'category_id' => $request->input('categoryId')]);
            if($note !== false){
                return response()->json(['status'=> "error", 'message'=> 'Note updated successfully!']);
            }
            return response()->json(['status'=> "error", 'message'=> 'Failed to update!']);
        }
        return response()->json(['status'=> "error", 'message'=> 'You can not update note!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request): \Illuminate\Http\JsonResponse
    {
        $validator = Validator::make($request->all(),[
            'id' => 'required|numeric|gt:0',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => "error", 'message' => $validator->errors()->first()]);
        }
        $note = Note::findOrfail($request->input('id'));
        if( auth()->user()->isAdmin() || $note->user_id == auth()->user()->id ){
            if($note->delete()){
                return response()->json(['status'=> "success", 'message'=> 'Note deleted successfully!']);
            }
            return response()->json(['status'=> "error", 'message'=> 'Failed to delete note!']);
        }
        return response()->json(['error'=> 200, 'message'=> 'You can not delete note!']);
    }
}
