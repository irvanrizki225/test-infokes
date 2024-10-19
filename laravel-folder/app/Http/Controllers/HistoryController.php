<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;

use App\Helpers\ResponseFormatter;
use App\Helpers\DataFormatter;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $formatter = new DataFormatter();
        $histories = History::all();
        $data = $formatter->HistoryFormatter($histories);


        return ResponseFormatter::success($data, 'Success Fetch Data');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(History $history)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(History $history)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, History $history)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(History $history)
    {
        //
    }
}
