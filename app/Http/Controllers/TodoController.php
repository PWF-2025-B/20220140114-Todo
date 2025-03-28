<?php  

namespace App\Http\Controllers;  

use Illuminate\Http\Request;  
use App\Models\Todo; // Tambahkan ini
use Illuminate\Support\Facades\Auth; // Tambahkan ini juga jika Auth digunakan

class TodoController extends Controller  
{  
    public function index()  
    {  
        // Ambil hanya todos milik user yang sedang login
        // $todos = Todo::all();  
        $todos = Todo::all(); 
        dd($todos);  
        return view('todo.index');  
    }  

    public function create()  
    {  
        return view('todo.create');  
    }  

    public function edit()  
    {  
        return view('todo.edit');  
    }  
}
