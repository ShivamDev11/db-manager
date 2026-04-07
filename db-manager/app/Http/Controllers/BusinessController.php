<?php

namespace App\Http\Controllers;

use App\Models\Business;
use Illuminate\Http\Request;

class BusinessController extends Controller
{
    public function index()
    {
        $businesses = Business::paginate(20);
        return view('businesses.index', compact('businesses'));
    }

    public function duplicates()
    {
        // Get all duplicates grouped by hash
        $duplicateHashes = Business::where('is_duplicate', true)
            ->distinct('duplicate_hash')
            ->pluck('duplicate_hash');

        $duplicateGroups = [];
        foreach ($duplicateHashes as $hash) {
            $duplicateGroups[] = Business::where('duplicate_hash', $hash)->get();
        }

        return view('businesses.duplicates', compact('duplicateGroups'));
    }

    public function report()
    {
        $totalCount = Business::count();
        $uniqueCount = Business::where('is_duplicate', false)->count();
        $duplicateCount = Business::where('is_duplicate', true)->count();
        $incompleteCount = Business::where('is_incomplete', true)->count();

        // City-wise data
        $cityWiseData = Business::select('city')
            ->selectRaw('count(*) as count')
            ->groupBy('city')
            ->orderByRaw('count DESC')
            ->get();

        // Category + city-wise
        $categoryCityData = Business::select('category', 'city')
            ->selectRaw('count(*) as count')
            ->groupBy('category', 'city')
            ->orderByRaw('count DESC')
            ->get();

        // Category + area-wise
        $categoryAreaData = Business::select('category', 'area')
            ->selectRaw('count(*) as count')
            ->groupBy('category', 'area')
            ->orderByRaw('count DESC')
            ->get();

        return view('businesses.report', compact(
            'totalCount',
            'uniqueCount',
            'duplicateCount',
            'incompleteCount',
            'cityWiseData',
            'categoryCityData',
            'categoryAreaData'
        ));
    }

    public function merge(Request $request)
    {
        $request->validate([
            'master_id' => 'required|exists:businesses,id',
            'duplicate_ids' => 'required|array',
            'duplicate_ids.*' => 'exists:businesses,id'
        ]);

        $masterId = (int) $request->master_id;
        $duplicateIds = collect($request->duplicate_ids)
            ->map(fn ($id) => (int) $id)
            ->unique()
            ->filter(fn ($id) => $id !== $masterId)
            ->values()
            ->all();

        if (count($duplicateIds) === 0) {
            return back()->with('error', 'Please select one or more duplicate records to merge. Do not select the master record.');
        }

        Business::where('id', $masterId)->update([
            'master_id' => null,
            'is_duplicate' => false,
        ]);

        Business::whereIn('id', $duplicateIds)->update([
            'master_id' => $masterId,
            'is_duplicate' => true,
        ]);

        return back()->with('success', 'Records merged successfully');
    }

    public function show($id)
    {
        $business = Business::findOrFail($id);
        $duplicates = $business->duplicates();
        return view('businesses.show', compact('business', 'duplicates'));
    }

    public function destroy($id)
    {
        Business::findOrFail($id)->delete();
        return back()->with('success', 'Record deleted successfully');
    }
}
