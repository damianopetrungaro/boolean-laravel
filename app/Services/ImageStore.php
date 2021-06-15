<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class ImageStore
{
    public function save(UploadedFile $file): string
    {
        $filename = Str::random(15) . $file->getFilename() . "." . $file->extension();
        $file->move(public_path('images'), $filename);
        return 'images/' . $filename;
    }

    public function delete(string $path): bool
    {
        return unlink(public_path($path));
    }

    public function replace(string $old, UploadedFile $new): string
    {
        if ($old != "") {
            $this->delete($old);
        }

        return $this->save($new);
    }
}
