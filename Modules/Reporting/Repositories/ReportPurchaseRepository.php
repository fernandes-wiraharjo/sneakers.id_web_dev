<?php

namespace Modules\Reporting\Repositories;

use Modules\Reporting\Entities\ReportPurchase;
use Modules\Reporting\Entities\ReportPurchaseHistory;

class ReportPurchaseRepository
{
    public function __construct(ReportPurchase $model, ReportPurchaseHistory $historyModel)
    {
        $this->model = $model;
        $this->historyModel = $historyModel;
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
        $dataBefore = $item->toArray();
        $item->update($data);
        $dataAfter = $item->fresh()->toArray();
        $this->historyModel->create([
            'report_purchase_id' => $item->id,
            'data_before' => $dataBefore,
            'data_after' => $dataAfter,
            'updated_by' => auth()->check() ? (auth()->user()->name ?? (string) auth()->id()) : null,
        ]);
        return $item;
    }

    public function delete($id)
    {
        $this->historyModel->where('report_purchase_id', $id)->delete();
        $item = $this->model->findOrFail($id);
        return $item->delete();
    }

    public function newQuery()
    {
        return $this->model->newQuery();
    }
}
