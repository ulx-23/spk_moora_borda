<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // 1. Ambil Elemen
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        // 2. Cek Status Terakhir di LocalStorage
        // Jika statusnya 'tutup', kita tambahkan class 'toggled' biar CSS menyembunyikannya
        if (localStorage.getItem('status_sidebar') === 'tutup') {
            el.classList.add("toggled");
        }

        // 3. Fungsi Klik Tombol
        toggleButton.onclick = function (e) {
            e.preventDefault(); // Mencegah loncat ke atas page
            
            // Tambah/Hapus class 'toggled' pada wrapper
            el.classList.toggle("toggled");

            // 4. Simpan status terbaru
            if (el.classList.contains("toggled")) {
                // Jika sekarang tertutup, simpan 'tutup'
                localStorage.setItem('status_sidebar', 'tutup');
            } else {
                // Jika sekarang terbuka, hapus status (kembali default)
                localStorage.removeItem('status_sidebar');
            }
        };
    </script>
</body>
</html>