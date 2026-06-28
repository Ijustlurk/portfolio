<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Commissions | Yan</title>
        <meta name="description" content="Yan digital illustration commissions sheet and calculator.">
        <link rel="icon" href="{{ asset('icons/ico.png') }}?v={{ time() }}">
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.cdnfonts.com/css/ibm-plex-mono-3" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600;700;800&family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">

        <!-- CSS -->
        <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ time() }}">

        <style>
            :root {
                --accent-purple: #c4b5fd;
                --accent-purple-glow: rgba(196, 181, 253, 0.4);
                --accent-purple-solid: #8b5cf6;
                --calc-bg: rgba(17, 24, 39, 0.6);
                --calc-border: rgba(255, 255, 255, 0.08);
            }

            body.dark-theme {
                --bg-color: #0b0f19;
                --bg-color-rgb: 11, 15, 25;
                --text-main: #f3f4f6;
                --text-muted: #9ca3af;
                --card-bg: rgba(17, 24, 39, 0.55);
                --calc-bg: rgba(17, 24, 39, 0.65);
                --calc-border: rgba(255, 255, 255, 0.08);
            }

            body {
                background-color: var(--bg-color);
                background-image: 
                    radial-gradient(rgba(255, 255, 255, 0.04) 1px, transparent 1px),
                    radial-gradient(circle at 10% 20%, rgba(255, 118, 117, 0.04) 0%, transparent 40%),
                    radial-gradient(circle at 90% 80%, rgba(116, 185, 255, 0.04) 0%, transparent 40%);
                background-size: 24px 24px, 100% 100%, 100% 100%;
                background-attachment: fixed;
                font-family: 'IBM Plex Mono', 'Consolas', 'Monaco', monospace !important;
                min-height: 100vh;
                margin: 0;
                padding: 0;
                display: flex;
                flex-direction: column;
            }

            body.light-theme {
                background-image: 
                    radial-gradient(rgba(0, 0, 0, 0.03) 1px, transparent 1px),
                    radial-gradient(circle at 10% 20%, rgba(255, 118, 117, 0.03) 0%, transparent 45%),
                    radial-gradient(circle at 90% 80%, rgba(116, 185, 255, 0.03) 0%, transparent 45%);
                --accent-purple: #7c3aed;
                --accent-purple-glow: rgba(124, 58, 237, 0.2);
                --accent-purple-solid: #6d28d9;
                --calc-bg: rgba(255, 255, 255, 0.7);
                --calc-border: rgba(0, 0, 0, 0.08);
            }

            .commission-wrapper {
                flex: 1;
                max-width: 1300px;
                width: 100%;
                margin: 0 auto;
                padding: 40px;
                display: grid;
                grid-template-columns: 1.1fr 1fr;
                gap: 40px;
                align-items: center;
            }

            @media (max-width: 992px) {
                .commission-wrapper {
                    grid-template-columns: 1fr;
                    padding: 30px 25px;
                    gap: 30px;
                }
            }

            @media (min-width: 993px) {
                .commission-wrapper {
                    height: 100vh;
                    box-sizing: border-box;
                    align-items: center;
                }

                .preview-container-col {
                    height: 100%;
                }

                .preview-static-wrap {
                    height: 90%;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: center;
                    width: 100%;
                }

                .preview-frame {
                    height: calc(100% - 30px);
                    width: auto;
                    max-width: 520px;
                    aspect-ratio: 3/4;
                }

                .calculator-card {
                    height: 90%;
                    overflow-y: auto;
                    padding-right: 18px; /* space for custom scrollbar */
                }

                /* Custom Scrollbar for Calculator Card */
                .calculator-card::-webkit-scrollbar {
                    width: 6px;
                }
                .calculator-card::-webkit-scrollbar-track {
                    background: transparent;
                }
                .calculator-card::-webkit-scrollbar-thumb {
                    background: rgba(139, 92, 246, 0.3);
                    border-radius: 99px;
                }
                .calculator-card::-webkit-scrollbar-thumb:hover {
                    background: rgba(139, 92, 246, 0.6);
                }
            }

            /* Preview Section */
            .preview-container-col {
                width: 100%;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
            }

            .preview-frame {
                position: relative;
                width: 100%;
                max-width: 520px;
                aspect-ratio: 3/4;
                border-radius: 20px;
                overflow: hidden;
                box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
                border: 4px solid transparent;
                background: linear-gradient(var(--card-bg), var(--card-bg)) padding-box,
                    linear-gradient(45deg, var(--accent-1), var(--accent-2), var(--accent-purple-solid), var(--accent-1)) border-box;
                background-size: 100% 100%, 400% 400%;
                animation: neonGlow 8s linear infinite;
            }

            .preview-image-wrapper {
                position: relative;
                width: 100%;
                height: 100%;
                overflow: hidden;
                display: flex;
                align-items: center;
                justify-content: center;
                background: rgba(0, 0, 0, 0.2);
            }

            .preview-image-wrapper img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                object-position: top;
                transition: opacity 0.4s cubic-bezier(0.4, 0, 0.2, 1), transform 0.4s ease;
                opacity: 0;
            }

            .preview-image-wrapper img.loaded {
                opacity: 1;
            }

            /* SVG Placeholder Visual */
            .placeholder-visual {
                position: absolute;
                inset: 0;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                padding: 40px;
                text-align: center;
                background: radial-gradient(circle, rgba(139, 92, 246, 0.08) 0%, transparent 70%);
                transition: opacity 0.4s ease;
            }

            .placeholder-visual svg {
                width: 64px;
                height: 64px;
                color: var(--accent-purple-solid);
                margin-bottom: 20px;
                opacity: 0.6;
                animation: float 4s ease-in-out infinite;
            }

            @keyframes float {
                0%, 100% { transform: translateY(0); }
                50% { transform: translateY(-8px); }
            }

            .placeholder-title {
                font-size: 1.1rem;
                font-weight: 700;
                color: var(--text-main);
                margin-bottom: 8px;
            }

            .placeholder-desc {
                font-size: 0.85rem;
                color: var(--text-muted);
                max-width: 280px;
                line-height: 1.5;
            }

            /* Calculator Card */
            .calculator-card {
                background: var(--calc-bg);
                backdrop-filter: blur(20px) saturate(180%);
                -webkit-backdrop-filter: blur(20px) saturate(180%);
                border: 1px solid var(--calc-border);
                border-radius: 24px;
                padding: 24px 28px;
                box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
                display: flex;
                flex-direction: column;
                gap: 16px;
            }

            @media (max-width: 576px) {
                .calculator-card {
                    padding: 20px;
                }
            }

            .calc-section-title {
                font-size: 0.78rem;
                font-weight: 700;
                letter-spacing: 0.15em;
                color: var(--text-muted);
                text-transform: uppercase;
                margin-bottom: 6px;
            }

            /* Render Quality Pills */
            .pills-container {
                display: flex;
                background: rgba(0, 0, 0, 0.2);
                border: 1px solid rgba(255, 255, 255, 0.05);
                border-radius: 99px;
                padding: 4px;
                gap: 4px;
                width: 100%;
            }

            body.light-theme .pills-container {
                background: rgba(0, 0, 0, 0.04);
                border-color: rgba(0, 0, 0, 0.05);
            }

            .pill-btn {
                flex: 1;
                background: transparent;
                border: none;
                color: var(--text-muted);
                font-family: 'IBM Plex Mono', monospace;
                font-size: 0.8rem;
                font-weight: 600;
                padding: 8px 12px;
                border-radius: 99px;
                cursor: pointer;
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .pill-btn.active {
                background: var(--accent-purple-solid);
                color: #ffffff;
                box-shadow: 0 4px 14px var(--accent-purple-glow);
            }

            /* Coverage Type Row */
            .coverage-grid {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                gap: 12px;
            }

            .coverage-card {
                background: rgba(0, 0, 0, 0.15);
                border: 1px solid rgba(255, 255, 255, 0.04);
                border-radius: 12px;
                padding: 10px 12px;
                text-align: center;
                cursor: pointer;
                transition: all 0.3s ease;
                display: flex;
                flex-direction: column;
                gap: 4px;
            }

            body.light-theme .coverage-card {
                background: rgba(0, 0, 0, 0.02);
                border-color: rgba(0, 0, 0, 0.04);
            }

            .coverage-card:hover {
                transform: translateY(-2px);
                border-color: rgba(139, 92, 246, 0.3);
            }

            .coverage-card.active {
                background: rgba(139, 92, 246, 0.05);
                border-color: var(--accent-purple-solid);
                box-shadow: 0 0 15px var(--accent-purple-glow);
            }

            .coverage-title {
                font-size: 0.88rem;
                font-weight: 700;
                color: var(--text-main);
            }

            .coverage-price {
                font-size: 0.72rem;
                color: var(--text-muted);
            }

            /* Add-on Options Toggles */
            .addons-grid {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 8px;
            }

            @media (max-width: 480px) {
                .addons-grid {
                    grid-template-columns: 1fr;
                }
            }

            .addon-item {
                display: flex;
                justify-content: space-between;
                align-items: center;
                background: rgba(0, 0, 0, 0.15);
                border: 1px solid rgba(255, 255, 255, 0.04);
                border-radius: 12px;
                padding: 8px 12px;
                transition: all 0.3s ease;
            }

            body.light-theme .addon-item {
                background: rgba(0, 0, 0, 0.02);
                border-color: rgba(0, 0, 0, 0.04);
            }

            .addon-item:hover {
                border-color: rgba(139, 92, 246, 0.25);
            }

            .addon-info {
                display: flex;
                flex-direction: column;
                gap: 2px;
                text-align: left;
            }

            .addon-label {
                font-size: 0.82rem;
                font-weight: 700;
                color: var(--text-main);
            }

            .addon-price {
                font-size: 0.7rem;
                color: var(--accent-purple-solid);
                font-weight: 600;
            }

            /* Switch styles */
            .switch {
                position: relative;
                display: inline-block;
                width: 38px;
                height: 22px;
                flex-shrink: 0;
            }

            .switch input {
                opacity: 0;
                width: 0;
                height: 0;
            }

            .slider {
                position: absolute;
                cursor: pointer;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: rgba(255, 255, 255, 0.15);
                border: 1px solid rgba(255, 255, 255, 0.05);
                transition: .3s;
                border-radius: 34px;
            }

            body.light-theme .slider {
                background-color: rgba(0, 0, 0, 0.1);
                border-color: transparent;
            }

            .slider:before {
                position: absolute;
                content: "";
                height: 14px;
                width: 14px;
                left: 3px;
                bottom: 3px;
                background-color: white;
                transition: .3s;
                border-radius: 50%;
            }

            .switch input:checked + .slider {
                background-color: var(--accent-purple-solid);
            }

            .switch input:checked + .slider:before {
                transform: translateX(16px);
            }

            /* Summary Details Box */
            .summary-box {
                background: rgba(0, 0, 0, 0.2);
                border: 1px solid rgba(255, 255, 255, 0.03);
                border-radius: 16px;
                padding: 16px 20px;
                position: relative;
                display: flex;
                flex-direction: column;
                gap: 10px;
            }

            body.light-theme .summary-box {
                background: rgba(0, 0, 0, 0.02);
                border-color: rgba(0, 0, 0, 0.04);
            }

            .summary-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 16px;
                flex-wrap: wrap;
            }

            .summary-price-wrap {
                display: flex;
                flex-direction: column;
            }

            .summary-price {
                font-size: 2.2rem;
                font-weight: 800;
                color: var(--text-main);
                line-height: 1;
            }

            .summary-delivery {
                font-size: 0.8rem;
                color: var(--text-muted);
                margin-top: 4px;
            }

            .slot-btn {
                background: var(--accent-purple-solid);
                color: #ffffff;
                text-decoration: none;
                font-size: 0.88rem;
                font-weight: 700;
                padding: 12px 24px;
                border-radius: 12px;
                box-shadow: 0 4px 15px var(--accent-purple-glow);
                transition: all 0.3s ease;
                display: inline-flex;
                align-items: center;
                gap: 6px;
                border: none;
                cursor: pointer;
            }

            .slot-btn:hover {
                transform: translateY(-2px);
                box-shadow: 0 6px 20px rgba(139, 92, 246, 0.4);
            }

            /* Tech Specs Row */
            .specs-row {
                display: flex;
                justify-content: space-between;
                gap: 16px;
                flex-wrap: wrap;
                font-size: 0.72rem;
                color: var(--text-muted);
            }

            .spec-item {
                display: flex;
                flex-direction: column;
                gap: 2px;
            }

            .spec-label {
                text-transform: uppercase;
                letter-spacing: 0.1em;
                opacity: 0.6;
            }

            .spec-value {
                font-weight: 700;
                color: var(--accent-purple-solid);
            }

            /* Floating Sample Badge */
            .preview-sample-badge {
                position: absolute;
                top: 16px;
                left: 16px;
                background: rgba(17, 24, 39, 0.7);
                color: #fff;
                font-size: 0.75rem;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 0.1em;
                padding: 6px 12px;
                border-radius: 20px;
                border: 1px solid rgba(255, 255, 255, 0.15);
                backdrop-filter: blur(10px);
                -webkit-backdrop-filter: blur(10px);
                z-index: 10;
                pointer-events: none;
                font-family: var(--font-mono);
            }

            /* Floating Full Image Preview Button */
            .full-preview-trigger {
                position: absolute;
                bottom: 16px;
                left: 50%;
                transform: translateX(-50%);
                background: rgba(139, 92, 246, 0.85);
                color: #fff;
                border: none;
                border-radius: 12px;
                padding: 8px 16px;
                font-size: 0.8rem;
                font-weight: 700;
                font-family: 'IBM Plex Mono', monospace;
                cursor: pointer;
                backdrop-filter: blur(8px);
                -webkit-backdrop-filter: blur(8px);
                box-shadow: 0 4px 15px rgba(139, 92, 246, 0.4);
                display: flex;
                align-items: center;
                gap: 6px;
                z-index: 10;
                transition: all 0.3s cubic-bezier(0.2, 0.8, 0.2, 1);
            }

            .full-preview-trigger:hover {
                background: rgba(139, 92, 246, 1);
                transform: translateX(-50%) translateY(-2px);
                box-shadow: 0 6px 20px rgba(139, 92, 246, 0.6);
            }

            /* Sleek Image Lightbox Modal */
            .lightbox-modal {
                display: none;
                position: fixed;
                z-index: 99999;
                left: 0;
                top: 0;
                width: 100vw;
                height: 100vh;
                background-color: rgba(11, 15, 25, 0.9);
                backdrop-filter: blur(15px);
                -webkit-backdrop-filter: blur(15px);
                justify-content: center;
                align-items: center;
            }

            .lightbox-content {
                max-width: 90%;
                max-height: 90vh;
                object-fit: contain;
                border-radius: 12px;
                border: 1px solid rgba(255, 255, 255, 0.1);
                box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.8);
                transform: scale(0.95);
                opacity: 0;
                transition: transform 0.3s cubic-bezier(0.2, 0.8, 0.2, 1), opacity 0.3s ease;
            }

            .lightbox-modal.active {
                display: flex;
            }

            .lightbox-modal.active .lightbox-content {
                transform: scale(1);
                opacity: 1;
            }

            .lightbox-close {
                position: absolute;
                top: 24px;
                right: 32px;
                color: var(--text-muted);
                font-size: 2.5rem;
                font-weight: 300;
                cursor: pointer;
                transition: color 0.2s;
            }

            .lightbox-close:hover {
                color: #fff;
            }
        </style>
    </head>
    <body class="loading-active">
        <!-- Floating Dark/Light Toggle -->
        <div class="theme-toggle-container" style="position: absolute; top: 25px; right: 25px; z-index: 1000;">
            <button id="theme-toggle" class="theme-toggle-btn" aria-label="Toggle Dark Mode">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="theme-toggle-icon">
                    <mask id="moon-mask">
                        <rect x="0" y="0" width="24" height="24" fill="white" />
                        <circle cx="25" cy="5" r="8" fill="black" class="mask-circle" />
                    </mask>
                    <circle cx="12" cy="12" r="5" fill="currentColor" mask="url(#moon-mask)" class="theme-toggle-center" />
                    <g class="theme-toggle-rays" stroke="currentColor">
                        <line x1="12" y1="1" x2="12" y2="3" />
                        <line x1="12" y1="21" x2="12" y2="23" />
                        <line x1="4.22" y1="4.22" x2="5.64" y2="5.64" />
                        <line x1="18.36" y1="18.36" x2="19.78" y2="19.78" />
                        <line x1="1" y1="12" x2="3" y2="12" />
                        <line x1="21" y1="12" x2="23" y2="12" />
                        <line x1="4.22" y1="19.78" x2="5.64" y2="18.36" />
                        <line x1="18.36" y1="5.64" x2="19.78" y2="4.22" />
                    </g>
                </svg>
            </button>
        </div>



        <div class="commission-wrapper">
            <!-- Left Column: Image Artwork Previews -->
            <div class="preview-container-col">
                <div class="preview-static-wrap">
                    <div class="calc-section-title" style="margin-bottom: 10px; width: 100%; max-width: 520px; text-align: left; font-weight: 800; letter-spacing: 0.15em;">Sample</div>
                    <div class="preview-frame">
                        <div class="preview-image-wrapper">
                            <div class="preview-sample-badge">Sample</div>
                            <img id="tier-preview-image" src="" alt="Commission Preview">
                            
                            <!-- Floating Full Preview Button -->
                            <button id="btn-full-preview" class="full-preview-trigger" onclick="openCommissionLightbox()" style="display: none;">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M15 3h6v6M9 21H3v-6M21 3l-7 7M3 21l7-7"/></svg>
                                View Full Image
                            </button>

                            <!-- Premium SVG Placeholder -->
                            <div id="tier-preview-placeholder" class="placeholder-visual" style="display: none;">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                    <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                    <polyline points="21 15 16 10 5 21"></polyline>
                                </svg>
                                <div class="placeholder-title" id="placeholder-tier-title">Preview Sample</div>
                                <div class="placeholder-desc">No illustration has been uploaded for this option yet. Samples will show up here once available.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Calculator Card -->
            <div class="calculator-card">
                <!-- Service Type Selector -->
                <div>
                    <div class="calc-section-title">Service Type</div>
                    <div class="pills-container" style="margin-bottom: 8px;">
                        <button class="pill-btn active" data-service="illustration" onclick="selectService('illustration')">Illustration</button>
                        <button class="pill-btn" data-service="char_sheet" onclick="selectService('char_sheet')">Character Sheet</button>
                        <button class="pill-btn" data-service="comic" onclick="selectService('comic')">Comic Page</button>
                    </div>
                </div>

                <!-- Presets (Illustration only) -->
                <div id="sec-presets">
                    <div class="calc-section-title">Illustration Preset</div>
                    <div style="display: flex; gap: 20px; padding: 8px 14px; font-size: 0.8rem; font-family: var(--font-mono); align-items: center; background: rgba(0, 0, 0, 0.15); border: 1px solid rgba(255, 255, 255, 0.04); border-radius: 12px; margin-bottom: 4px;">
                        <label style="display: flex; align-items: center; gap: 6px; cursor: pointer; color: var(--text-main); font-weight: 500;">
                            <input type="radio" name="preset" value="custom" checked onclick="selectPreset('custom')" style="accent-color: var(--accent-purple-solid); cursor: pointer;"> Custom
                        </label>
                        <label style="display: flex; align-items: center; gap: 6px; cursor: pointer; color: var(--text-main); font-weight: 500;">
                            <input type="radio" name="preset" value="book_cover" onclick="selectPreset('book_cover')" style="accent-color: var(--accent-purple-solid); cursor: pointer;"> Book Cover
                        </label>
                        <label style="display: flex; align-items: center; gap: 6px; cursor: pointer; color: var(--text-main); font-weight: 500;">
                            <input type="radio" name="preset" value="splash_art" onclick="selectPreset('splash_art')" style="accent-color: var(--accent-purple-solid); cursor: pointer;"> Splash Art
                        </label>
                    </div>
                </div>

                <!-- Render Quality -->
                <div id="sec-quality">
                    <div class="calc-section-title">Render Quality</div>
                    <div class="pills-container">
                        <button class="pill-btn" data-quality="sketch" onclick="selectQuality('sketch')">Sketch</button>
                        <button class="pill-btn" data-quality="flat_color" onclick="selectQuality('flat_color')">Flat Color</button>
                        <button class="pill-btn" data-quality="fully_rendered" onclick="selectQuality('fully_rendered')">Fully Rendered</button>
                    </div>
                </div>

                <!-- Coverage Type -->
                <div id="sec-coverage">
                    <div class="calc-section-title">Coverage Type</div>
                    <div class="coverage-grid">
                        <div class="coverage-card" data-coverage="headshot" onclick="selectCoverage('headshot')">
                            <span class="coverage-title">Headshot</span>
                            <span class="coverage-price" id="price-headshot-badge">...</span>
                        </div>
                        <div class="coverage-card" data-coverage="bust" onclick="selectCoverage('bust')">
                            <span class="coverage-title">Bust</span>
                            <span class="coverage-price" id="price-bust-badge">...</span>
                        </div>
                        <div class="coverage-card" data-coverage="full_body" onclick="selectCoverage('full_body')">
                            <span class="coverage-title">Full-Body</span>
                            <span class="coverage-price" id="price-full_body-badge">...</span>
                        </div>
                    </div>
                </div>

                <!-- Add-on Toggles -->
                <div id="sec-addons">
                    <div class="calc-section-title">Toggles & Add-ons</div>
                    <div class="addons-grid">
                        <!-- Detailed BG Toggle -->
                        <div class="addon-item" id="addon-item-bg">
                            <div class="addon-info">
                                <span class="addon-label">Detailed Background</span>
                                <span class="addon-price" id="addon-bg-price">...</span>
                            </div>
                            <label class="switch">
                                <input type="checkbox" id="toggle-bg" onchange="handleToggleChange()">
                                <span class="slider"></span>
                            </label>
                        </div>
                        <!-- Source File Toggle -->
                        <div class="addon-item" id="addon-item-source">
                            <div class="addon-info">
                                <span class="addon-label">Source File (.PSD)</span>
                                <span class="addon-price" id="addon-source-price">...</span>
                            </div>
                            <label class="switch">
                                <input type="checkbox" id="toggle-source" onchange="handleToggleChange()">
                                <span class="slider"></span>
                            </label>
                        </div>
                        <!-- Urgent Delivery Toggle -->
                        <div class="addon-item" id="addon-item-urgent">
                            <div class="addon-info">
                                <span class="addon-label">Urgent Delivery</span>
                                <span class="addon-price" id="addon-urgent-price">...</span>
                            </div>
                            <label class="switch">
                                <input type="checkbox" id="toggle-urgent" onchange="handleToggleChange()">
                                <span class="slider"></span>
                            </label>
                        </div>
                        <!-- Commercial License Toggle -->
                        <div class="addon-item" id="addon-item-commercial">
                            <div class="addon-info">
                                <span class="addon-label">Commercial License</span>
                                <span class="addon-price" id="addon-commercial-price">...</span>
                            </div>
                            <label class="switch">
                                <input type="checkbox" id="toggle-commercial" onchange="handleToggleChange()">
                                <span class="slider"></span>
                            </label>
                        </div>

                        <!-- NSFW Toggle -->
                        <div class="addon-item" id="addon-item-nsfw">
                            <div class="addon-info">
                                <span class="addon-label">NSFW / Mature Content</span>
                                <span class="addon-price" id="addon-nsfw-price">...</span>
                            </div>
                            <label class="switch">
                                <input type="checkbox" id="toggle-nsfw" onchange="handleToggleChange()">
                                <span class="slider"></span>
                            </label>
                        </div>
                        
                        <!-- Additional Characters Toggle (Illustration Mode Only) -->
                        <div class="addon-item" id="addon-item-additional-char" style="grid-column: span 2; display: flex; flex-direction: column; align-items: stretch; gap: 12px;">
                            <div style="display: flex; justify-content: space-between; align-items: center; width: 100%;">
                                <div class="addon-info">
                                    <span class="addon-label">Additional Characters</span>
                                    <span class="addon-price" id="addon-additional-char-price">...</span>
                                </div>
                                <label class="switch">
                                    <input type="checkbox" id="toggle-additional-char" onchange="toggleAdditionalCharInput(); handleToggleChange();">
                                    <span class="slider"></span>
                                </label>
                            </div>
                            <!-- Collapsible characters selector -->
                            <div id="additional-char-selector-block" style="display: none; padding-top: 10px; border-top: 1px dashed rgba(255, 255, 255, 0.08); flex-direction: column; gap: 10px;">
                                <div style="display: flex; align-items: center; justify-content: space-between; width: 100%;">
                                    <span style="font-size: 0.78rem; color: var(--text-muted);">Quantity (1 - 10):</span>
                                    <div style="display: flex; align-items: center; gap: 8px;">
                                        <button type="button" onclick="adjustCharCount(-1)" style="background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255,255,255,0.1); color: var(--text-main); font-family: var(--font-mono); width: 28px; height: 28px; border-radius: 6px; cursor: pointer; display: flex; align-items: center; justify-content: center; font-weight: bold; transition: all 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.2)'" onmouseout="this.style.background='rgba(255,255,255,0.1)'">-</button>
                                        <input type="number" id="additional-char-count" value="1" min="1" max="10" readonly style="width: 45px; text-align: center; background: rgba(0,0,0,0.3); border: 1px solid rgba(255, 255, 255, 0.1); color: var(--text-main); font-family: var(--font-mono); font-weight: bold; border-radius: 6px; padding: 4px; font-size: 0.85rem; -moz-appearance: textfield;">
                                        <button type="button" onclick="adjustCharCount(1)" style="background: rgba(255, 255, 255, 0.1); border: 1px solid rgba(255,255,255,0.1); color: var(--text-main); font-family: var(--font-mono); width: 28px; height: 28px; border-radius: 6px; cursor: pointer; display: flex; align-items: center; justify-content: center; font-weight: bold; transition: all 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.2)'" onmouseout="this.style.background='rgba(255,255,255,0.1)'">+</button>
                                    </div>
                                </div>
                                <div style="font-size: 0.68rem; color: #fde68a; font-family: var(--font-mono); text-align: left; line-height: 1.3;">
                                    ⚠️ Note: Additional characters will extend delivery duration.
                                </div>
                            </div>
                        </div>

                        <!-- With Graphic Toggle (Character Sheet Mode Only) -->
                        <div class="addon-item" id="addon-item-with-graphic" style="display: none;">
                            <div class="addon-info">
                                <span class="addon-label">With Graphic Design</span>
                                <span class="addon-price" id="addon-with-graphic-price">...</span>
                            </div>
                            <label class="switch">
                                <input type="checkbox" id="toggle-with-graphic" onchange="updateCalculator()">
                                <span class="slider"></span>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Summary Details -->
                <div class="summary-box" id="sec-summary">
                    <div class="summary-header" style="justify-content: center; text-align: center;">
                        <div class="summary-price-wrap" style="align-items: center; text-align: center; width: 100%;">
                            <span class="summary-price" id="tier-display-price">$0</span>
                            <div style="display: flex; flex-direction: column; margin-top: 4px; gap: 2px; align-items: center;">
                                <span class="summary-delivery" id="tier-display-delivery">Estimated Delivery: ...</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tech Specs & TOS link -->
                <div class="specs-row" id="sec-specs" style="align-items: flex-end;">
                    <div class="spec-item">
                        <span class="spec-label">Resolution</span>
                        <span class="spec-value" id="spec-resolution">...</span>
                    </div>
                    <div class="spec-item">
                        <span class="spec-label">DPI</span>
                        <span class="spec-value" id="spec-dpi">...</span>
                    </div>
                    <div class="spec-item">
                        <span class="spec-label">Tools</span>
                        <span class="spec-value" id="spec-tools">...</span>
                    </div>
                </div>

                <!-- Comic Page Inquiry Panel (Comic Mode Only) -->
                <div id="sec-comic-inquiry" style="display: none; background: rgba(0, 0, 0, 0.2); border: 1px solid rgba(255, 255, 255, 0.05); border-radius: 20px; padding: 30px; text-align: center; flex-direction: column; gap: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.15);">
                    <div style="background: radial-gradient(circle, rgba(196, 181, 253, 0.1) 0%, transparent 70%); padding: 15px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; align-self: center; margin-bottom: 5px;">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="var(--accent-purple-solid)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="animation: float 4s ease-in-out infinite;">
                            <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path>
                            <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path>
                        </svg>
                    </div>
                    <div>
                        <h4 style="font-family: var(--font-mono); font-size: 1rem; font-weight: 800; margin: 0 0 8px 0; text-transform: uppercase; color: var(--text-main);">Comic & Manga Pages</h4>
                        <p style="font-size: 0.8rem; color: var(--text-muted); line-height: 1.6; margin: 0;">
                            Comic page rates are custom quoted because every project is unique in its panel count, complexity, storyboarding, and background details. Let's discuss your project!
                        </p>
                    </div>
                    
                    <div style="display: flex; flex-direction: column; gap: 10px; width: 100%; margin-top: 5px;">
                        <a href="mailto:hello@yanillust.com?subject=Comic%20Page%20Commission%20Inquiry&body=Hello%20Yan%2C%0A%0AI%20am%20interested%20in%20commissioning%20a%20comic%2Fmanga%20page.%20Here%20are%20some%20details%20about%20my%20project%3A%0A%0A-%20Type%20of%20comic%3A%20%5BWebtoon%2C%20manga%2C%20western%20comic%5D%0A-%20Number%20of%20pages%20or%20panels%3A%20%5BQuantity%5D%0A-%20Story%2FScript%20Status%3A%20%5BReady%20%2F%20In-progress%5D%0A-%20Visual%20Style%3A%20%5BBlack%20%26%20white%2C%20flat%20color%2C%20fully%20rendered%5D%0A%0AProject%20Brief%3A%20%5BDescription%5D%0A%0ALooking%20forward%20to%20your%20reply%21" class="slot-btn" style="justify-content: center; width: 100%; box-sizing: border-box;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 4px;"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                            Inquire via Email
                        </a>
                        <a href="https://twitter.com/yanillust" target="_blank" class="btn btn-secondary" style="justify-content: center; width: 100%; box-sizing: border-box; font-size: 0.88rem; font-weight: 700; padding: 12px 24px; border-radius: 12px; border-color: rgba(255,255,255,0.15); display: inline-flex; align-items: center; gap: 8px;">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 4px;"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>
                            Message on Twitter / X
                        </a>
                    </div>
                </div>

                <!-- TOS button link -->
                <div style="text-align: center; border-top: 1px solid rgba(255, 255, 255, 0.05); padding-top: 10px; margin-top: 4px;">
                    <button onclick="openTosModal()" style="background: none; border: none; color: var(--text-muted); text-decoration: underline; font-family: var(--font-mono); font-size: 0.72rem; cursor: pointer; transition: color 0.3s;" onmouseover="this.style.color='var(--accent-purple-solid)'" onmouseout="this.style.color='var(--text-muted)'">
                        Terms of Service (TOS)
                    </button>
                </div>
            </div>
        </div>

        <!-- TOS MODAL -->
        <div class="modal" id="tos-modal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.8); backdrop-filter: blur(10px); z-index: 10000; align-items: center; justify-content: center;">
            <div style="background: var(--card-bg); border: 1px solid var(--calc-border); border-radius: 20px; padding: 40px; max-width: 600px; width: 90%; max-height: 80vh; overflow-y: auto; text-align: left; box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 1px solid rgba(255,255,255,0.08); padding-bottom: 10px;">
                    <h3 style="margin: 0; font-family: var(--font-mono); font-size: 1.2rem; font-weight: 800; color: var(--text-main); text-transform: uppercase;">Commission Terms of Service</h3>
                    <button onclick="closeTosModal()" style="background: none; border: none; color: var(--text-muted); font-size: 1.5rem; cursor: pointer;">×</button>
                </div>
                <div style="font-family: var(--font-sans); font-size: 0.9rem; color: var(--text-muted); line-height: 1.65; display: flex; flex-direction: column; gap: 15px;">
                    <p><strong>1. General Terms</strong><br>By requesting a commission, you agree to the terms listed below. All artworks are for personal use unless commercial rights are purchased.</p>
                    <p><strong>2. Payment & Process</strong><br>Full payment or a 50% deposit is required before commencing work. The artist will provide sketches for approval before finalizing lineart and colors.</p>
                    <p><strong>3. Revisions</strong><br>Each tier includes a set number of major revisions. Additional edits after the rendering phase may incur extra fees.</p>
                    <p><strong>4. Copyright & Commercial Use</strong><br>The artist retains copyright over the original creation. Commercial license enables use for promotions, merchandising, or streaming, but credit must be attributed to Yan.</p>
                    <p style="color: var(--accent-purple-solid); font-weight: bold; font-family: var(--font-mono); font-size: 0.8rem; margin-top: 15px;">💡 Terms of Service placeholder. The artist will provide the updated detailed text later.</p>
                </div>
                <div style="display: flex; justify-content: flex-end; margin-top: 30px; border-top: 1px solid rgba(255,255,255,0.08); padding-top: 15px;">
                    <button onclick="closeTosModal()" class="slot-btn" style="padding: 10px 20px; font-size: 0.8rem;">I Understand</button>
                </div>
            </div>
        </div>

        <script>
            // Theme script
            const themeToggle = document.getElementById('theme-toggle');
            themeToggle.addEventListener('click', () => {
                document.body.classList.toggle('dark-theme');
                document.body.classList.toggle('light-theme');
                const isDark = document.body.classList.contains('dark-theme');
                localStorage.setItem('theme', isDark ? 'dark' : 'light');
            });

            // Sync toggle UI
            const isLight = document.body.classList.contains('light-theme');
            if (isLight) {
                document.body.classList.remove('dark-theme');
            } else {
                document.body.classList.add('dark-theme');
            }

            // Commission Data passed from controller
            const tiersData = @json($tiers);
            const multipliers = @json($multipliers);

            // Selections State
            let currentService = 'illustration';
            let currentQuality = 'fully_rendered';
            let currentCoverage = 'full_body';

            function formatLabel(str) {
                return str.split('_')
                    .map(word => word.charAt(0).toUpperCase() + word.slice(1))
                    .join(' ')
                    .replace('Full Body', 'Full-Body');
            }

            function selectService(service) {
                currentService = service;
                
                // Toggle visibility of panels depending on service type
                const secPresets = document.getElementById('sec-presets');
                const secQuality = document.getElementById('sec-quality');
                const secCoverage = document.getElementById('sec-coverage');
                const secAddons = document.getElementById('sec-addons');
                const secSummary = document.getElementById('sec-summary');
                const secSpecs = document.getElementById('sec-specs');
                const secComicInquiry = document.getElementById('sec-comic-inquiry');
                
                // Addon items toggles
                const addonBg = document.getElementById('addon-item-bg');
                const addonAddChar = document.getElementById('addon-item-additional-char');
                const addonWithGraphic = document.getElementById('addon-item-with-graphic');

                if (service === 'illustration') {
                    secPresets.style.display = 'block';
                    secQuality.style.display = 'block';
                    secCoverage.style.display = 'block';
                    secAddons.style.display = 'block';
                    secSummary.style.display = 'block';
                    secSpecs.style.display = 'flex';
                    secComicInquiry.style.display = 'none';
                    
                    addonBg.style.display = 'flex';
                    addonAddChar.style.display = 'flex';
                    addonWithGraphic.style.display = 'none';
                } else if (service === 'char_sheet') {
                    secPresets.style.display = 'none';
                    secQuality.style.display = 'block';
                    secCoverage.style.display = 'none';
                    secAddons.style.display = 'block';
                    secSummary.style.display = 'block';
                    secSpecs.style.display = 'flex';
                    secComicInquiry.style.display = 'none';
                    
                    addonBg.style.display = 'none';
                    addonAddChar.style.display = 'none';
                    addonWithGraphic.style.display = 'flex';
                } else if (service === 'comic') {
                    secPresets.style.display = 'none';
                    secQuality.style.display = 'none';
                    secCoverage.style.display = 'none';
                    secAddons.style.display = 'none';
                    secSummary.style.display = 'none';
                    secSpecs.style.display = 'none';
                    secComicInquiry.style.display = 'flex';
                }

                // Update active class on Service pills
                document.querySelectorAll('[data-service]').forEach(btn => {
                    if (btn.getAttribute('data-service') === service) {
                        btn.classList.add('active');
                    } else {
                        btn.classList.remove('active');
                    }
                });

                // Reset specific toggles on view change
                if (service === 'char_sheet') {
                    document.getElementById('toggle-bg').checked = false;
                    document.getElementById('toggle-additional-char').checked = false;
                    toggleAdditionalCharInput();
                } else if (service === 'illustration') {
                    document.getElementById('toggle-with-graphic').checked = false;
                    // Reset preset selector to Custom
                    const customRadio = document.querySelector('input[name="preset"][value="custom"]');
                    if (customRadio) customRadio.checked = true;
                }

                updateCalculator();
            }

            function selectPreset(preset) {
                if (preset === 'book_cover') {
                    currentQuality = 'fully_rendered';
                    currentCoverage = 'full_body';
                    document.getElementById('toggle-bg').checked = true;
                    document.getElementById('toggle-commercial').checked = true;
                    document.getElementById('toggle-source').checked = true;
                    document.getElementById('toggle-additional-char').checked = false;
                    toggleAdditionalCharInput();
                } else if (preset === 'splash_art') {
                    currentQuality = 'fully_rendered';
                    currentCoverage = 'full_body';
                    document.getElementById('toggle-bg').checked = true;
                    document.getElementById('toggle-commercial').checked = true;
                    document.getElementById('toggle-source').checked = false;
                    document.getElementById('toggle-additional-char').checked = false;
                    toggleAdditionalCharInput();
                }
                updateCalculator();
            }

            function resetPresetRadio() {
                const radio = document.querySelector('input[name="preset"][value="custom"]');
                if (radio) radio.checked = true;
            }

            function handleToggleChange() {
                if (currentService === 'illustration') {
                    resetPresetRadio();
                }
                updateCalculator();
            }

            function selectQuality(quality) {
                currentQuality = quality;
                if (currentService === 'illustration') {
                    resetPresetRadio();
                }
                updateCalculator();
            }

            function selectCoverage(coverage) {
                currentCoverage = coverage;
                if (currentService === 'illustration') {
                    resetPresetRadio();
                }
                updateCalculator();
            }

            function openTosModal() {
                document.getElementById('tos-modal').style.display = 'flex';
            }

            // Sync with old calls just in case
            function closeTosModal() {
                document.getElementById('tos-modal').style.display = 'none';
            }

            function toggleAdditionalCharInput() {
                const checked = document.getElementById('toggle-additional-char').checked;
                const block = document.getElementById('additional-char-selector-block');
                if (checked) {
                    block.style.display = 'flex';
                } else {
                    block.style.display = 'none';
                }
            }

            function adjustCharCount(val) {
                const input = document.getElementById('additional-char-count');
                let count = parseInt(input.value) || 1;
                count += val;
                if (count < 1) count = 1;
                if (count > 10) count = 10;
                input.value = count;
                handleToggleChange();
            }

            function updateCalculator() {
                // Mute/Disable add-ons if Render Quality is Sketch or Flat Color
                const addOnToggles = [
                    'toggle-bg',
                    'toggle-source',
                    'toggle-urgent',
                    'toggle-commercial',
                    'toggle-nsfw',
                    'toggle-additional-char',
                    'toggle-with-graphic'
                ];
                const addOnItems = [
                    'addon-item-bg',
                    'addon-item-source',
                    'addon-item-urgent',
                    'addon-item-commercial',
                    'addon-item-nsfw',
                    'addon-item-additional-char',
                    'addon-item-with-graphic'
                ];

                if (currentQuality === 'sketch' || currentQuality === 'flat_color') {
                    addOnToggles.forEach(id => {
                        const el = document.getElementById(id);
                        if (el) {
                            el.checked = false;
                            el.disabled = true;
                        }
                    });
                    addOnItems.forEach(id => {
                        const el = document.getElementById(id);
                        if (el) {
                            el.style.opacity = '0.35';
                            el.style.pointerEvents = 'none';
                        }
                    });
                    const additionalCharBlock = document.getElementById('additional-char-selector-block');
                    if (additionalCharBlock) {
                        additionalCharBlock.style.display = 'none';
                    }
                } else {
                    addOnToggles.forEach(id => {
                        const el = document.getElementById(id);
                        if (el) {
                            el.disabled = false;
                        }
                    });
                    addOnItems.forEach(id => {
                        const el = document.getElementById(id);
                        if (el) {
                            el.style.opacity = '1';
                            el.style.pointerEvents = 'auto';
                        }
                    });
                }

                // Update active state in Quality pills UI
                document.querySelectorAll('[data-quality]').forEach(btn => {
                    if (btn.getAttribute('data-quality') === currentQuality) {
                        btn.classList.add('active');
                    } else {
                        btn.classList.remove('active');
                    }
                });

                // Update active state in Coverage cards UI
                document.querySelectorAll('.coverage-card').forEach(card => {
                    if (card.getAttribute('data-coverage') === currentCoverage) {
                        card.classList.add('active');
                    } else {
                        card.classList.remove('active');
                    }
                });

                // Render dynamic base pricing on badges inside coverage selection
                document.querySelectorAll('.coverage-card').forEach(card => {
                    const cov = card.getAttribute('data-coverage');
                    const matchingTier = tiersData.find(t => t.render_quality === currentQuality && t.coverage_type === cov);
                    const badge = card.querySelector('.coverage-price');
                    if (matchingTier && badge) {
                        badge.textContent = `$${matchingTier.price}+`;
                    }
                });

                // Find currently selected base price and specs details
                let basePrice = 0;
                let deliveryTime = '';
                let tier = null;
                
                if (currentService === 'illustration') {
                    tier = tiersData.find(t => t.render_quality === currentQuality && t.coverage_type === currentCoverage);
                    if (tier) {
                        basePrice = tier.price;
                        deliveryTime = tier.delivery_time;
                    }
                } else if (currentService === 'char_sheet') {
                    // Base price comes from Character Sheet base rate settings
                    if (currentQuality === 'sketch') {
                        basePrice = multipliers.char_sheet_sketch;
                    } else if (currentQuality === 'flat_color') {
                        basePrice = multipliers.char_sheet_flat_color;
                    } else if (currentQuality === 'fully_rendered') {
                        basePrice = multipliers.char_sheet_fully_rendered;
                    }
                    // Specs and delivery time default to the full_body tier specs for active quality
                    tier = tiersData.find(t => t.render_quality === currentQuality && t.coverage_type === 'full_body');
                    if (tier) {
                        deliveryTime = tier.delivery_time;
                    }
                }

                // If Comic Page is selected, customize preview card and exit calculation
                if (currentService === 'comic') {
                    const imgEl = document.getElementById('tier-preview-image');
                    const placeholderEl = document.getElementById('tier-preview-placeholder');
                    const btnFullPreview = document.getElementById('btn-full-preview');
                    if (btnFullPreview) btnFullPreview.style.display = 'none';
                    
                    imgEl.classList.remove('loaded');
                    setTimeout(() => {
                        imgEl.style.display = 'none';
                        document.getElementById('placeholder-tier-title').textContent = "Comic & Manga Pages";
                        placeholderEl.querySelector('.placeholder-desc').textContent = "Discuss panel layouts, storyboarding, script development, and color options directly with the artist.";
                        placeholderEl.style.display = 'flex';
                    }, 150);
                    return;
                }

                if (!tier) return;

                // Calculate add-on costs dynamically in JS
                const bgPct = multipliers.detailed_bg;
                const sourcePct = multipliers.source_file;
                const urgentPct = multipliers.urgent;
                const commPct = multipliers.commercial;
                const addCharPct = multipliers.additional_char;
                const withGraphicPct = multipliers.with_graphic;
                const nsfwPrice = multipliers.nsfw;

                const bgPrice = Math.round(basePrice * bgPct / 100);
                const sourcePrice = Math.round(basePrice * sourcePct / 100);
                const urgentPrice = Math.round(basePrice * urgentPct / 100);
                const commPrice = Math.round(basePrice * commPct / 100);
                const addCharPrice = Math.round(basePrice * addCharPct / 100);
                const withGraphicPrice = Math.round(basePrice * withGraphicPct / 100);

                // Update UI prices
                const formattedBgPrice = multipliers.detailed_bg > 0 ? `+$${bgPrice}` : 'FREE';
                const formattedSourcePrice = multipliers.source_file > 0 ? `+$${sourcePrice}` : 'FREE';
                const formattedUrgentPrice = multipliers.urgent > 0 ? `+$${urgentPrice}` : 'FREE';
                const formattedCommPrice = multipliers.commercial > 0 ? `+$${commPrice}` : 'FREE';
                const formattedAddCharPrice = multipliers.additional_char > 0 ? `+$${addCharPrice}` : 'FREE';
                const formattedWithGraphicPrice = multipliers.with_graphic > 0 ? `+$${withGraphicPrice}` : 'FREE';
                const formattedNsfwPrice = multipliers.nsfw > 0 ? `+$${nsfwPrice}` : 'FREE';

                document.getElementById('addon-bg-price').textContent = formattedBgPrice;
                document.getElementById('addon-source-price').textContent = formattedSourcePrice;
                document.getElementById('addon-urgent-price').textContent = formattedUrgentPrice;
                document.getElementById('addon-commercial-price').textContent = formattedCommPrice;
                document.getElementById('addon-additional-char-price').textContent = formattedAddCharPrice;
                document.getElementById('addon-with-graphic-price').textContent = formattedWithGraphicPrice;
                document.getElementById('addon-nsfw-price').textContent = formattedNsfwPrice;

                // Start building calculations
                let totalPrice = basePrice;
                let activeAddonsList = [];

                if (document.getElementById('toggle-bg').checked) {
                    totalPrice += bgPrice;
                    activeAddonsList.push('Detailed Background');
                }
                if (document.getElementById('toggle-source').checked) {
                    totalPrice += sourcePrice;
                    activeAddonsList.push('Source File (.PSD)');
                }
                if (document.getElementById('toggle-urgent').checked) {
                    totalPrice += urgentPrice;
                    activeAddonsList.push('Urgent Delivery');
                }
                if (document.getElementById('toggle-commercial').checked) {
                    totalPrice += commPrice;
                    activeAddonsList.push('Commercial License');
                }
                if (document.getElementById('toggle-nsfw').checked) {
                    totalPrice += nsfwPrice;
                    activeAddonsList.push('NSFW / Mature Content');
                }
                if (currentService === 'illustration' && document.getElementById('toggle-additional-char').checked) {
                    const countInput = document.getElementById('additional-char-count');
                    const charCount = parseInt(countInput.value || 1);
                    totalPrice += (addCharPrice * charCount);
                    activeAddonsList.push(`Additional Characters (x${charCount})`);
                }
                if (currentService === 'char_sheet' && document.getElementById('toggle-with-graphic').checked) {
                    totalPrice += withGraphicPrice;
                    activeAddonsList.push('With Graphic Design');
                }

                // Render Summary Panel
                document.getElementById('tier-display-price').textContent = `$${totalPrice}`;

                // Delivery duration calculation details
                let deliveryText = `Estimated Delivery: ${deliveryTime}`;
                if (document.getElementById('toggle-urgent').checked) {
                    // Reduce duration if urgent is active
                    deliveryText = 'Estimated Delivery: 3-5 Days (Express)';
                }
                document.getElementById('tier-display-delivery').textContent = deliveryText;

                // Update Specs
                document.getElementById('spec-resolution').textContent = tier.resolution;
                document.getElementById('spec-dpi').textContent = `${tier.dpi} DPI`;
                document.getElementById('spec-tools').textContent = tier.tools;

                // Update Artwork Previews
                const imgEl = document.getElementById('tier-preview-image');
                const placeholderEl = document.getElementById('tier-preview-placeholder');

                const qLabel = formatLabel(currentQuality);
                const cLabel = currentService === 'illustration' ? formatLabel(currentCoverage) : 'Full-Body';

                if (tier.image_path) {
                    const imageSrc = tier.image_path.startsWith('http') 
                        ? tier.image_path 
                        : `{{ asset('storage') }}/${tier.image_path}`;

                    imgEl.classList.remove('loaded');
                    const btnFullPreview = document.getElementById('btn-full-preview');
                    setTimeout(() => {
                        imgEl.onload = () => {
                            imgEl.classList.add('loaded');
                        };
                        imgEl.src = imageSrc;
                        placeholderEl.style.display = 'none';
                        imgEl.style.display = 'block';
                        if (btnFullPreview) btnFullPreview.style.display = 'flex';
                        
                        if (imgEl.complete) {
                            imgEl.classList.add('loaded');
                        }
                    }, 150);
                } else {
                    imgEl.classList.remove('loaded');
                    const btnFullPreview = document.getElementById('btn-full-preview');
                    setTimeout(() => {
                        imgEl.style.display = 'none';
                        if (btnFullPreview) btnFullPreview.style.display = 'none';
                        const displayTitle = currentService === 'illustration' ? `${qLabel} ${cLabel}` : `${qLabel} Character Sheet`;
                        document.getElementById('placeholder-tier-title').textContent = displayTitle;
                        placeholderEl.style.display = 'flex';
                    }, 150);
                }
            }

            // Lightbox Control Functions
            function openCommissionLightbox() {
                const previewImg = document.getElementById('tier-preview-image');
                const lightbox = document.getElementById('commission-lightbox');
                const lightboxImg = document.getElementById('commission-lightbox-img');
                
                if (previewImg && previewImg.src && previewImg.style.display !== 'none') {
                    lightboxImg.src = previewImg.src;
                    lightbox.classList.add('active');
                    document.body.style.overflow = 'hidden';
                }
            }
            
            function closeCommissionLightbox() {
                const lightbox = document.getElementById('commission-lightbox');
                if (lightbox) {
                    lightbox.classList.remove('active');
                    document.body.style.overflow = '';
                }
            }

            // Trigger initial render
            document.addEventListener('DOMContentLoaded', () => {
                selectService('illustration');
            });
        </script>

        <!-- Image Lightbox Modal for Commission Preview -->
        <div id="commission-lightbox" class="lightbox-modal" onclick="closeCommissionLightbox()">
            <span class="lightbox-close" onclick="closeCommissionLightbox()">&times;</span>
            <img class="lightbox-content" id="commission-lightbox-img" onclick="event.stopPropagation()">
        </div>
    </body>
</html>
