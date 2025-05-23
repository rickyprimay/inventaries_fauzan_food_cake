<aside :class="sidebarToggle ? 'translate-x-0' : '-translate-x-full'"
    class="absolute left-0 top-0 z-9999 border flex h-screen w-72.5 flex-col overflow-y-hidden bg-white duration-300 ease-linear lg:static lg:translate-x-0"
    @click.outside="sidebarToggle = false">
    <div class="flex items-center justify-between gap-2 px-6 py-5.5 lg:py-6.5">
        <a href="/">
            <h1 class="text-yellow-400 font-outline-2 ml-4 font-extrabold text-4xl">Fauzan Food & Cake</h1>
        </a>

        <button class="block lg:hidden text-black" @click.stop="sidebarToggle = !sidebarToggle">
            <svg class="fill-current" width="20" height="18" viewBox="0 0 20 18" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M19 8.175H2.98748L9.36248 1.6875C9.69998 1.35 9.69998 0.825 9.36248 0.4875C9.02498 0.15 8.49998 0.15 8.16248 0.4875L0.399976 8.3625C0.0624756 8.7 0.0624756 9.225 0.399976 9.5625L8.16248 17.4375C8.31248 17.5875 8.53748 17.7 8.76248 17.7C8.98748 17.7 9.17498 17.625 9.36248 17.475C9.69998 17.1375 9.69998 16.6125 9.36248 16.275L3.02498 9.8625H19C19.45 9.8625 19.825 9.4875 19.825 9.0375C19.825 8.55 19.45 8.175 19 8.175Z"
                    fill="" />
            </svg>
        </button>
    </div>

    <div class="no-scrollbar flex flex-col overflow-y-auto duration-300 ease-linear">
        <nav class="mt-5 px-4 py-4 lg:mt-9 lg:px-6" x-data="{ selected: $persist('Dashboard') }">
            <div>
                @if(session('user_role') == 'Admin')
                    <h3 class="mb-4 ml-4 text-sm font-medium text-bodydark2">Admin Panel</h3>
                @else
                    <h3 class="mb-4 ml-4 text-sm font-medium text-bodydark2">Dashboard</h3>
                @endif

                <ul class="mb-6 flex flex-col gap-1.5">
                    <li>
                        <a href="{{ route('dashboard') }}"
                            class="group relative flex items-center gap-2.5 rounded-md px-4 py-2 font-medium duration-300 ease-in-out
                            hover:bg-graydark hover:text-white
                            {{ request()->routeIs('dashboard') ? 'bg-graydark text-white' : 'text-black' }}">
                            <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M6.10322 0.956299H2.53135C1.5751 0.956299 0.787598 1.7438 0.787598 2.70005V6.27192C0.787598 7.22817 1.5751 8.01567 2.53135 8.01567H6.10322C7.05947 8.01567 7.84697 7.22817 7.84697 6.27192V2.72817C7.8751 1.7438 7.0876 0.956299 6.10322 0.956299ZM6.60947 6.30005C6.60947 6.5813 6.38447 6.8063 6.10322 6.8063H2.53135C2.2501 6.8063 2.0251 6.5813 2.0251 6.30005V2.72817C2.0251 2.44692 2.2501 2.22192 2.53135 2.22192H6.10322C6.38447 2.22192 6.60947 2.44692 6.60947 2.72817V6.30005Z"
                                    fill="" />
                                <path
                                    d="M15.4689 0.956299H11.8971C10.9408 0.956299 10.1533 1.7438 10.1533 2.70005V6.27192C10.1533 7.22817 10.9408 8.01567 11.8971 8.01567H15.4689C16.4252 8.01567 17.2127 7.22817 17.2127 6.27192V2.72817C17.2127 1.7438 16.4252 0.956299 15.4689 0.956299ZM15.9752 6.30005C15.9752 6.5813 15.7502 6.8063 15.4689 6.8063H11.8971C11.6158 6.8063 11.3908 6.5813 11.3908 6.30005V2.72817C11.3908 2.44692 11.6158 2.22192 11.8971 2.22192H15.4689C15.7502 2.22192 15.9752 2.44692 15.9752 2.72817V6.30005Z"
                                    fill="" />
                                <path
                                    d="M6.10322 9.92822H2.53135C1.5751 9.92822 0.787598 10.7157 0.787598 11.672V15.2438C0.787598 16.2001 1.5751 16.9876 2.53135 16.9876H6.10322C7.05947 16.9876 7.84697 16.2001 7.84697 15.2438V11.7001C7.8751 10.7157 7.0876 9.92822 6.10322 9.92822ZM6.60947 15.272C6.60947 15.5532 6.38447 15.7782 6.10322 15.7782H2.53135C2.2501 15.7782 2.0251 15.5532 2.0251 15.272V11.7001C2.0251 11.4188 2.2501 11.1938 2.53135 11.1938H6.10322C6.38447 11.1938 6.60947 11.4188 6.60947 11.7001V15.272Z"
                                    fill="" />
                                <path
                                    d="M15.4689 9.92822H11.8971C10.9408 9.92822 10.1533 10.7157 10.1533 11.672V15.2438C10.1533 16.2001 10.9408 16.9876 11.8971 16.9876H15.4689C16.4252 16.9876 17.2127 16.2001 17.2127 15.2438V11.7001C17.2127 10.7157 16.4252 9.92822 15.4689 9.92822ZM15.9752 15.272C15.9752 15.5532 15.7502 15.7782 15.4689 15.7782H11.8971C11.6158 15.7782 11.3908 15.5532 11.3908 15.272V11.7001C11.3908 11.4188 11.6158 11.1938 11.8971 11.1938H15.4689C15.7502 11.1938 15.9752 11.4188 15.9752 11.7001V15.272Z"
                                    fill="" />
                            </svg>

                            Dashboard

                        </a>
                    </li>
                    
                    @if(session('user_role') == 'Admin')
                    <li>
                        <a href="{{ route('user') }}"
                           class="group relative flex items-center gap-2.5 rounded-md px-4 py-2 font-medium duration-300 ease-in-out
                            hover:bg-graydark hover:text-white
                            {{ request()->routeIs('user') ? 'bg-graydark text-white' : 'text-black' }}">
                           
                            <svg class="fill-current" width="18" height="18" viewBox="0 0 18 18" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.0002 7.79065C11.0814 7.79065 12.7689 6.1594 12.7689 4.1344C12.7689 2.1094 11.0814 0.478149 9.0002 0.478149C6.91895 0.478149 5.23145 2.1094 5.23145 4.1344C5.23145 6.1594 6.91895 7.79065 9.0002 7.79065Z" fill="" />
                                <path d="M10.8283 9.05627H7.17207C4.16269 9.05627 1.71582 11.5313 1.71582 14.5406V16.875C1.71582 17.2125 1.99707 17.5219 2.3627 17.5219C2.72832 17.5219 3.00957 17.2407 3.00957 16.875V14.5406C3.00957 12.2344 4.89394 10.3219 7.22832 10.3219H10.8564C13.1627 10.3219 15.0752 12.2063 15.0752 14.5406V16.875C15.0752 17.2125 15.3564 17.5219 15.7221 17.5219C16.0877 17.5219 16.3689 17.2407 16.3689 16.875V14.5406C16.2846 11.5313 13.8377 9.05627 10.8283 9.05627Z" fill="" />
                            </svg>
                        
                            Manajemen User
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('outlet') }}"
                           class="group relative flex items-center gap-2.5 rounded-md px-4 py-2 font-medium duration-300 ease-in-out
                            hover:bg-graydark hover:text-white
                            {{ request()->routeIs('outlet') ? 'bg-graydark text-white' : 'text-black' }}">
                           
                           <i class="fa-solid fa-shop"></i>
                        
                            Manajemen Outlet
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('division') }}"
                           class="group relative flex items-center gap-2.5 rounded-md px-4 py-2 font-medium duration-300 ease-in-out
                            hover:bg-graydark hover:text-white
                            {{ request()->routeIs('division') ? 'bg-graydark text-white' : 'text-black' }}">
                           
                           <i class="fa-solid fa-people-group"></i>
                        
                            Manajemen Divisi
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('category') }}"
                           class="group relative flex items-center gap-2.5 rounded-md px-4 py-2 font-medium duration-300 ease-in-out
                            hover:bg-graydark hover:text-white
                            {{ request()->routeIs('category') ? 'bg-graydark text-white' : 'text-black' }}">
                           
                           <i class="fa-solid fa-layer-group"></i>
                        
                            Manajemen Kategori
                        </a>
                    </li>

                    @endif


                </ul>
            </div>

            <div>
                <h3 class="mb-4 ml-4 text-sm font-medium text-bodydark2">Master Data</h3>

                <ul class="mb-6 flex flex-col gap-1.5">

                    <li>
                        <a href="{{ route('product') }}"
                           class="group relative flex items-center gap-2.5 rounded-md px-4 py-2 font-medium duration-300 ease-in-out
                            hover:bg-graydark hover:text-white
                            {{ request()->routeIs('product') ? 'bg-graydark text-white' : 'text-black' }}">
                           
                           <i class="fa-solid fa-bag-shopping"></i>
                        
                            Produk
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('delivery') }}"
                           class="group relative flex items-center gap-2.5 rounded-md px-4 py-2 font-medium duration-300 ease-in-out
                            hover:bg-graydark hover:text-white
                            {{ request()->routeIs('delivery') || request()->routeIs('delivery.detail') ? 'bg-graydark text-white' : 'text-black' }}">
                           
                           <i class="fa-solid fa-truck"></i>
                        
                            Pengiriman
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('receive') }}"
                           class="group relative flex items-center gap-2.5 rounded-md px-4 py-2 font-medium duration-300 ease-in-out
                            hover:bg-graydark hover:text-white
                            {{ request()->routeIs('receive') ? 'bg-graydark text-white' : 'text-black' }}">
                           
                           <i class="fa-solid fa-truck fa-flip-horizontal"></i>
                        
                            Pengiriman Dari Outlet Lain
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('transactions') }}"
                           class="group relative flex items-center gap-2.5 rounded-md px-4 py-2 font-medium duration-300 ease-in-out
                            hover:bg-graydark hover:text-white
                            {{ request()->routeIs('transactions') ? 'bg-graydark text-white' : 'text-black' }}">
                           
                            <i class="fa-solid fa-cart-shopping"></i>
                        
                            Transaksi
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('stokist-report') }}"
                           class="group relative flex items-center gap-2.5 rounded-md px-4 py-2 font-medium duration-300 ease-in-out
                            hover:bg-graydark hover:text-white
                            {{ request()->routeIs('stokist-report') ? 'bg-graydark text-white' : 'text-black' }}">
                           
                            <i class="fa-solid fa-file-signature"></i>
                        
                            Laporan Stokist
                        </a>
                    </li>

                </ul>
            </div>
        </nav>
    </div>
</aside>
