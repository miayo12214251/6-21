<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Person;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    public function index(Post $post, Person $person)
    {
        $contractData = Post::selectRaw('person.name as name, SUM(posts.contract) as total_contract')
                            ->join('person', 'posts.person_id', '=', 'person.id')
                            ->groupBy('person.name')
                            ->orderByDesc('total_contract')
                            ->get();

        $meetingData = Post::selectRaw('person.name as name, SUM(posts.meeting) as total_meeting')
                        ->join('person', 'posts.person_id', '=', 'person.id')
                        ->groupBy('person.name')
                        ->orderByDesc('total_meeting')
                        ->get();

        $appointmentData = Post::selectRaw('person.name as name, SUM(posts.appointment) as total_appointment')
                            ->join('person', 'posts.person_id', '=', 'person.id')
                            ->groupBy('person.name')
                            ->orderByDesc('total_appointment')
                            ->get();
        
        return view('posts.index')->with([
            'posts' => $post->getPaginateByLimit(),
            'contractData' => $contractData,
            'meetingData' => $meetingData, 
            'appointmentData' => $appointmentData,
            'persons' => $person->get()
            
        ]);
    }
    
    public function statistics(Post $post)
    {
    $contractData = Post::selectRaw('person.name as name, SUM(posts.contract) as total_contract')
                        ->join('person', 'posts.person_id', '=', 'person.id')
                        ->groupBy('person.name')
                        ->orderByDesc('total_contract')
                        ->get();
    
    $meetingData = Post::selectRaw('person.name as name, SUM(posts.meeting) as total_meeting')
                    ->join('person', 'posts.person_id', '=', 'person.id')
                    ->groupBy('person.name')
                    ->orderByDesc('total_meeting')
                    ->get();
    
    $appointmentData = Post::selectRaw('person.name as name, SUM(posts.appointment) as total_appointment')
                        ->join('person', 'posts.person_id', '=', 'person.id')
                        ->groupBy('person.name')
                        ->orderByDesc('total_appointment')
                        ->get();
    
    return view('posts.statistics')->with([
        'posts' => $post->getPaginateByLimit(),
        'contractData' => $contractData,
        'meetingData' => $meetingData, 
        'appointmentData' => $appointmentData
    ]);
    
    }
    public function show(Post $post)
    {
        return view('posts.show')->with(['post' => $post]);
    }

    public function create()
    {
        $persons = Person::pluck('name', 'id')->toArray();
        return view('posts.create', compact('persons'));
    }

    public function store(Request $request)
    {
        dd($request);
        $request->validate([
            'post.created_at2' => ['required', 'date'],
            'post.body' => 'required',
        ], [
            // 'post.created_at2.regex' => '日付は〇〇年〇〇月〇〇日の形式で入力してください。',
        ]);
    
        $input = $request->input('post');
        $post = new Post();
        $post->fill($input);
        $post->save();
    
        return redirect('/posts/' . $post->id);
    }

    public function edit(Post $post)
    {
        return view('posts.edit')->with(['post' => $post]);
    }

    public function update(PostRequest $request, Post $post)
    {
        $input_post = $request['post'];
        $post->fill($input_post)->save();
    
        return redirect('/posts/' . $post->id);
    }

    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/');
    }
}
