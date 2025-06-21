@if ($stocks->hasPages())
    <div class="pagination-container">
        {{ $stocks->appends(request()->input())->links() }}
    </div>
@endif