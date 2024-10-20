<?php

namespace App\DataTables;

use App\Models\Salebill;
use App\Traits\LanguageTrait;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Html\Editor\Editor;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;

class SalebillDataTable extends DataTable
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
            ->addColumn('action', 'salebill.action')
            ->setRowId('id')
            ->editColumn('store_id', function ($row): mixed {
                return $row->store->name;
            })
            ->editColumn('product_id', function ($row): mixed {
                return $row->product->name;
            })
            ->editColumn('user_id', function ($row): mixed {
                return $row->user->name;
            })->editColumn('action', function ($row) {
                return view('Data.Action.salebill', ['id' => $row->id])->render();
            });

    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Salebill $model): QueryBuilder
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
            ->setTableId('salebill-table')
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
            Column::make('store_id')
                ->title(__('gadwalls.namestore')),
            Column::make('product_id')
                ->title(__('gadwalls.nameproduct')),
            Column::make('user_id')
                ->title(__('gadwalls.nameuser')),
            Column::make('notes')
                ->title(__('gadwalls.notes')),
            Column::make('quantity')
                ->title(__('gadwalls.quantity')),
            Column::computed('action')->exportable(false)->printable(false)->width(60)->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Salebill_' . date('YmdHis');
    }
}
