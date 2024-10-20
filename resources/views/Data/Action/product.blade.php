<!--- action link & script --->
<x-action-script />


<div class="container mt-5">
    <div class="dropdown text-center" style="margin-top: -38px">
        <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-ellipsis-h"></i>
        </button>
        <ul class="dropdown-menu">
            <!-- view -->
            <li>
                <x-href :type="'primary'" :class="'dropdown-item'" :href="route('product.show', $id)" :icon="'eye'" :action="'view'" />
            </li>
            <!-- add -->
            <li>
                <x-form :action="'#'" :icon="'plus'" :type="'success'" :action="'add'" />
            </li>
            <!-- edit -->
            <li>
                <x-href :type="'warning'" :href="'#'" :icon="'edit'" :action="'edit'" />
            </li>
            <!-- delete -->
            <li>
                <x-form :action="'#'" :method="'DELETE'" :icon="'trash'" :type="'danger'"
                    :action="'delete'" />
            </li>
        </ul>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Prevent reinitialization
        if (!$.fn.DataTable.isDataTable('#product-table')) {
            var table = $('#product-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: '/product/table', // Ensure this route exists
                    type: 'GET', // Use 'POST' if your route expects POST
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content') // Include CSRF token if using POST
                    },
                    error: function(xhr, error, thrown) {
                        console.error("DataTables AJAX error:", xhr.status, xhr.responseText);
                        alert(
                            "An error occurred while fetching data. Please check the console for details."
                        );
                    }
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'supplier_id',
                        name: 'supplier.name'
                    },
                    {
                        data: 'store_id',
                        name: 'store.name'
                    },
                    {
                        data: 'code',
                        name: 'code'
                    },
                    {
                        data: 'quantity',
                        name: 'quantity'
                    },
                    {
                        data: 'expire_date',
                        name: 'expire_date'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, 'All']
                ],
                pagingType: 'full_numbers',
                pageLength: 10,
                drawCallback: function(settings) {
                    // Re-initialize any JavaScript plugins or components if needed
                }
            });
        }

        // Event delegation for action buttons
        $('#product-table').on('click', '.dropdown-menu li a, .dropdown-menu li button', function(e) {
            e.preventDefault();
            var action = $(this).data('action') || $(this).attr('class').split(' ')[0];
            var id = $(this).closest('tr').attr('id');

            switch (action) {
                case 'view':
                    window.location.href = `/product/show/${id}`;
                    break;
                case 'edit':
                    window.location.href = `/product/edit/${id}`;
                    break;
                case 'delete':
                    if (confirm('Are you sure you want to delete this product?')) {
                        // Submit the delete form
                        $(this).closest('form').submit();
                    }
                    break;
                    // Add more cases as needed
            }
        });

        // Handle delete confirmations
        $('#product-table').on('submit', '.delete-form', function(e) {
            e.preventDefault();
            var form = this;

            if (confirm('Are you sure you want to delete this product?')) {
                form.submit();
            }
        });
    });
</script>
