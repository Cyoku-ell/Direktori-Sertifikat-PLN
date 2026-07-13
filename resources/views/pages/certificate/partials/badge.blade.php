@php

    use Carbon\Carbon;

    if (!$row->expired_at) {
        $text = 'Tidak Ada Expired';

        $class = 'bg-gray-100 text-gray-700';
    } else {
        $today = Carbon::today();

        $expired = Carbon::parse($row->expired_at);

        if ($expired->isPast()) {
            $text = 'Expired';

            $class = 'bg-red-100 text-red-700';
        } elseif ($today->diffInDays($expired) <= 90) {
            $text = 'Segera Expired';

            $class = 'bg-yellow-100 text-yellow-700';
        } else {
            $text = 'Aktif';

            $class = 'bg-green-100 text-green-700';
        }
    }

@endphp

<span class="px-3 py-1 rounded-full text-xs font-semibold {{ $class }}">

    {{ $text }}

</span>
