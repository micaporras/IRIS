<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ToDo;
use App\Models\User;
use App\Models\Bookmark;
use App\Models\Events;

class ToDoController extends Controller
{
    public function list(Request $request, ToDo $task) 
    {
        if(Auth::check()){
            // $task = ToDo::orderby('created_at')->get();
            $keyword = $request->get('search');

            if(!empty($keyword)){
                $task = ToDo::where('name','LIKE', "%$keyword%")
                ->orWhere('description', 'LIKE', "%$keyword%")
                ->get();
            }
            else{
                $task = ToDo::orderby('created_at')->get();
            }

            $countCompletedTasks = ToDo::where('status', 'completed')->count();
            $countOngoingTasks = ToDo::where('status', 'On Going')->count();
            $countFailedTasks = ToDo::where('status', 'Failed To Do')->count();
            return view('to-do.list', ['task' => $task], compact('countCompletedTasks','countOngoingTasks', 'countFailedTasks'));
        }
        return redirect('login')->withSuccess('Login to access the list');
    }

    public function todoCalendar() 
    {
        if(Auth::check()){
            $events = array();
            $todo = Events::all();
            foreach($todo as $todo) {
            $events[] = [
                'title' => $todo->name,
                'description' => $todo->description,
                'start' => $todo->start,
                'end' => $todo->end,
                'createdby' => $todo->createdby,
                'status' => $todo->status,
            ];
        }
        return view('calendar.todoCalendar', ['events' => $events]);
        }
        return redirect('login')->withSuccess('Login to access the calendar');
        
    }

    public function todoCalendar1() 
    {
        $events = array();
        $todo = Events::all();
        foreach($todo as $todo) {
            $events[] = [
                'title' => $todo->name,
                'description' => $todo->description,
                'start' => $todo->start,
                'end' => $todo->end,
                'createdby' => $todo->createdby,
                'status' => $todo->status,
            ];
        }
        
        return view('calendar.todoCalendar1', ['events' => $events]);
    }

    public function todoCalendar2() 
    {
        $events = array();
        $todo = Events::all();
        foreach($todo as $todo) {
            $events[] = [
                'title' => $todo->name,
                'description' => $todo->description,
                'start' => $todo->start,
                'end' => $todo->end,
                'createdby' => $todo->createdby,
                'status' => $todo->status,
            ];
        }
        
        return view('calendar.todoCalendar2', ['events' => $events]);
    }

    public function editOnlyList() 
    {
        if(Auth::check()){
            $task = ToDo::orderby('created_at')->get();
            return view('to-do.editOnlyList', ['task' => $task]);
        }
        return redirect('login')->withSuccess('Login to access the list');
        
    }

    public function viewOnlyList() 
    {
        if(Auth::check()){
            $task = ToDo::orderby('created_at')->get();
            return view('to-do.viewOnlyList', ['task' => $task]);
        }
        return redirect('login')->withSuccess('Login to access the list');
    }

    public function usersList() 
    {
        if(Auth::check()){
            $users = User::orderby('created_at')->get();
            return view('users.usersList', ['users' => $users]);
        }
        return redirect('login')->withSuccess('Login to access the list');
    }

    public function create()
    {
        if(Auth::check()){
            return view('to-do.create');
        }
        return redirect('login')->withSuccess('You need to login first');
    }

    public function bookmarkTab()
    {
        if(Auth::check()){
            $bookmark = Bookmark::orderby('created_at')->get();
            return view('to-do.bookmarkTab', ['bookmark' => $bookmark]);
        }
        return redirect('login')->withSuccess('You need to login first');
    }

    public function bookmarkTab1()
    {
        $bookmark = Bookmark::orderby('created_at')->get();
        return view('to-do.bookmarkTab1', ['bookmark' => $bookmark]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'status' => 'required',
            'createdby' => 'required',
            'start' => 'required',
            'end' => 'required',
        ]);

        $task = new ToDo;
        $task->name = $request->name;
        $task->description = $request->description;
        $task->start = $request->start;
        $task->end = $request->end;
        $task->status = $request->status;
        $task->createdby = $request->createdby;

        $todo = new Events;
        $todo ->id = $task->id;
        $todo ->name = $request->name;
        $todo ->description = $request->description;
        $todo ->start = $request->start;
        $todo ->end = $request->end;
        $todo ->status = $request->status;
        $todo ->createdby = $request->createdby;

        $task->save();
        $todo->save();
        return redirect('list')->withSuccess('Task Added Successfully');
    }


    public function edit($id)
    {
        if(Auth::check()){
            $task = ToDo::findOrFail($id);
            return view('to-do.edit', ['task' => $task]);
        }
        return redirect('login')->withSuccess('You need to login first');
    }

    public function bookmark($id)
    {
        if(Auth::check()){
            $task = ToDo::findOrFail($id);
            return view('to-do.bookmark', ['task' => $task]);
        }
        return redirect('login')->withSuccess('You need to login first');
    }

    public function bookmark1($id)
    {
        $bookmark = Bookmark::findOrFail($id);
        return view('to-do.bookmark1', ['bookmark' => $bookmark]);
    }


    public function edit2($id)
    {
        $task = ToDo::findOrFail($id);
        return view('to-do.edit2', ['task' => $task]);
    }

    public function editUsers($id)
    {
        $users = User::findOrFail($id);
        return view('users.editUsers', ['users' => $users]);
    }

    public function editProfile($id)
    {
        $users = User::findOrFail($id);
        return view('users.editProfile');
    }

    public function update(Request $request, ToDo $task)
    {
        $request->validate([
            'name' => 'required',
            'createdby' => 'required'
        ]);

        $task = ToDo::find($request->hidden_id);
        $todo = Events::find($request->hidden_id);

        $task->name = $request->name;
        $task->description = $request->description;
        $task->start = $request->start;
        $task->end = $request->end;
        $task->status = $request->status;
        $task->createdby = $request->createdby;

        $todo->name = $request->name;
        $todo->description = $request->description;
        $todo->start = $request->start;
        $todo->end = $request->end;
        $todo->status = $request->status;
        $todo->createdby = $request->createdby;

        $task->save();
        $todo->save();
        return redirect('list')->withSuccess('Task Updated');
    }
    

    public function addBookmark(Request $request, ToDo $task, Bookmark $bookmark)
    {
        $request->validate([
            'name' => 'required',
            'createdby' => 'required'
        ]);

        $task = ToDo::find($request->hidden_id);
        $bookmark = new Bookmark;

        $bookmark->id= $request->id;
        $bookmark->name = $request->name;
        $bookmark->description = $request->description; 
        $bookmark->start = $request->start;
        $bookmark ->end = $request->end;
        $bookmark->status = $request->status;
        $bookmark->createdby = $request->createdby;

        $bookmark->save();
        return redirect('list')->withSuccess('Task Added to Bookmark');
    }

    public function addBookmark1(Request $request, ToDo $task, Bookmark $bookmark)
    {
        $request->validate([
            'name' => 'required',
            'createdby' => 'required'
        ]);

        $bookmark = Bookmark::find($request->hidden_id);
        $task = new ToDo;

        $task->id= $request->id;
        $task->name = $request->name;
        $task->description = $request->description;
        $task ->start = $request->start;
        $task ->end = $request->end;
        $task->status = $request->status;
        $task->createdby = $request->createdby;

        $todo = new Events;

        $todo->id = $request->id;
        $todo ->name = $request->name;
        $todo ->description = $request->description;
        $todo ->start = $request->start;
        $todo ->end = $request->end;
        $todo ->status = $request->status;
        $todo ->createdby = $request->createdby;

        $task->save();
        $todo->save();
        return redirect('list')->withSuccess('Task Restored');
    }

    public function update2(Request $request, ToDo $task)
    {
        $request->validate([
            'name' => 'required',
            'createdby' => 'required'
        ]);

        $task = ToDo::find($request->hidden_id);
        $todo = Events::find($request->hidden_id);

        $task->name = $request->name;
        $task->description = $request->description;
        $task->start = $request->start;
        $task->end = $request->end;
        $task->status = $request->status;
        $task->createdby = $request->createdby;

        $todo->name = $request->name;
        $todo->description = $request->description;
        $todo->start = $request->start;
        $todo->end = $request->end;
        $todo->status = $request->status;
        $todo->createdby = $request->createdby;

        $task->save();
        $todo->save();
        return redirect('editOnlyList')->withSuccess('Task Updated');
    }

    public function delete($id) 
    {
        $task = ToDo::findOrFail($id);
        $todo = Events::findOrFail($id);
        $todo->delete();
        $task->delete();

        return redirect('list')->withSuccess('Task Deleted Successfully');
    }

    public function deleteBM($id) 
    {
        $bookmark = Bookmark::findOrFail($id);
        $bookmark->delete();
        return redirect('bookmarkTab')->withSuccess('Bookmark Deleted Successfully');
    }

    public function deleteUser($id) 
    {
        $users = User::findOrFail($id);
        $users->delete();
        return redirect('usersList')->withSuccess('User Deleted Successfully');
    }

    public function userList(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'status' => 'required'
        ]);

        $users = new User;
        $users->name = $request->name;
        $users->description = $request->description;
        $users->status = $request->status;
        $users->createdby = $request->createdby;

        $users->save();
        return redirect('usersList')->withSuccess('Task Added Successfully');
    }

    public function updateUser(Request $request, User $users)
    {
        $request->validate([
            'level' => 'required',
        ]);

        $users = User::find($request->hidden_id);

        $users->name = $request->name;
        $users->level = $request->level;

        $users->save();
        return redirect('usersList')->withSuccess('User Updated');
    }

    public function updateProfile(Request $request, User $users)
    {
        $request->validate([
            'name' => 'required',
        ]);

        $users = User::find($request->hidden_id);

        $users->name = $request->name;

        $users->save();
        return redirect('dashboard')->withSuccess('User Updated');
    }

}
