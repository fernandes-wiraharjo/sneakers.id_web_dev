<?php

  namespace Modules\EcommerceLink\Entities;

  use Modules\EcommerceLink\Entities\EcommerceLink;
  use Hexters\Ladmin\Datatables\Datatables;
  use Hexters\Ladmin\Contracts\DataTablesInterface;

  class EcommerceLinkDatatables extends Datatables implements DataTablesInterface {

    /**
     * Datatables function
     */
    public function render() {

      /**
       * Data from controller
       */
      $data = self::$data;

      return $this->eloquent(EcommerceLink::query())
        ->addIndexColumn()
        ->addColumn('action', function($item) {
          return view('ladmin::table.action', [
            'show' => null,
            'edit' => [
              'gate' => 'administrator.master-data.ecommerce-link.update',
              'url' => route('administrator.master-data.ecommerce-link.edit', [$item->id, 'back' => request()->fullUrl()])
            ],
            'destroy' => [
              'gate' => 'administrator.master-data.ecommerce-link.destroy',
              'url' => route('administrator.master-data.ecommerce-link.destroy', [$item->id, 'back' => request()->fullUrl()]),
            ]
          ]);
        })
        ->escapeColumns([])
        ->make(true);
    }

    /**
     * Datatables Option
     */
    public function options() {

      /**
       * Data from controller
       */
      $data = self::$data;

      return [
        'title' => 'List Of Model',
        'buttons' => null, // e.g : view('user.actions.create')
        'fields' => [
            __('No'),
            __('ID'),
            __('Title'),
            __('Action')
          ], // Table header
        'foos' => [ // Custom data array. You can call in your blade with variable $foos
          'bar' => 'baz',
          'baz' => 'bar',
        ],
        /**
         * DataTables Options
         */
        'options' => [
            'processing' => true,
            'serverSide' => true,
            'ajax' => request()->fullurl(),
            'columns' => [
                ['data' => 'DT_RowIndex', 'name' => 'DT_RowIndex', 'orderable' => false, 'class' => 'datatables-number'],
                ['data' => 'id', 'class' => 'text-center datatables-id'],
                ['data' => 'ecommerce_title'],
                ['data' => 'action', 'class' => 'text-center datatables-action', 'orderable' => false],
            ]
          ]
      ];

    }

  }
