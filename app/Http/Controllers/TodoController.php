<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use App\Http\Requests\ToDoStoreRequest;
use App\Http\Requests\ToDoUpdateRequest;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = Todo::latest('id')->select(['id', 'title', 'is_completed', 'updated_at'])->paginate(30);
        // return $todos;
        return view('todo.todo', compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('todo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ToDoStoreRequest $request)
    {
        // dd($request->all());

        Todo::create([
            'title' => $request->title,
        ]);

        Toastr::success('ToDo Created Successfully 🙂');
        // return redirect()->back();
        return redirect()->route('todos.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // dd($id);
        $todo = Todo::where('id', $id)->first();
        return view('todo.edit', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ToDoUpdateRequest $request, string $id)
    {
        // dd($request->all());
        $todo = Todo::where('id', $id)->first();
        $todo->update([
            'title' => $request->title,
            'is_completed' => $request->filled('is_completed'),
        ]);

        Toastr::success('ToDo Updated Successfully 🙂');
        // return redirect()->back();
        return redirect()->route('todos.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // dd($id);
        $todo = Todo::where('id', $id)->first();
        $todo->delete();

        Toastr::success('ToDo Deleted Successfully 🙂');
        // return redirect()->back();
        return redirect()->route('todos.index');
    }
}
