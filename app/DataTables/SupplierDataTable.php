<?php

namespace App\DataTables;

use App\Models\Supplier;
use App\Traits\LanguageTrait;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class SupplierDataTable extends DataTable
{
    use LanguageTrait;

    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'supplier.action')
            ->setRowId('id')
            ->editColumn('role', function ($row): mixed {
                return $row->getRoleName();
            })->editColumn('action', function ($row) {
                return view('Data.Action.supplier', ['id' => $row->id])->render();
            });

    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Supplier $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        $languageUrl = $this->getLanguageUrl();

        return $this->builder()
            ->setTableId('supplier-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ])
            ->parameters([
                'lengthChange' => true,
                'language' => [
                    'url' => $languageUrl,
                ],
                'responsive' => true,
                'autoWidth' => false,
                'pagingType' => 'simple_numbers',
                'lengthMenu' => [[15, 25, 50, -1], [15, 25, 50, 'الكل']],
                'order' => [[1, 'asc']],
                'buttons' => ['excel', 'csv', 'pdf', 'print', 'reset', 'reload'],
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [

            Column::make('id'),
            Column::make('name')
                ->title(__('gadwalls.namesapplier')),
            Column::make('email')
                ->title(__('gadwalls.email')),
            Column::make('role')
                ->title(__('gadwalls.role')),
            Column::make('tax')
                ->title(__('gadwalls.tax')),
            Column::make('address')
                ->title(__('gadwalls.address')),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),

        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Supplier_' . date('YmdHis');
    }
}
