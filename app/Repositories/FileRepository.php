<?php


namespace App\Repositories;

use App\Classes\ApplicationFile;
use App\Databases\FileModel;
use Illuminate\Http\Request;

class FileRepository extends GenericRepository
{
    public function getUploadedFiles($type, Request $request = null)
    {
        $images = [];
        if ($request->hasFile($type)) {
            $files = $request->file($type);
            foreach ($files as $file) {
                $image = $this->saveToDisk($type, $file);
                $this->saveImage($type, $image);
                array_push($images, $image);
            }
        }
        return $images;
    }

    /**
     * @param Model $type
     * @param ApplicationFile $image
     * @return mixed|void
     */
    private function saveImage($type, ApplicationFile $image): void
    {
        $dbFile = new FileModel(
            [
                "type" => $type == "images" ? "image" : $type,
                "name" => $image->getName(),
                "original_name" => $image->getOriginalName(),
                "extension" => $image->getExtension(),
                "size" => $image->getSize(),
                "height" => $image->getHeight(),
                "width" => $image->getWidth()
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
        \Illuminate\Http\UploadedFile $file
    ): ApplicationFile {
        if ($file->isValid()) {
            $id = uniqid(true);
            $file->storeAs("public/{$type}", "{$id}.{$file->extension()}");
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
