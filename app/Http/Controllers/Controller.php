<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function uploadFile($file, $storePath)
    {
        // If not authenticated and file null then return
        if (!Auth::check() && $file == null) {
            return null;
        }

        // Otherwise store the file
        $name = time() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs($storePath, $name, 'public');

        return 'storage/' . $path;
    }
}
