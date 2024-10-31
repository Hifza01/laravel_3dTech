<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Task;
use App\Models\Notification;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as DomPDF;

class LaporanController extends Controller
{
    public function index() {
        $teknisi = User::where('level', 'teknisi')->get();

        $notifications = Notification::latest()->get();

        $currentDate = now();

        $bulan = $currentDate->month;
        $tahun = $currentDate->year;

        $teknisiRanking = User::where('level', 'teknisi')
            ->withCount(['tasks' => function($query) use ($bulan, $tahun) {
                $query->where('status', 'done')
                    ->whereMonth('due', $bulan)
                    ->whereYear('due', $tahun);
            }])
            ->orderBy('tasks_count', 'desc')
            ->get();

        $toDoCount = Task::where('status', 'to_do')        
            ->where('due', '>=', $currentDate)
            ->count();
        $inProgressCount = Task::where('status', 'in_progress')
            ->count();
        $doneCount = Task::where('status', 'done')
            ->whereMonth('due', $bulan)
            ->whereYear('due', $tahun)
            ->count();
        $backlogCount = Task::where('status', 'to_do')
            ->where('due', '<', $currentDate)
            ->count();

        return view('laporan', compact('teknisi', 'notifications', 'toDoCount', 'inProgressCount', 'doneCount', 'backlogCount', 'teknisiRanking'));
    }

    public function downloadPdf(Request $request) {
        $jenisLaporan = $request->input('jenis_laporan');
        $bulan = $request->input('bulan');
        $tahun = $request->input('tahun');
        switch ($jenisLaporan) {
            case '1':
                if ($request->input('bulan') == 0) {
                    $data = Task::where('status', 'done')
                                ->whereYear('due', $tahun)
                                ->get();
                } else {
                    $data = Task::where('status', 'done')
                                ->whereMonth('due', $bulan)
                                ->whereYear('due', $tahun)
                                ->get();
                }
                $view = 'laporan.rekap-selesai';
                break;
            case '2':
                if ($request->input('bulan') == 0) {
                    $data = Task::select('category', \DB::raw('count(*) as total'))
                                ->whereYear('due', $tahun)
                                ->groupBy('category')
                                ->orderBy('total', 'desc')
                                ->get();
                } else {
                    $data = Task::select('category', \DB::raw('count(*) as total'))
                                ->whereYear('due', $tahun)
                                ->whereMonth('due', $bulan)
                                ->groupBy('category')
                                ->orderBy('total', 'desc')
                                ->get();
                }                    
                $view = 'laporan.rekap-terbanyak';
                break;
            case '3':
                if ($request->input('bulan') == 0) {
                    $data = Task::whereYear('due', $tahun)
                                ->orderBy('due', 'asc')
                                ->get();
                } else {
                    $data = Task::whereYear('due', $tahun)
                                ->whereMonth('due', $bulan)
                                ->get();
                }
                $view = 'laporan.rekap-bulanan';
                break;
            case '4':          
                if ($request->input('bulan') == 0) {          
                $data = User::where('level', 'teknisi')
                            ->withCount(['tasks' => function($query) use ($bulan, $tahun) {
                                $query->where('status', 'done')
                                      ->whereYear('due', $tahun);
                            }])
                            ->orderBy('tasks_count', 'desc')
                            ->get();
                } else {    
                $data = User::where('level', 'teknisi')
                            ->withCount(['tasks' => function($query) use ($bulan, $tahun) {
                                $query->where('status', 'done')
                                      ->whereMonth('due', $bulan)
                                      ->whereYear('due', $tahun);
                            }])
                            ->orderBy('tasks_count', 'desc')
                            ->get();
                        }
                $view = 'laporan.rekap-peringkat-teknisi';
                break; 
            default:
                return redirect()->back()->with('error', 'Jenis laporan tidak valid');
        }

        $pdf = DomPDF::loadView($view, compact('data', 'bulan', 'tahun'));

        return $pdf->download('laporan.pdf');
    }
}
