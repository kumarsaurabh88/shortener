<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\ShortUrl;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ShortUrlController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isSuperAdmin()) {
            return redirect('/')->with('error', 'SuperAdmin cannot view URLs');
        }

        if ($user->isAdmin()) {
            $shortUrls = ShortUrl::where('company_id', '!=', $user->company_id)->paginate(15);
        } else {
            $shortUrls = ShortUrl::where('company_id', $user->company_id)
                ->where('created_by', '!=', $user->id)
                ->paginate(15);
        }

        return view('urls.index', compact('shortUrls'));
    }

    public function create()
    {
        $user = auth()->user();

        // Only Admin and Member can create URLs
        if ($user->isSuperAdmin() || $user->isAdmin()) {
            return redirect('/')->with('error', 'You do not have permission to create short URLs');
        }

        return view('urls.create');
    }

    public function store(Request $request)
    {
        $user = auth()->user();

        // Only Member can create URLs
        if (!$user->isMember()) {
            return redirect('/')->with('error', 'You do not have permission to create short URLs');
        }

        $validated = $request->validate([
            'original_url' => ['required', 'url'],
        ]);

        $shortUrl = ShortUrl::create([
            'original_url' => $validated['original_url'],
            'short_code' => Str::random(6),
            'company_id' => $user->company_id,
            'created_by' => $user->id,
        ]);

        return redirect()->route('urls.show', $shortUrl)->with('success', 'Short URL created successfully!');
    }

    public function show(ShortUrl $shortUrl)
    {
        $user = auth()->user();

        // Verify user has permission to view this URL
        if ($user->isMember() && $shortUrl->created_by !== $user->id && $shortUrl->company_id === $user->company_id) {
            // Member can see URLs from others in their company
        } elseif ($user->isAdmin() && $shortUrl->company_id === $user->company_id) {
            // Admin can see URLs from their own company
        } elseif (!$user->isSuperAdmin()) {
            return redirect('/')->with('error', 'Unauthorized');
        }

        return view('urls.show', compact('shortUrl'));
    }

    public function destroy(ShortUrl $shortUrl)
    {
        $user = auth()->user();

        // Only the creator can delete
        if ($shortUrl->created_by !== $user->id) {
            return redirect('/')->with('error', 'You cannot delete this URL');
        }

        $shortUrl->delete();
        return redirect()->route('urls.index')->with('success', 'Short URL deleted successfully!');
    }

    public function redirect($code)
    {
        $shortUrl = ShortUrl::where('short_code', $code)->firstOrFail();
        $shortUrl->increment('clicks');
        return redirect($shortUrl->original_url);
    }
}
