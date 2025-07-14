<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Divine Seva')</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Laila:wght@500;700&display=swap"
        rel="stylesheet">
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #FFFBF5;
        }

        .font-laila {
            font-family: 'Laila', serif;
        }

        .text-brand-orange {
            color: #FF6D2E;
        }

        .bg-brand-orange {
            background-color: #FF6D2E;
        }

        .border-brand-orange {
            border-color: #FF6D2E;
        }

        .text-brand-maroon {
            color: #800000;
        }

        .bg-brand-maroon {
            background-color: #800000;
        }

        .section-title {
            @apply text-3xl md:text-4xl font-laila text-brand-maroon font-bold text-center;
        }

        .section-subtitle {
            @apply text-center text-gray-600 mt-2 max-w-2xl mx-auto;
        }

        #carousel-wrapper::-webkit-scrollbar {
            display: none;
        }
    </style>

    @stack('styles')
</head>

<body class="text-gray-800">

    <!-- Navbar -->
    @include('frontend.partials.navbar')

    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @include('frontend.partials.footer')

    <script>
        // Mobile Menu Toggle
        const toggle = document.getElementById('mobile-menu-button');
        const menu = document.getElementById('mobile-menu');
        if (toggle) {
            toggle.addEventListener('click', () => {
                menu.classList.toggle('hidden');
            });
        }

        // Close mobile menu on link click
        document.querySelectorAll('#mobile-menu a').forEach(link => {
            link.addEventListener('click', () => {
                menu.classList.add('hidden');
            });
        });

        lucide.createIcons();
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const wrapper = document.getElementById('carousel-wrapper');

            let scrollX = 0;
            const speed = 0.5;
            let isPaused = false;

            // Pause on hover
            wrapper.addEventListener('mouseenter', () => isPaused = true);
            wrapper.addEventListener('mouseleave', () => isPaused = false);

            function scrollLoop() {
                if (!isPaused) {
                    scrollX += speed;

                    if (scrollX >= wrapper.scrollWidth / 2) {
                        scrollX = 0;
                        wrapper.scrollLeft = 0;
                    }

                    wrapper.scrollLeft = scrollX;
                }

                requestAnimationFrame(scrollLoop);
            }

            requestAnimationFrame(scrollLoop);
        });
    </script>
    <script>
        document.querySelector('select[name="pooja_id"]').addEventListener('change', function() {
            const selectedId = this.value;
            const priceInput = document.getElementById('pooja-price');
            const wrapper = document.getElementById('price-wrapper');

            if (selectedId && poojaPrices[selectedId]) {
                priceInput.value = '₹ ' + poojaPrices[selectedId];
                wrapper.classList.remove('hidden');
            } else {
                priceInput.value = '';
                wrapper.classList.add('hidden');
            }
        });
    </script>
    <script>
        const panditSelect = document.getElementById('pandit-select');

        document.querySelector('select[name="pooja_id"]').addEventListener('change', function() {
            const poojaId = this.value;

            // Clear old options
            panditSelect.innerHTML = '<option value="">-- Select Pandit --</option>';

            if (poojaPanditsMap[poojaId]) {
                const pandits = poojaPanditsMap[poojaId];

                Object.entries(pandits).forEach(([id, name]) => {
                    const opt = document.createElement('option');
                    opt.value = id;
                    opt.textContent = name;
                    panditSelect.appendChild(opt);
                });
            }
        });
    </script>




    @stack('scripts')
</body>

</html>
