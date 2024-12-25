
      <!-- ===== Sidebar Start ===== -->
    <aside
      :class="sidebarToggle ? 'translate-x-0' : '-translate-x-full'"
      class="absolute left-0 top-0 z-9999 flex h-screen w-72.5 flex-col overflow-y-hidden bg-black duration-300 ease-linear dark:bg-boxdark lg:static lg:translate-x-0"
      @click.outside="sidebarToggle = false"
    >
      <!-- SIDEBAR HEADER -->
      <div class="flex items-center justify-between gap-2 px-6 py-5.5 lg:py-6.5">
        <a href="{{ route('dashboard') }}">
            <img src="{{ asset('assets/images/logo/logo-sidebar.png') }}" class="sidebar-logo" alt="Logo"/>
            {{-- <img src="{{ asset('assets/images/logo.webp') }}" class="m-auto" width="100px"> --}}
        </a>

          <button class="block lg:hidden" @click.stop="sidebarToggle = !sidebarToggle">
              <svg class="fill-current" width="20" height="18" viewBox="0 0 20 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path
                      d="M19 8.175H2.98748L9.36248 1.6875C9.69998 1.35 9.69998 0.825 9.36248 0.4875C9.02498 0.15 8.49998 0.15 8.16248 0.4875L0.399976 8.3625C0.0624756 8.7 0.0624756 9.225 0.399976 9.5625L8.16248 17.4375C8.31248 17.5875 8.53748 17.7 8.76248 17.7C8.98748 17.7 9.17498 17.625 9.36248 17.475C9.69998 17.1375 9.69998 16.6125 9.36248 16.275L3.02498 9.8625H19C19.45 9.8625 19.825 9.4875 19.825 9.0375C19.825 8.55 19.45 8.175 19 8.175Z"
                      fill=""
                  />
              </svg>
          </button>
      </div>
      <!-- SIDEBAR HEADER -->

      <div class="no-scrollbar flex flex-col overflow-y-auto duration-300 ease-linear">

        <!-- Sidebar Menu -->
        <nav class="mt-5 px-4 py-4 lg:mt-9 lg:px-6" x-data="{selected: $persist('Dashboard')}">
          <!-- Menu Group -->
          <div>
            <h3 class="mb-4 ml-4 text-sm font-medium text-bodydark2">MENU</h3>
            <ul class="mb-6 flex flex-col gap-1.5">
              <!-- Menu Item Dashbiard -->
              <li>
                {{-- add bg-graydark-important this class to active menu  --}}
                <a
                    class="group relative flex items-center gap-2.5 rounded-sm px-4 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                    href="{{ route('dashboard')  }}"
                    @click="selected = (selected === 'Dashboard' ? '':'Dashboard')"
                    :class="{ 'bg-graydark dark:bg-meta-4': (selected === 'Dashboard') && (page === 'dashboard') }"
                    :class="page === 'dashboard' && 'bg-graydark'"
                >
                <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path  d="M6.10322 0.956299H2.53135C1.5751 0.956299 0.787598 1.7438 0.787598 2.70005V6.27192C0.787598 7.22817 1.5751 8.01567 2.53135 8.01567H6.10322C7.05947 8.01567 7.84697 7.22817 7.84697 6.27192V2.72817C7.8751 1.7438 7.0876 0.956299 6.10322 0.956299ZM6.60947 6.30005C6.60947 6.5813 6.38447 6.8063 6.10322 6.8063H2.53135C2.2501 6.8063 2.0251 6.5813 2.0251 6.30005V2.72817C2.0251 2.44692 2.2501 2.22192 2.53135 2.22192H6.10322C6.38447 2.22192 6.60947 2.44692 6.60947 2.72817V6.30005Z" fill=""/>
                  <path d="M15.4689 0.956299H11.8971C10.9408 0.956299 10.1533 1.7438 10.1533 2.70005V6.27192C10.1533 7.22817 10.9408 8.01567 11.8971 8.01567H15.4689C16.4252 8.01567 17.2127 7.22817 17.2127 6.27192V2.72817C17.2127 1.7438 16.4252 0.956299 15.4689 0.956299ZM15.9752 6.30005C15.9752 6.5813 15.7502 6.8063 15.4689 6.8063H11.8971C11.6158 6.8063 11.3908 6.5813 11.3908 6.30005V2.72817C11.3908 2.44692 11.6158 2.22192 11.8971 2.22192H15.4689C15.7502 2.22192 15.9752 2.44692 15.9752 2.72817V6.30005Z" fill=""/>
                  <path d="M6.10322 9.92822H2.53135C1.5751 9.92822 0.787598 10.7157 0.787598 11.672V15.2438C0.787598 16.2001 1.5751 16.9876 2.53135 16.9876H6.10322C7.05947 16.9876 7.84697 16.2001 7.84697 15.2438V11.7001C7.8751 10.7157 7.0876 9.92822 6.10322 9.92822ZM6.60947 15.272C6.60947 15.5532 6.38447 15.7782 6.10322 15.7782H2.53135C2.2501 15.7782 2.0251 15.5532 2.0251 15.272V11.7001C2.0251 11.4188 2.2501 11.1938 2.53135 11.1938H6.10322C6.38447 11.1938 6.60947 11.4188 6.60947 11.7001V15.272Z" fill=""/>
                  <path d="M15.4689 9.92822H11.8971C10.9408 9.92822 10.1533 10.7157 10.1533 11.672V15.2438C10.1533 16.2001 10.9408 16.9876 11.8971 16.9876H15.4689C16.4252 16.9876 17.2127 16.2001 17.2127 15.2438V11.7001C17.2127 10.7157 16.4252 9.92822 15.4689 9.92822ZM15.9752 15.272C15.9752 15.5532 15.7502 15.7782 15.4689 15.7782H11.8971C11.6158 15.7782 11.3908 15.5532 11.3908 15.272V11.7001C11.3908 11.4188 11.6158 11.1938 11.8971 11.1938H15.4689C15.7502 11.1938 15.9752 11.4188 15.9752 11.7001V15.272Z" fill=""/>
                </svg>
                  Dashboard
                </a>
              </li>
              <!-- Menu Item Dashbiard -->
            </ul>
            @if (!auth()->user()->hasRole(['Worker', 'Manager']))

                <h3 class="mb-4 ml-4 text-sm font-medium text-bodydark2">Financial Transaction</h3>
                <ul class="mb-6 flex flex-col gap-1.5">
                    <!-- Menu Item Financial Transaction -->
                    <li>
                        <button
                            class="group relative flex w-full items-center justify-between gap-2.5 rounded-sm px-4 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                            @click="selected = (selected === 'Financials' ? '' : 'Financials')"
                            :class="{ 'bg-graydark dark:bg-meta-4': selected === 'Financials' }"
                        >
                            <div class="flex items-center gap-2.5">
                                <!-- Financial Transaction Icon -->
                                <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <!-- Arrow representing financial movement -->
                                    <path d="M9 3V15M3 9L9 3L15 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>

                                    <!-- Dollar symbol representing money -->
                                    <path d="M6 6H12M6 12H12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M8 3V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Financial Transaction
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down transform transition-transform duration-300" :class="{ 'rotate-180': selected === 'Financials' }" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                            </svg>
                        </button>
                        <ul x-show="selected === 'Financials'" class="mt-1 ml-4 flex flex-col gap-1.5" x-transition>
                            @if (auth()->user()->hasRole(['Admin', 'Manager']))
                                <li>
                                    <a href="{{route('financials.create')}}" class="flex items-center gap-2.5 rounded-sm px-4 py-2 text-sm font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4">
                                        Add Transaction
                                    </a>
                                </li>
                            @endif
                            <li>
                                <a href="{{route('financials.index')}}" class="flex items-center gap-2.5 rounded-sm px-4 py-2 text-sm font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4">
                                    View Transactions
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>

                <h3 class="mb-4 ml-4 text-sm font-medium text-bodydark2">Invoice</h3>
                <ul class="mb-6 flex flex-col gap-1.5">
                    <!-- Menu Item Invoice -->
                    <li>
                        <button
                            class="group relative flex w-full items-center justify-between gap-2.5 rounded-sm px-4 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                            @click="selected = (selected === 'Invoices' ? '' : 'Invoices')"
                            :class="{ 'bg-graydark dark:bg-meta-4': selected === 'Invoices' }"
                        >
                            <div class="flex items-center gap-2.5">
                                <!-- Invoice Icon -->
                                <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3 1H15C15.553 1 16 1.447 16 2V16C16 16.553 15.553 17 15 17H3C2.447 17 2 16.553 2 16V2C2 1.447 2.447 1 3 1Z" stroke="currentColor" stroke-width="2"/>
                                    <path d="M3 3H15V15H3V3Z" stroke="currentColor" stroke-width="2"/>
                                    <path d="M6 6H12" stroke="currentColor" stroke-width="2"/>
                                    <path d="M6 9H12" stroke="currentColor" stroke-width="2"/>
                                    <path d="M6 12H9" stroke="currentColor" stroke-width="2"/>
                                </svg>
                                Invoice
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down transform transition-transform duration-300" :class="{ 'rotate-180': selected === 'Invoices' }" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                            </svg>
                        </button>
                        <ul x-show="selected === 'Invoices'" class="mt-1 ml-4 flex flex-col gap-1.5" x-transition>

                            @if (auth()->user()->hasRole(['Admin', 'Manager']))
                                <li>
                                    <a href="{{route('invoices.create')}}" class="flex items-center gap-2.5 rounded-sm px-4 py-2 text-sm font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4">
                                        Add Invoice
                                    </a>
                                </li>
                            @endif
                            <li>
                                <a href="{{route('invoices.index')}}" class="flex items-center gap-2.5 rounded-sm px-4 py-2 text-sm font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4">
                                    View Invoices
                                </a>
                            </li>
                        </ul>
                    </li>

                </ul>

                <h3 class="mb-4 ml-4 text-sm font-medium text-bodydark2">Task</h3>
                <ul class="mb-6 flex flex-col gap-1.5">
                    <!-- Menu Item Task Management -->
                    <li>
                        <button
                            class="group relative flex w-full items-center justify-between gap-2.5 rounded-sm px-4 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                            @click="selected = (selected === 'Tasks' ? '' : 'Tasks')"
                            :class="{ 'bg-graydark dark:bg-meta-4': selected === 'Tasks' }"
                        >
                            <div class="flex items-center gap-2.5">
                                <!-- Task Management Icon -->
                                <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_130_9728)">
                                        <path
                                            d="M3.45928 0.984375H1.6874C1.04053 0.984375 0.478027 1.51875 0.478027 2.19375V3.96563C0.478027 4.6125 1.0124 5.175 1.6874 5.175H3.45928C4.10615 5.175 4.66865 4.64063 4.66865 3.96563V2.16562C4.64053 1.51875 4.10615 0.984375 3.45928 0.984375ZM3.3749 3.88125H1.77178V2.25H3.3749V3.88125Z"
                                        />
                                        <path
                                            d="M7.22793 3.71245H16.8748C17.2123 3.71245 17.5217 3.4312 17.5217 3.06558C17.5217 2.69995 17.2404 2.4187 16.8748 2.4187H7.22793C6.89043 2.4187 6.58105 2.69995 6.58105 3.06558C6.58105 3.4312 6.89043 3.71245 7.22793 3.71245Z"
                                        />
                                        <path
                                            d="M3.45928 6.75H1.6874C1.04053 6.75 0.478027 7.28437 0.478027 7.95937V9.73125C0.478027 10.3781 1.0124 10.9406 1.6874 10.9406H3.45928C4.10615 10.9406 4.66865 10.4062 4.66865 9.73125V7.95937C4.64053 7.28437 4.10615 6.75 3.45928 6.75ZM3.3749 9.64687H1.77178V8.01562H3.3749V9.64687Z"
                                        />
                                        <path
                                            d="M16.8748 8.21252H7.22793C6.89043 8.21252 6.58105 8.49377 6.58105 8.8594C6.58105 9.22502 6.86231 9.47815 7.22793 9.47815H16.8748C17.2123 9.47815 17.5217 9.1969 17.5217 8.8594C17.5217 8.5219 17.2123 8.21252 16.8748 8.21252Z"
                                        />
                                        <path
                                            d="M3.45928 12.8531H1.6874C1.04053 12.8531 0.478027 13.3875 0.478027 14.0625V15.8344C0.478027 16.4813 1.0124 17.0438 1.6874 17.0438H3.45928C4.10615 17.0438 4.66865 16.5094 4.66865 15.8344V14.0625C4.64053 13.3875 4.10615 12.8531 3.45928 12.8531ZM3.3749 15.75H1.77178V14.1188H3.3749V15.75Z"
                                        />
                                        <path
                                            d="M16.8748 14.2875H7.22793C6.89043 14.2875 6.58105 14.5687 6.58105 14.9344C6.58105 15.3 6.86231 15.5812 7.22793 15.5812H16.8748C17.2123 15.5812 17.5217 15.3 17.5217 14.9344C17.5217 14.5687 17.2123 14.2875 16.8748 14.2875Z"
                                        />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_130_9728">
                                            <rect width="18" height="18" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                                Task Management
                            </div>
                            <!-- Animated Dropdown Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down transform transition-transform duration-300" :class="{ 'rotate-180': selected === 'Tasks' }" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                            </svg>
                        </button>

                        <!-- Sub-menu for Task Management -->
                        <ul x-show="selected === 'Tasks'" class="mt-1 ml-4 flex flex-col gap-1.5"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform scale-90"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-90"
                        >
                            @if (auth()->user()->hasRole(['Admin', 'Manager']))
                                <li>
                                    <a href="{{route('tasks.create')}}" class="flex items-center gap-2.5 rounded-sm px-4 py-2 text-sm font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4">
                                        Add Task
                                    </a>
                                </li>
                            @endif
                            <li>
                                <a href="{{route('tasks.index')}}" class="flex items-center gap-2.5 rounded-sm px-4 py-2 text-sm font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4">
                                    View Tasks
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- Menu Item Task Management -->
                </ul>


                @if (auth()->user()->hasRole('Admin'))
                    <h3 class="mb-4 ml-4 text-sm font-medium text-bodydark2">User</h3>
                    <ul class="mb-6 flex flex-col gap-1.5">
                        <!-- Main Menu: Users -->
                        <li>
                            <button
                                class="group relative flex w-full items-center justify-between gap-2.5 rounded-sm px-4 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                                @click="selected = (selected === 'Users' ? '' : 'Users')"
                                :class="{ 'bg-graydark dark:bg-meta-4': selected === 'Users' }"
                            >
                            <div class="flex items-center gap-2.5">
                                <!-- User Icon -->
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="18"
                                    height="18"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="feather feather-users"
                                >
                                <circle cx="9" cy="7" r="4" />
                                <path d="M17 11c0 2.21-1.79 4-4 4s-4-1.79-4-4" />
                                <path d="M21 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2" />
                                <circle cx="17" cy="7" r="3" />
                                <path d="M20.5 21v-2a3.5 3.5 0 0 0-3.5-3.5H7A3.5 3.5 0 0 0 3.5 19v2" />
                                </svg>
                                Users
                            </div>
                            <!-- Animated Dropdown Icon -->
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="16"
                                height="16"
                                fill="currentColor"
                                class="bi bi-chevron-down transform transition-transform duration-300"
                                :class="{ 'rotate-180': selected === 'Users' }"
                                viewBox="0 0 16 16"
                            >
                                <path
                                fill-rule="evenodd"
                                d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"
                                />
                            </svg>
                            </button>

                            <!-- Sub-menu for Users -->
                            <ul
                                x-show="selected === 'Users'"
                                class="mt-1 ml-4 flex flex-col gap-1.5"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 transform scale-90"
                                x-transition:enter-end="opacity-100 transform scale-100"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100 transform scale-100"
                                x-transition:leave-end="opacity-0 transform scale-90"
                            >
                                <li>
                                    <a
                                        href="{{ route('users.create') }}"
                                        class="flex items-center gap-2.5 rounded-sm px-4 py-2 text-sm font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                                    >
                                        Add User
                                    </a>
                                </li>
                                <li>
                                    <a
                                        href="{{ route('users.index') }}"
                                        class="flex items-center gap-2.5 rounded-sm px-4 py-2 text-sm font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                                    >
                                        View Users
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>

                @endif

                <h3 class="mb-4 ml-4 text-sm font-medium text-bodydark2">Customer Boat</h3>
                <ul class="mb-6 flex flex-col gap-1.5">
                    <!-- Menu Item Customers -->
                    <li>
                        <button
                            class="group relative flex w-full items-center justify-between gap-2.5 rounded-sm px-4 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                            @click="selected = (selected === 'CustomerBoats' ? '' : 'CustomerBoats')"
                            :class="{ 'bg-graydark dark:bg-meta-4': selected === 'CustomerBoats' }"
                        >
                            <div class="flex items-center gap-2.5">
                                <!-- Customer Boats Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-boat">
                                    <path d="M3 13l3 3h12l3-3M5 10h14v3H5z" />
                                    <path d="M12 5v5" />
                                </svg>
                                Customer Boats
                            </div>
                            <!-- Animated Dropdown Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down transform transition-transform duration-300" :class="{ 'rotate-180': selected === 'CustomerBoats' }" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                            </svg>
                        </button>

                        <!-- Sub-menu for Customer Boats -->
                        <ul x-show="selected === 'CustomerBoats'" class="mt-1 ml-4 flex flex-col gap-1.5"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform scale-90"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-90"
                        >
                            <li>
                                <a href="{{ route('customer_boats.create') }}" class="flex items-center gap-2.5 rounded-sm px-4 py-2 text-sm font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4">
                                    Add Customer Boat
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('customer_boats.index') }}" class="flex items-center gap-2.5 rounded-sm px-4 py-2 text-sm font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4">
                                    View Customer Boats
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- Menu Item Customers -->

                </ul>
            @endif
            @if (auth()->user()->hasRole('Manager'))
                @canAny(['financial_transaction.create', 'financial_transaction.read'])
                    <h3 class="mb-4 ml-4 text-sm font-medium text-bodydark2">Financial Transaction</h3>
                    <ul class="mb-6 flex flex-col gap-1.5">
                        <!-- Menu Item Financial Transaction -->
                        <li>
                            <button
                                class="group relative flex w-full items-center justify-between gap-2.5 rounded-sm px-4 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                                @click="selected = (selected === 'Financials' ? '' : 'Financials')"
                                :class="{ 'bg-graydark dark:bg-meta-4': selected === 'Financials' }"
                            >
                                <div class="flex items-center gap-2.5">
                                    <!-- Financial Transaction Icon -->
                                    <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <!-- Arrow representing financial movement -->
                                        <path d="M9 3V15M3 9L9 3L15 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>

                                        <!-- Dollar symbol representing money -->
                                        <path d="M6 6H12M6 12H12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        <path d="M8 3V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                    Financial Transaction
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down transform transition-transform duration-300" :class="{ 'rotate-180': selected === 'Financials' }" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                                </svg>
                            </button>
                            <ul x-show="selected === 'Financials'" class="mt-1 ml-4 flex flex-col gap-1.5" x-transition>

                                @can('financial_transaction.create')
                                    <li>
                                        <a href="{{route('financials.create')}}" class="flex items-center gap-2.5 rounded-sm px-4 py-2 text-sm font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4">
                                            Add Transaction
                                        </a>
                                    </li>
                                @endcan
                                @can('financial_transaction.read')
                                    <li>
                                        <a href="{{route('financials.index')}}" class="flex items-center gap-2.5 rounded-sm px-4 py-2 text-sm font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4">
                                            View Transactions
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    </ul>
                @endcanAny

                @canAny(['invoice.create', 'invoice.read'])
                    <h3 class="mb-4 ml-4 text-sm font-medium text-bodydark2">Invoice</h3>
                    <ul class="mb-6 flex flex-col gap-1.5">
                        <!-- Menu Item Invoice -->
                        <li>
                            <button
                                class="group relative flex w-full items-center justify-between gap-2.5 rounded-sm px-4 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                                @click="selected = (selected === 'Invoices' ? '' : 'Invoices')"
                                :class="{ 'bg-graydark dark:bg-meta-4': selected === 'Invoices' }"
                            >
                                <div class="flex items-center gap-2.5">
                                    <!-- Invoice Icon -->
                                    <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M3 1H15C15.553 1 16 1.447 16 2V16C16 16.553 15.553 17 15 17H3C2.447 17 2 16.553 2 16V2C2 1.447 2.447 1 3 1Z" stroke="currentColor" stroke-width="2"/>
                                        <path d="M3 3H15V15H3V3Z" stroke="currentColor" stroke-width="2"/>
                                        <path d="M6 6H12" stroke="currentColor" stroke-width="2"/>
                                        <path d="M6 9H12" stroke="currentColor" stroke-width="2"/>
                                        <path d="M6 12H9" stroke="currentColor" stroke-width="2"/>
                                    </svg>
                                    Invoice
                                </div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down transform transition-transform duration-300" :class="{ 'rotate-180': selected === 'Invoices' }" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                                </svg>
                            </button>
                            <ul x-show="selected === 'Invoices'" class="mt-1 ml-4 flex flex-col gap-1.5" x-transition>

                                @can('invoice.create')
                                    <li>
                                        <a href="{{route('invoices.create')}}" class="flex items-center gap-2.5 rounded-sm px-4 py-2 text-sm font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4">
                                            Add Invoice
                                        </a>
                                    </li>
                                @endcan
                                @can('invoice.read')
                                    <li>
                                        <a href="{{route('invoices.index')}}" class="flex items-center gap-2.5 rounded-sm px-4 py-2 text-sm font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4">
                                            View Invoices
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>

                    </ul>
                @endcanAny

                @canAny(['task.create', 'task.read'])
                    <h3 class="mb-4 ml-4 text-sm font-medium text-bodydark2">Task</h3>
                    <ul class="mb-6 flex flex-col gap-1.5">
                        <!-- Menu Item Task Management -->
                        <li>
                            <button
                                class="group relative flex w-full items-center justify-between gap-2.5 rounded-sm px-4 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                                @click="selected = (selected === 'Tasks' ? '' : 'Tasks')"
                                :class="{ 'bg-graydark dark:bg-meta-4': selected === 'Tasks' }"
                            >
                                <div class="flex items-center gap-2.5">
                                    <!-- Task Management Icon -->
                                    <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_130_9728)">
                                            <path
                                                d="M3.45928 0.984375H1.6874C1.04053 0.984375 0.478027 1.51875 0.478027 2.19375V3.96563C0.478027 4.6125 1.0124 5.175 1.6874 5.175H3.45928C4.10615 5.175 4.66865 4.64063 4.66865 3.96563V2.16562C4.64053 1.51875 4.10615 0.984375 3.45928 0.984375ZM3.3749 3.88125H1.77178V2.25H3.3749V3.88125Z"
                                            />
                                            <path
                                                d="M7.22793 3.71245H16.8748C17.2123 3.71245 17.5217 3.4312 17.5217 3.06558C17.5217 2.69995 17.2404 2.4187 16.8748 2.4187H7.22793C6.89043 2.4187 6.58105 2.69995 6.58105 3.06558C6.58105 3.4312 6.89043 3.71245 7.22793 3.71245Z"
                                            />
                                            <path
                                                d="M3.45928 6.75H1.6874C1.04053 6.75 0.478027 7.28437 0.478027 7.95937V9.73125C0.478027 10.3781 1.0124 10.9406 1.6874 10.9406H3.45928C4.10615 10.9406 4.66865 10.4062 4.66865 9.73125V7.95937C4.64053 7.28437 4.10615 6.75 3.45928 6.75ZM3.3749 9.64687H1.77178V8.01562H3.3749V9.64687Z"
                                            />
                                            <path
                                                d="M16.8748 8.21252H7.22793C6.89043 8.21252 6.58105 8.49377 6.58105 8.8594C6.58105 9.22502 6.86231 9.47815 7.22793 9.47815H16.8748C17.2123 9.47815 17.5217 9.1969 17.5217 8.8594C17.5217 8.5219 17.2123 8.21252 16.8748 8.21252Z"
                                            />
                                            <path
                                                d="M3.45928 12.8531H1.6874C1.04053 12.8531 0.478027 13.3875 0.478027 14.0625V15.8344C0.478027 16.4813 1.0124 17.0438 1.6874 17.0438H3.45928C4.10615 17.0438 4.66865 16.5094 4.66865 15.8344V14.0625C4.64053 13.3875 4.10615 12.8531 3.45928 12.8531ZM3.3749 15.75H1.77178V14.1188H3.3749V15.75Z"
                                            />
                                            <path
                                                d="M16.8748 14.2875H7.22793C6.89043 14.2875 6.58105 14.5687 6.58105 14.9344C6.58105 15.3 6.86231 15.5812 7.22793 15.5812H16.8748C17.2123 15.5812 17.5217 15.3 17.5217 14.9344C17.5217 14.5687 17.2123 14.2875 16.8748 14.2875Z"
                                            />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_130_9728">
                                                <rect width="18" height="18" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                    Task Management
                                </div>
                                <!-- Animated Dropdown Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down transform transition-transform duration-300" :class="{ 'rotate-180': selected === 'Tasks' }" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                                </svg>
                            </button>

                            <!-- Sub-menu for Task Management -->
                            <ul x-show="selected === 'Tasks'" class="mt-1 ml-4 flex flex-col gap-1.5"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 transform scale-90"
                                x-transition:enter-end="opacity-100 transform scale-100"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100 transform scale-100"
                                x-transition:leave-end="opacity-0 transform scale-90"
                            >
                                @can('task.create')
                                    <li>
                                        <a href="{{route('tasks.create')}}" class="flex items-center gap-2.5 rounded-sm px-4 py-2 text-sm font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4">
                                            Add Task
                                        </a>
                                    </li>
                                @endcan
                                @can('task.read')
                                    <li>
                                        <a href="{{route('tasks.index')}}" class="flex items-center gap-2.5 rounded-sm px-4 py-2 text-sm font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4">
                                            View Tasks
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                        <!-- Menu Item Task Management -->
                    </ul>
                @endcanAny

                @canAny(['user.create', 'user.read'])
                    <h3 class="mb-4 ml-4 text-sm font-medium text-bodydark2">User</h3>
                    <ul class="mb-6 flex flex-col gap-1.5">
                        <!-- Main Menu: Users -->
                        <li>
                            <button
                                class="group relative flex w-full items-center justify-between gap-2.5 rounded-sm px-4 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                                @click="selected = (selected === 'Users' ? '' : 'Users')"
                                :class="{ 'bg-graydark dark:bg-meta-4': selected === 'Users' }"
                            >
                            <div class="flex items-center gap-2.5">
                                <!-- User Icon -->
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="18"
                                    height="18"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="feather feather-users"
                                >
                                <circle cx="9" cy="7" r="4" />
                                <path d="M17 11c0 2.21-1.79 4-4 4s-4-1.79-4-4" />
                                <path d="M21 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2" />
                                <circle cx="17" cy="7" r="3" />
                                <path d="M20.5 21v-2a3.5 3.5 0 0 0-3.5-3.5H7A3.5 3.5 0 0 0 3.5 19v2" />
                                </svg>
                                Users
                            </div>
                            <!-- Animated Dropdown Icon -->
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                width="16"
                                height="16"
                                fill="currentColor"
                                class="bi bi-chevron-down transform transition-transform duration-300"
                                :class="{ 'rotate-180': selected === 'Users' }"
                                viewBox="0 0 16 16"
                            >
                                <path
                                fill-rule="evenodd"
                                d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"
                                />
                            </svg>
                            </button>

                            <!-- Sub-menu for Users -->
                            <ul
                                x-show="selected === 'Users'"
                                class="mt-1 ml-4 flex flex-col gap-1.5"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 transform scale-90"
                                x-transition:enter-end="opacity-100 transform scale-100"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100 transform scale-100"
                                x-transition:leave-end="opacity-0 transform scale-90"
                            >
                                @can('user.create')
                                    <li>
                                        <a
                                            href="{{ route('users.create') }}"
                                            class="flex items-center gap-2.5 rounded-sm px-4 py-2 text-sm font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                                        >
                                            Add User
                                        </a>
                                    </li>
                                @endcan
                                @can('user.read')
                                    <li>
                                        <a
                                            href="{{ route('users.index') }}"
                                            class="flex items-center gap-2.5 rounded-sm px-4 py-2 text-sm font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                                        >
                                            View Users
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                    </ul>
                @endcanAny

                @canAny(['customers_boat.create', 'customers_boat.read'])
                    <h3 class="mb-4 ml-4 text-sm font-medium text-bodydark2">Customer Boat</h3>
                    <ul class="mb-6 flex flex-col gap-1.5">
                        <!-- Menu Item Customers -->
                        <li>
                            <button
                                class="group relative flex w-full items-center justify-between gap-2.5 rounded-sm px-4 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                                @click="selected = (selected === 'CustomerBoats' ? '' : 'CustomerBoats')"
                                :class="{ 'bg-graydark dark:bg-meta-4': selected === 'CustomerBoats' }"
                            >
                                <div class="flex items-center gap-2.5">
                                    <!-- Customer Boats Icon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-boat">
                                        <path d="M3 13l3 3h12l3-3M5 10h14v3H5z" />
                                        <path d="M12 5v5" />
                                    </svg>
                                    Customer Boats
                                </div>
                                <!-- Animated Dropdown Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down transform transition-transform duration-300" :class="{ 'rotate-180': selected === 'CustomerBoats' }" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                                </svg>
                            </button>

                            <!-- Sub-menu for Customer Boats -->
                            <ul x-show="selected === 'CustomerBoats'" class="mt-1 ml-4 flex flex-col gap-1.5"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 transform scale-90"
                                x-transition:enter-end="opacity-100 transform scale-100"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100 transform scale-100"
                                x-transition:leave-end="opacity-0 transform scale-90"
                            >
                                @can('customers_boat.create')
                                    <li>
                                        <a href="{{ route('customer_boats.create') }}" class="flex items-center gap-2.5 rounded-sm px-4 py-2 text-sm font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4">
                                            Add Customer Boat
                                        </a>
                                    </li>
                                @endcan
                                @can('customers_boat.read')
                                    <li>
                                        <a href="{{ route('customer_boats.index') }}" class="flex items-center gap-2.5 rounded-sm px-4 py-2 text-sm font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4">
                                            View Customer Boats
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                        <!-- Menu Item Customers -->

                    </ul>
                @endcanAny

            @endif
            @if (auth()->user()->hasRole('Worker'))

                <h3 class="mb-4 ml-4 text-sm font-medium text-bodydark2">Financial Transaction</h3>
                <ul class="mb-6 flex flex-col gap-1.5">
                    <!-- Menu Item Financial Transaction -->
                    <li>
                        <button
                            class="group relative flex w-full items-center justify-between gap-2.5 rounded-sm px-4 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                            @click="selected = (selected === 'Financials' ? '' : 'Financials')"
                            :class="{ 'bg-graydark dark:bg-meta-4': selected === 'Financials' }"
                        >
                            <div class="flex items-center gap-2.5">
                                <!-- Financial Transaction Icon -->
                                <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <!-- Arrow representing financial movement -->
                                    <path d="M9 3V15M3 9L9 3L15 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>

                                    <!-- Dollar symbol representing money -->
                                    <path d="M6 6H12M6 12H12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M8 3V15" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                Financial Transaction
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down transform transition-transform duration-300" :class="{ 'rotate-180': selected === 'Financials' }" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                            </svg>
                        </button>
                        <ul x-show="selected === 'Financials'" class="mt-1 ml-4 flex flex-col gap-1.5" x-transition>
                            @if (auth()->user()->hasRole(['Admin', 'Manager']))
                                <li>
                                    <a href="{{route('financials.create')}}" class="flex items-center gap-2.5 rounded-sm px-4 py-2 text-sm font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4">
                                        Add Transaction
                                    </a>
                                </li>
                            @endif
                            <li>
                                <a href="{{route('financials.index')}}" class="flex items-center gap-2.5 rounded-sm px-4 py-2 text-sm font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4">
                                    View Transactions
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>

                <h3 class="mb-4 ml-4 text-sm font-medium text-bodydark2">Invoice</h3>
                <ul class="mb-6 flex flex-col gap-1.5">
                    <!-- Menu Item Invoice -->
                    <li>
                        <button
                            class="group relative flex w-full items-center justify-between gap-2.5 rounded-sm px-4 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                            @click="selected = (selected === 'Invoices' ? '' : 'Invoices')"
                            :class="{ 'bg-graydark dark:bg-meta-4': selected === 'Invoices' }"
                        >
                            <div class="flex items-center gap-2.5">
                                <!-- Invoice Icon -->
                                <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3 1H15C15.553 1 16 1.447 16 2V16C16 16.553 15.553 17 15 17H3C2.447 17 2 16.553 2 16V2C2 1.447 2.447 1 3 1Z" stroke="currentColor" stroke-width="2"/>
                                    <path d="M3 3H15V15H3V3Z" stroke="currentColor" stroke-width="2"/>
                                    <path d="M6 6H12" stroke="currentColor" stroke-width="2"/>
                                    <path d="M6 9H12" stroke="currentColor" stroke-width="2"/>
                                    <path d="M6 12H9" stroke="currentColor" stroke-width="2"/>
                                </svg>
                                Invoice
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down transform transition-transform duration-300" :class="{ 'rotate-180': selected === 'Invoices' }" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                            </svg>
                        </button>
                        <ul x-show="selected === 'Invoices'" class="mt-1 ml-4 flex flex-col gap-1.5" x-transition>

                            @if (auth()->user()->hasRole(['Admin', 'Manager']))
                                <li>
                                    <a href="{{route('invoices.create')}}" class="flex items-center gap-2.5 rounded-sm px-4 py-2 text-sm font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4">
                                        Add Invoice
                                    </a>
                                </li>
                            @endif
                            <li>
                                <a href="{{route('invoices.index')}}" class="flex items-center gap-2.5 rounded-sm px-4 py-2 text-sm font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4">
                                    View Invoices
                                </a>
                            </li>
                        </ul>
                    </li>

                </ul>

                <h3 class="mb-4 ml-4 text-sm font-medium text-bodydark2">Task</h3>
                <ul class="mb-6 flex flex-col gap-1.5">
                    <!-- Menu Item Task Management -->
                    <li>
                        <button
                            class="group relative flex w-full items-center justify-between gap-2.5 rounded-sm px-4 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                            @click="selected = (selected === 'Tasks' ? '' : 'Tasks')"
                            :class="{ 'bg-graydark dark:bg-meta-4': selected === 'Tasks' }"
                        >
                            <div class="flex items-center gap-2.5">
                                <!-- Task Management Icon -->
                                <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_130_9728)">
                                        <path
                                            d="M3.45928 0.984375H1.6874C1.04053 0.984375 0.478027 1.51875 0.478027 2.19375V3.96563C0.478027 4.6125 1.0124 5.175 1.6874 5.175H3.45928C4.10615 5.175 4.66865 4.64063 4.66865 3.96563V2.16562C4.64053 1.51875 4.10615 0.984375 3.45928 0.984375ZM3.3749 3.88125H1.77178V2.25H3.3749V3.88125Z"
                                        />
                                        <path
                                            d="M7.22793 3.71245H16.8748C17.2123 3.71245 17.5217 3.4312 17.5217 3.06558C17.5217 2.69995 17.2404 2.4187 16.8748 2.4187H7.22793C6.89043 2.4187 6.58105 2.69995 6.58105 3.06558C6.58105 3.4312 6.89043 3.71245 7.22793 3.71245Z"
                                        />
                                        <path
                                            d="M3.45928 6.75H1.6874C1.04053 6.75 0.478027 7.28437 0.478027 7.95937V9.73125C0.478027 10.3781 1.0124 10.9406 1.6874 10.9406H3.45928C4.10615 10.9406 4.66865 10.4062 4.66865 9.73125V7.95937C4.64053 7.28437 4.10615 6.75 3.45928 6.75ZM3.3749 9.64687H1.77178V8.01562H3.3749V9.64687Z"
                                        />
                                        <path
                                            d="M16.8748 8.21252H7.22793C6.89043 8.21252 6.58105 8.49377 6.58105 8.8594C6.58105 9.22502 6.86231 9.47815 7.22793 9.47815H16.8748C17.2123 9.47815 17.5217 9.1969 17.5217 8.8594C17.5217 8.5219 17.2123 8.21252 16.8748 8.21252Z"
                                        />
                                        <path
                                            d="M3.45928 12.8531H1.6874C1.04053 12.8531 0.478027 13.3875 0.478027 14.0625V15.8344C0.478027 16.4813 1.0124 17.0438 1.6874 17.0438H3.45928C4.10615 17.0438 4.66865 16.5094 4.66865 15.8344V14.0625C4.64053 13.3875 4.10615 12.8531 3.45928 12.8531ZM3.3749 15.75H1.77178V14.1188H3.3749V15.75Z"
                                        />
                                        <path
                                            d="M16.8748 14.2875H7.22793C6.89043 14.2875 6.58105 14.5687 6.58105 14.9344C6.58105 15.3 6.86231 15.5812 7.22793 15.5812H16.8748C17.2123 15.5812 17.5217 15.3 17.5217 14.9344C17.5217 14.5687 17.2123 14.2875 16.8748 14.2875Z"
                                        />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_130_9728">
                                            <rect width="18" height="18" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                                Task Management
                            </div>
                            <!-- Animated Dropdown Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down transform transition-transform duration-300" :class="{ 'rotate-180': selected === 'Tasks' }" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                            </svg>
                        </button>

                        <!-- Sub-menu for Task Management -->
                        <ul x-show="selected === 'Tasks'" class="mt-1 ml-4 flex flex-col gap-1.5"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform scale-90"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-90"
                        >
                            @if (auth()->user()->hasRole(['Admin', 'Manager']))
                                <li>
                                    <a href="{{route('tasks.create')}}" class="flex items-center gap-2.5 rounded-sm px-4 py-2 text-sm font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4">
                                        Add Task
                                    </a>
                                </li>
                            @endif
                            <li>
                                <a href="{{route('tasks.index')}}" class="flex items-center gap-2.5 rounded-sm px-4 py-2 text-sm font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4">
                                    View Tasks
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- Menu Item Task Management -->
                </ul>
                {{-- <h3 class="mb-4 ml-4 text-sm font-medium text-bodydark2">Task</h3>
                <ul class="mb-6 flex flex-col gap-1.5">
                    <!-- Menu Item Task Management -->
                    <li>
                        <button
                            class="group relative flex w-full items-center justify-between gap-2.5 rounded-sm px-4 py-2 font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4"
                            @click="selected = (selected === 'Tasks' ? '' : 'Tasks')"
                            :class="{ 'bg-graydark dark:bg-meta-4': selected === 'Tasks' }"
                        >
                            <div class="flex items-center gap-2.5">
                                <!-- Task Management Icon -->
                                <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_130_9728)">
                                        <path
                                            d="M3.45928 0.984375H1.6874C1.04053 0.984375 0.478027 1.51875 0.478027 2.19375V3.96563C0.478027 4.6125 1.0124 5.175 1.6874 5.175H3.45928C4.10615 5.175 4.66865 4.64063 4.66865 3.96563V2.16562C4.64053 1.51875 4.10615 0.984375 3.45928 0.984375ZM3.3749 3.88125H1.77178V2.25H3.3749V3.88125Z"
                                        />
                                        <path
                                            d="M7.22793 3.71245H16.8748C17.2123 3.71245 17.5217 3.4312 17.5217 3.06558C17.5217 2.69995 17.2404 2.4187 16.8748 2.4187H7.22793C6.89043 2.4187 6.58105 2.69995 6.58105 3.06558C6.58105 3.4312 6.89043 3.71245 7.22793 3.71245Z"
                                        />
                                        <path
                                            d="M3.45928 6.75H1.6874C1.04053 6.75 0.478027 7.28437 0.478027 7.95937V9.73125C0.478027 10.3781 1.0124 10.9406 1.6874 10.9406H3.45928C4.10615 10.9406 4.66865 10.4062 4.66865 9.73125V7.95937C4.64053 7.28437 4.10615 6.75 3.45928 6.75ZM3.3749 9.64687H1.77178V8.01562H3.3749V9.64687Z"
                                        />
                                        <path
                                            d="M16.8748 8.21252H7.22793C6.89043 8.21252 6.58105 8.49377 6.58105 8.8594C6.58105 9.22502 6.86231 9.47815 7.22793 9.47815H16.8748C17.2123 9.47815 17.5217 9.1969 17.5217 8.8594C17.5217 8.5219 17.2123 8.21252 16.8748 8.21252Z"
                                        />
                                        <path
                                            d="M3.45928 12.8531H1.6874C1.04053 12.8531 0.478027 13.3875 0.478027 14.0625V15.8344C0.478027 16.4813 1.0124 17.0438 1.6874 17.0438H3.45928C4.10615 17.0438 4.66865 16.5094 4.66865 15.8344V14.0625C4.64053 13.3875 4.10615 12.8531 3.45928 12.8531ZM3.3749 15.75H1.77178V14.1188H3.3749V15.75Z"
                                        />
                                        <path
                                            d="M16.8748 14.2875H7.22793C6.89043 14.2875 6.58105 14.5687 6.58105 14.9344C6.58105 15.3 6.86231 15.5812 7.22793 15.5812H16.8748C17.2123 15.5812 17.5217 15.3 17.5217 14.9344C17.5217 14.5687 17.2123 14.2875 16.8748 14.2875Z"
                                        />
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_130_9728">
                                            <rect width="18" height="18" fill="white" />
                                        </clipPath>
                                    </defs>
                                </svg>
                                Task Management
                            </div>
                            <!-- Animated Dropdown Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chevron-down transform transition-transform duration-300" :class="{ 'rotate-180': selected === 'Tasks' }" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                            </svg>
                        </button>

                        <!-- Sub-menu for Task Management -->
                        <ul x-show="selected === 'Tasks'" class="mt-1 ml-4 flex flex-col gap-1.5"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform scale-90"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-90"
                        >
                            <li>
                                <a href="{{route('worker.tasks.assign')}}" class="flex items-center gap-2.5 rounded-sm px-4 py-2 text-sm font-medium text-bodydark1 duration-300 ease-in-out hover:bg-graydark dark:hover:bg-meta-4">
                                    Your Tasks
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- Menu Item Task Management -->
                </ul> --}}


            @endif

          </div>
        </nav>
        <!-- Sidebar Menu -->
      </div>
    </aside>
  <!-- ===== Sidebar End ===== -->
