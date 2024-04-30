<script type="module">
    $('.btn-acc').click(function(e) {
        e.preventDefault();
        let form = $(this).closest("form");
        let name = $(this).data("name");
        Swal.fire({
            title: "Konfirmasi Servis?",
            text: "Anda tidak akan dapat mengembalikannya!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, konfirmasi!",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
</script>
