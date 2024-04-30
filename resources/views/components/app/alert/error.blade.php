<script type="module">
    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 4000,
        timerProgressBar: true,
    });
    Toast.fire({
        icon: "error",
        title: "{{ session('error') }}",
    });
</script>
