<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AdminSensorController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim($request->query('search', ''));
        $status = $request->query('status', '');
        $type = $request->query('type', '');

        // SENSOR STATISTICS
        $stats = [
            'total' => DB::table('sensors')->count(),

            'active' => DB::table('sensors')
                ->whereRaw('UPPER(status) = ?', ['ACTIVE'])
                ->count(),

            'inactive' => DB::table('sensors')
                ->whereRaw('UPPER(status) = ?', ['INACTIVE'])
                ->count(),

            'maintenance' => DB::table('sensors')
                ->whereRaw('UPPER(status) = ?', ['MAINTENANCE'])
                ->count(),
        ];

        // SENSOR QUERY
        $query = DB::table('sensors')
            ->select('sensors.*');

        // GET LATEST READING
        $query->selectSub(
            DB::table('monitoring')
                ->select('reading_value')
                ->whereColumn('monitoring.sensor_id', 'sensors.id')
                ->orderByDesc('recorded_at')
                ->orderByDesc('id')
                ->limit(1),
            'latest_reading'
        );

        $query->selectSub(
            DB::table('monitoring')
                ->select('recorded_at')
                ->whereColumn('monitoring.sensor_id', 'sensors.id')
                ->orderByDesc('recorded_at')
                ->orderByDesc('id')
                ->limit(1),
            'latest_recorded_at'
        );

        // SEARCH
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('sensor_code', 'ILIKE', "%{$search}%")
                    ->orWhere('sensor_name', 'ILIKE', "%{$search}%")
                    ->orWhere('sensor_type', 'ILIKE', "%{$search}%")
                    ->orWhere('specific_location', 'ILIKE', "%{$search}%");
            });
        }

        // STATUS FILTER
        if (in_array($status, [
            'ACTIVE',
            'INACTIVE',
            'MAINTENANCE'
        ], true)) {
            $query->whereRaw('UPPER(status) = ?', [$status]);
        }

        // SENSOR TYPE FILTER
        if ($type !== '') {
            $query->where('sensor_type', $type);
        }

        $sensors = $query
            ->orderByDesc('sensors.created_at')
            ->paginate(10)
            ->withQueryString();

        // AVAILABLE SENSOR TYPES
        $sensorTypes = DB::table('sensors')
            ->select('sensor_type')
            ->distinct()
            ->orderBy('sensor_type')
            ->pluck('sensor_type');

        return view('admin.sensors.index', compact(
            'sensors',
            'stats',
            'search',
            'status',
            'type',
            'sensorTypes'
        ));
    }

    public function create(): View
    {
        return view('admin.sensors.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'sensor_code' => [
                'required',
                'string',
                'max:50',
                'unique:sensors,sensor_code',
            ],

            'sensor_name' => [
                'required',
                'string',
                'max:100',
            ],

            'sensor_type' => [
                'required',
                'string',
                'max:100',
            ],

            'measurement_unit' => [
                'required',
                'string',
                'max:50',
            ],

            'specific_location' => [
                'required',
                'string',
                'max:150',
            ],

            'hardware_model' => [
                'nullable',
                'string',
                'max:100',
            ],

            'status' => [
                'required',
                Rule::in([
                    'ACTIVE',
                    'INACTIVE',
                    'MAINTENANCE',
                ]),
            ],
        ]);

        DB::table('sensors')->insert([
            'sensor_code' => $validated['sensor_code'],
            'sensor_name' => $validated['sensor_name'],
            'sensor_type' => $validated['sensor_type'],
            'measurement_unit' => $validated['measurement_unit'],
            'specific_location' => $validated['specific_location'],
            'hardware_model' => $validated['hardware_model'] ?? null,
            'status' => $validated['status'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()
            ->route('admin.sensors.index')
            ->with('success', 'Sensor successfully registered.');
    }
}
