<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Upsell;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $bannersCount = Banner::count();
        $activeBannersCount = Banner::where('is_active', true)->count();
        $upsellsCount = Upsell::count();
        $banners= Ba
        $activeUpsellsCount = Upsell::where('is_active', true)->count();

        return view('admin.dashboard.index', compact(
            'bannersCount',
            'activeBannersCount',
            'upsellsCount',
            'activeUpsellsCount'
        ));
    }
}