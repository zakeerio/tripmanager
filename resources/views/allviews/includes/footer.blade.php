
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
{{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script> --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<!--Custom JS-->
<script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>

<script>
    $(document).ready(function () {
        if($("#datatables").length > 0 ){
            $('#datatables').DataTable();
        }
    });
</script>
