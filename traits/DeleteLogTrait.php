<?php

namespace App\Helpers\Traits;

use App\Models\DeleteLog;
use Illuminate\Support\Facades\Auth;

trait DeleteLogTrait
{
    public function deleteLog($model, $row)
    {
        // Deleted status update
        $find = $model::findOrFail($row);
        $find->deleted_by = Auth::user()->username;
        $find->save();
        $find->delete();

        // Inserting the delete log
        $deletelog = new DeleteLog();
        $deletelog->model = $model;
        $deletelog->row_id = $row;
        $deletelog->save();
        return $deletelog;
    }
}
