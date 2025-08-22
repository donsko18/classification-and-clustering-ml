<script>
    var result = confirm("Apakah anda yakin ingin keluar dari akun ?");
    if (result === true) {
        window.location.href = 'proseslogout.php';
    } else {
        window.location.href = 'index.php';
    }
</script>
