<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function updateStatus(Request $request, $id) {
        $task = Task::findOrFail($id);

        $validStatuses = ['to_do', 'in_progress', 'done'];
        if (in_array($request->input('status'), $validStatuses)) {
            $task->status = $request->input('status');
            $task->save();
        }

        return redirect()->route('dashboard')->with('success', 'Status tugas berhasil diupdate.');
    }
}
