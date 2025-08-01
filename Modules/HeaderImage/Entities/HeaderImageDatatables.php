<?php

  namespace Modules\HeaderImage\Entities;

  use App\Models\Model;
  use Hexters\Ladmin\Datatables\Datatables;
  use Hexters\Ladmin\Contracts\DataTablesInterface;

  class HeaderImageDatatables extends Datatables implements DataTablesInterface {

    /**
     * Datatables function
     */
    public function render() {

      /**
       * Data from controller
       */
      $data = self::$data;

      return $this->eloquent(Model::query())
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
        'fields' => [ __('ID'), ], // Table header
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
              ['data' => 'id', 'class' => 'text-center'],
          ]
        ]
      ];

    }

  }
