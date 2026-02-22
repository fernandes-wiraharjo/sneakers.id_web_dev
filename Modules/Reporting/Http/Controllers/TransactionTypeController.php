<?php

namespace Modules\Reporting\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Reporting\Entities\TransactionType;
use Modules\Reporting\Repositories\TransactionTypeRepository;
use Modules\Reporting\Entities\TransactionTypeDatatables;
use Hexters\Ladmin\Exceptions\LadminException;
use Alert;

class TransactionTypeController extends Controller
{
    protected $repository;

    public function __construct(TransactionTypeRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(TransactionTypeDatatables $dataTable)
    {
        ladmin()->allow('administrator.master-data.transaction-type.index');
        return $dataTable->render('reporting::transaction-type.index');
    }

    public function create()
    {
        ladmin()->allow('administrator.master-data.transaction-type.create');
        $data['transactionType'] = new TransactionType();
        return view('reporting::transaction-type.create', $data);
    }

    public function store(Request $request)
    {
        try {
            ladmin()->allow('administrator.master-data.transaction-type.create');
            $request->validate([
                'code' => 'required|string|max:64|unique:transaction_types,code',
                'name' => 'nullable|string|max:255',
                'is_active' => 'nullable|boolean',
            ]);
            $data = $request->only(['code', 'name', 'is_active']);
            $data['is_active'] = $request->boolean('is_active');
            $this->repository->create($data);
            Alert::success('Transaction Type created successfully!');
            return redirect()->route('administrator.master-data.transaction-type.index')
                ->with('success', 'Transaction Type created successfully!');
        } catch (LadminException $e) {
            Alert::error($e->getMessage());
            return redirect()->back()->withErrors([$e->getMessage()]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    public function edit($id)
    {
        ladmin()->allow('administrator.master-data.transaction-type.update');
        $data['transactionType'] = $this->repository->getById($id);
        return view('reporting::transaction-type.edit', $data);
    }

    public function update(Request $request, $id)
    {
        try {
            ladmin()->allow('administrator.master-data.transaction-type.update');
            $request->validate([
                'code' => 'required|string|max:64|unique:transaction_types,code,' . (int) $id,
                'name' => 'nullable|string|max:255',
                'is_active' => 'nullable|boolean',
            ]);
            $data = $request->only(['code', 'name', 'is_active']);
            $data['is_active'] = $request->boolean('is_active');
            $this->repository->update($id, $data);
            Alert::success('Transaction Type updated successfully!');
            return redirect()->route('administrator.master-data.transaction-type.index')
                ->with('success', 'Transaction Type updated successfully!');
        } catch (LadminException $e) {
            Alert::error($e->getMessage());
            return redirect()->back()->withErrors([$e->getMessage()]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            ladmin()->allow('administrator.master-data.transaction-type.destroy');
            $this->repository->delete($id);
            Alert::success('Transaction Type deleted successfully!');
            return redirect()->route('administrator.master-data.transaction-type.index')
                ->with('success', 'Transaction Type deleted successfully!');
        } catch (LadminException $e) {
            Alert::error($e->getMessage());
            return redirect()->back();
        }
    }
}
