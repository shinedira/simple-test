<?php
namespace App\Service;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

trait UploadTrait
{
    public function upload(Request $request, $model, String $file = 'file')
    {
        if ($request->hasFile($file)) {
            if ($model::REPLACE_FILE)
                $this->delete($model);

            $filename = time() . '.' . $request->file->extension();
            
            Storage::putFileAs( $model::STORAGE_PATH, $request->file, $filename);

            return $filename;
        }
    }

    public function delete($model) : void
    {
        $filename = optional($model->file)->name;

        // dd('app/' . $model::STORAGE_PATH . $filename);

        Storage::delete($model::STORAGE_PATH . $filename);
    }
}
