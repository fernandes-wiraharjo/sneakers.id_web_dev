<?php

namespace Modules\TopTextCarousel\Repositories;

use Modules\TopTextCarousel\Entities\TopTextCarousel;

class TopTextCarouselRepository
{
    public function __construct(TopTextCarousel $model)
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
     * Get active items for frontend carousel (used in resources/views/bootstrap/parts/top-text-carousel.blade.php).
     */
    public function getActiveTopTextCarousel()
    {
        return $this->model->where('is_active', true)->orderBy('sort_order')->orderBy('id')->get();
    }
}
