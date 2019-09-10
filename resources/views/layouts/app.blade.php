{{-- start header  --}}
@component('layouts.header')
    @slot('page_name')
        @yield('title')
    @endslot
@endcomponent
{{-- end header --}}


@component('layouts.sidebar')
    
@endcomponent

{{-- start nav  --}}
@component('layouts.nav')

@endcomponent
{{-- end nav --}}

<!-- Begin Page Content -->
<div class="container-fluid" id="page_content_">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">@yield('page_header')</h1>

        @yield('content')

    
    </div>
      <!-- /.container-fluid -->

  </div>
    <!-- End of Main Content -->


    {{-- start footer --}}

    @component('layouts.footer')
        
    @endcomponent

    {{-- end footer  --}}