<?php
if ($this->session->flashdata('success')) { ?>
    <script>
        var successMessage = <?php echo json_encode($this->session->flashdata('success')); ?>;
        $(document).ready(function() {
            Swal.fire("Success!", successMessage, "success");
        });
    </script>
<?php } else if ($this->session->flashdata('warning')) { ?>
    <script>
        var warningMessage = <?php echo json_encode($this->session->flashdata('warning')); ?>;
        $(document).ready(function() {

            Swal.fire("Oops!", warningMessage, "warning");
        });
    </script>
<?php } else if ($this->session->flashdata('error')) { ?>
    <script>
        var errorMessage = <?php echo json_encode($this->session->flashdata('error')); ?>;
        $(document).ready(function() {

            Swal.fire("Error!", errorMessage, "error");
        });
    </script>
<?php } ?>

<script>
    $(document).ready(function() {

        // Menghentikan tautan dari navigasi langsung
        $(document).on('click', '.btn-hapus', function(event) {
            event.preventDefault();
            var href = $(this).attr('href');

            // Menampilkan dialog konfirmasi SweetAlert
            Swal.fire({
                title: "Apakah anda yakin?",
                text: "Data ini akan di hapus secara permanen",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Hapus!"
            }).then((result) => {
                if (result.isConfirmed) {
                    if (result.isConfirmed) {
                        // Jika pengguna mengkonfirmasi logout, arahkan ke URL logout
                        window.location.href = href;
                    }
                }
            });
        });

        $(document).on('click', '.btn-kembalikan', function(event) {
            event.preventDefault();
            var href = $(this).attr('href');

            // Menampilkan dialog konfirmasi SweetAlert
            Swal.fire({
                title: "Konfirmasi Pengembalian",
                text: "Apakah buku yang dikembalikan sudah sesuai dengan yang dipinjam?",
                icon: "question",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Kembalikan!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Jika pengguna mengkonfirmasi pengembalian, arahkan ke URL pengembalian
                    window.location.href = href;
                }
            });
        });

    });
</script>