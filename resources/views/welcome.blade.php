<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Portfolio | Yan - 2D Anime Style Illustrator & Comic Artist</title>
        <meta name="description" content="Portfolio of a 2D Anime Illustrator and Comic Artist.">
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <!-- Robust IBM Plex Mono CDNs -->
        <link href="https://fonts.cdnfonts.com/css/ibm-plex-mono-3" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=IBM+Plex+Serif:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:wght@300;400;500;600;700;800&family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">

        <!-- CSS -->
        <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ time() }}">

    </head>
    <body class="loading-active">
        <!-- Theme & Loader Initialization (Prevents Flash of Wrong Theme & Skips Loader) -->
        <script>
            (function() {
                const theme = localStorage.getItem('theme');
                if (theme === 'dark' || (!theme && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                    document.body.classList.add('dark-theme');
                }

                if (localStorage.getItem('hasVisited')) {
                    document.body.classList.remove('loading-active');
                    document.body.classList.add('app-loaded');
                    const style = document.createElement('style');
                    style.innerHTML = '#site-loader { display: none !important; }';
                    document.head.appendChild(style);
                }
            })();
        </script>

        <!-- Interactive Particle Background Canvas -->
        <canvas id="bg-canvas"></canvas>

        <!-- Site Loader -->
        <div id="site-loader" class="site-loader">
            <div class="loader-content">
                <div class="loader-logo">YAN</div>
                <div class="loader-progress-container">
                    <div class="loader-progress-bar" id="loader-progress-bar"></div>
                </div>
                <div class="loader-status-row">
                    <span class="loader-status-text" id="loader-status-text">INITIALIZING SYSTEM...</span>
                    <span class="loader-percentage" id="loader-percentage">00%</span>
                </div>
            </div>
        </div>

        <!-- Floating Dark Mode Toggle -->
        <div class="theme-toggle-container">
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

        <!-- Clickable Right Sticky Sidebar Scroll Indicator -->
        <div class="sidebar-container">
            <div class="sidebar-line-container">
                <div class="sidebar-progress-line"></div>
            </div>
            <div class="sidebar-list">
                <a href="#home" class="sidebar-item" data-section="home">
                    <span class="sidebar-label">Home</span>
                    <div class="sidebar-dot"></div>
                </a>
                <a href="#about" class="sidebar-item" data-section="about">
                    <span class="sidebar-label">About</span>
                    <div class="sidebar-dot"></div>
                </a>
                <a href="#illustrations" class="sidebar-item" data-section="illustrations">
                    <span class="sidebar-label">Illustrations</span>
                    <div class="sidebar-dot"></div>
                </a>
                <a href="#comics" class="sidebar-item" data-section="comics">
                    <span class="sidebar-label">Comics</span>
                    <div class="sidebar-dot"></div>
                </a>
                <a href="#concepts" class="sidebar-item" data-section="concepts">
                    <span class="sidebar-label">Works</span>
                    <div class="sidebar-dot"></div>
                </a>
                <a href="#socials" class="sidebar-item" data-section="socials">
                    <span class="sidebar-label">Socials</span>
                    <div class="sidebar-dot"></div>
                </a>
            </div>
            <!-- Single active label for mobile view -->
            <div class="sidebar-active-label">Home</div>
        </div>

        <div id="app-wrapper">
        <!-- Hero Section -->
        <section id="home" class="hero">
            <div class="hero-content">
                <div class="hero-brand">
                    <span class="hero-japanese">「ヤンイラスト」</span>
                    <span class="hero-pretitle">YAN</span>
                    <h1 class="hero-title">WORKS<br>PORTFOLIO</h1>
                </div>
                <div class="hero-btns">
                    <a href="#illustrations" class="hero-badge">
                        2D Illustrator
                        <div class="badge-tooltip">
                            <div class="tooltip-header">
                                <span class="tooltip-term">2D Illustrator</span>
                                <span class="tooltip-phonetic">/ˌtuː diː ˈɪl.ʌs.treɪ.tər/</span>
                            </div>
                            <div class="tooltip-pos">noun.</div>
                            <p class="tooltip-def">A visual artist who creates two-dimensional drawings, designs, or digital artwork intended to clarify, decorate, or visually communicate concepts for media like books, comics, games, and web interfaces.</p>
                        </div>
                    </a>
                    <a href="#comics" class="hero-badge">
                        Comic Artist
                        <div class="badge-tooltip">
                            <div class="tooltip-header">
                                <span class="tooltip-term">Comic Artist</span>
                                <span class="tooltip-phonetic">/ˈkɒm.ɪk ˈɑːr.tɪst/</span>
                            </div>
                            <div class="tooltip-pos">noun.</div>
                            <p class="tooltip-def">A storytelling illustrator who crafts sequential visual narratives through panels — blending expressive character art, dynamic compositions, and deliberate pacing to bring manga, webtoons, and graphic novels to life.</p>
                        </div>
                    </a>
                    <a href="#" class="hero-badge">
                        Digital Artist
                        <div class="badge-tooltip">
                            <div class="tooltip-header">
                                <span class="tooltip-term">Digital Artist</span>
                                <span class="tooltip-phonetic">/ˈdɪdʒ.ɪ.tl ˈɑːr.tɪst/</span>
                            </div>
                            <div class="tooltip-pos">noun.</div>
                            <p class="tooltip-def">A creative professional who produces artwork using digital tools and software — merging traditional artistic sensibility with modern technology to craft illustrations, concepts, and immersive visual experiences across digital mediums.</p>
                        </div>
                    </a>
                </div>
            </div>
        </section>

        <!-- About Section -->
        <section id="about">
            <div class="about-container">
                <!-- Interactive 3D Profile Card -->
                <div class="about-card-wrapper">
                    <div class="about-card">
                        <div class="about-card-image">
                            @php
                                $isDefaultImage = $about->image_path === 'images/IMG_4171 2.png';
                                $imgUrl = str_starts_with($about->image_path, 'http') ? $about->image_path : ($isDefaultImage ? asset($about->image_path) : asset('storage/' . $about->image_path));
                            @endphp
                            <img src="{{ $imgUrl }}" alt="Artist Profile" style="transform: scale({{ $about->image_scale }}); object-position: calc(50% + {{ $about->image_offset_x }}px) calc(50% + {{ $about->image_offset_y }}px);">
                            <div class="about-card-image-overlay"></div>
                        </div>
                    </div>
                </div>


                <!-- Right-side Text Content -->
                <div class="about-content-right">
                    <h2 class="about-title">The Artist</h2>
                    
                    <div class="about-paragraphs">
                        {!! $about->text_content !!}
                    </div>

                    <h3 class="about-tools-title">My Tools</h3>
                    <div class="about-tools-row">
                        <div class="tool-icon-card" data-title="Clip Studio Paint">
                            <img src="{{ asset('icons/icons8-clip-studio-paint-50.svg') }}" alt="Clip Studio Paint">
                            <div class="tool-tooltip">
                                <div class="tooltip-header">
                                    <span class="tooltip-term">Clip Studio Paint</span>
                                </div>
                                <p class="tooltip-def">Clip Studio Paint is my main tool of the trade. I have more than 6 years of experience in this software. A versatile digital painting and illustration software application widely used by artists to create digital art, comics, manga, and 2D animations, known for its natural brush engine and specialized vector tools.</p>
                            </div>
                        </div>
                        <div class="tool-icon-card" data-title="Adobe Photoshop">
                            <img src="{{ asset('icons/adobe-photoshop-svgrepo-com.svg') }}" alt="Photoshop">
                            <div class="tool-tooltip">
                                <div class="tooltip-header">
                                    <span class="tooltip-term">Adobe Photoshop</span>
                                </div>
                                <p class="tooltip-def">I also have extensive experience in Adobe Photoshop. I've used it mostly as a post processing tool, thanks to its much more extensive array of tools. Although I prefer to use CSP as my rendering software.</p>
                            </div>
                        </div>
                        <div class="tool-icon-card" data-title="Adobe InDesign">
                            <img src="{{ asset('icons/adobe-indesign-logo-svgrepo-com.svg') }}" alt="InDesign">
                            <div class="tool-tooltip">
                                <div class="tooltip-header">
                                    <span class="tooltip-term">Adobe InDesign</span>
                                </div>
                                <p class="tooltip-def">I have experience in InDesign, although not as extensive as the other tools. I've used it to layout our local university publication's newsletters and design book covers.</p>
                            </div>
                        </div>
                        <div class="tool-icon-card" data-title="Figma">
                            <img src="{{ asset('icons/figma-logo-svgrepo-com.svg') }}" alt="Figma">
                            <div class="tool-tooltip">
                                <div class="tooltip-header">
                                    <span class="tooltip-term">Figma</span>
                                </div>
                                <p class="tooltip-def">I've designed a couple mockups in Figma, one for this portfolio website, one for my Capstone Project (mobile app and website). I wouldn't say I have mastered the tool but I can utilize it to some extent.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Illustrations Section -->
        <section id="illustrations">
            @if($settings['maintenance_illustration'])
                <div class="coming-soon-container">
                    <div class="coming-soon-card">
                        <span class="coming-soon-subtitle">Illustrations Section</span>
                        <h2 class="coming-soon-title">Coming Soon</h2>
                        <p class="coming-soon-desc">This section is currently under maintenance. We're cataloging new illustration works and will be back shortly!</p>
                    </div>
                </div>
            @else
                <div class="illustrations-title-container">
                    <h2 class="illustrations-title">Illustration Showcase</h2>
                    <div class="illustrations-progress-bar-container">
                        <div class="illustrations-progress-bar"></div>
                    </div>
                </div>
                
                <div class="illustrations-slider-container">
                    <div class="illustrations-slider" id="illustrations-slider">
                        <!-- Dynamically populated via JS -->
                    </div>
                </div>

                <!-- Category buttons row -->
                <div class="illustrations-btn-row">
                    <button class="illustrations-btn active" data-type="original">Original</button>
                    <button class="illustrations-btn" data-type="fanart">Fanart</button>
                    <button class="illustrations-btn locked" id="locked-btn" data-type="locked">
                        <span class="btn-content">
                            <svg class="lock-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="width: 18px; height: 18px; display: inline-block; vertical-align: middle;">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                            </svg>
                        </span>
                    </button>
                </div>
            @endif
        </section>

        <!-- Comics Section -->
        <section id="comics">
            @if($settings['maintenance_comic'])
                <div class="coming-soon-container">
                    <div class="coming-soon-card">
                        <span class="coming-soon-subtitle">Comics & Manga</span>
                        <h2 class="coming-soon-title">Coming Soon</h2>
                        <p class="coming-soon-desc">Our comics catalog is currently offline for layout updates. Stay tuned for new chapters and pages!</p>
                    </div>
                </div>
            @else
                <div class="comics-header">
                    <h2 class="comics-title">Comics and Manga</h2>
                    <div class="comics-progress-bar-container">
                        <div class="comics-progress-bar"></div>
                    </div>
                </div>
                
                <div class="comics-grid">
                    @foreach($comics as $comic)
                        <div class="comics-card">
                            <div class="comics-card-img-wrapper">
                                <img src="{{ $comic->image_url }}" alt="{{ $comic->title }}" class="comics-card-img">
                                <div class="comics-card-overlay">
                                    <a href="#" class="comics-read-btn" data-pages="{{ $comic->pages ? json_encode($comic->pages) : '[]' }}" data-direction="{{ $comic->reading_direction ?? 'ltr' }}">
                                        <svg class="eye-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        </svg>
                                        Read
                                    </a>
                                </div>
                            </div>
                            <h3 class="comics-card-title">{{ $comic->title }}</h3>
                            @if($comic->description)
                                <p class="comics-card-desc" style="font-family: var(--font-sans); font-size: 0.8rem; color: var(--text-muted); margin-top: 4px; line-height: 1.4; word-break: break-word;">{{ $comic->description }}</p>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </section>

        <!-- Concepts Section -->
        <section id="concepts">
            @if($settings['maintenance_concept'])
                <div class="coming-soon-container">
                    <div class="coming-soon-card">
                        <span class="coming-soon-subtitle">Works Gallery</span>
                        <h2 class="coming-soon-title">Coming Soon</h2>
                        <p class="coming-soon-desc">We are curating high-quality character designs, keyframes, and environmental layouts. Coming soon!</p>
                    </div>
                </div>
            @else
                <div class="concepts-header">
                    <h2 class="concepts-title">Works Gallery</h2>
                    <div class="concepts-progress-bar-container">
                        <div class="concepts-progress-bar"></div>
                    </div>
                </div>
                
                <div class="concepts-grid-container">
                    @php
                        // Distribute concepts into 3 rows round-robin
                        $rows = [[], [], []];
                        foreach($concepts as $index => $concept) {
                            $rows[$index % 3][] = $concept;
                        }
                    @endphp
                    
                    @foreach($rows as $rowIndex => $rowConcepts)
                        <div class="concepts-row">
                            @foreach($rowConcepts as $concept)
                                <div class="concepts-card" onclick="openImageLightbox('{{ $concept->image_url }}', '{{ str_replace("'", "\\'", $concept->title) }}', '{{ str_replace(["\r", "\n"], ["", "\\n"], addslashes($concept->description)) }}', this.querySelector('img'))">
                                    <img src="{{ $concept->image_url }}" alt="{{ $concept->title }}" data-desc="{{ $concept->description }}" class="concepts-card-img" loading="lazy">
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            @endif
        </section>

        <!-- Contact Section -->
        <section id="socials">
            <h2 class="section-title">Let's Work Together</h2>
            <div class="about-content" style="text-align: center; flex-direction: column; gap: 24px;">
                <h3>Have an idea for a project?</h3>
                <p style="color: var(--text-muted); max-width: 600px; margin: 0 auto 10px;">Feel free to reach out on any of my socials! I am currently open for commissions and freelance work!</p>
                
                <div class="socials-container">
                    @foreach($socialLinks as $link)
                        @if(!$link->is_visible) @continue @endif
                        @php
                            $slug = strtolower($link->name);
                            $target = ($slug === 'commission calculator') ? '' : '_blank';
                            $class = 'vgen-btn'; // default generic class
                            $style = "";
                            
                            if ($slug === 'instagram') $class = 'instagram-btn';
                            elseif ($slug === 'twitter') $class = 'twitter-btn';
                            elseif ($slug === 'tiktok') $class = 'tiktok-btn';
                            elseif ($slug === 'facebook') $class = 'facebook-btn';
                            elseif ($slug === 'pixiv') $class = 'pixiv-btn';
                            elseif ($slug === 'commission calculator') $class = 'calculator-btn';
                            
                            if ($link->bg_color) {
                                $style .= "background-color: {$link->bg_color} !important; background: {$link->bg_color} !important; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);";
                            }
                            if ($link->text_color) {
                                $style .= "color: {$link->text_color} !important;";
                            }
                        @endphp
                        
                        <a href="{{ url($link->url) }}" @if($target) target="{{ $target }}" @endif class="social-pill-btn {{ $class }}" @if($style) style="{{ $style }}" @endif>
                            @if($slug === 'vgen')
                                <svg class="social-pill-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M5 5l7 14 7-14" />
                                    <path d="M19 3l.8 1.6 1.8.2-1.3 1.3.3 1.8-1.6-.8-1.6.8.3-1.8-1.3-1.3 1.8-.2z" fill="currentColor" stroke="none" />
                                </svg>
                            @elseif($slug === 'instagram')
                                <svg class="social-pill-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                </svg>
                            @elseif($slug === 'twitter')
                                <svg class="social-pill-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path>
                                </svg>
                            @elseif($slug === 'tiktok')
                                <svg class="social-pill-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5"></path>
                                </svg>
                            @elseif($slug === 'facebook')
                                <svg class="social-pill-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                                </svg>
                            @elseif($slug === 'commission calculator')
                                <svg class="social-pill-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="4" y="2" width="16" height="20" rx="2" ry="2"></rect>
                                    <line x1="9" y1="22" x2="9" y2="16"></line>
                                    <line x1="8" y1="10" x2="16" y2="10"></line>
                                    <line x1="8" y1="14" x2="16" y2="14"></line>
                                    <line x1="12" y1="6" x2="16" y2="6"></line>
                                    <line x1="8" y1="6" x2="8" y2="6.01"></line>
                                </svg>
                            @elseif($slug === 'pixiv')
                                <svg class="social-pill-icon" width="18" height="18" viewBox="0 0 24 24" fill="currentColor" stroke="none">
                                    <path d="M14 4H6v16h3v-6h5c3.31 0 6-2.69 6-6s-2.69-6-6-6zm0 9H9V7h5c1.65 0 3 1.35 3 3s-1.35 3-3 3z"/>
                                </svg>
                            @else
                                <svg class="social-pill-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
                                    <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
                                </svg>
                            @endif
                            <span>{{ $link->name }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- Reveal confirm modal -->
        <div class="illustrations-modal-backdrop" id="reveal-modal-backdrop">
            <div class="illustrations-modal">
                <h3 class="illustrations-modal-title">Reveal? 🌶️🥵🔞</h3>
                <p class="illustrations-modal-text">Are you sure you want to unlock the Spicy illustrations gallery? This section contains mature thematic illustrations.</p>
                <div class="illustrations-modal-btns">
                    <button class="illustrations-modal-btn cancel" id="modal-cancel-btn">No</button>
                    <button class="illustrations-modal-btn confirm" id="modal-confirm-btn">Yes</button>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer>
            <p>&copy; {{ date('Y') }} Yan. Drawing with 💖 and Art.</p>
        </footer>
        </div>

        <!-- Interactive Particle Background Script -->
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const canvas = document.getElementById('bg-canvas');
                if (!canvas) return;
                const ctx = canvas.getContext('2d');

                let grid    = [];
                let points  = [];
                let mouse   = { x: null, y: null, active: false };
                let ripples = [];    // tap ripples (expanding rings)
                let bullets = [];    // slingshot projectiles
                let binaryParticles = []; // boundary annihilation particles
                let nuked   = null;  // { time, x, y } — collision annihilation event
                let bulletColorIdx = 0;
                const BULLET_COLORS = ['220,60,60', '60,120,220']; // red, blue

                // Slingshot drag state
                let sling = { active: false, dragging: false, startX: 0, startY: 0, currentX: 0, currentY: 0 };

                const spacing         = 35;
                const DRAG_THRESHOLD  = 8;
                function getMaxDragDist() { return Math.hypot(window.innerWidth, window.innerHeight) * 0.5; }
                const MAX_BULLET_SPEED = 3500;  // px/s

                /* ── Web Audio — winch ratchet (movement-only) ─── */
                let audioCtx       = null;
                let winchTimer     = null;
                let currentTension = 0;
                let lastMoveTime   = 0;   // timestamp of last mousemove during drag
                let isMouseMoving  = false;

                function getAudioCtx() {
                    if (!audioCtx) audioCtx = new (window.AudioContext || window.webkitAudioContext)();
                    return audioCtx;
                }

                function playClick() {
                    try {
                        const ac   = getAudioCtx();
                        const buf  = ac.createBuffer(1, ac.sampleRate * 0.045, ac.sampleRate);
                        const data = buf.getChannelData(0);
                        for (let i = 0; i < data.length; i++) {
                            const t = i / ac.sampleRate;
                            data[i] = (Math.random() * 2 - 1) * Math.exp(-t * 90) * 0.55;
                        }
                        const src = ac.createBufferSource();
                        const flt = ac.createBiquadFilter();
                        const gn  = ac.createGain();
                        src.buffer = buf;
                        flt.type = 'bandpass';
                        flt.frequency.value = 400 + currentTension * 1200;
                        flt.Q.value = 3;
                        gn.gain.value = 0.22 + currentTension * 0.40;
                        src.connect(flt); flt.connect(gn); gn.connect(ac.destination);
                        src.start();
                    } catch(e) {}
                }

                function scheduleWinch() {
                    if (!sling.dragging) return;
                    // Only click if mouse actually moved recently (within 120ms)
                    if (performance.now() - lastMoveTime < 120) {
                        playClick();
                    }
                    const delay = Math.max(40, 210 - currentTension * 170);
                    winchTimer = setTimeout(scheduleWinch, delay);
                }
                function startWinch() { stopWinch(); lastMoveTime = performance.now(); scheduleWinch(); }
                function stopWinch()  { clearTimeout(winchTimer); winchTimer = null; }

                /* ── Grid ──────────────────────────────────────── */
                function resizeCanvas(scatter = false) {
                    canvas.width  = window.innerWidth;
                    canvas.height = window.innerHeight;
                    initGrid(scatter);
                }

                function initGrid(scatter = false) {
                    grid = []; points = [];
                    const cols = Math.ceil(canvas.width  / spacing) + 1;
                    const rows = Math.ceil(canvas.height / spacing) + 1;
                    for (let r = 0; r <= rows; r++) {
                        grid[r] = [];
                        for (let c = 0; c <= cols; c++) {
                            const x = c * spacing, y = r * spacing;
                            let startX = x;
                            let startY = y;
                            let vx = 0;
                            let vy = 0;
                            if (scatter) {
                                // Start at the center of the viewport
                                startX = canvas.width / 2;
                                startY = canvas.height / 2;
                                // Add a tiny random dispersion to show a cluster of dots initially
                                startX += (Math.random() - 0.5) * 30;
                                startY += (Math.random() - 0.5) * 30;
                                
                                // Add initial velocity radiating outwards from center to its origin (x, y)
                                const dx = x - canvas.width / 2;
                                const dy = y - canvas.height / 2;
                                const dist = Math.hypot(dx, dy);
                                if (dist > 1) {
                                    const angle = Math.atan2(dy, dx);
                                    // Speed scales with distance so outer dots get a larger outward push
                                    const speed = (dist / Math.hypot(canvas.width, canvas.height)) * 15;
                                    vx = Math.cos(angle) * speed;
                                    vy = Math.sin(angle) * speed;
                                }
                            }
                            const p = { x: startX, y: startY, originX: x, originY: y, vx, vy };
                            grid[r][c] = p;
                            points.push(p);
                        }
                    }
                }

                /* ── Bullet position helper ─────────────────────
                   Bullet decelerates: pos(t) = origin + dir*(v/k)*(1-e^(-kt))
                   Returns current {bx, by, speed} */
                function bulletPos(b, elapsed) {
                    const k = b.k !== undefined ? b.k : 0.7;
                    const travel   = (b.speed / k) * (1 - Math.exp(-k * elapsed));
                    const curSpeed = b.speed * Math.exp(-k * elapsed);
                    return {
                        bx: b.x + b.dirX * travel,
                        by: b.y + b.dirY * travel,
                        curSpeed
                    };
                }

                function spawnBinaryParticles(x, y, count, bulletColor, edge, tension) {
                    const spawnSpread = tension * 25; // initial coordinate spread
                    const maxSpeed = 150 + tension * 750; // wider velocity spread
                    
                    for (let i = 0; i < count; i++) {
                        let angle;
                        if (edge === 'left') {
                            angle = (Math.random() - 0.5) * Math.PI;
                        } else if (edge === 'right') {
                            angle = (Math.random() - 0.5) * Math.PI + Math.PI;
                        } else if (edge === 'top') {
                            angle = Math.random() * Math.PI;
                        } else {
                            angle = Math.random() * Math.PI + Math.PI;
                        }
                        
                        // wider dispersion for larger tension (bullets)
                        const speed = (50 + tension * 100) + Math.random() * maxSpeed;
                        const vx = Math.cos(angle) * speed;
                        const vy = Math.sin(angle) * speed;
                        
                        // Jitter the spawn position slightly for wider initial dispersion
                        const px = x + (Math.random() - 0.5) * spawnSpread;
                        const py = y + (Math.random() - 0.5) * spawnSpread;
                        
                        binaryParticles.push({
                            x: px,
                            y: py,
                            vx,
                            vy,
                            text: Math.random() > 0.5 ? "1" : "0",
                            alpha: 1.0,
                            // Lower decay rate so they last longer (1 to 2.5 seconds)
                            decay: 0.005 + Math.random() * 0.010,
                            size: 10 + Math.random() * 12,
                            color: bulletColor
                        });
                    }
                }

                /* ── Main loop ─────────────────────────────────── */
                function animate() {
                    ctx.clearRect(0, 0, canvas.width, canvas.height);
                    const now    = performance.now();
                    const isDark = document.body.classList.contains('dark-theme');
                    const dotRGB = isDark ? '255,255,255' : '0,0,0';

                    ripples = ripples.filter(r => (now - r.startTime) < 3000);
                    bullets = bullets.filter(b => (now - b.startTime) < 3500);

                    // Check edge collisions and update bullets array
                    bullets = bullets.filter(b => {
                        const elapsed = (now - b.startTime) / 1000;
                        const { bx, by, curSpeed } = bulletPos(b, elapsed);
                        
                        // Grace period of 250ms to prevent instant pop near release points at screen edges
                        if (elapsed < 0.25) {
                            return true;
                        }

                        let hit = false;
                        let edge = '';
                        let collideX = bx;
                        let collideY = by;
                        
                        const speedRatio = curSpeed / b.speed;
                        const basePush = (60 + b.tension * 100) + (curSpeed / MAX_BULLET_SPEED) * (80 + b.tension * 140);
                        const r = (basePush * (0.15 + 0.85 * speedRatio)) / 2;

                        if (bx - r <= 0) {
                            hit = true;
                            edge = 'left';
                            collideX = 0;
                        } else if (bx + r >= canvas.width) {
                            hit = true;
                            edge = 'right';
                            collideX = canvas.width;
                        }
                        
                        if (by - r <= 0) {
                            hit = true;
                            edge = 'top';
                            collideY = 0;
                            if (edge === '') edge = 'top';
                        } else if (by + r >= canvas.height) {
                            hit = true;
                            edge = 'bottom';
                            collideY = canvas.height;
                            if (edge === '') edge = 'bottom';
                        }
                        
                        if (hit) {
                            const count = Math.floor(20 + b.tension * 40);
                            spawnBinaryParticles(collideX, collideY, count, b.color, edge, b.tension);
                            return false; 
                        }
                        return true;
                    });

                    // Pre-compute bullet positions for this frame
                    const bulletData = bullets.map(b => {
                        const elapsed = (now - b.startTime) / 1000;
                        const { bx, by, curSpeed } = bulletPos(b, elapsed);
                        const speedRatio = curSpeed / b.speed; // 1 at launch → 0 as it slows
                        return { b, bx, by, curSpeed, elapsed, speedRatio };
                    });

                    /* ── Bullet collision detection ─────────────── */
                    if (!nuked && bulletData.length >= 2) {
                        for (let i = 0; i < bulletData.length; i++) {
                            for (let j = i + 1; j < bulletData.length; j++) {
                                const a = bulletData[i], b = bulletData[j];
                                const d = Math.hypot(a.bx - b.bx, a.by - b.by);
                                const collideR = 35 + (a.b.tension + b.b.tension) * 25;
                                if (d < collideR) {
                                    nuked = {
                                        time: now,
                                        x: (a.bx + b.bx) / 2,
                                        y: (a.by + b.by) / 2
                                    };
                                    bullets = [];
                                    ripples = [];
                                    binaryParticles = [];
                                    break;
                                }
                            }
                            if (nuked) break;
                        }
                    }

                    /* ── Slingshot drag overlay ─────────────────── */
                    if (!nuked && sling.active && sling.dragging) {
                        const dx   = sling.currentX - sling.startX;
                        const dy   = sling.currentY - sling.startY;
                        const dist = Math.hypot(dx, dy);
                        const t    = Math.min(dist / getMaxDragDist(), 1);
                        const rc   = isDark ? '255,255,255' : '0,0,0';
                        ctx.save();

                        // Rubber-band dashed line
                        ctx.setLineDash([5, 6]);
                        ctx.strokeStyle = `rgba(${rc},${(0.12 + t * 0.22).toFixed(2)})`;
                        ctx.lineWidth = 1.5;
                        ctx.beginPath();
                        ctx.moveTo(sling.startX, sling.startY);
                        ctx.lineTo(sling.currentX, sling.currentY);
                        ctx.stroke();
                        ctx.setLineDash([]);

                        // Direction arrow (opposite of drag)
                        if (dist > 15) {
                            const nx = -dx / dist, ny = -dy / dist;
                            const al = 28 + t * 65;
                            const ax = sling.startX + nx * al, ay = sling.startY + ny * al;
                            const alpha = (0.18 + t * 0.42).toFixed(2);
                            ctx.strokeStyle = `rgba(${rc},${alpha})`;
                            ctx.lineWidth = 1.5;
                            ctx.beginPath(); ctx.moveTo(sling.startX, sling.startY); ctx.lineTo(ax, ay); ctx.stroke();
                            const px = -ny, py = nx, hs = 7;
                            ctx.fillStyle = `rgba(${rc},${alpha})`;
                            ctx.beginPath();
                            ctx.moveTo(ax, ay);
                            ctx.lineTo(ax - nx*hs + px*hs*0.5, ay - ny*hs + py*hs*0.5);
                            ctx.lineTo(ax - nx*hs - px*hs*0.5, ay - ny*hs - py*hs*0.5);
                            ctx.closePath(); ctx.fill();
                        }

                        // Anchor & pull dots
                        ctx.fillStyle = `rgba(${rc},${(0.3 + t * 0.5).toFixed(2)})`;
                        ctx.beginPath(); ctx.arc(sling.startX, sling.startY, 3.5 + t * 4, 0, Math.PI * 2); ctx.fill();
                        ctx.fillStyle = `rgba(${rc},0.22)`;
                        ctx.beginPath(); ctx.arc(sling.currentX, sling.currentY, 5, 0, Math.PI * 2); ctx.fill();

                        // ── Range circle (dashed, centered on click point) ──
                        ctx.setLineDash([10, 5, 3, 5]);  // broken dash pattern
                        ctx.strokeStyle = `rgba(${rc},${(0.18 + t * 0.32).toFixed(2)})`;
                        ctx.lineWidth = 1.5;
                        ctx.beginPath();
                        ctx.arc(sling.startX, sling.startY, dist, 0, Math.PI * 2);
                        ctx.stroke();
                        ctx.setLineDash([]);

                        // ── Distance tooltip at cursor ──
                        if (dist > 20) {
                            const label = `${Math.round(dist)} px`;
                            ctx.font = '11px "IBM Plex Mono", monospace';
                            const tm = ctx.measureText(label);
                            const padX = 8, padY = 5;
                            const tw = tm.width + padX * 2;
                            const th = 18 + padY * 2;
                            // Position tooltip offset from cursor
                            const tooltipX = sling.currentX + 14;
                            const tooltipY = sling.currentY - 10;

                            // Rounded rect background
                            const bgAlpha = isDark ? 0.25 : 0.08;
                            ctx.fillStyle = `rgba(${rc},${bgAlpha})`;
                            ctx.beginPath();
                            const r2 = 4;
                            ctx.moveTo(tooltipX + r2, tooltipY);
                            ctx.lineTo(tooltipX + tw - r2, tooltipY);
                            ctx.quadraticCurveTo(tooltipX + tw, tooltipY, tooltipX + tw, tooltipY + r2);
                            ctx.lineTo(tooltipX + tw, tooltipY + th - r2);
                            ctx.quadraticCurveTo(tooltipX + tw, tooltipY + th, tooltipX + tw - r2, tooltipY + th);
                            ctx.lineTo(tooltipX + r2, tooltipY + th);
                            ctx.quadraticCurveTo(tooltipX, tooltipY + th, tooltipX, tooltipY + th - r2);
                            ctx.lineTo(tooltipX, tooltipY + r2);
                            ctx.quadraticCurveTo(tooltipX, tooltipY, tooltipX + r2, tooltipY);
                            ctx.closePath();
                            ctx.fill();

                            // Border
                            ctx.strokeStyle = `rgba(${rc},${(0.08 + t * 0.12).toFixed(2)})`;
                            ctx.lineWidth = 0.5;
                            ctx.stroke();

                            // Text
                            ctx.fillStyle = `rgba(${rc},${(0.35 + t * 0.45).toFixed(2)})`;
                            ctx.textBaseline = 'middle';
                            ctx.fillText(label, tooltipX + padX, tooltipY + th / 2);
                        }

                        ctx.restore();
                    }

                    /* ── Draw visible bullet circles ────────────── */
                    bulletData.forEach(({ b, bx, by, curSpeed, speedRatio }) => {
                        const bc = b.color;
                        // Match the push radius formula from dot physics, then halve it
                        const basePush   = (60 + b.tension * 100) + (curSpeed / MAX_BULLET_SPEED) * (80 + b.tension * 140);
                        const pushRadius = basePush * (0.15 + 0.85 * speedRatio);
                        const r = pushRadius / 2;
                        if (r < 0.5) return;
                        const alpha = (0.35 + b.tension * 0.55) * speedRatio;
                        // Filled circle
                        ctx.fillStyle = `rgba(${bc},${alpha.toFixed(2)})`;
                        ctx.beginPath();
                        ctx.arc(bx, by, r, 0, Math.PI * 2);
                        ctx.fill();
                        // Soft outer halo
                        const haloR = r * 2.5;
                        const grad = ctx.createRadialGradient(bx, by, r * 0.3, bx, by, haloR);
                        grad.addColorStop(0, `rgba(${bc},${(alpha * 0.35).toFixed(2)})`);
                        grad.addColorStop(1, `rgba(${bc},0)`);
                        ctx.fillStyle = grad;
                        ctx.beginPath();
                        ctx.arc(bx, by, haloR, 0, Math.PI * 2);
                        ctx.fill();
                    });

                    /* ── Dot physics & drawing ──────────────────── */
                    points.forEach(p => {
                        // Mouse fabric pull
                        if (mouse.active && mouse.x !== null) {
                            const dx = mouse.x - p.x, dy = mouse.y - p.y;
                            const d  = Math.hypot(dx, dy);
                            if (d < 180) {
                                const f = (180 - d) / 180;
                                const a = Math.atan2(dy, dx);
                                p.x += Math.cos(a) * f * f * 3.5;
                                p.y += Math.sin(a) * f * f * 3.5;
                            }
                        }

                        // ── Tap ripple (symmetric expanding ring) ──
                        ripples.forEach(rip => {
                            const elapsed   = (now - rip.startTime) / 1000;
                            const waveFront = elapsed * 520;
                            const waveWidth = 75;
                            const dx = p.originX - rip.x, dy = p.originY - rip.y;
                            const d  = Math.hypot(dx, dy);
                            const df = Math.abs(d - waveFront);
                            if (df < waveWidth) {
                                const env = Math.sin((1 - df / waveWidth) * Math.PI);
                                const a   = Math.atan2(dy, dx);
                                p.vx += Math.cos(a) * env * 4.5;
                                p.vy += Math.sin(a) * env * 4.5;
                            }
                        });

                        // ── Bullet parting — energy decays as bullet slows ──
                        bulletData.forEach(({ b, bx, by, curSpeed, elapsed, speedRatio }) => {
                            // Vector from bullet to this dot
                            const dx = p.originX - bx;
                            const dy = p.originY - by;
                            const distToBullet = Math.hypot(dx, dy);

                            // Push radius shrinks as bullet loses energy
                            const basePush  = (60 + b.tension * 100) + (curSpeed / MAX_BULLET_SPEED) * (80 + b.tension * 140);
                            const pushRadius = basePush * (0.15 + 0.85 * speedRatio); // shrinks to 15% at rest

                            if (distToBullet < pushRadius && distToBullet > 1) {
                                const dotAlongDir  = dx * b.dirX + dy * b.dirY;
                                const dotPerpX     = dx - dotAlongDir * b.dirX;
                                const dotPerpY     = dy - dotAlongDir * b.dirY;
                                const perpDist     = Math.hypot(dotPerpX, dotPerpY);

                                // Force decays with speedRatio — bullet "runs out of energy"
                                const falloff  = 1 - (distToBullet / pushRadius);
                                const strength = falloff * falloff * falloff * (20 + b.tension * 35) * speedRatio;

                                if (perpDist > 0.5) {
                                    const perpNX = dotPerpX / perpDist;
                                    const perpNY = dotPerpY / perpDist;
                                    p.vx += perpNX * strength;
                                    p.vy += perpNY * strength;
                                } else {
                                    // Dot is directly on the trajectory line — push radially outward
                                    p.vx += (dx / distToBullet) * strength;
                                    p.vy += (dy / distToBullet) * strength;
                                }
                            }
                        });

                        // Spring back to origin — disabled after nuke
                        if (!nuked) {
                            p.vx += (p.originX - p.x) * 0.035;
                            p.vy += (p.originY - p.y) * 0.035;
                            p.vx *= 0.88; p.vy *= 0.88;
                        } else {
                            p.vx *= 0.995; p.vy *= 0.995; // almost no friction — dots drift forever
                        }
                        p.x  += p.vx;  p.y  += p.vy;

                        // ── Dot rendering ──
                        let dr = 1.2, op = 0.22;

                        // Cursor glow
                        if (mouse.active && mouse.x !== null) {
                            const dm = Math.hypot(mouse.x - p.x, mouse.y - p.y);
                            if (dm < 150) {
                                const f = (150 - dm) / 150;
                                dr = 1.2 + f * 2.0; op = 0.22 + f * 0.70;
                            }
                        }

                        // Tap ripple brightness
                        ripples.forEach(rip => {
                            const elapsed   = (now - rip.startTime) / 1000;
                            const waveFront = elapsed * 520;
                            const waveWidth = 75;
                            const d  = Math.hypot(p.originX - rip.x, p.originY - rip.y);
                            const df = Math.abs(d - waveFront);
                            if (df < waveWidth) {
                                const env = Math.sin((1 - df / waveWidth) * Math.PI);
                                dr = Math.max(dr, 1.2 + env * 2.5);
                                op = Math.max(op, 0.22 + env * 0.70);
                            }
                        });

                        // Bullet proximity glow — scales with tension
                        bulletData.forEach(({ b, bx, by, curSpeed }) => {
                            const d = Math.hypot(p.x - bx, p.y - by);
                            const glowR = (50 + b.tension * 80) + (curSpeed / MAX_BULLET_SPEED) * (80 + b.tension * 160);
                            if (d < glowR) {
                                const f = 1 - d / glowR;
                                dr = Math.max(dr, 1.2 + f * f * (3.0 + b.tension * 3.5));
                                op = Math.max(op, 0.22 + f * (0.55 + b.tension * 0.40));
                            }
                        });

                        // ── Nuke ripple — expanding wavefront annihilates dots ──
                        if (nuked) {
                            const nukeElapsed = (now - nuked.time) / 1000;
                            const waveFront   = nukeElapsed * 800;
                            const waveWidth   = 180; // wide band for dramatic sweep
                            const dx = p.originX - nuked.x;
                            const dy = p.originY - nuked.y;
                            const d  = Math.hypot(dx, dy);
                            const df = Math.abs(d - waveFront);

                            // Only push dots within the ripple band
                            if (df < waveWidth) {
                                const env = Math.sin((1 - df / waveWidth) * Math.PI);
                                const pushStr = env * Math.max(0, 1 - nukeElapsed * 0.12) * 140;
                                if (d > 1) {
                                    p.vx += (dx / d) * pushStr * 0.3;
                                    p.vy += (dy / d) * pushStr * 0.3;
                                } else {
                                    p.vx += (Math.random() - 0.5) * pushStr;
                                    p.vy += (Math.random() - 0.5) * pushStr;
                                }
                                // Brighten dots as the wavefront hits them
                                dr = Math.max(dr, 1.2 + env * 4.0);
                                op = Math.max(op, 0.22 + env * 0.75);
                            }

                            // Dots behind the wavefront fade out
                            if (d < waveFront - waveWidth * 0.5) {
                                const fadeT = Math.min(1, (waveFront - waveWidth * 0.5 - d) / 300);
                                op *= (1 - fadeT);
                            }

                            if (nukeElapsed > 4) op = 0;
                        }

                        ctx.fillStyle = `rgba(${dotRGB},${Math.min(op, 0.92).toFixed(2)})`;
                        ctx.beginPath();
                        ctx.arc(p.x, p.y, dr, 0, Math.PI * 2);
                        ctx.fill();
                    });

                    // ── Update and Draw Binary Particles ──
                    binaryParticles = binaryParticles.filter(p => p.alpha > 0.01);
                    binaryParticles.forEach(p => {
                        p.x += p.vx * 0.016;
                        p.y += p.vy * 0.016;
                        
                        // Ease out: slow down particles even more as they fade out (quadratic deceleration ease-out)
                        const easeOutFactor = 0.94 - (1 - p.alpha) * 0.04;
                        p.vx *= easeOutFactor;
                        p.vy *= easeOutFactor;
                        
                        p.alpha -= p.decay;
                        
                        ctx.fillStyle = `rgba(${p.color},${p.alpha.toFixed(2)})`;
                        ctx.font = `bold ${p.size}px "IBM Plex Mono", monospace`;
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'middle';
                        ctx.fillText(p.text, p.x, p.y);
                    });

                    // ── Nuke purple flash ──
                    if (nuked) {
                        const nukeElapsed = (now - nuked.time) / 1000;

                        // Full-screen purple flash (red + blue = purple)
                        const flashAlpha = Math.max(0, 1 - nukeElapsed / 1.2);
                        if (flashAlpha > 0) {
                            ctx.fillStyle = `rgba(160,60,220,${(flashAlpha * 0.85).toFixed(2)})`;
                            ctx.fillRect(0, 0, canvas.width, canvas.height);
                        }
                    }

                    requestAnimationFrame(animate);
                }

                /* ── Event listeners ───────────────────────────── */
                window.addEventListener('resize', () => resizeCanvas(false));

                window.addEventListener('mousemove', e => {
                    if (window._flipbookOpen) { mouse.active = false; return; }
                    mouse.x = e.clientX; mouse.y = e.clientY; mouse.active = !nuked;
                    if (nuked) return;
                    if (sling.active) {
                        sling.currentX = e.clientX; sling.currentY = e.clientY;
                        const dist = Math.hypot(sling.currentX - sling.startX, sling.currentY - sling.startY);
                        if (dist > DRAG_THRESHOLD) {
                            const wasDragging = sling.dragging;
                            sling.dragging = true;
                            currentTension = Math.min(dist / getMaxDragDist(), 1);
                            lastMoveTime = performance.now(); // track that cursor IS moving
                            if (!wasDragging) startWinch();
                        }
                    }
                });

                window.addEventListener('mouseleave', () => {
                    if (window._flipbookOpen) return;
                    mouse.active = false;
                    sling.active = sling.dragging = false;
                    stopWinch();
                });

                window.addEventListener('mousedown', e => {
                    if (window._flipbookOpen || nuked) return;
                    sling.active = true; sling.dragging = false;
                    sling.startX = sling.currentX = e.clientX;
                    sling.startY = sling.currentY = e.clientY;
                });

                window.addEventListener('mouseup', e => {
                    if (window._flipbookOpen || nuked || !sling.active) return;
                    stopWinch();
                    const dx   = sling.currentX - sling.startX;
                    const dy   = sling.currentY - sling.startY;
                    const dist = Math.hypot(dx, dy);

                    if (sling.dragging && dist > DRAG_THRESHOLD) {
                        // Fire bullet — tension controls speed, size, and force
                        const tension = Math.min(dist / getMaxDragDist(), 1);
                        const dirX = -dx / dist, dirY = -dy / dist;
                        
                        // Projectile speed is faster and dependent on dist
                        const speed = Math.max(1200, dist * 6.5);
                        
                        // Max range is longer and at least 3.5 times the click/release distance (at least twice dist)
                        const maxRange = Math.max(255, dist * 3.5);
                        
                        // Solve for deceleration factor k: maxRange = speed / k => k = speed / maxRange
                        const k = speed / maxRange;

                        bullets.push({
                            x: sling.currentX, y: sling.currentY,
                            dirX, dirY,
                            speed,
                            tension,
                            k,
                            color: BULLET_COLORS[bulletColorIdx++ % 2],
                            startTime: performance.now()
                        });
                    } else {
                        // Tap — symmetric ripple
                        ripples.push({ x: e.clientX, y: e.clientY, startTime: performance.now() });
                    }
                    sling.active = sling.dragging = false;
                    currentTension = 0;
                });

                // Listen for custom theme toggles to respawn the grid dots
                window.addEventListener('theme-changed', () => {
                    nuked = null;
                    bullets = [];
                    ripples = [];
                    binaryParticles = [];
                    initGrid(false);
                });

                // Init with scatter on load
                resizeCanvas(true);
                animate();

                // --- Preloader Progress Logic ---
                const loader = document.getElementById('site-loader');
                const progressBar = document.getElementById('loader-progress-bar');
                const statusText = document.getElementById('loader-status-text');
                const percentageEl = document.getElementById('loader-percentage');
                const appWrapper = document.getElementById('app-wrapper');

                const hasVisited = localStorage.getItem('hasVisited');
                if (hasVisited) {
                    if (loader) loader.style.display = 'none';
                    if (appWrapper) appWrapper.classList.add('app-loaded');
                    document.body.classList.add('app-loaded');
                    document.body.classList.remove('loading-active');
                    window.dispatchEvent(new Event('resize'));
                    window.dispatchEvent(new Event('scroll'));
                } else {
                    let loadProgress = 0;
                    const loadDuration = 1800; // 1.8 seconds
                    const loaderStartTime = performance.now();

                    function updateLoader(now) {
                        const elapsed = now - loaderStartTime;
                        loadProgress = Math.min(100, (elapsed / loadDuration) * 100);

                        // Update progress bar width and percentage text
                        if (progressBar) progressBar.style.width = `${loadProgress}%`;
                        if (percentageEl) percentageEl.textContent = `${Math.floor(loadProgress).toString().padStart(2, '0')}%`;

                        // Staged status messages
                        if (statusText) {
                            if (loadProgress < 30) {
                                statusText.textContent = "INITIALIZING SYSTEM...";
                            } else if (loadProgress < 65) {
                                statusText.textContent = "STABILIZING PARTICLES...";
                            } else if (loadProgress < 90) {
                                statusText.textContent = "RENDERING MESH...";
                            } else {
                                statusText.textContent = "SYSTEM READY";
                            }
                        }

                        if (loadProgress < 100) {
                            requestAnimationFrame(updateLoader);
                        } else {
                            // Complete loading
                            setTimeout(() => {
                                if (loader) loader.classList.add('site-loader-fade');
                                if (appWrapper) appWrapper.classList.add('app-loaded');
                                document.body.classList.add('app-loaded');
                                document.body.classList.remove('loading-active');
                                localStorage.setItem('hasVisited', 'true');
                                
                                // Re-trigger resize & scroll adjustments just in case layout settled
                                window.dispatchEvent(new Event('resize'));
                                window.dispatchEvent(new Event('scroll'));
                            }, 250);
                        }
                    }

                    // Start loader tracking
                    requestAnimationFrame(updateLoader);
                }
            });
        </script>
        <!-- Dark Mode Toggle Script -->
        <script>
            (function() {
                const btn = document.getElementById('theme-toggle');
                if (!btn) return;

                // Apply saved theme on load (inline script in <head> handles the class,
                // this just ensures the button state is always synced).
                function applyTheme(dark) {
                    if (dark) {
                        document.body.classList.add('dark-theme');
                        localStorage.setItem('theme', 'dark');
                    } else {
                        document.body.classList.remove('dark-theme');
                        localStorage.setItem('theme', 'light');
                    }
                }

                btn.addEventListener('click', function() {
                    const isDark = document.body.classList.contains('dark-theme');
                    applyTheme(!isDark);
                    window.dispatchEvent(new CustomEvent('theme-changed'));
                });
            })();
        </script>

        <!-- JavaScript for Interactive Scroll Effects -->
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const sections = [
                    document.getElementById('home'),
                    document.getElementById('about'),
                    document.getElementById('illustrations'),
                    document.getElementById('comics'),
                    document.getElementById('concepts'),
                    document.getElementById('socials')
                ];

                const sidebarItems = document.querySelectorAll('.sidebar-item');
                const sidebarProgressLine = document.querySelector('.sidebar-progress-line');
                const sidebarDotFirst = document.querySelector('.sidebar-item[data-section="home"] .sidebar-dot');
                const sidebarDotLast = document.querySelector('.sidebar-item[data-section="socials"] .sidebar-dot');
                const sidebarLineContainer = document.querySelector('.sidebar-line-container');

                // Recalculate line container height/width and position
                function adjustLineContainer() {
                    if (!sidebarDotFirst || !sidebarDotLast || !sidebarLineContainer) return;
                    const firstRect = sidebarDotFirst.getBoundingClientRect();
                    const lastRect = sidebarDotLast.getBoundingClientRect();
                    const containerRect = document.querySelector('.sidebar-container').getBoundingClientRect();
                    
                    const isMobile = window.innerWidth <= 992;
                    
                    if (isMobile) {
                        sidebarLineContainer.style.top = `${firstRect.top - containerRect.top + (firstRect.height / 2) - 1}px`;
                        sidebarLineContainer.style.left = `${firstRect.left - containerRect.left + (firstRect.width / 2)}px`;
                        sidebarLineContainer.style.width = `${lastRect.left - firstRect.left}px`;
                        sidebarLineContainer.style.height = '2px';
                        sidebarLineContainer.style.right = 'auto';
                    } else {
                        sidebarLineContainer.style.top = `${firstRect.top - containerRect.top + (firstRect.height / 2)}px`;
                        sidebarLineContainer.style.height = `${lastRect.top - firstRect.top}px`;
                        sidebarLineContainer.style.width = '2px';
                        sidebarLineContainer.style.left = 'auto';
                        sidebarLineContainer.style.right = '5px';
                    }
                }

                // Update active state on scroll
                function updateScroll() {
                    const scrollTop = window.scrollY;
                    const docHeight = document.documentElement.scrollHeight - window.innerHeight;
                    
                    // 1. Determine active section based on scroll position
                    let activeSectionId = 'home';
                    
                    // Check if scrolled near the bottom
                    if ((window.innerHeight + window.scrollY) >= document.documentElement.scrollHeight - 80) {
                        activeSectionId = 'socials';
                    } else {
                        sections.forEach(section => {
                            if (!section) return;
                            const sectionTop = section.offsetTop;
                            if (scrollTop >= sectionTop - window.innerHeight / 3) {
                                activeSectionId = section.id;
                            }
                        });
                    }

                    // 2. Calculate overall scroll progress (percentage) and update sidebar progress
                    let scrollPercent = 0;
                    if (docHeight > 0) {
                        scrollPercent = (scrollTop / docHeight) * 100;
                    }
                    
                    const isMobile = window.innerWidth <= 992;
                    
                    if (sidebarProgressLine) {
                        if (isMobile) {
                            sidebarProgressLine.style.width = `${scrollPercent}%`;
                            sidebarProgressLine.style.height = '100%';
                        } else {
                            sidebarProgressLine.style.height = `${scrollPercent}%`;
                            sidebarProgressLine.style.width = '100%';
                        }
                    }
                    
                    // 3. Apply active classes to sidebar and header nav
                    sidebarItems.forEach(item => {
                        const label = item.querySelector('.sidebar-label');
                        const dot = item.querySelector('.sidebar-dot');
                        if (item.getAttribute('data-section') === activeSectionId) {
                            label.classList.add('active');
                            dot.classList.add('active');
                        } else {
                            label.classList.remove('active');
                            dot.classList.remove('active');
                        }
                    });

                    // 4. Update the single active label on mobile with a morph transition
                    const activeLabelEl = document.querySelector('.sidebar-active-label');
                    if (activeLabelEl) {
                        const formattedText = activeSectionId.charAt(0).toUpperCase() + activeSectionId.slice(1);
                        if (activeLabelEl.textContent.trim() !== formattedText) {
                            activeLabelEl.style.opacity = '0';
                            activeLabelEl.style.transform = 'scale(0.85) translateY(-5px)';
                            
                            setTimeout(() => {
                                activeLabelEl.textContent = formattedText;
                                activeLabelEl.style.opacity = '1';
                                activeLabelEl.style.transform = 'scale(1) translateY(0)';
                            }, 200);
                        }
                    }
                }

                // --- Float-in Scroll Animation Logic for About Section ---
                const aboutSection = document.getElementById('about');
                const aboutCard = document.querySelector('.about-card-wrapper');
                const aboutContentRight = document.querySelector('.about-content-right');

                if (aboutSection && aboutCard && aboutContentRight) {
                    const observer = new IntersectionObserver((entries) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                aboutCard.classList.add('active');
                                aboutContentRight.classList.add('active');
                            } else {
                                aboutCard.classList.remove('active');
                                aboutContentRight.classList.remove('active');
                            }
                        });
                    }, {
                        threshold: 0.15
                    });

                    observer.observe(aboutSection);
                }


                // Run on load, resize, and scroll
                window.addEventListener('scroll', updateScroll);
                window.addEventListener('resize', () => {
                    adjustLineContainer();
                    updateScroll();
                });
                
                // Allow CSS layout to settle before adjusting heights
                setTimeout(() => {
                    adjustLineContainer();
                    updateScroll();
                }, 200);
            });
        </script>

        <!-- Illustrations Interactivity and Unlocking Script -->
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const illustrationData = @json($illustrations);

                const slider = document.getElementById('illustrations-slider');
                const progressBar = document.querySelector('.illustrations-progress-bar');
                const buttons = document.querySelectorAll('.illustrations-btn');
                const lockedBtn = document.getElementById('locked-btn');
                
                const modalBackdrop = document.getElementById('reveal-modal-backdrop');
                const modalConfirm = document.getElementById('modal-confirm-btn');
                const modalCancel = document.getElementById('modal-cancel-btn');

                let lockClickCount = 0;
                let isUnlocked = false;

                // Load retro sound with fallbacks
                const bumpSound = new Audio("{{ asset('audio/Pokemon Wall Bump Sound Effect-[AudioTrimmer.com].wav') }}");
                const fallbackSound = new Audio("{{ asset('audio/bump.wav') }}");

                function playBumpSound() {
                    bumpSound.currentTime = 0;
                    bumpSound.play().catch(() => {
                        fallbackSound.currentTime = 0;
                        fallbackSound.play().catch(() => {});
                    });
                }

                function renderIllustrations(type) {
                    if (!slider) return;
                    const items = illustrationData[type] || [];
                    slider.innerHTML = '';

                    items.forEach(item => {
                        const card = document.createElement('div');
                        card.className = 'illustrations-card';
                        
                        const playButtonHtml = item.timelapse_url ? `
                            <button class="timelapse-play-btn" onclick="openTimelapseVideo('${item.timelapse_url}', '${item.title.replace(/'/g, "\\'")}', event)" title="Watch Process Timelapse">
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M8 5v14l11-7z"/>
                                </svg>
                                <span>Timelapse</span>
                            </button>
                        ` : '';

                        const hoverVideoHtml = item.timelapse_url ? `
                            <video class="illustrations-hover-video" src="${item.timelapse_url}" muted loop playsinline></video>
                        ` : '';

                        card.innerHTML = `
                            <div class="illustrations-img-wrapper skeleton">
                                <img class="illustrations-img" src="${item.img}" alt="${item.title}" data-desc="${item.description || ''}" style="opacity: 0; transition: opacity 0.4s ease; --offset-x: ${item.image_offset_x || 0}px; --offset-y: ${item.image_offset_y || 0}px; --scale: ${item.image_scale || 1.0};">
                                ${playButtonHtml}
                                ${hoverVideoHtml}
                            </div>
                            <div class="illustrations-card-content">
                                <span class="illustrations-card-category">${item.category}</span>
                                <h3 class="illustrations-card-title">${item.title}</h3>
                            </div>
                        `;

                        const img = card.querySelector('.illustrations-img');
                        const wrapper = card.querySelector('.illustrations-img-wrapper');
                        
                        img.onload = () => {
                            img.style.opacity = '1';
                            wrapper.classList.remove('skeleton');
                        };

                        img.onerror = () => {
                            wrapper.classList.remove('skeleton');
                            wrapper.innerHTML = `
                                <div class="illustrations-placeholder-gfx">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                        <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                        <polyline points="21 15 16 10 5 21"></polyline>
                                    </svg>
                                </div>
                            `;
                        };

                        // Hover to play timelapse video
                        if (item.timelapse_url) {
                            const hoverVideo = card.querySelector('.illustrations-hover-video');
                            card.addEventListener('mouseenter', () => {
                                if (hoverVideo) {
                                    hoverVideo.style.opacity = '1';
                                    hoverVideo.play().catch(e => console.log('Video play failed:', e));
                                }
                            });
                            card.addEventListener('mouseleave', () => {
                                if (hoverVideo) {
                                    hoverVideo.style.opacity = '0';
                                    hoverVideo.pause();
                                }
                            });
                        }

                        // Click card to open full image lightbox
                        card.addEventListener('click', (e) => {
                            if (e.target.closest('.timelapse-play-btn')) return;
                            openImageLightbox(item.img, item.title, item.description || '', card.querySelector('.illustrations-img'));
                        });

                        slider.appendChild(card);
                    });

                    // Reset scroll and progress bar
                    slider.scrollLeft = 0;
                    if (progressBar) progressBar.style.width = '0%';
                }

                function updateHorizontalProgressBar() {
                    if (!slider || !progressBar) return;
                    const maxScroll = slider.scrollWidth - slider.clientWidth;
                    const percent = maxScroll > 0 ? (slider.scrollLeft / maxScroll) * 100 : 0;
                    progressBar.style.width = `${percent}%`;
                }

                function setActiveCategory(activeBtn, type) {
                    buttons.forEach(b => b.classList.remove('active'));
                    activeBtn.classList.add('active');
                    renderIllustrations(type);
                }

                function showRevealModal() {
                    if (modalBackdrop) modalBackdrop.classList.add('active');
                }

                function hideRevealModal() {
                    if (modalBackdrop) modalBackdrop.classList.remove('active');
                    lockClickCount = 0;
                }

                // Handle category buttons
                buttons.forEach(btn => {
                    btn.addEventListener('click', () => {
                        const type = btn.getAttribute('data-type');
                        if (type === 'locked') {
                            playBumpSound();
                            btn.classList.add('shake');
                            btn.addEventListener('animationend', () => {
                                btn.classList.remove('shake');
                            }, { once: true });

                            lockClickCount++;
                            if (lockClickCount === 3) {
                                showRevealModal();
                            }
                            return;
                        }
                        
                        setActiveCategory(btn, type);
                    });
                });

                // Horizontal scroll listener
                if (slider) {
                    slider.addEventListener('scroll', updateHorizontalProgressBar);
                }

                // Wheel scroll redirection directly inside illustrations slider (hover-only)
                let isSliderScrolling = false;
                if (slider) {
                    slider.addEventListener('wheel', (e) => {
                        const cards = slider.querySelectorAll('.illustrations-card');
                        if (cards.length === 0) return;

                        const maxScroll = slider.scrollWidth - slider.clientWidth;
                        if (maxScroll <= 0) return; // Slider not scrollable

                        // Dynamically calculate stride to handle different screen sizes and flex gaps perfectly
                        const stride = cards.length > 1 ? (cards[1].offsetLeft - cards[0].offsetLeft) : cards[0].offsetWidth;
                        const maxIndex = Math.round(maxScroll / stride);
                        const currentIndex = Math.round(slider.scrollLeft / stride);

                        if (e.deltaY > 0) {
                            // Scrolling down -> Slide to next card
                            if (currentIndex < maxIndex) {
                                e.preventDefault();
                                if (!isSliderScrolling) {
                                    isSliderScrolling = true;
                                    const nextIndex = Math.min(currentIndex + 1, maxIndex);
                                    slider.scrollTo({
                                        left: nextIndex * stride,
                                        behavior: 'smooth'
                                    });
                                    setTimeout(() => { isSliderScrolling = false; }, 400);
                                }
                            }
                        } else if (e.deltaY < 0) {
                            // Scrolling up -> Slide to previous card
                            if (currentIndex > 0) {
                                e.preventDefault();
                                if (!isSliderScrolling) {
                                    isSliderScrolling = true;
                                    const prevIndex = Math.max(currentIndex - 1, 0);
                                    slider.scrollTo({
                                        left: prevIndex * stride,
                                        behavior: 'smooth'
                                    });
                                    setTimeout(() => { isSliderScrolling = false; }, 400);
                                }
                            }
                        }
                    }, { passive: false });
                }

                // Modal events
                if (modalCancel) {
                    modalCancel.addEventListener('click', hideRevealModal);
                }

                if (modalBackdrop) {
                    modalBackdrop.addEventListener('click', (e) => {
                        if (e.target === modalBackdrop) hideRevealModal();
                    });
                }

                if (modalConfirm) {
                    modalConfirm.addEventListener('click', () => {
                        isUnlocked = true;
                        hideRevealModal();

                        if (lockedBtn) {
                            lockedBtn.classList.remove('locked');
                            lockedBtn.setAttribute('data-type', 'spicy');
                            lockedBtn.innerHTML = '<span class="btn-content" style="opacity: 0; transition: opacity 0.25s ease;">🌶️Spicy</span>';
                            
                            setTimeout(() => {
                                const content = lockedBtn.querySelector('.btn-content');
                                if (content) content.style.opacity = '1';
                            }, 50);

                            setActiveCategory(lockedBtn, 'spicy');
                        }
                    });
                }

                // Render initial category
                renderIllustrations('original');

                // --- Comics Section Scroll Progress & Wheel Redirection ---
                const comicsGrid = document.querySelector('.comics-grid');
                const comicsProgressBar = document.querySelector('.comics-progress-bar');

                function updateComicsProgressBar() {
                    if (!comicsGrid || !comicsProgressBar) return;
                    const maxScroll = comicsGrid.scrollWidth - comicsGrid.clientWidth;
                    const percent = maxScroll > 0 ? (comicsGrid.scrollLeft / maxScroll) * 100 : 0;
                    comicsProgressBar.style.width = `${percent}%`;
                }

                if (comicsGrid) {
                    comicsGrid.addEventListener('scroll', updateComicsProgressBar);
                }

                let isComicsScrolling = false;
                if (comicsGrid) {
                    comicsGrid.addEventListener('wheel', (e) => {
                        const cards = comicsGrid.querySelectorAll('.comics-card');
                        if (cards.length === 0) return;

                        const maxScroll = comicsGrid.scrollWidth - comicsGrid.clientWidth;
                        if (maxScroll <= 0) return;

                        const stride = cards.length > 1 ? (cards[1].offsetLeft - cards[0].offsetLeft) : cards[0].offsetWidth;
                        const maxIndex = Math.round(maxScroll / stride);
                        const currentIndex = Math.round(comicsGrid.scrollLeft / stride);

                        if (e.deltaY > 0) {
                            if (currentIndex < maxIndex) {
                                e.preventDefault();
                                if (!isComicsScrolling) {
                                    isComicsScrolling = true;
                                    const nextIndex = Math.min(currentIndex + 1, maxIndex);
                                    comicsGrid.scrollTo({
                                        left: nextIndex * stride,
                                        behavior: 'smooth'
                                    });
                                    setTimeout(() => { isComicsScrolling = false; }, 400);
                                }
                            }
                        } else if (e.deltaY < 0) {
                            if (currentIndex > 0) {
                                e.preventDefault();
                                if (!isComicsScrolling) {
                                    isComicsScrolling = true;
                                    const prevIndex = Math.max(currentIndex - 1, 0);
                                    comicsGrid.scrollTo({
                                        left: prevIndex * stride,
                                        behavior: 'smooth'
                                    });
                                    setTimeout(() => { isComicsScrolling = false; }, 400);
                                }
                            }
                        }
                    }, { passive: false });
                }

                // --- Concepts Section Scroll Progress & Wheel Redirection ---
                const conceptsRows = document.querySelectorAll('.concepts-row');
                const conceptsProgressBar = document.querySelector('.concepts-progress-bar');

                function updateConceptsProgressBar() {
                    if (conceptsRows.length === 0 || !conceptsProgressBar) return;
                    
                    let totalPercent = 0;
                    let activeRowsCount = 0;

                    conceptsRows.forEach(row => {
                        const maxScroll = row.scrollWidth - row.clientWidth;
                        if (maxScroll > 0) {
                            totalPercent += (row.scrollLeft / maxScroll) * 100;
                            activeRowsCount++;
                        }
                    });

                    const averagePercent = activeRowsCount > 0 ? (totalPercent / activeRowsCount) : 0;
                    conceptsProgressBar.style.width = `${averagePercent}%`;
                }

                conceptsRows.forEach(row => {
                    row.addEventListener('scroll', updateConceptsProgressBar);

                    row.addEventListener('wheel', (e) => {
                        const maxScroll = row.scrollWidth - row.clientWidth;
                        if (maxScroll <= 0) return;

                        // Check boundaries to allow vertical scrolling to pass through
                        const isAtStart = row.scrollLeft === 0;
                        const isAtEnd = Math.abs(row.scrollLeft - maxScroll) < 1;
                        if ((e.deltaY < 0 && isAtStart) || (e.deltaY > 0 && isAtEnd)) {
                            return; // Fall through to normal page scrolling
                        }

                        e.preventDefault();
                        row.scroll({
                            left: row.scrollLeft + e.deltaY * 0.8, // slightly damped for smoother scrolling
                            behavior: 'auto'
                        });
                    }, { passive: false });
                });
            });
        </script>

        <!-- Vanilla-Tilt.js CDN for 3D interactive tilt cards -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-tilt/1.8.1/vanilla-tilt.min.js"></script>

        <!-- Custom Flipbook Modal (IFrame Loading Isolated turn.js Reader) -->
        <div id="flipbook-modal" class="flipbook-modal">
            <div class="flipbook-modal-backdrop" id="flipbook-backdrop"></div>
            <iframe id="flipbook-iframe" src="" style="width: 100%; height: 100%; border: none; background: transparent; position: relative; z-index: 10001;" allowtransparency="true"></iframe>
        </div>

        <!-- Comic Reader modal controller script -->
        <script>
        let _flipbookOpen = false;

        function openFlipbook(pagesJson, direction) {
            let pages;
            try { pages = JSON.parse(pagesJson); } catch(e) { pages = []; }
            if (!Array.isArray(pages) || pages.length === 0) {
                alert('This comic does not have a flipbook uploaded yet.');
                return;
            }

            const modal = document.getElementById('flipbook-modal');
            const iframe = document.getElementById('flipbook-iframe');

            // Load flipbook.php inside the iframe with direction query param
            iframe.src = '{{ asset("flipbook.php") }}?pages=' + encodeURIComponent(pagesJson) + '&direction=' + direction;

            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
            document.body.classList.add('flipbook-open');
            window._flipbookOpen = true; // suspend particle canvas interactions

            // Block all sibling elements from interaction (keyboard + pointer)
            Array.from(document.body.children).forEach(el => {
                if (el !== modal) el.setAttribute('inert', '');
            });

            // Focus the iframe so keyboard events register immediately inside it
            setTimeout(() => {
                iframe.focus();
            }, 100);
        }

        function closeFlipbook() {
            const modal = document.getElementById('flipbook-modal');
            const iframe = document.getElementById('flipbook-iframe');

            // Clear the iframe src to stop any loading/audio/processes
            iframe.src = '';

            modal.classList.remove('active');
            document.body.style.overflow = '';
            document.body.classList.remove('flipbook-open');
            window._flipbookOpen = false; // restore particle canvas interactions

            // Restore all sibling elements
            Array.from(document.body.children).forEach(el => el.removeAttribute('inert'));
        }

        document.addEventListener('DOMContentLoaded', () => {
            // Read buttons
            document.querySelectorAll('.comics-read-btn').forEach(btn => {
                btn.addEventListener('click', e => {
                    e.preventDefault();
                    const pages = btn.getAttribute('data-pages');
                    const direction = btn.getAttribute('data-direction') || 'ltr';
                    if (pages && pages !== '[]' && pages !== 'null') {
                        openFlipbook(pages, direction);
                    } else {
                        alert('This comic does not have a flipbook uploaded yet.');
                    }
                });
            });

            // Backdrop click to close
            const backdrop = document.getElementById('flipbook-backdrop');
            if (backdrop) {
                backdrop.addEventListener('click', closeFlipbook);
            }

            // ESC key to close modal from parent window
            document.addEventListener('keydown', e => {
                if (window._flipbookOpen && e.key === 'Escape') {
                    closeFlipbook();
                }
            });
        });
        </script>

        <!-- Sleek Glassmorphic Video Lightbox Modal Player -->
        <div id="video-modal" class="video-modal">
            <div class="video-modal-backdrop" id="video-backdrop"></div>
            <div class="video-modal-content">
                <button class="video-modal-close" onclick="closeVideoModal()" aria-label="Close video">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
                <h3 class="video-modal-title" id="video-modal-title">Timelapse</h3>
                <div class="video-player-wrapper">
                    <video id="video-player" src="" controls autoplay playsinline></video>
                </div>
            </div>
        </div>

        <!-- Video Lightbox Controller Script -->
        <script>
        let _videoPlayerOpen = false;

        function openTimelapseVideo(url, title, event) {
            if (event) {
                event.preventDefault();
                event.stopPropagation();
            }
            const modal = document.getElementById('video-modal');
            const player = document.getElementById('video-player');
            const titleEl = document.getElementById('video-modal-title');

            titleEl.textContent = title + ' - Process Timelapse';
            player.src = url;
            player.load();
            
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
            window._videoPlayerOpen = true;

            // Block sibling elements from interaction
            Array.from(document.body.children).forEach(el => {
                if (el !== modal) el.setAttribute('inert', '');
            });

            // Focus player
            player.focus();
        }

        function closeVideoModal() {
            const modal = document.getElementById('video-modal');
            const player = document.getElementById('video-player');

            player.pause();
            player.src = '';

            modal.classList.remove('active');
            document.body.style.overflow = '';
            window._videoPlayerOpen = false;

            // Restore interaction for sibling elements
            Array.from(document.body.children).forEach(el => el.removeAttribute('inert'));
        }

        document.addEventListener('DOMContentLoaded', () => {
            const backdrop = document.getElementById('video-backdrop');
            if (backdrop) {
                backdrop.addEventListener('click', closeVideoModal);
            }

            document.addEventListener('keydown', e => {
                if (window._videoPlayerOpen && e.key === 'Escape') {
                    closeVideoModal();
                }
            });
        });
        </script>

        <!-- Sleek Glassmorphic Image Lightbox Modal -->
        <div id="image-modal" class="image-modal">
            <div class="image-modal-backdrop" id="image-backdrop"></div>
            
            <!-- Close Button -->
            <button class="image-modal-close" onclick="closeImageModal()" aria-label="Close image">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>

            <!-- Navigation Buttons -->
            <button class="image-modal-nav prev" id="image-modal-prev" onclick="navigateGallery(-1)" aria-label="Previous artwork">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
            </button>
            <button class="image-modal-nav next" id="image-modal-next" onclick="navigateGallery(1)" aria-label="Next artwork">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="5" y1="12" x2="19" y2="12"></line>
                    <polyline points="12 5 19 12 12 19"></polyline>
                </svg>
            </button>

            <div class="image-modal-content">
                <div class="image-viewer-wrapper">
                    <img id="image-modal-viewer" src="" alt="Full Artwork">
                </div>
                <h3 class="image-modal-title" id="image-modal-title">Artwork Title</h3>
                <p class="image-modal-desc" id="image-modal-desc" style="font-family: var(--font-sans); font-size: 0.88rem; color: var(--text-muted); margin-top: 8px; line-height: 1.6; text-align: center; max-width: 600px; margin-left: auto; margin-right: auto; white-space: pre-wrap; display: none;"></p>
            </div>
        </div>

        <!-- Image Lightbox Controller Script -->
        <script>
        let _imagePlayerOpen = false;
        let _activeSourceImg = null;
        let _galleryImages = [];
        let _galleryIndex = -1;

        function openImageLightbox(url, title, description, sourceImg) {
            const modal = document.getElementById('image-modal');
            const viewer = document.getElementById('image-modal-viewer');
            const titleEl = document.getElementById('image-modal-title');
            const descEl = document.getElementById('image-modal-desc');

            titleEl.textContent = title;
            if (descEl) {
                descEl.textContent = description || '';
                descEl.style.display = description ? 'block' : 'none';
            }
            viewer.src = url;
            window._activeSourceImg = sourceImg;

            // Gather gallery context for prev/next navigation
            if (sourceImg) {
                const section = sourceImg.closest('section');
                if (section) {
                    window._galleryImages = Array.from(section.querySelectorAll('.concepts-card-img, .illustrations-img'));
                    window._galleryIndex = window._galleryImages.indexOf(sourceImg);
                }
            } else {
                window._galleryImages = [];
                window._galleryIndex = -1;
            }

            // Show or hide nav buttons based on gallery size
            const prevBtn = document.getElementById('image-modal-prev');
            const nextBtn = document.getElementById('image-modal-next');
            if (window._galleryImages.length > 1) {
                prevBtn.classList.remove('hidden');
                nextBtn.classList.remove('hidden');
            } else {
                prevBtn.classList.add('hidden');
                nextBtn.classList.add('hidden');
            }

            const isConcept = sourceImg && sourceImg.classList.contains('concepts-card-img');

            // Shared Element Transition (FLIP opening animation only for concepts)
            if (isConcept) {
                const sourceRect = sourceImg.getBoundingClientRect();
                
                // Create animated flying image clone
                const clone = sourceImg.cloneNode();
                clone.style.position = 'fixed';
                clone.style.top = sourceRect.top + 'px';
                clone.style.left = sourceRect.left + 'px';
                clone.style.width = sourceRect.width + 'px';
                clone.style.height = sourceRect.height + 'px';
                clone.style.margin = '0';
                clone.style.padding = '0';
                clone.style.borderRadius = window.getComputedStyle(sourceImg.parentElement || sourceImg).borderRadius;
                clone.style.zIndex = '10010';
                clone.style.transition = 'all 0.5s cubic-bezier(0.18, 0.89, 0.32, 1.15)';
                clone.style.boxShadow = '0 15px 45px rgba(0,0,0,0.35)';
                clone.style.pointerEvents = 'none';
                
                document.body.appendChild(clone);
                sourceImg.style.visibility = 'hidden';

                // Keep final content hidden during flight
                const content = modal.querySelector('.image-modal-content');
                content.style.opacity = '0';
                content.style.transform = 'scale(0.9)';
                content.style.transition = 'opacity 0.25s ease, transform 0.25s ease';

                modal.classList.add('active');
                
                // Force layout so browser calculates viewer's size/position
                modal.offsetHeight;
                const targetRect = viewer.getBoundingClientRect();

                // Trigger slide/grow to target
                clone.style.top = targetRect.top + 'px';
                clone.style.left = targetRect.left + 'px';
                clone.style.width = targetRect.width + 'px';
                clone.style.height = targetRect.height + 'px';
                clone.style.borderRadius = '14px';

                setTimeout(() => {
                    content.style.opacity = '1';
                    content.style.transform = 'scale(1)';
                    clone.style.opacity = '0';
                    setTimeout(() => {
                        clone.remove();
                        sourceImg.style.visibility = 'visible';
                    }, 200);
                }, 480);
            } else {
                // Standard modal open without FLIP animation
                const content = modal.querySelector('.image-modal-content');
                content.style.opacity = '1';
                content.style.transform = 'scale(1)';
                content.style.transition = 'opacity 0.25s ease, transform 0.25s ease';
                modal.classList.add('active');
            }

            document.body.style.overflow = 'hidden';
            window._imagePlayerOpen = true;

            // Block sibling elements from interaction
            Array.from(document.body.children).forEach(el => {
                if (el !== modal) el.setAttribute('inert', '');
            });

            // Focus the close button
            document.querySelector('.image-modal-close').focus();
        }

        function closeImageModal() {
            const modal = document.getElementById('image-modal');
            const viewer = document.getElementById('image-modal-viewer');
            const sourceImg = window._activeSourceImg;
            const isConcept = sourceImg && sourceImg.classList.contains('concepts-card-img');

            // Shared Element Transition (FLIP closing animation only for concepts)
            if (isConcept && sourceImg && viewer.src) {
                const viewerRect = viewer.getBoundingClientRect();
                
                const clone = viewer.cloneNode();
                clone.style.position = 'fixed';
                clone.style.top = viewerRect.top + 'px';
                clone.style.left = viewerRect.left + 'px';
                clone.style.width = viewerRect.width + 'px';
                clone.style.height = viewerRect.height + 'px';
                clone.style.margin = '0';
                clone.style.padding = '0';
                clone.style.borderRadius = '14px';
                clone.style.zIndex = '10010';
                clone.style.transition = 'all 0.4s cubic-bezier(0.16, 1, 0.3, 1)';
                clone.style.pointerEvents = 'none';

                document.body.appendChild(clone);
                sourceImg.style.visibility = 'hidden';

                const content = modal.querySelector('.image-modal-content');
                content.style.opacity = '0';

                const sourceRect = sourceImg.getBoundingClientRect();
                clone.offsetHeight; // force reflow

                clone.style.top = sourceRect.top + 'px';
                clone.style.left = sourceRect.left + 'px';
                clone.style.width = sourceRect.width + 'px';
                clone.style.height = sourceRect.height + 'px';
                clone.style.borderRadius = window.getComputedStyle(sourceImg.parentElement || sourceImg).borderRadius;

                modal.classList.remove('active');

                setTimeout(() => {
                    clone.remove();
                    sourceImg.style.visibility = 'visible';
                }, 400);
            } else {
                modal.classList.remove('active');
            }

            document.body.style.overflow = '';
            window._imagePlayerOpen = false;

            // Restore interaction for sibling elements
            Array.from(document.body.children).forEach(el => el.removeAttribute('inert'));
            
            // Clean the src when animation completes
            setTimeout(() => {
                if (!window._imagePlayerOpen) {
                    viewer.src = '';
                }
            }, 400);
        }

        function navigateGallery(direction) {
            if (!window._galleryImages || window._galleryImages.length <= 1) return;

            let newIndex = window._galleryIndex + direction;
            if (newIndex < 0) {
                newIndex = window._galleryImages.length - 1;
            } else if (newIndex >= window._galleryImages.length) {
                newIndex = 0;
            }

            window._galleryIndex = newIndex;
            const nextImg = window._galleryImages[newIndex];

            const viewer = document.getElementById('image-modal-viewer');
            const titleEl = document.getElementById('image-modal-title');

            // Visual transition fade-out/scale-down
            viewer.style.opacity = '0.3';
            viewer.style.transform = 'scale(0.97)';

            setTimeout(() => {
                viewer.src = nextImg.src;
                titleEl.textContent = nextImg.getAttribute('alt') || '';
                
                const desc = nextImg.getAttribute('data-desc') || '';
                const descEl = document.getElementById('image-modal-desc');
                if (descEl) {
                    descEl.textContent = desc;
                    descEl.style.display = desc ? 'block' : 'none';
                }
                
                window._activeSourceImg = nextImg;

                viewer.onload = () => {
                    viewer.style.opacity = '1';
                    viewer.style.transform = 'scale(1)';
                };
            }, 120);
        }

        document.addEventListener('DOMContentLoaded', () => {
            // Prevent dragging of all links, images, and elements to copy/paste the link
            document.addEventListener('dragstart', (e) => {
                e.preventDefault();
            });

            const backdrop = document.getElementById('image-backdrop');
            if (backdrop) {
                backdrop.addEventListener('click', closeImageModal);
            }

            document.addEventListener('keydown', e => {
                if (window._imagePlayerOpen) {
                    if (e.key === 'Escape') {
                        closeImageModal();
                    } else if (e.key === 'ArrowLeft') {
                        navigateGallery(-1);
                    } else if (e.key === 'ArrowRight') {
                        navigateGallery(1);
                    }
                }
            });
        });
        </script>

        <!-- Custom 3D Tilt & Sheen Script -->
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const tiltCards = document.querySelectorAll('.about-card, .coming-soon-card');

                tiltCards.forEach((card) => {
                    // Create sheen element
                    const sheen = document.createElement('div');
                    sheen.classList.add('card-sheen');
                    card.appendChild(sheen);

                    card.addEventListener('mouseenter', () => {
                        card.style.transition = 'none';
                        sheen.style.transition = 'none';
                        sheen.style.opacity = '1';
                    });

                    card.addEventListener('mousemove', (e) => {
                        const rect = card.getBoundingClientRect();
                        const x = e.clientX - rect.left;
                        const y = e.clientY - rect.top;

                        const centerX = rect.width / 2;
                        const centerY = rect.height / 2;

                        // Calculate rotations (less violent)
                        const rotateX = -(y - centerY) / 35;
                        const rotateY = (x - centerX) / 35;

                        card.style.transform = `perspective(1000px) rotateX(${rotateX}deg) rotateY(${rotateY}deg) scale(1.02)`;

                        // Update sheen position
                        const percentX = (x / rect.width) * 100;
                        const percentY = (y / rect.height) * 100;
                        sheen.style.background = `radial-gradient(circle at ${percentX}% ${percentY}%, rgba(255,255,255,0.4) 0%, rgba(255,255,255,0) 70%)`;
                    });

                    card.addEventListener('mouseleave', () => {
                        card.style.transition = 'transform 0.5s cubic-bezier(0.25, 1, 0.5, 1)';
                        card.style.transform = 'perspective(1000px) rotateX(0deg) rotateY(0deg) scale(1)';
                        
                        sheen.style.transition = 'opacity 0.5s ease';
                        sheen.style.opacity = '0';
                    });
                });
            });
        </script>
    </body>
</html>
