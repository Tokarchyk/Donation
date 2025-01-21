<div>
    <a href="{{ route('donation.index', ['column' => $sortColumn, 'sort' => $sortDirection === 'asc' ? 'desc' : 'asc' ]) }}">
        @if($sortDirection !== 'desc')
            <i class="fa-solid fa-arrow-up"></i>
            @else
            <i class="fa-solid fa-arrow-down"></i>
        @endif
    </a>
</div>