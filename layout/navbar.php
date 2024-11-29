<nav>
    <div class="logo">
        <a href="../pages/dashboard.php">E-Report</a>
    </div>
        <ul>
            <li><a href="../pages/dashboard.php" <?php if($_SERVER['SCRIPT_NAME'] === '/10RPLSKL/e-report/pages/dashboard.php') { ?>class="active"<?php } ?>>Halaman Utama</a></li>
            <li><a href="../pages/add.php" <?php if($_SERVER['SCRIPT_NAME'] === '/10RPLSKL/e-report/pages/add.php') { ?>class="active"<?php } ?>>Ajukan Pengaduan</a></li>
            <li><a href="../pages/view.php" <?php if($_SERVER['SCRIPT_NAME'] === '/10RPLSKL/e-report/pages/view.php') { ?>class="active"<?php } ?>>List Pengaduan</a></li>
        </ul>
    </div>
    <div>
        <form id="logout" action="../process/logout.php" method="post">
            <button onclick="logoutButton(event)" type="submit" class="logout" title="Keluar">
                <?php include('../assets/image/logout.svg') ?>
            </button>
        </form>
    </div>
</nav>

<script>
    function logoutButton(event) {
        if (confirm('Yakin ingin logout?')) {
            document.querySelector('#logout').submit();
        } else {
            event.preventDefault();
        }
    }
</script>