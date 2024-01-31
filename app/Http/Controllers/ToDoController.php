<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ToDo;
use App\Models\User;
use App\Models\Bookmark;
use App\Models\Events;

class ToDoController extends Controller
{
    public function list() 
    {
        $task = ToDo::orderby('created_at')->get();
        return view('to-do.list', ['task' => $task]);
    }

    public function todoCalendar() 
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

        return view('calendar.todoCalendar', ['events' => $events]);
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
        $task = ToDo::orderby('created_at')->get();
        return view('to-do.editOnlyList', ['task' => $task]);
    }

    public function viewOnlyList() 
    {
        $task = ToDo::orderby('created_at')->get();
        return view('to-do.viewOnlyList', ['task' => $task]);
    }

    public function usersList() 
    {
        $users = User::orderby('created_at')->get();
        return view('users.usersList', ['users' => $users]);
    }

    public function create()
    {
        return view('to-do.create');
    }

    public function bookmarkTab()
    {
        $bookmark = Bookmark::orderby('created_at')->get();
        return view('to-do.bookmarkTab', ['bookmark' => $bookmark]);
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
        $task = ToDo::findOrFail($id);
        return view('to-do.edit', ['task' => $task]);
    }

    public function bookmark($id)
    {
        $task = ToDo::findOrFail($id);
        return view('to-do.bookmark', ['task' => $task]);
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

}
