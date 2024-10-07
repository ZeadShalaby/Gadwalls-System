<?php

namespace App\DataTables;

use App\Models\Store;
use App\Traits\LanguageTrait;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class StoreDataTable extends DataTable
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
            ->addColumn('action', 'store.action')
            ->setRowId('id')
            ->editColumn('supplier_id', function ($row): mixed {
                return $row->supplier->name;
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Store $model): QueryBuilder
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
            ->setTableId('store-table')
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
            Column::make('type')
                ->title(__('gadwalls.typeStore')),
            Column::make('supplier_id')
                ->title(__('gadwalls.namesupplier')),
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
        return 'Store_' . date('YmdHis');
    }
}
