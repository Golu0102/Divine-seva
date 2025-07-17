<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Divine Seva')</title>

    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&family=Laila:wght@500;700&display=swap"
        rel="stylesheet">
    <!-- Font Awesome CDN -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])


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
    <!-- Floating Call & WhatsApp Buttons -->
    <style>
        .floating-button {
            position: fixed;
            bottom: 20px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            cursor: pointer;
            animation: pulse 2s infinite;
        }

        .call-button {
            left: 20px;
            background-color: #ff5722;
            color: #fff;
        }

        .whatsapp-button {
            right: 20px;
            background-color: #25d366;
            color: #fff;
        }

        .floating-tooltip {
            position: absolute;
            top: -35px;
            white-space: nowrap;
            background-color: #fff;
            color: #000;
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 13px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
            display: none;
        }

        .floating-button:hover .floating-tooltip {
            display: block;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(0, 0, 0, 0.4);
            }

            70% {
                transform: scale(1.05);
                box-shadow: 0 0 0 10px rgba(0, 0, 0, 0);
            }

            100% {
                transform: scale(1);
                box-shadow: 0 0 0 0 rgba(0, 0, 0, 0);
            }
        }

        @media (max-width: 768px) {
            .floating-button {
                width: 60px;
                height: 60px;
                font-size: 20px;
            }

            .floating-tooltip {
                font-size: 12px;
                padding: 3px 8px;
            }
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
            const scrollAmount = 1; // pixels per frame
            let isPaused = false;

            // Duplicate the scroll items once to enable seamless loop
            if (wrapper.children.length > 0) {
                wrapper.innerHTML += wrapper.innerHTML;
            }

            // Pause on hover
            wrapper.addEventListener('mouseenter', () => isPaused = true);
            wrapper.addEventListener('mouseleave', () => isPaused = false);

            function scrollLoop() {
                if (!isPaused) {
                    wrapper.scrollLeft += scrollAmount;

                    // Reset scroll if we've scrolled through the first set
                    if (wrapper.scrollLeft >= wrapper.scrollWidth / 2) {
                        wrapper.scrollLeft = 0;
                    }
                }

                requestAnimationFrame(scrollLoop);
            }

            scrollLoop();
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
