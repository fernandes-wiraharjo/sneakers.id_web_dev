<?php

namespace Modules\Reporting\Repositories;

use Modules\Reporting\Entities\TransactionType;

class TransactionTypeRepository
{
    public function __construct(TransactionType $model)
    {
        $this->model = $model;
    }

    public function getById($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $item = $this->model->findOrFail($id);
        $item->update($data);
        return $item;
    }

    public function delete($id)
    {
        return $this->model->findOrFail($id)->delete();
    }

    public function newQuery()
    {
        return $this->model->newQuery();
    }

    /**
     * Get active types for dropdown (code => name or code).
     */
    public function getForDropdown()
    {
        return $this->model->where('is_active', true)->orderBy('code')->get();
    }

    /**
     * Get default code (first active, or 'WEB' if none).
     */
    public function getDefaultCode()
    {
        $first = $this->model->where('is_active', true)->orderBy('code')->value('code');
        return $first ?? 'WEB';
    }
}
