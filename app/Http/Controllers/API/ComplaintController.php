<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Complaint;
use Auth;

class ComplaintController extends Controller
{
    public function __construct(){
      $this->middleware('auth:api');
    }

    public function index(){
      $user = Auth::user()->id;
      $complaints = Complaint::where('user_id', $user)->orderBy('id','DESC')->get();
      if ($complaints->isEmpty()) {
        return response()->json([
          'message' => 'Success',
          'status' => true,
          'data' => []
        ], 200);
      }
      foreach ($complaints as $complaint) {
        $result[] = [
          'id' => $complaint->id,
          'title' => $complaint->title,
          'message' => $complaint->message,
          'input1' => $complaint->input1,
          'input2' => $complaint->input2,
          'input3' => $complaint->input3,
          'input4' => $complaint->input4,
          'input5' => $complaint->input5,
          'date' => $complaint->created_at->format('d M Y'),
          'create' => $complaint->created_at->diffForHumans(),
          'update' => $complaint->updated_at->diffForHumans(),
          'name_user' => $complaint->users->name,
          'email' => $complaint->users->email
        ];
      }
      return response()->json([
        'message' => 'Success',
        'status' => true,
        'data' => $result
      ], 200);
    }

    public function store(Request $request){
      $complaint = Complaint::create([
        'title' => $request->title,
        'message' => $request->message,
        'input1' => $request->input1,
        'input2' => $request->input2,
        'input3' => $request->input3,
        'input4' => $request->input4,
        'input5' => $request->input5,
        'user_id' => Auth::user()->id
      ]);

      return response()->json([
        'message' => 'Success',
        'status' => true,
        'data' => [
          'id' => $complaint->id,
          'title' => $complaint->title,
          'message' => $complaint->message,
          'input1' => $complaint->input1,
          'input2' => $complaint->input2,
          'input3' => $complaint->input3,
          'input4' => $complaint->input4,
          'input5' => $complaint->input5,
          'date' => $complaint->created_at->format('d M Y'),
          'create' => $complaint->created_at->diffForHumans(),
          'update' => $complaint->updated_at->diffForHumans(),
          'name_user' => $complaint->users->name,
          'email' => $complaint->users->email
        ]
      ], 201);
    }

    public function show($id){
      $complaint = Complaint::find($id);
      if ($complaint == null) {
        return response()->json([
          'message' => 'Success',
          'status' => true,
          'data' => []
        ]);
      }
      return response()->json([
        'message' => 'Success',
        'status' => true,
        'data' => [
          'id' => $complaint->id,
          'title' => $complaint->title,
          'message' => $complaint->message,
          'input1' => $complaint->input1,
          'input2' => $complaint->input2,
          'input3' => $complaint->input3,
          'input4' => $complaint->input4,
          'input5' => $complaint->input5,
          'date' => $complaint->created_at->format('d M Y'),
          'create' => $complaint->created_at->diffForHumans(),
          'update' => $complaint->updated_at->diffForHumans(),
          'name_user' => $complaint->users->name,
          'email' => $complaint->users->email
        ]
      ], 200);
    }

    public function update(Request $request,$id){
      $complaint = Complaint::find($id);
      $complaint->update([
        'title' => $request->title,
        'message' => $request->message,
        'input1' => $request->input1,
        'input2' => $request->input2,
        'input3' => $request->input3,
        'input4' => $request->input4,
        'input5' => $request->input5,
      ]);

      return response()->json([
        'message' => 'Update Success',
        'status' => true,
        'data' => [
          'id' => $complaint->id,
          'title' => $complaint->title,
          'message' => $complaint->message,
          'input1' => $complaint->input1,
          'input2' => $complaint->input2,
          'input3' => $complaint->input3,
          'input4' => $complaint->input4,
          'input5' => $complaint->input5,
          'date' => $complaint->created_at->format('d M Y'),
          'time' => $complaint->created_at->diffForHumans(),
          'update' => $complaint->updated_at->diffForHumans(),
          'name_user' => $complaint->users->name,
          'email' => $complaint->users->email
        ]
      ], 201);
    }

    public function destroy($id){
      $complaint = Complaint::find($id);
      $complaint->delete();

      return response()->json([
        'message' => 'Delete Success',
        'status' => true
      ]);
    }
}
