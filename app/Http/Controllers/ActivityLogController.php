<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivityLog;

class ActivityLogController extends Controller
{
    public function index()
    {
        // admin/superadmin only route will be applied in routes
        return response()->json(ActivityLog::latest()->paginate(50));
    }

    public function show($id)
    {
        return response()->json(ActivityLog::findOrFail($id));
    }
}
