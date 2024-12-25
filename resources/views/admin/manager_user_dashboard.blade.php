@extends("admin.layout.app")

@section('content')
    <div class="mx-auto max-w-screen-2xl p-4 md:p-6 2xl:p-10">
        <h2 class="text-title-md2 font-bold text-black dark:text-white add-heading mb-4">
            Tasks Info
        </h2>
        <div class="grid grid-cols-1 gap-4 md:grid-cols-2 md:gap-6 xl:grid-cols-4 2xl:gap-7.5">
            <!-- Card Item Start: Total Tasks -->
            <div class="rounded-sm border border-stroke bg-white px-7.5 py-6 shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="flex h-11.5 w-11.5 items-center justify-center rounded-full bg-meta-2 dark:bg-meta-4">
                    <svg class="fill-primary" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_130_9728)">
                            <path d="M3.45928 0.984375H1.6874C1.04053 0.984375 0.478027 1.51875 0.478027 2.19375V3.96563C0.478027 4.6125 1.0124 5.175 1.6874 5.175H3.45928C4.10615 5.175 4.66865 4.64063 4.66865 3.96563V2.16562C4.64053 1.51875 4.10615 0.984375 3.45928 0.984375ZM3.3749 3.88125H1.77178V2.25H3.3749V3.88125Z" fill=""></path>
                            <path d="M7.22793 3.71245H16.8748C17.2123 3.71245 17.5217 3.4312 17.5217 3.06558C17.5217 2.69995 17.2404 2.4187 16.8748 2.4187H7.22793C6.89043 2.4187 6.58105 2.69995 6.58105 3.06558C6.58105 3.4312 6.89043 3.71245 7.22793 3.71245Z" fill=""></path>
                            <path d="M3.45928 6.75H1.6874C1.04053 6.75 0.478027 7.28437 0.478027 7.95937V9.73125C0.478027 10.3781 1.0124 10.9406 1.6874 10.9406H3.45928C4.10615 10.9406 4.66865 10.4062 4.66865 9.73125V7.95937C4.64053 7.28437 4.10615 6.75 3.45928 6.75ZM3.3749 9.64687H1.77178V8.01562H3.3749V9.64687Z" fill=""></path>
                            <path d="M16.8748 8.21252H7.22793C6.89043 8.21252 6.58105 8.49377 6.58105 8.8594C6.58105 9.22502 6.86231 9.47815 7.22793 9.47815H16.8748C17.2123 9.47815 17.5217 9.1969 17.5217 8.8594C17.5217 8.5219 17.2123 8.21252 16.8748 8.21252Z" fill=""></path>
                            <path d="M3.45928 12.8531H1.6874C1.04053 12.8531 0.478027 13.3875 0.478027 14.0625V15.8344C0.478027 16.4813 1.0124 17.0438 1.6874 17.0438H3.45928C4.10615 17.0438 4.66865 16.5094 4.66865 15.8344V14.0625C4.64053 13.3875 4.10615 12.8531 3.45928 12.8531ZM3.3749 15.75H1.77178V14.1188H3.3749V15.75Z" fill=""></path>
                            <path d="M16.8748 14.2875H7.22793C6.89043 14.2875 6.58105 14.5687 6.58105 14.9344C6.58105 15.3 6.86231 15.5812 7.22793 15.5812H16.8748C17.2123 15.5812 17.5217 15.3 17.5217 14.9344C17.5217 14.5687 17.2123 14.2875 16.8748 14.2875Z" fill=""></path>
                        </g>
                        <defs>
                            <clipPath id="clip0_130_9728">
                                <rect width="18" height="18" fill="white"></rect>
                            </clipPath>
                        </defs>
                    </svg>
                </div>
                <div class="mt-4 flex items-end justify-between">
                    <div>
                        <h4 class="text-title-md font-bold text-black dark:text-white">
                            {{ $counts['totalTasks'] }}
                        </h4>
                        <span class="text-sm font-medium">Total Tasks</span>
                    </div>
                </div>
            </div>
            <!-- Card Item End: Total Tasks -->

            <!-- Card Item Start: Completed Tasks -->
            <div class="rounded-sm border border-stroke bg-white px-7.5 py-6 shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="flex h-11.5 w-11.5 items-center justify-center rounded-full bg-meta-2 dark:bg-meta-4">
                    <!-- Checkmark Icon SVG -->
                    <svg class="fill-primary dark:fill-white" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7.5 13.75L3.75 10L4.5375 9.2125L7.5 12.175L15.4625 4.2125L16.25 5L7.5 13.75Z" fill="" />
                    </svg>
                </div>
                <div class="mt-4 flex items-end justify-between">
                    <div>
                        <h4 class="text-title-md font-bold text-black dark:text-white">
                            {{ $counts['compeletedTasks'] }}
                        </h4>
                        <span class="text-sm font-medium">Completed Tasks</span>
                    </div>
                </div>
            </div>
            <!-- Card Item End: Completed Tasks -->

            <!-- Card Item Start: In-Progress Tasks -->
            <div class="rounded-sm border border-stroke bg-white px-7.5 py-6 shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="flex h-11.5 w-11.5 items-center justify-center rounded-full bg-meta-2 dark:bg-meta-4">
                    <svg class="fill-primary" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_130_9728)">
                            <path d="M3.45928 0.984375H1.6874C1.04053 0.984375 0.478027 1.51875 0.478027 2.19375V3.96563C0.478027 4.6125 1.0124 5.175 1.6874 5.175H3.45928C4.10615 5.175 4.66865 4.64063 4.66865 3.96563V2.16562C4.64053 1.51875 4.10615 0.984375 3.45928 0.984375ZM3.3749 3.88125H1.77178V2.25H3.3749V3.88125Z" fill=""></path>
                            <path d="M7.22793 3.71245H16.8748C17.2123 3.71245 17.5217 3.4312 17.5217 3.06558C17.5217 2.69995 17.2404 2.4187 16.8748 2.4187H7.22793C6.89043 2.4187 6.58105 2.69995 6.58105 3.06558C6.58105 3.4312 6.89043 3.71245 7.22793 3.71245Z" fill=""></path>
                            <path d="M3.45928 6.75H1.6874C1.04053 6.75 0.478027 7.28437 0.478027 7.95937V9.73125C0.478027 10.3781 1.0124 10.9406 1.6874 10.9406H3.45928C4.10615 10.9406 4.66865 10.4062 4.66865 9.73125V7.95937C4.64053 7.28437 4.10615 6.75 3.45928 6.75ZM3.3749 9.64687H1.77178V8.01562H3.3749V9.64687Z" fill=""></path>
                            <path d="M16.8748 8.21252H7.22793C6.89043 8.21252 6.58105 8.49377 6.58105 8.8594C6.58105 9.22502 6.86231 9.47815 7.22793 9.47815H16.8748C17.2123 9.47815 17.5217 9.1969 17.5217 8.8594C17.5217 8.5219 17.2123 8.21252 16.8748 8.21252Z" fill=""></path>
                            <path d="M3.45928 12.8531H1.6874C1.04053 12.8531 0.478027 13.3875 0.478027 14.0625V15.8344C0.478027 16.4813 1.0124 17.0438 1.6874 17.0438H3.45928C4.10615 17.0438 4.66865 16.5094 4.66865 15.8344V14.0625C4.64053 13.3875 4.10615 12.8531 3.45928 12.8531ZM3.3749 15.75H1.77178V14.1188H3.3749V15.75Z" fill=""></path>
                            <path d="M16.8748 14.2875H7.22793C6.89043 14.2875 6.58105 14.5687 6.58105 14.9344C6.58105 15.3 6.86231 15.5812 7.22793 15.5812H16.8748C17.2123 15.5812 17.5217 15.3 17.5217 14.9344C17.5217 14.5687 17.2123 14.2875 16.8748 14.2875Z" fill=""></path>
                        </g>
                        <defs>
                            <clipPath id="clip0_130_9728">
                                <rect width="18" height="18" fill="white"></rect>
                            </clipPath>
                        </defs>
                    </svg>
                </div>
                <div class="mt-4 flex items-end justify-between">
                    <div>
                        <h4 class="text-title-md font-bold text-black dark:text-white">
                            {{ $counts['inprogressTasks'] }}
                        </h4>
                        <span class="text-sm font-medium">In-Progress Tasks</span>
                    </div>
                </div>
            </div>
            <!-- Card Item End: In-Progress Tasks -->

            <!-- Card Item Start: Pending Tasks -->
            <div class="rounded-sm border border-stroke bg-white px-7.5 py-6 shadow-default dark:border-strokedark dark:bg-boxdark">
                <div class="flex h-11.5 w-11.5 items-center justify-center rounded-full bg-meta-2 dark:bg-meta-4">
                    <svg class="fill-primary" width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_130_9728)">
                            <path d="M3.45928 0.984375H1.6874C1.04053 0.984375 0.478027 1.51875 0.478027 2.19375V3.96563C0.478027 4.6125 1.0124 5.175 1.6874 5.175H3.45928C4.10615 5.175 4.66865 4.64063 4.66865 3.96563V2.16562C4.64053 1.51875 4.10615 0.984375 3.45928 0.984375ZM3.3749 3.88125H1.77178V2.25H3.3749V3.88125Z" fill=""></path>
                            <path d="M7.22793 3.71245H16.8748C17.2123 3.71245 17.5217 3.4312 17.5217 3.06558C17.5217 2.69995 17.2404 2.4187 16.8748 2.4187H7.22793C6.89043 2.4187 6.58105 2.69995 6.58105 3.06558C6.58105 3.4312 6.89043 3.71245 7.22793 3.71245Z" fill=""></path>
                            <path d="M3.45928 6.75H1.6874C1.04053 6.75 0.478027 7.28437 0.478027 7.95937V9.73125C0.478027 10.3781 1.0124 10.9406 1.6874 10.9406H3.45928C4.10615 10.9406 4.66865 10.4062 4.66865 9.73125V7.95937C4.64053 7.28437 4.10615 6.75 3.45928 6.75ZM3.3749 9.64687H1.77178V8.01562H3.3749V9.64687Z" fill=""></path>
                            <path d="M16.8748 8.21252H7.22793C6.89043 8.21252 6.58105 8.49377 6.58105 8.8594C6.58105 9.22502 6.86231 9.47815 7.22793 9.47815H16.8748C17.2123 9.47815 17.5217 9.1969 17.5217 8.8594C17.5217 8.5219 17.2123 8.21252 16.8748 8.21252Z" fill=""></path>
                            <path d="M3.45928 12.8531H1.6874C1.04053 12.8531 0.478027 13.3875 0.478027 14.0625V15.8344C0.478027 16.4813 1.0124 17.0438 1.6874 17.0438H3.45928C4.10615 17.0438 4.66865 16.5094 4.66865 15.8344V14.0625C4.64053 13.3875 4.10615 12.8531 3.45928 12.8531ZM3.3749 15.75H1.77178V14.1188H3.3749V15.75Z" fill=""></path>
                            <path d="M16.8748 14.2875H7.22793C6.89043 14.2875 6.58105 14.5687 6.58105 14.9344C6.58105 15.3 6.86231 15.5812 7.22793 15.5812H16.8748C17.2123 15.5812 17.5217 15.3 17.5217 14.9344C17.5217 14.5687 17.2123 14.2875 16.8748 14.2875Z" fill=""></path>
                        </g>
                        <defs>
                            <clipPath id="clip0_130_9728">
                                <rect width="18" height="18" fill="white"></rect>
                            </clipPath>
                        </defs>
                    </svg>
                </div>
                <div class="mt-4 flex items-end justify-between">
                    <div>
                        <h4 class="text-title-md font-bold text-black dark:text-white">
                            {{ $counts['pendingTasks'] }}
                        </h4>
                        <span class="text-sm font-medium">Pending Tasks</span>
                    </div>
                </div>
            </div>
            <!-- Card Item End: Pending Tasks -->
        </div>
        <div class="mt-4">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <!-- ====== Table One Start -->
                <div>
                    <div class="rounded-sm border border-stroke bg-white px-5 pb-2.5 pt-6 shadow-default dark:border-strokedark dark:bg-boxdark sm:px-7.5 xl:pb-1">
                        <h4 class="mb-6 text-xl font-bold text-black dark:text-white">
                            Top Customers
                        </h4>

                        <div class="flex flex-col">
                            <div class="grid grid-cols-3 rounded-sm bg-gray-2 dark:bg-meta-4 sm:grid-cols-3">
                                <div class="p-2.5 xl:p-5">
                                    <h5 class="text-sm font-medium uppercase xsm:text-base">Company Owner</h5>
                                </div>
                                <div class="p-2.5 text-center xl:p-5">
                                    <h5 class="text-sm font-medium uppercase xsm:text-base">Remaining Balance</h5>
                                </div>
                                <div class="p-2.5 text-center xl:p-5">
                                    <h5 class="text-sm font-medium uppercase xsm:text-base">User</h5>
                                </div>
                            </div>
                            @foreach($topCustomers as $customer)
                                <div class="grid grid-cols-3 border-b border-stroke dark:border-strokedark sm:grid-cols-3">
                                    <div class="flex items-center gap-3 p-2.5 xl:p-5">
                                        <p class="hidden font-medium text-black dark:text-white sm:block">
                                            {{ $customer->name }}
                                        </p>
                                    </div>

                                    <div class="flex items-center justify-center p-2.5 xl:p-5">
                                        <p class="font-medium text-black dark:text-white">${{$customer->remainingBalance() }}</p>
                                    </div>

                                    <div class="flex items-center justify-center p-2.5 xl:p-5">
                                        {{ $customer->user->name ?? '' }}
                                    </div>
                                </div>
                            @endforeach

                            @if($topCustomers->isEmpty())
                                <div class="border-b border-stroke dark:border-strokedark">
                                    <div class="flex justify-center py-4 items-center gap-3 p-2.5 xl:p-5">
                                        <p class="font-medium text-black dark:text-white sm:block">
                                        No Cusotmer Found in your system
                                        </p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- ====== Table One End -->

            </div>
        </div>
    </div>
@endsection
