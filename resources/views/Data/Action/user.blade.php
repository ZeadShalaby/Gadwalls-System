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
                <x-href :type="'primary'" :href="'#'" :icon="'eye'" />
            </li>
            <!-- add -->
            <li>
                <x-form :action="'#'" :icon="'plus'" :type="'success'" />
            </li>
            <!-- edit -->
            <li>
                <x-href :type="'warning'" :href="'#'" :icon="'edit'" />
            </li>
            <!-- delete -->
            <li>
                <x-form :action="'#'" :method="'DELETE'" :icon="'trash'" :type="'danger'" />
            </li>
        </ul>
    </div>
</div>
