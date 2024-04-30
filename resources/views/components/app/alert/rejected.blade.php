<script type="module">
    $('.btn-rejected').click(function(e) {
        e.preventDefault();
        let form = $(this).closest("form");
        let name = $(this).data("name");
        Swal.fire({
            title: "Tolak pemesanan?",
            text: "Anda tidak akan dapat mengembalikannya!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, tolak!",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    });
</script>
