<?php

namespace App\Http\Controllers;

use App\Models\Folder;
use Illuminate\Http\Request;
use App\Helpers\ResponseFormatter;
use App\Helpers\DataFormatter;

class FolderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $data = Folder::where('parent_id', null)->orWhere('parent_id', "")->get();

            $formatter = new DataFormatter();
            $folders = $formatter->FolderFormatter($data);

            return ResponseFormatter::success($folders, 'Success Fetch Data');
        } catch (\Throwable $th) {
            return ResponseFormatter::error($th, 'Error When Fetch Data', 500);
        }
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
        try {
            $request->validate([
                'name' => 'required',
            ]);

            $folder = Folder::create([
                'name' => $request->name,
                'parent_id' => $request->parent_id
            ]);

            return ResponseFormatter::success($folder, 'Success Create Data');
        } catch (\Throwable $th) {
            return ResponseFormatter::error($th, 'Error When Create Data', 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($name)
    {
        try {
            $folder = Folder::where('name', $name)->first();
            $folders = Folder::where('parent_id', $folder->id)->get();
            $formatter = new DataFormatter();
            $folders = $formatter->FolderFormatter($folders);
            //create history
            $formatter->CreateHistory($folder->id);
            return ResponseFormatter::success($folders, 'Success Fetch Data');
        } catch (\Throwable $th) {
            return ResponseFormatter::error($th, 'Error When Fetch Data', 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Folder $folder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        try {
            $request->validate([
                'name' => 'required',
            ]);

            $folder = Folder::where('id', $id)->update([
                'name' => $request->name,
                'parent_id' => $request->parent_id
            ]);

            return ResponseFormatter::success(null, 'Success Update Data');
        } catch (\Throwable $th) {
            return ResponseFormatter::error($th, 'Error When Update Data', 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $folder = Folder::where('id', $id)->delete();
            return ResponseFormatter::success(null, 'Success Delete Data');
        } catch (\Throwable $th) {
            return ResponseFormatter::error($th, 'Error When Delete Data', 500);
        }
    }
}
