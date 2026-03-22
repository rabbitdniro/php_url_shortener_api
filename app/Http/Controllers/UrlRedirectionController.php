<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Url;

class UrlRedirectionController extends Controller
{
    // Redirects to original URL
    public function originalUrl(Request $request)
    {
        if (!isset($_SERVER['PATH_INFO'])) {
            return;
        }

        // Getting short_code from path value
        $path = $_SERVER['PATH_INFO'];
        $short_code = explode('/', trim($path, '/'));

        if (!Url::where('short_code', $short_code)->exists()) {
            return response()->json(['message' => 'Not Found'], 404);
        }
        // Increment Click count
        Url::where('short_code', $short_code)->increment('click_count');

        // Retrieve original URL
        $url = Url::where('short_code', $short_code)->value('original_url');

        return redirect($url, 302, ['message' => 'found']);
    }
}
