<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Task;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index() {
        $user = Auth::user();

        $currentDate = now();
        $currentMonth = now()->month;
        $currentYear = now()->year;

        $teknisi = User::where('level', 'teknisi')->get();

        $toDoTasks = Task::where('status', 'to_do')
            ->where('is_approved', true)
            ->where('due', '>=', $currentDate)
            ->with(['teknisi', 'comments.user'])
            ->get();

        $inProgressTasks = Task::where('status', 'in_progress')
            ->with(['teknisi', 'comments.user'])
            ->get();

        $doneTasks = Task::where('status', 'done')
            ->whereMonth('due', $currentMonth)
            ->whereYear('due', $currentYear)
            ->with(['teknisi', 'comments.user'])
            ->get();

        $overdueTasks = Task::where('status', 'to_do')
            ->where('is_approved', true)
            ->where('due', '<', $currentDate)
            ->with(['teknisi', 'comments.user'])
            ->get();

        $notifications = Notification::latest()->get();

        return view('dashboard', compact('user', 'toDoTasks', 'overdueTasks', 'inProgressTasks', 'doneTasks', 'teknisi', 'notifications'));
    }

    public function AddTask(Request $request) {
        $request->validate([
            'name' => 'required|exists:users,id',
            'category' => 'required|string',
            'content' => 'required|string',
            'due' => 'required|date',
            'color' => 'required|string',
        ]);

        try {
            $task = new Task;
            $task->teknisi_id = $request->name;
            $task->category = $request->category;
            $task->content = $request->content;
            $task->due = $request->due;
            $task->color = $request->color;
            $task->status = 'menunggu_disetujui';
            $task->save();
            
            return redirect('/dashboard')->with('success', 'Tugas Berhasil Ditambah');
        } catch (\Exception $e) {
            return redirect('/dashboard')->with('fail', $e->getMessage());
        }
    }

    public function tambah() {
        $teknisi = User::where('level', 'teknisi')->get();

        $notifications = Notification::latest()->get();

        return view('tambah', compact('teknisi', 'notifications')); 
    }

    public function AddUser(Request $request) {
        $request->validate([
            'name' => 'required|string',
            'level' => 'required|string',
            'email' => 'required|email|unique:users',            
            'password' => 'required|confirmed|min:5|max:8',
        ]);
        try {
            $user = new User;
            $user->name = $request->name;
            $user->level = $request->level;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();

            return redirect('/tambah')->with('success','Akun Berhasil Ditambah');
        } catch (\Exception $e) {
            return redirect('/tambah')->with('fail','Akun Gagal Ditambah');
        }  
    }

    public function loadEditForm($id) {
        $user = User::find($id);
        $teknisi = User::where('level', 'teknisi')->get();

        $notifications = Notification::latest()->get();

        return view('edit-user', compact('user', 'teknisi', 'notifications'));
    }

    public function EditUser(Request $request) {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|min:5|max:8',
        ]);

        try {
            User::where('id', $request->user_id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            return redirect()->route('edit', $request->user_id)->with('success', 'Akun Berhasil Diedit');
        } catch (\Exception $e) {
            return redirect()->route('edit', $request->user_id)->with('fail', 'Akun Gagal Diedit');
        }
    }
}
