<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Diary_note; 
use Illuminate\Support\Facades\Auth;

class DiaryController extends Controller
{
    function create(Request $request){
        $user = $request->user();

        $diary = new Diary_note();
        $diary->title = $request->title;
        $diary->content = $request->content;
        $diary->tag = $request->tags;
        $diary->email = $user->email;
        $diary->day = $request->date;
        $res = $diary->save();

        if($res){
            return back()->with('success', 'Diary entry created successfully');
        } else {
            return back()->with('fail', 'Something went wrong, try again');
        }
    }

    function listDiaries(){

        $user = Auth::user();

        if(!$user){
            return redirect('login')->with('fail', 'Please log in to view your diaries');
        }

        $diaries = Diary_note::where('email', $user->email)->orderby('day','desc')->paginate(5);
        return view('dashboard',['diaries'=>$diaries]);
    }

    function editdiary($id){

        $user = Auth::user();

        if(!$user){
            return redirect('login')->with('fail', 'Please log in to edit your diary');
        }
        $diary = Diary_note::FindOrFail($id);
        return view('updatediaries', ['diary' => $diary]);      
    }

    function update(Request $request,$id){

        $user = Auth::user();

        if(!$user){
            return redirect('login')->with('fail', 'Please log in to update your diary');
        }

        $diary = Diary_note::find($id);
        if(!$diary){
            return back()->with('fail', 'Diary entry not found');   
        }
        $diary->title = $request->title;
        $diary->content = $request->content;
        $diary->tag = $request->tags;
        $diary->day = $request->date;
        $res = $diary->save();
        if($res){
            return redirect('dashboard')->with('success', 'Diary entry updated successfully');
        } else {
            return back()->with('fail', 'Something went wrong, try again');
        }
    }

    function read($id){

        $user =Auth::user();

        $diary = Diary_note::find($id);
        if(!$diary){
            return back()->with('fail', 'Diary entry not found');   
        }
        return view('read', ['diary' => $diary]);

    }

    function delete($id){
        $user = Auth::user();

        $diary = Diary_note::find($id);
        $res = $diary->delete();
        if($res){
            return redirect('dashboard')->with('success', 'Diary entry deleted successfully');
        } else {
            return back()->with('fail', 'Something went wrong, try again');
        }
    }
        
}
