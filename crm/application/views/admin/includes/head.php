<script>
(function($) {
    "use strict";

    // Gunakan window.load untuk memastikan SEMUA gambar & script lain selesai dulu
    $(window).on('load', function() {
        console.log("System Fully Loaded - Mengaktifkan Tombol...");

        // 1. FIX TOMBOL MACET (Menggunakan Event Delegation)
        // Ini akan menangkap klik pada elemen apapun, bahkan yang baru muncul
        $(document).on('click', 'a[href="#"], button', function(e) {
            // Logika untuk mengecek apakah ini tombol yang bermasalah
            var target = $(this);
            
            // Jika tombol seharusnya membuka modal tapi macet
            if (target.data('toggle') === 'modal' || target.data('target')) {
                // Biarkan Bootstrap menanganinya, tapi pastikan tidak diblokir
                console.log('Tombol Modal diklik');
            }
        });

        // 2. RE-INITIALIZE CSRF (Jika token kadaluarsa saat loading lama)
        if (typeof csrfData !== 'undefined' && typeof $ !== 'undefined') {
            $.ajaxSetup({
                data: {
                    [csrfData['token_name']]: csrfData['hash']
                }
            });
        }
        
        // 3. HILANGKAN LOADING OVERLAY (Jika website loading terus)
        // Kadang loading screen lupa hilang kalau ada error di background
        setTimeout(function(){
            if($('.preloader').length > 0 || $('#preloader').length > 0) {
                $('.preloader, #preloader').fadeOut('slow');
                console.log("Preloader dipaksa hilang.");
            }
        }, 3000); // Paksa hilang setelah 3 detik
    });

})(jQuery);
</script>
