<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tweet;
use App\User;
use App\Tag;
use App\Comment;
use Intervention\Image\ImageManager;


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

    	$tags = explode(' ', $request->tags);

    	$tagsFormatted = [];

    	foreach ($tags as $tag ) {
    		
    		//clean up newly created tags array.
    		if (trim($tag)) {

    			$tagsFormatted[] = strtolower(trim($tag));
    		}
    	}

    	//loop over each tag

    	foreach ($tagsFormatted as $tag ) {
    		//loop over each formatted tag and grab the first matching result or add new tag to db
    		$theTag = Tag::firstOrCreate(['name' => $tag]);

    		$allTagIds[] = $theTag->id;

    	}

    	$newTweet->tags()->attach($allTagIds);

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

    public function deleteTweet($id) {
    	$tweet = Tweet::findOrFail($id);

    	if( $tweet->user_id != \Auth::user()->id ) {
    		return 'Not your tweet';
    	} else {
    		return view('profile.confirm_tweet_delete', compact('tweet'));
    	};
    }

    public function destroyTweet( $id ){
    	$tweet = Tweet::findOrFail($id);

    	if( $tweet->user_id != \Auth::user()->id ) {
    		return 'Not your tweet';
    	} 

    	$tweet->delete();

    	return redirect('profile/'.$tweet->user->username);
    
    }

    public function newProfileImage(Request $request ) {
    	$this->validate($request, [
    			'photo' => 'required|image'
    		]);

    	$manager = new ImageManager;

    	//make a temporary copy of submitted file and save it as a profile image using intervention image.
    	$profileImage = $manager->make($request->photo);

    	$profileImage->resize(240, null, function ($constraint) {
    		$constraint->aspectRatio();
		});

		$profileImage->save('profiles/'.\Auth::user()->id.'.jpg', 90);

		//save filename in user's table
		$user = User::find( \Auth::user()->id );
		$user->profileImage = \Auth::user()->id.'.jpg';
		$user->save();

		return redirect('profile/'.$user->username);
    }
}
