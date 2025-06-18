@if ($bahans->hasPages())
    <div class="pagination-container">
        {{ $bahans->appends(request()->input())->links() }}
    </div>
@endif