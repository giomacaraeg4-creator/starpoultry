<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'sensors' => DB::table('sensors')->count(),
            'cameras' => DB::table('cameras')->count(),
            'inventory' => DB::table('inventory')->count(),

            'feeding' => DB::table('automated_feeding')
                ->where('is_enabled', true)
                ->count(),

            'accounts' => DB::table('accounts')->count(),

            'low_stock' => DB::table('inventory')
                ->whereNotNull('reorder_level')
                ->whereColumn('quantity', '<=', 'reorder_level')
                ->count(),
        ];

        $latestReadings = DB::table('monitoring')
            ->join('sensors', 'monitoring.sensor_id', '=', 'sensors.id')
            ->select(
                'sensors.sensor_name',
                'sensors.sensor_type',
                'sensors.measurement_unit',
                'monitoring.reading_value',
                'monitoring.recorded_at'
            )
            ->orderByDesc('monitoring.recorded_at')
            ->limit(5)
            ->get();

        $latestRecording = DB::table('camera_recordings')
            ->orderByDesc('captured_at')
            ->first();

        $cameraStreamUrl = config('services.poultry_camera.stream_url');

        return view('admin.dashboard', compact(
            'stats',
            'latestReadings',
            'latestRecording',
            'cameraStreamUrl'
        ));
    }
}
