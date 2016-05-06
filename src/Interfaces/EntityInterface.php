<?php

namespace Azure\Interfaces;

interface EntityInterface
{
    public function all();

    public function one($id);

    public function find($filters);

    public function create($entity);

    public function edit($entityId, $newEntity);

    public function delete($entityId);
}
