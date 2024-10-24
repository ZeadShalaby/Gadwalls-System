<?php

namespace App\DataTables;

use Carbon\Carbon;
use App\Models\Product;
use App\Traits\LanguageTrait;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class ProductDataTable extends DataTable
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
            ->addColumn('action', 'product.action')
            ->setRowId('id')
            ->editColumn('supplier_id', function ($row): mixed {
                return $row->supplier->name;
            })
            ->editColumn('store_id', function ($row): mixed {
                return $row->store->name;
            })->editColumn('expire_date', function ($row): mixed {
                return $row->expire_date ? Carbon::parse($row->expire_date)->format('Y-m-d') : 'N/A';
            })->editColumn('action', function ($row) {
                return view('Data.Action.product', ['id' => $row->id])->render();
            });

    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
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
            ->setTableId('product-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip') // <"row"<"col-sm-6"l><"col-sm-6"f>>Brtip
            ->orderBy(1)
            ->responsive(true)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel')
                    ->className('btn btn-success')
                    ->filename($this->filename()),
                Button::make('csv')
                    ->className('btn btn-info')
                    ->filename($this->filename()),
                Button::make('pdf')
                    ->className('btn btn-danger')
                    ->filename($this->filename()),
                Button::make('print')
                    ->className('btn btn-primary')
                    ->filename($this->filename()),
                Button::make('reset')
                    ->className('btn btn-secondary'),
                Button::make('reload')
                    ->className('btn btn-dark'),
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
                'buttons' => ['excel', 'csv', 'pdf', 'print', 'reset', 'reload', 'import'], // Ensure import is listed
            ]);
    }


    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {

        return [
            Column::make('id')
                ->title('ID')
                ->width(50)
                ->className('text-center'),
            Column::make('name')
                ->title(__('gadwalls.nameproduct')),
            Column::make('supplier_id')
                ->title(__('gadwalls.supplier'))
                ->addClass('text-center'),
            Column::make('store_id')
                ->title(__('gadwalls.stores'))
                ->addClass('text-center'),
            Column::make('code')
                ->title(__('gadwalls.code')),
            Column::make('quantity')
                ->title(__('gadwalls.quantity'))
                ->addClass('text-center'),
            Column::make('expire_date')
                ->title(__('gadwalls.expire'))
                ->addClass('text-center'),
            Column::computed('action')->title(__('gadwalls.action'))->width(100)->addClass('text-center'),
        ];
    }


    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        $filename = 'product-table_' . date('YmdHis');
        Log::info("Generated filename: $filename"); // تسجيل اسم الملف في الـ Log
        return $filename;
    }
}
