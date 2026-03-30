<?php
// File: app/Http/Middleware/LogVisitor.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class LogVisitor
{
    public function handle(Request $request, Closure $next): Response
    {
        // আমরা এখানে চেক করছি এটি কোনো অ্যাসেট ফাইলের রিকোয়েস্ট কিনা
        if ($request->isMethod('get') && !$this->isAssetRequest($request)) {
            
            $ipAddress = $request->ip();
            $userAgent = $request->header('User-Agent');
            $visitorIdentifier = md5($ipAddress . $userAgent);

            // চেক করা হচ্ছে, এই ইউনিক আইডেন্টিফায়ার দিয়ে আজকে লগ করা হয়েছে কিনা
            $existingVisitor = DB::table('visitors')
                                ->where('visitor_identifier', $visitorIdentifier)
                                ->whereDate('created_at', today())
                                ->exists();

            if (!$existingVisitor) {
                DB::table('visitors')->insert([
                    'ip_address' => $ipAddress,
                    'user_agent' => $userAgent,
                    'visitor_identifier' => $visitorIdentifier,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
        
        return $next($request);
    }

    /**
     * Helper function to check if the request is for an asset file.
     * এই মেথডটি যোগ করা হয়েছে।
     */
    protected function isAssetRequest(Request $request): bool
    {
        $path = $request->path();
        // আপনি এখানে আরও extension যোগ করতে পারেন
        $assetExtensions = ['css', 'js', 'jpg', 'jpeg', 'png', 'gif', 'svg', 'ico', 'woff', 'woff2', 'ttf', 'eot', 'map'];
        $extension = strtolower(pathinfo($path, PATHINFO_EXTENSION));

        return in_array($extension, $assetExtensions);
    }
}