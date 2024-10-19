<?php

namespace App\Helpers;

use App\Models\History;
use App\Models\Folder;
use Illuminate\Support\Carbon;

class DataFormatter
{
    public function FolderFormatter($folder)
    {
        $data = [];

       foreach ($folder as $key => $value) {
            $data[$key]['id'] = $value->id;
            $data[$key]['name'] = $value->name;
            $data[$key]['parent_id'] = $value->parent_id;
       }

        return $data;
    }

    public function CreateHistory($id)
    {
        History::create([
            'folder_id' => $id,
            'last_seen' => Carbon::now()
        ]);
    }

    public function HistoryFormatter($histories)
    {
        $data = [];
        $ids = [];

        foreach ($histories as $value) {
            if (!in_array($value->folder_id, $ids)) {
                $folder = Folder::find($value->folder_id);

                if ($folder) {
                    $data[] = [
                        'id' => $folder->id,
                        'name' => $folder->name,
                        'parent_id' => $folder->parent_id,
                    ];

                    $ids[] = $value->folder_id;
                }
            }
        }

        return $data;
    }


}
