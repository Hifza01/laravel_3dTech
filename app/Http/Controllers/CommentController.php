<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Task $task){
        $request->validate([
            'comment' => 'required|string',
        ]);

        Comment::create([
            'user_id' => auth()->id(),
            'task_id' => $task->id,
            'comment' => $request->comment,
        ]);

        return redirect()->back()->with('success', 'Komentar berhasil ditambahkan.');
    }
}
