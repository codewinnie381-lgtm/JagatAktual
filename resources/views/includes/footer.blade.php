<!-- Footer -->
<footer
    style="
        background-color: #0f172a;
        color: #ffffff;
        padding: 3rem 1rem 1rem;
        margin-top: 4rem;
    "
>
    <div
        style="
            max-width: 1200px;
            margin: 0 auto;
        "
    >
        <!-- Footer Content -->
        <div
            style="
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
                gap: 2rem;
                margin-bottom: 2rem;
            "
        >
            <!-- Tentang Kami -->
            <div>
                <h3
                    style="
                        font-size: 1.125rem;
                        font-weight: 600;
                        margin-bottom: 1rem;
                    "
                >
                    Tentang Kami
                </h3>
                <p
                    style="
                        color: rgba(255,255,255,0.8);
                        line-height: 1.6;
                        font-size: 0.95rem;
                    "
                >
                    Jagat Aktual adalah portal berita terpercaya yang menyajikan
                    informasi terkini dari berbagai kategori dengan sumber yang
                    kredibel.
                </p>
            </div>

            <!-- Kategori -->
            <div>
                <h3
                    style="
                        font-size: 1.125rem;
                        font-weight: 600;
                        margin-bottom: 1rem;
                    "
                >
                    Kategori
                </h3>
                <ul style="list-style: none; padding: 0; margin: 0;">
                    <li style="margin-bottom: 0.5rem;">
                        <a href="#" style="color: rgba(255,255,255,0.8); text-decoration: none;">
                            Olahraga
                        </a>
                    </li>
                    <li style="margin-bottom: 0.5rem;">
                        <a href="#" style="color: rgba(255,255,255,0.8); text-decoration: none;">
                            Hiburan
                        </a>
                    </li>
                    <li style="margin-bottom: 0.5rem;">
                        <a href="#" style="color: rgba(255,255,255,0.8); text-decoration: none;">
                            Politik
                        </a>
                    </li>
                    <li>
                        <a href="#" style="color: rgba(255,255,255,0.8); text-decoration: none;">
                            Teknologi
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Informasi -->
            <div>
                <h3
                    style="
                        font-size: 1.125rem;
                        font-weight: 600;
                        margin-bottom: 1rem;
                    "
                >
                    Informasi
                </h3>
                <ul style="list-style: none; padding: 0; margin: 0;">
                    <li style="margin-bottom: 0.5rem;">
                        <a href="#" style="color: rgba(255,255,255,0.8); text-decoration: none;">
                            Tentang Kami
                        </a>
                    </li>
                    <li style="margin-bottom: 0.5rem;">
                        <a href="#" style="color: rgba(255,255,255,0.8); text-decoration: none;">
                            Kontak
                        </a>
                    </li>
                    <li style="margin-bottom: 0.5rem;">
                        <a href="#" style="color: rgba(255,255,255,0.8); text-decoration: none;">
                            Kebijakan Privasi
                        </a>
                    </li>
                    <li>
                        <a href="#" style="color: rgba(255,255,255,0.8); text-decoration: none;">
                            Syarat & Ketentuan
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Sosial Media -->
            <div>
                <h3
                    style="
                        font-size: 1.125rem;
                        font-weight: 600;
                        margin-bottom: 1rem;
                    "
                >
                    Ikuti Kami
                </h3>
                <div style="display: flex; gap: 0.75rem;">
                    <a href="#" target="_blank">
                        <img src="{{ asset('assets/img/facebook.png') }}" alt="Facebook" style="width: 22px;">
                    </a>
                    <a href="#" target="_blank">
                        <img src="{{ asset('assets/img/instagram.png') }}" alt="Instagram" style="width: 22px;">
                    </a>
                </div>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div
            style="
                border-top: 1px solid rgba(255,255,255,0.1);
                padding-top: 1rem;
                text-align: center;
                color: rgba(255,255,255,0.6);
                font-size: 0.875rem;
            "
        >
            &copy; {{ date('Y') }} Jagat Aktual. All rights reserved.
        </div>
    </div>
</footer>
