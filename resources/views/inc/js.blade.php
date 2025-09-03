<!-- [Page Specific JS] start -->
<script src="{{ asset('js/plugins/apexcharts.min.js') }}"></script>
<script src="{{ asset('js/plugins/jsvectormap.min.js') }}"></script>
<script src="{{ asset('js/plugins/world.js') }}"></script>
<script src="{{ asset('js/plugins/world-merc.js') }}"></script>
{{-- <script src="{{ asset('js/widgets/earnings-users-chart.js') }}"></script> --}}
{{-- <script src="{{ asset('js/widgets/world-map-markers.js') }}"></script> --}}
<!-- [Page Specific JS] end -->

<!-- Required Js -->
<script src="{{ asset('js/plugins/popper.min.js') }}"></script>
<script src="{{ asset('js/plugins/simplebar.min.js') }}"></script>
<script src="{{ asset('js/plugins/bootstrap.min.js') }}"></script>
{{-- <script src="{{ asset('js/plugins/i18next.min.js') }}"></script>
<script src="{{ asset('js/plugins/i18nextHttpBackend.min.js') }}"></script> --}}
<script src="{{ asset('js/icon/custom-font.js') }}"></script>
<script src="{{ asset('js/script.js') }}"></script>
<script src="{{ asset('js/theme.js') }}"></script>
{{-- <script src="{{ asset('js/multi-lang.js') }}"></script> --}}
<script src="{{ asset('js/plugins/feather.min.js') }}"></script>
<script src="{{ asset('js/sweetalert2-11.js') }}"></script>
<script src="{{ asset('js/iziToast.js') }}"></script>

{{-- ADDON --}}
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.6/dist/signature_pad.umd.min.js"></script>
<script src="{{ asset('js/plugins/simple-datatables.js') }}"></script>
<script src="{{ asset('js/plugins/choices.min.js') }}"></script>
<script src="{{ asset('js/plugins/ckeditor/classic/ckeditor.js') }}"></script>

{{-- DIAGRAM --}}
<script src="{{ asset('js/plugins/apexcharts.min.js') }}"></script>

{{-- CDN --}}
{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
{{-- <script src="{{ asset('js/jquery.min.js') }}"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment-with-locales.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

{{-- MANUAL JQUERY / JAVASCRIPT --}}
    {{-- DATA PC THEME START --}}
    <script>
        function layout_change(theme) {
            document.documentElement.setAttribute('data-pc-theme', theme);
            localStorage.setItem('pc-theme', theme);
            if (theme == 'light') {
                document.getElementById('logo-light').style.display = 'inline';
                document.getElementById('logo-dark').style.display = 'none';
            } else {
                document.getElementById('logo-light').style.display = 'none';
                document.getElementById('logo-dark').style.display = 'inline';
            }
        }

        // function layout_change_default() {
        //     document.body.setAttribute('data-pc-theme', 'dark');
        //     localStorage.removeItem('pc-theme');
        // }
    </script>
    {{-- DATA PC THEME END --}}

{{-- <script>
    layout_change('dark');
</script>

<script>
    layout_sidebar_change('light');
</script>

<script>
    change_box_container('false');
</script>

<script>
    layout_caption_change('true');
</script>

<script>
    layout_rtl_change('false');
</script>

<script>
    preset_change('preset-1');
</script> --}}
