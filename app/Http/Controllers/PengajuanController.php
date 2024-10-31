<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengajuanController extends Controller
{
    public function create() {
        $teknisi = User::where('level', 'teknisi')->get();
        return view('pengajuan', compact('teknisi'));
    }

    public function index() {
        $pengajuan = Task::where('is_approved', false)->get();

        $teknisi = User::where('level', 'teknisi')->get();

        $notifications = Notification::latest()->get();

        return view('pengajuan', compact('pengajuan', 'teknisi', 'notifications'));
    }

    public function approveTask($id) {
        $task = Task::find($id);
        if ($task) {
            $task->is_approved = true;
            $task->status = 'to_do';
            $task->save();
    
            $message = 'Pengajuan tugas Anda diterima';
            Notification::create([
                'user_id' => $task->teknisi->id,
                'message' => $message,
            ]);
    
            return redirect('/pengajuan')->with('success', 'Tugas berhasil disetujui');
        }
    
        return redirect('/pengajuan')->with('fail', 'Tugas tidak ditemukan');
    }    
    
    public function rejectTask($id) {
        $task = Task::find($id);
        if ($task) {
            $message = 'Pengajuan tugas Anda ditolak';
            Notification::create([
                'user_id' => $task->teknisi->id,
                'message' => $message,
            ]);
    
            $task->delete();
        
            return redirect('/pengajuan')->with('success', 'Tugas berhasil ditolak');
        }
        
        return redirect('/pengajuan')->with('fail', 'Tugas tidak ditemukan');
    }
}
