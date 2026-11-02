<footer class="ebook-footer">
    <div class="container-xl">

        <div class="footer-content">

            <!-- Brand -->
            <div class="footer-brand">
                <div class="footer-logo">
                    <img src="{{ asset('images/icon.png') }}" alt="icon">
                </div>

                <div>
                    <h3>Ebooks</h3>
                    <p>
                        Platform untuk mengelola dan membaca berbagai koleksi buku.
                    </p>
                </div>
            </div>

            <!-- Menu -->
            <div class="footer-menu">
                <h4>Menu</h4>

                <a href="#">Dashboard</a>
                <a href="#">Kategori Buku</a>
                <a href="#">Paket Langganan</a>
            </div>

            <!-- Informasi -->
            <div class="footer-menu">
                <h4>Informasi</h4>

                <a href="#">Documentation</a>
                <a href="#">License</a>
                <a href="#">Source Code</a>
            </div>

        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom">

            <span>
                © 2026 <strong>Ebooks</strong>. All rights reserved.
            </span>

            <span class="footer-version">
                Version 1.0.0
            </span>

        </div>

    </div>
</footer>


<style>

    /* ============================= */
    /* FOOTER */
    /* ============================= */

    .ebook-footer {
        margin-top: auto;
        padding-top: 14px;

        background: #182433;
        color: white;
    }


    /* ============================= */
    /* FOOTER CONTENT */
    /* ============================= */

    .footer-content {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr;
        gap: 40px;

        padding-bottom: 10px;
    }


    /* ============================= */
    /* BRAND */
    /* ============================= */

    .footer-brand {
        display: flex;
        align-items: flex-start;
        gap: 15px;
    }

    .footer-logo {
        width: 48px;
        height: 48px;

        display: flex;
        align-items: center;
        justify-content: center;

        background: #206bc4;
        border-radius: 12px;

        font-size: 24px;
    }

    .footer-brand h3 {
        margin: 0 0 5px;

        font-size: 22px;
        font-weight: 700;

    @media (max-width: 991px) {
        .footer-content {
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 18px 24px;
        }

        .footer-brand {
            grid-column: 1 / -1;
        }
    }

    @media (max-width: 575px) {
        .footer-content {
            gap: 16px;
        }

        .footer-brand {
            gap: 10px;
        }

        .footer-bottom {
            align-items: flex-start;
            flex-direction: column;
            gap: 8px;
        }
    }
    }

    .footer-brand p {
        max-width: 350px;

        margin: 0;

        color: #aeb9c8;
        font-size: 14px;
        line-height: 1.5;
    }


    /* ============================= */
    /* MENU */
    /* ============================= */

    .footer-menu {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .footer-menu h4 {
        margin: 0 0 4px;

        font-size: 15px;
        font-weight: 600;

        color: white;
    }

    .footer-menu a {
        width: fit-content;

        color: #aeb9c8;
        font-size: 14px;
        line-height: 1.3;

        text-decoration: none;

        transition: all 0.25s ease;
    }

    .footer-menu a:hover {
        color: white;
        transform: translateX(4px);
    }


    /* ============================= */
    /* FOOTER BOTTOM */
    /* ============================= */

    .footer-bottom {
        display: flex;
        align-items: center;
        justify-content: space-between;

        padding: 7px 0;

        border-top: 1px solid rgba(255, 255, 255, 0.1);

        color: #aeb9c8;
        font-size: 13px;
    }

    .footer-bottom strong {
        color: white;
    }


    /* ============================= */
    /* VERSION */
    /* ============================= */

    .footer-version {
        padding: 4px 8px;

        background: rgba(255, 255, 255, 0.08);

        border: 1px solid rgba(255, 255, 255, 0.1);

        border-radius: 6px;

        font-size: 12px;
    }


    /* ============================= */
    /* RESPONSIVE */
    /* ============================= */

    @media (max-width: 768px) {

        .ebook-footer {
            padding-top: 18px;
        }

        .footer-content {
            grid-template-columns: 1fr;
            gap: 16px;
        }

        .footer-bottom {
            flex-direction: column;
            gap: 8px;

            text-align: center;
        }

    }

</style>