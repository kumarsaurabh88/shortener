<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isSuperAdmin()) {
            // SuperAdmin cannot see all URLs
            $shortUrls = collect();
            $stats = [
                'total_companies' => 0,
                'total_users' => 0,
                'total_urls' => 0,
            ];
        } elseif ($user->isAdmin()) {
            // Admin sees URLs not created in their company
            $shortUrls = ShortUrl::where('company_id', '!=', $user->company_id)->get();
            $stats = [
                'total_urls' => $shortUrls->count(),
                'company_urls' => ShortUrl::where('company_id', $user->company_id)->count(),
            ];
        } else {
            // Member sees URLs not created by themselves
            $shortUrls = ShortUrl::where('company_id', $user->company_id)
                ->where('created_by', '!=', $user->id)
                ->get();
            $stats = [
                'my_urls' => ShortUrl::where('created_by', $user->id)->count(),
                'other_urls' => $shortUrls->count(),
            ];
        }

        return view('dashboard', compact('user', 'shortUrls', 'stats'));
    }
}
