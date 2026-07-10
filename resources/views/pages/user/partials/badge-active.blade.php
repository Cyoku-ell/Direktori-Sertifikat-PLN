<button
    class="toggleActive
    px-3 py-1 rounded-full text-xs font-semibold transition
    {{ $user->is_active
        ? 'bg-green-100 text-green-700 hover:bg-green-200'
        : 'bg-red-100 text-red-700 hover:bg-red-200' }}"
    data-id="{{ $user->id }}">

    <i class="fa-solid {{ $user->is_active ? 'fa-circle-check' : 'fa-circle-xmark' }} mr-1"></i>

    {{ $user->is_active ? 'Active' : 'Inactive' }}

</button>
