@extends('admin.layout.app')

@section('content')
<div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
    <!-- Breadcrumb Start -->
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-title-md2 font-bold text-black dark:text-white add-heading">
        Add Boat
        </h2>

        <nav>
        <ol class="flex items-center gap-2">
            <li>
                <a class="font-medium" href="{{ route('dashboard') }}">Dashboard /</a>
            </li>
            <li class="font-medium text-primary add-heading">Add Boat</li>
        </ol>
        </nav>
    </div>
    <!-- Breadcrumb End -->

   <!-- User Form -->
   <div class="bg-white rounded-md shadow-md border border-stroke p-6 dark:bg-boxdark dark:border-strokedark">
    <form action="{{ route('customer_boats.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Boat Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-black dark:text-white mb-2">
                    Boat Name <span class="text-red-500">*</span>
                </label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Enter the boat's name"
                    class="w-full rounded border border-gray-300 px-4 py-2 text-sm text-black dark:border-strokedark dark:bg-form-input dark:text-white focus:outline-none focus:ring-2 focus:ring-primary"
                    required
                />
            </div>
            <!-- Customer Selection -->
            <div>
                <label for="user_id" class="block text-sm font-medium text-black dark:text-white mb-2">
                    Customer <span class="text-red-500">*</span>
                </label>
                <select
                    id="user_id"
                    name="user_id"
                    class="w-full rounded border border-gray-300 px-4 py-2 text-sm text-black dark:border-strokedark dark:bg-form-input dark:text-white focus:outline-none focus:ring-2 focus:ring-primary"
                    required
                >
                    <option value="">Select a Customer</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="text-right">
            <button
                type="submit"
                class="px-6 py-2 rounded bg-primary text-white font-medium hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-opacity-50 btn-background"
            >
                Add Boat
            </button>
        </div>
    </form>
</div>
</div>
@endsection
