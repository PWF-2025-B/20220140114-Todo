<?php  

namespace App\Http\Controllers;  

use Illuminate\Http\Request;  
use App\Models\Todo; // Tambahkan ini
use Illuminate\Support\Facades\Auth; // Tambahkan ini juga jika Auth digunakan

class TodoController extends Controller  
{  
    public function index()  
    {  
        $todos = Todo::all();
        return view('todo.index', compact('todos'));
    }  

    public function create()  
    {  
        return view('todo.create');  
    }  

    public function edit()  
    {  
        return view('todo.edit');  
    }  

    public function store(Request $request)
{
    $request->validate([
        'title' => 'required'
    ]);

    Todo::create([
        'title' => $request->title,
        'user_id' => Auth::id(), 
        'is_done' => false,      
    ]);

    return redirect()->route('todo.index')->with('success', 'Todo created successfully!');
    }

}
