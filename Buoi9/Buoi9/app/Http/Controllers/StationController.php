<?php

namespace App\Http\Controllers;

use App\Models\Station;
use App\Helper\WardHelper;
use Illuminate\Http\Request;

class StationController extends Controller
{
    /* ==================== USER ==================== */

    // Danh sách cho người dùng
    public function index()
    {
        $wards = WardHelper::get_Wards();
        $stations = Station::withCount('bicycles')->get();
        return view('stations.index', compact('stations', 'wards'));
    }

    // API lọc trạm xe (cho route api/stations)
    public function filter(Request $request)
    {
        $query = Station::withCount('bicycles');
        if ($request->filled('ward')) {
            $query->where('ward', $request->ward);
        }
        return response()->json($query->get());
    }

    /* ==================== ADMIN ==================== */

    // Danh sách station
    public function adminIndex()
    {
        $stations = Station::paginate(10);
        return view('admin.stations.index', compact('stations'));
    }

    // Thùng rác
    public function trash()
    {
        $stations = Station::onlyTrashed()
            ->withCount(['rentalsFrom', 'rentalsTo', 'bicycles'])
            ->paginate(10);
        return view('admin.stations.trash', compact('stations'));
    }

    /* ==================== CREATE ==================== */

    public function create()
    {
        $wards = WardHelper::get_Wards();
        return view('admin.stations.create', compact('wards'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'ward' => 'required',
            'capacity' => 'required|integer|min:0'
        ]);

        Station::create([
            'station_name' => $request->name,
            'address' => $request->address,
            'ward' => $request->ward,
            'total_docks' => $request->capacity,
            'status' => 'active'
        ]);

        return redirect()->route('admin.stations.index')
            ->with('success', 'Thêm trạm thành công');
    }

    /* ==================== EDIT ==================== */

    public function edit($id)
    {
        $station = Station::findOrFail($id);
        $wards = WardHelper::get_Wards();

        return view('admin.stations.edit', compact('station', 'wards'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'capacity' => 'required|integer|min:0'
        ]);

        $station = Station::findOrFail($id);
        $station->update([
            'station_name' => $request->name,
            'address' => $request->address,
            'ward' => $request->ward,
            'total_docks' => $request->capacity,
            'status' => $request->status
        ]);

        return redirect()->route('admin.stations.index')
            ->with('success', 'Cập nhật thành công');
    }

    /* ==================== DELETE ==================== */

    // Xóa mềm
    public function destroy($id)
    {
        $station = Station::findOrFail($id);
        $station->delete();

        return redirect()->route('admin.stations.index')
            ->with('success', 'Đã chuyển vào thùng rác');
    }

    /* ==================== RESTORE ==================== */

    public function restore($id)
    {
        $station = Station::withTrashed()->findOrFail($id);
        $station->restore();

        return redirect()->route('admin.stations.trash')
            ->with('success', 'Đã khôi phục');
    }

    public function restoreSelected(Request $request)
    {
        $ids = explode(',', $request->ids);

        Station::onlyTrashed()
            ->whereIn('id', $ids)
            ->restore();

        return back()->with('success', 'Đã khôi phục các trạm đã chọn');
    }

    public function restoreAll()
    {
        Station::onlyTrashed()->restore();

        return redirect()->route('admin.stations.trash')
            ->with('success', 'Khôi phục tất cả thành công');
    }

    /* ==================== FORCE DELETE ==================== */

    public function forceDelete($id)
    {
        $station = Station::withTrashed()
            ->withCount(['rentalsFrom', 'rentalsTo', 'bicycles'])
            ->findOrFail($id);

        // Check liên kết
        $totalRentals = ($station->rentalsFrom_count ?? 0) + ($station->rentalsTo_count ?? 0);

        if ($totalRentals > 0) {
            return back()->with('error', 'Không thể xóa: trạm đã có lịch sử thuê');
        }

        if ($station->bicycles_count > 0) {
            return back()->with('error', 'Không thể xóa: trạm vẫn còn xe');
        }

        $station->forceDelete();
        return redirect()->route('admin.stations.trash')
            ->with('success', 'Đã xóa vĩnh viễn');
    }

    public function forceDeleteSelected(Request $request)
    {
        $ids = explode(',', $request->ids);

        $stations = Station::onlyTrashed()
            ->withCount(['rentalsFrom', 'rentalsTo', 'bicycles'])
            ->whereIn('id', $ids)
            ->get();

        foreach ($stations as $station) {
            $totalRentals = ($station->rentalsFrom_count ?? 0) + ($station->rentalsTo_count ?? 0);

            if ($totalRentals == 0 && ($station->bicycles_count ?? 0) == 0) {
                $station->forceDelete();
            }
        }

        return back()->with('success', 'Đã xóa các trạm đã chọn');
    }

    public function forceDeleteAll()
    {
        $stations = Station::onlyTrashed()
            ->withCount(['rentalsFrom', 'rentalsTo', 'bicycles'])
            ->get();

        foreach ($stations as $station) {
            $totalRentals = ($station->rentalsFrom_count ?? 0) + ($station->rentalsTo_count ?? 0);
            if ($totalRentals == 0 && ($station->bicycles_count ?? 0) == 0) {
                $station->forceDelete();
            }
        }

        return redirect()->route('admin.stations.trash')
            ->with('success', 'Đã xóa các trạm hợp lệ');
    }
}
