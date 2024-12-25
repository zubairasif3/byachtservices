<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
        Bonaveture | Admin Panel
    </title>
    <link rel="icon" href="{{ asset('assets/images/logo.webp') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
  {{-- <link rel="icon" href="{{ asset('assets/image/favicon.ico') }}"> --}}
  <link href="{{asset('assets/css/style.css')}}" rel="stylesheet">
  {{-- <script data-cfasync="false" nonce="b1548f15-15d8-4d18-a080-91638ca7a126">try{(function(w,d){!function(j,k,l,m){if(j.zaraz)console.error("zaraz is loaded twice");else{j[l]=j[l]||{};j[l].executed=[];j.zaraz={deferred:[],listeners:[]};j.zaraz._v="5828";j.zaraz._n="b1548f15-15d8-4d18-a080-91638ca7a126";j.zaraz.q=[];j.zaraz._f=function(n){return async function(){var o=Array.prototype.slice.call(arguments);j.zaraz.q.push({m:n,a:o})}};for(const p of["track","set","debug"])j.zaraz[p]=j.zaraz._f(p);j.zaraz.init=()=>{var q=k.getElementsByTagName(m)[0],r=k.createElement(m),s=k.getElementsByTagName("title")[0];s&&(j[l].t=k.getElementsByTagName("title")[0].text);j[l].x=Math.random();j[l].w=j.screen.width;j[l].h=j.screen.height;j[l].j=j.innerHeight;j[l].e=j.innerWidth;j[l].l=j.location.href;j[l].r=k.referrer;j[l].k=j.screen.colorDepth;j[l].n=k.characterSet;j[l].o=(new Date).getTimezoneOffset();if(j.dataLayer)for(const t of Object.entries(Object.entries(dataLayer).reduce(((u,v)=>({...u[1],...v[1]})),{})))zaraz.set(t[0],t[1],{scope:"page"});j[l].q=[];for(;j.zaraz.q.length;){const w=j.zaraz.q.shift();j[l].q.push(w)}r.defer=!0;for(const x of[localStorage,sessionStorage])Object.keys(x||{}).filter((z=>z.startsWith("_zaraz_"))).forEach((y=>{try{j[l]["z_"+y.slice(7)]=JSON.parse(x.getItem(y))}catch{j[l]["z_"+y.slice(7)]=x.getItem(y)}}));r.referrerPolicy="origin";r.src="cdn-cgi/zaraz/sd0d9.js?z="+btoa(encodeURIComponent(JSON.stringify(j[l])));q.parentNode.insertBefore(r,q)};["complete","interactive"].includes(k.readyState)?zaraz.init():j.addEventListener("DOMContentLoaded",zaraz.init)}}(w,d,"zarazData","script");window.zaraz._p=async mY=>new Promise((mZ=>{if(mY){mY.e&&mY.e.forEach((m$=>{try{const na=d.querySelector("script[nonce]"),nb=na?.nonce||na?.getAttribute("nonce"),nc=d.createElement("script");nb&&(nc.nonce=nb);nc.innerHTML=m$;nc.onload=()=>{d.head.removeChild(nc)};d.head.appendChild(nc)}catch(nd){console.error(`Error executing script: ${m$}\n`,nd)}}));Promise.allSettled((mY.f||[]).map((ne=>fetch(ne[0],ne[1]))))}mZ()}));zaraz._p({"e":["(function(w,d){})(window,document)"]});})(window,document)}catch(e){throw fetch("/cdn-cgi/zaraz/t"),e;};
  </script> --}}
</head>

    <!-- Additional Styles -->
    @stack('styles')
<body
  x-data="{ page: 'ecommerce', 'loaded': true, 'darkMode': true, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }"
  x-init="
        darkMode = JSON.parse(localStorage.getItem('darkMode'));
        $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
  :class="{'dark text-bodydark bg-boxdark-2': darkMode === true}"
>
  <!-- ===== Preloader Start ===== -->
  <div x-show="loaded" x-init="window.addEventListener('DOMContentLoaded', () => {setTimeout(() => loaded = false, 500)})" class="fixed left-0 top-0 z-999999 flex h-screen w-screen items-center justify-center bg-white dark:bg-black">
    <div class="h-16 w-16 animate-spin rounded-full border-4 border-solid border-primary border-t-transparent"></div>
  </div>

    <!-- ===== Preloader End ===== -->

    <!-- ===== Page Wrapper Start ===== -->
    <div class="flex h-screen overflow-hidden">
        <!-- Main Sidebar Container -->
        @include('admin.layout.sidebar')

        <!-- ===== Content Area Start ===== -->
        <div class="relative flex flex-1 flex-col overflow-y-auto overflow-x-hidden">
            <!-- Navbar -->
            @include('admin.layout.header')
            <!-- ===== Main Content Start ===== -->
            <main>
                @yield('content')
            </main>
        <!-- ===== Main Content End ===== -->
        </div>
        <!-- ===== Content Area End ===== -->
    </div>
  <!-- ===== Page Wrapper End ===== -->
  <script defer src="{{ asset('assets/js/bundle.js') }}"></script>
  <script defer src="https://static.cloudflareinsights.com/beacon.min.js/vcd15cbe7772f49c399c6a5babf22c1241717689176015"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
        const notificationBell = document.querySelector('[x-data]');

        notificationBell.addEventListener('click', function () {
            fetch(`{{ url("/notifications/mark-as-read") }}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            }).then(() => {
                const notifyingElement = document.querySelector('[notifying]');
                if (notifyingElement) notifyingElement.classList.add('hidden');
            });
        });
    });
  </script>
</body>
</html>

