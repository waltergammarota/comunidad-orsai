<?php


namespace App\Repositories;

use App\Classes\ApplicationFile;
use App\Databases\FileModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class FileRepository extends GenericRepository
{
    public function getUploadedFiles($type, Request $request = null, $width = null, $height = null)
    {
        $images = [];
        if ($request->hasFile($type)) {
            $files = $request->file($type);
            foreach ($files as $key => $file) {
                $image = $this->saveToDisk($type, $file, $width, $height);
                $this->saveImage($type, $image, $key);
                array_push($images, $image);
            }
        }
        return $images;
    }

    public function resizeImage($file, $type, $id, $extension, $width, $height)
    {
        // Resize image
        $resize = Image::make($file)->fit($width, $height)->encode($extension);

        // Put image to storage
        Storage::put("public/{$type}/{$id}.{$file->extension()}", $resize->__toString());

    }

    /**
     * @param Model $type
     * @param ApplicationFile $image
     * @param Int $key
     * @return mixed|void
     */
    private function saveImage($type, ApplicationFile $image, $key): void
    {
        $dbFile = new FileModel(
            [
                "type" => $type == "images" ? "image" : $type,
                "name" => $image->getName(),
                "original_name" => $image->getOriginalName(),
                "extension" => $image->getExtension(),
                "size" => $image->getSize(),
                "height" => $image->getHeight(),
                "width" => $image->getWidth(),
                'position' => $key
            ]
        );
        $dbFile->save();
        $image->setId($dbFile->id);
        $image->setCreatedAt($dbFile->created_at);
        $image->setUpdatedAt($dbFile->updated_at);
    }

    /**
     * @param $type
     * @param \Illuminate\Http\UploadedFile $file
     * @return ApplicationFile
     */
    private function saveToDisk(
        $type,
        \Illuminate\Http\UploadedFile $file,
        $width = null, $height = null
    ): ApplicationFile
    {
        if ($file->isValid()) {
            $id = uniqid(true);
            if ($width > 0 && $height > 0) {
                $this->resizeImage($file, $type, $id, $file->extension(), $width, $height);
            } else {
                $file->storeAs("public/{$type}", "{$id}.{$file->extension()}");
            }
            $newFile = new ApplicationFile();
            $newFile->setType($type);
            $newFile->setName($id);
            $newFile->setOriginalName($file->getClientOriginalName());
            $newFile->setExtension($file->extension());
            $newFile->setSize($file->getSize());
            if ($type != 'pdf') {
                $imagedetails = getimagesize($file->path());
                $width = $imagedetails[0];
                $height = $imagedetails[1];
                $newFile->setWidth($width);
                $newFile->setHeight($height);
            } else {
                $newFile->setHeight(0);
                $newFile->setWidth(0);
            }
        }
        return $newFile;
    }
}
