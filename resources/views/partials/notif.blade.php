@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil',
            text: "{{ session('success') }}",
            timer: 3000,
            showConfirmButton: false,
            toast: true,
            position: 'center'
        });
    </script>
@endif

@if (session('fail'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: "{{ session('fail') }}",
            timer: 3000,
            showConfirmButton: false,
            toast: true,
            position: 'center'
        });
    </script>
@endif
