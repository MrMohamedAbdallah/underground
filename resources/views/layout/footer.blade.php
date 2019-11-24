<footer class="navbar">
    <ul class="navbar-nav">
        <li>Privacy &amp; policy</li>
        <li>Sitemap</li>
        <li>©2019 Mohamed Abdallah</li>
    </ul>
</footer>

<script src="{{ asset('js/jquery.min.js') }}"></script>
<script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('js/app.min.js') }}"></script>

@yield('script')


{{-- Sweetalert --}}
@if(Session::has('success'))
<script>
Swal.fire(
  '{{ __("app.good job") }}',
  '{{ Session::get('success') }}',
  'success'
)
</script>
@endif



</body>

</html>