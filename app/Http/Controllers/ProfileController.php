<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tweet;
use App\User;
use App\Comment;


use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
    //
    public function index() {

    	//count total posts by user
    	$totalTweets = \Auth::user()->tweets()->count();


    	return view('profile/index', compact('totalTweets'));
    }

    public function newTweet(Request $request) {
    	
    	$this->validate( $request, [
    			'content'=>'required|max:140'
    		]);

    	$newTweet = new Tweet();

    	$newTweet->content = $request->content;
    	$newTweet->user_id = \Auth::user()->id;

    	$newTweet->save();

    	return redirect('profile');
    }

    public function show($username){

    	$user = User::where('username', '=', $username )->firstOrFail();

    	$userPosts = $user->tweets()->get();


    	return view('profile.show', compact('user', 'userPosts'));
    }

    public function newComment(Request $request) {
    	$this->validate($request, [
    			'comment'=>'required|min:2|max:140',
    			'tweet_id'=>'required|exists:tweets,id'
    		]);

    	$comment = new Comment();

    	$comment->content = $request->comment;
    	$comment->user_id = \Auth::user()->id;
    	$comment->tweet_id = $request->tweet_id;

    	$comment->save();

// redirects user back to page.
    	return back();
    }
}
