@if ($alats->hasPages())
    <div class="pagination-container">
        {{ $alats->appends(request()->input())->links() }}
    </div>
@endif