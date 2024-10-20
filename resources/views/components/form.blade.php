<form action="{{ $action }}" method="POST">
    @csrf
    @if (isset($method))
        @method($method)
    @endif
    <button type="submit" class="dropdown-item text-{{ $type }}">
        <i class="fas fa-{{ $icon }}"></i>
    </button>
</form>
