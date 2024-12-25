@extends('admin.layout.app')

@section('content')
<div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
    <!-- Breadcrumb Start -->
    <div class="mb-6 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <h2 class="text-title-md2 font-bold text-black dark:text-white add-heading">
        Add User
        </h2>

        <nav>
        <ol class="flex items-center gap-2">
            <li>
                <a class="font-medium" href="{{ route('dashboard') }}">Dashboard /</a>
            </li>
            <li class="font-medium text-primary add-heading">Add User</li>
        </ol>
        </nav>
    </div>
    <!-- Breadcrumb End -->

   <!-- User Form -->
   <div class="bg-white rounded-md shadow-md border border-stroke p-6 dark:bg-boxdark dark:border-strokedark">
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- User Name -->
            <div>
                <label for="name" class="block text-sm font-medium text-black dark:text-white mb-2">
                    User Name <span class="text-red-500">*</span>
                </label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
                    placeholder="Enter the user's name"
                    class="w-full rounded border border-gray-300 px-4 py-2 text-sm text-black dark:border-strokedark dark:bg-form-input dark:text-white focus:outline-none focus:ring-2 focus:ring-primary"
                    required
                />
            </div>
            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-black dark:text-white mb-2">
                    Email Address <span class="text-red-500">*</span>
                </label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="Enter the user's email"
                    class="w-full rounded border border-gray-300 px-4 py-2 text-sm text-black dark:border-strokedark dark:bg-form-input dark:text-white focus:outline-none focus:ring-2 focus:ring-primary"
                    required
                />
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-black dark:text-white mb-2">
                    Password <span class="text-red-500">*</span>
                </label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Enter a secure password"
                    class="w-full rounded border border-gray-300 px-4 py-2 text-sm text-black dark:border-strokedark dark:bg-form-input dark:text-white focus:outline-none focus:ring-2 focus:ring-primary"
                    required
                />
            </div>

            <!-- Role Selection -->
            <div>
                <label for="role" class="block text-sm font-medium text-black dark:text-white mb-2">
                    Role <span class="text-red-500">*</span>
                </label>
                <select
                    id="role"
                    name="role"
                    class="w-full rounded border border-gray-300 px-4 py-2 text-sm text-black dark:border-strokedark dark:bg-form-input dark:text-white focus:outline-none focus:ring-2 focus:ring-primary"
                    required
                    onchange="togglePermissions()"
                >
                    <option value="">Select a Role</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}" {{ old('role') == $role->id ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Phone -->
            <div>
                <label for="phone" class="block text-sm font-medium text-black dark:text-white mb-2">
                    Phone
                </label>
                <input
                    type="text"
                    id="phone"
                    name="phone"
                    value="{{ old('phone') }}"
                    placeholder="Enter the user's phone number"
                    class="w-full rounded border border-gray-300 px-4 py-2 text-sm text-black dark:border-strokedark dark:bg-form-input dark:text-white focus:outline-none focus:ring-2 focus:ring-primary"
                />
            </div>
            <!-- Address -->
            <div>
                <label for="address" class="block text-sm font-medium text-black dark:text-white mb-2">
                    Address
                </label>
                <textarea
                    id="address"
                    name="address"
                    placeholder="Enter the user's address"
                    class="w-full rounded border border-gray-300 px-4 py-2 text-sm text-black dark:border-strokedark dark:bg-form-input dark:text-white focus:outline-none focus:ring-2 focus:ring-primary"
                >{{ old('address') }}</textarea>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <!-- Hour Rate -->
            <div>
                <label for="hourly_rate" class="block text-sm font-medium text-black dark:text-white mb-2">
                    Hour Rate <span class="text-red-500">*</span>
                </label>
                <input
                    type="number"
                    id="hourly_rate"
                    name="hourly_rate"
                    value="{{ old('hourly_rate', 0) }}"
                    placeholder="Enter the user's hourly rate"
                    class="w-full rounded border border-gray-300 px-4 py-2 text-sm text-black dark:border-strokedark dark:bg-form-input dark:text-white focus:outline-none focus:ring-2 focus:ring-primary"
                    required
                />
            </div>
            <!-- Balance -->
            <div>
                <label for="balance" class="block text-sm font-medium text-black dark:text-white mb-2">
                    Balance <span class="text-red-500">*</span>
                </label>
                <input
                    type="number"
                    id="balance"
                    name="balance"
                    value="{{ old('balance, 0') }}"
                    placeholder="Enter the user's balance"
                    class="w-full rounded border border-gray-300 px-4 py-2 text-sm text-black dark:border-strokedark dark:bg-form-input dark:text-white focus:outline-none focus:ring-2 focus:ring-primary"
                    required
                />
            </div>
        </div>


        <!-- Permissions Table -->
        <div id="permissions-section" class="mb-6 hidden">
            <label class="block text-sm font-medium text-black dark:text-white mb-4">
                Permissions (Optional)
            </label>
            <table class="w-full border-collapse border border-stroke dark:border-strokedark">
                <thead>
                    <tr>
                        <th class="border border-stroke px-4 py-2 text-left dark:border-strokedark">Feature</th>
                        <th class="border border-stroke px-4 py-2 text-center dark:border-strokedark">View</th>
                        <th class="border border-stroke px-4 py-2 text-center dark:border-strokedark">Create</th>
                        <th class="border border-stroke px-4 py-2 text-center dark:border-strokedark">Update</th>
                        <th class="border border-stroke px-4 py-2 text-center dark:border-strokedark">Delete</th>
                        <th class="border border-stroke px-4 py-2 text-center dark:border-strokedark">Full Access</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $entity => $entityPermissions)
                        <tr>
                            <td class="border border-stroke px-4 py-2 dark:border-strokedark capitalize">
                                {{ ucfirst($entity) }}
                            </td>
                            <td class="border border-stroke px-4 py-2 text-center dark:border-strokedark">
                                <input type="checkbox" name="permissions[{{ $entity }}.read]"
                                       value="{{ $entityPermissions->firstWhere('name', "{$entity}.read") ? '1' : '' }}">
                            </td>
                            <td class="border border-stroke px-4 py-2 text-center dark:border-strokedark">
                                <input type="checkbox" name="permissions[{{ $entity }}.create]"
                                       value="{{ $entityPermissions->firstWhere('name', "{$entity}.create") ? '1' : '' }}">
                            </td>
                            <td class="border border-stroke px-4 py-2 text-center dark:border-strokedark">
                                <input type="checkbox" name="permissions[{{ $entity }}.update]"
                                       value="{{ $entityPermissions->firstWhere('name', "{$entity}.update") ? '1' : '' }}">
                            </td>
                            <td class="border border-stroke px-4 py-2 text-center dark:border-strokedark">
                                <input type="checkbox" name="permissions[{{ $entity }}.delete]"
                                       value="{{ $entityPermissions->firstWhere('name', "{$entity}.delete") ? '1' : '' }}">
                            </td>
                            <td class="border border-stroke px-4 py-2 text-center dark:border-strokedark">
                                <input type="checkbox" name=""
                                       class="full-access-toggle"
                                       data-entity="{{ $entity }}">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


        <!-- Submit Button -->
        <div class="text-right">
            <button
                type="submit"
                class="px-6 py-2 rounded bg-primary text-white font-medium hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-primary focus:ring-opacity-50 btn-background"
            >
                Add User
            </button>
        </div>
    </form>
</div>
</div>


<script>
    function togglePermissions() {
        const roleSelect = document.getElementById('role');
        const permissionsSection = document.getElementById('permissions-section');

        // Assuming the role ID for "Manager" is known (e.g., '4')
        const managerRoleId = "{{ $roles->firstWhere('name', 'Manager')->id ?? '' }}";

        if (roleSelect.value === managerRoleId) {
            permissionsSection.classList.remove('hidden');
        } else {
            permissionsSection.classList.add('hidden');
        }
    }

    // Trigger the function on page load to handle old inputs
    document.addEventListener('DOMContentLoaded', togglePermissions);

        document.querySelectorAll('.full-access-toggle').forEach(fullCheckbox => {
        fullCheckbox.addEventListener('change', function () {
            const entity = this.dataset.entity;
            const readCheckbox = document.querySelector(`input[name="permissions[${entity}.read]"]`);
            const createCheckbox = document.querySelector(`input[name="permissions[${entity}.create]"]`);
            const updateCheckbox = document.querySelector(`input[name="permissions[${entity}.update]"]`);
            const deleteCheckbox = document.querySelector(`input[name="permissions[${entity}.delete]"]`);

            if (this.checked) {
                readCheckbox.checked = true;
                createCheckbox.checked = true;
                updateCheckbox.checked = true;
                deleteCheckbox.checked = true;
            } else {
                readCheckbox.checked = false;
                createCheckbox.checked = false;
                updateCheckbox.checked = false;
                deleteCheckbox.checked = false;
            }
        });
    });
</script>
@endsection
