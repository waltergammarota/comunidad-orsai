<?php


namespace App\Repositories;


class GenericRepository
{
    protected function mapDBToClass($model, $object)
    {
        $newObject = clone $object;
        $newObject->setId($model->id);
        $newObject->setCreatedAt($model->created_at);
        $newObject->setUpdatedAt($model->updated_at);
        return $newObject;
    }

    protected function saveToDB(Model $model, $object)
    {
        if ($object->getId() != null && $object->getId() > 0) {
            $model->id = $object->getId();
            $model->exists = true;
        }
        $model->save();
        return $this->mapDBToClass($model, $object);

    }

}
