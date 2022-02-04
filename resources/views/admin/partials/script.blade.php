<!-- General JS Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
{{-- <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> --}}
{{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="{{ asset('stisla/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
<script src="{{ asset('stisla/js/stisla.js') }}"></script>
<script src="{{ asset('stisla/modules/sweetalert2/sweetalert2.min.js') }}"></script>

@stack('js')
<script src="{{ asset('stisla/js/scripts.js') }}"></script>
<script src="{{ asset('stisla/js/custome.js') }}"></script>

@yield('js')
<script>
    $(function() {
        $('.loading').hide();

        $('form').submit(function(e) {
            $('.loading').show();
        })
    })

    var token = $('meta[name="csrf-token"]').attr('content')
</script>


<script src="{{ asset('js/master.js') }}"></script>