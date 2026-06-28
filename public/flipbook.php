<?php
$pages = [];
$error = null;
$direction = isset($_GET['direction']) && $_GET['direction'] === 'rtl' ? 'rtl' : 'ltr';

if (!isset($_GET['pages'])) {
    $error = "No comic specified. Please go back to the portfolio and select a comic to read.";
} else {
    $decoded = json_decode($_GET['pages'], true);
    if (!is_array($decoded) || empty($decoded)) {
        $error = "This comic does not have any pages uploaded yet, or the page data is invalid.";
    } else {
        $pages = $decoded;
    }
}
$hasBackCover = (count($pages) % 2 === 0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comic Reader | Yan</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@400;500;600;700&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <script>
        // Check if loaded inside an iframe and add CSS class early to prevent style flash
        if (window.self !== window.top) {
            document.documentElement.className += ' in-iframe';
        }
    </script>
    <style>
        /* CSS reset & variables */
        :root {
            --bg-color: #06070a;
            --gradient-start: #11131e;
            --accent-color: #a03cdc;
            --accent-glow: rgba(160, 60, 220, 0.15);
            --header-bg: rgba(6, 7, 10, 0.85);
            --text-primary: #ffffff;
            --text-secondary: rgba(255, 255, 255, 0.6);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: radial-gradient(circle at center, var(--gradient-start) 0%, var(--bg-color) 100%);
            color: var(--text-primary);
            font-family: 'Outfit', sans-serif;
            height: 100vh;
            width: 100vw;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        html.in-iframe body {
            background: transparent !important;
        }

        html.in-iframe .ambient-glow {
            display: none !important;
        }

        /* Ambient glow background */
        .ambient-glow {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 80vw;
            height: 80vh;
            background: radial-gradient(circle, var(--accent-glow) 0%, rgba(0, 0, 0, 0) 70%);
            pointer-events: none;
            z-index: 0;
            filter: blur(80px);
        }

        /* Top header bar */
        .reader-header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            padding: 18px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 10;
            background: linear-gradient(to bottom, rgba(6, 7, 10, 0.9) 0%, rgba(6, 7, 10, 0) 100%);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            /* border removed for cleaner UI */
        }

        .header-brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-logo {
            font-weight: 700;
            letter-spacing: 0.15em;
            font-size: 1.15rem;
            background: linear-gradient(135deg, #fff 30%, rgba(255,255,255,0.5) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .brand-badge {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 0.72rem;
            color: var(--accent-color);
            background: rgba(160, 60, 220, 0.12);
            padding: 3px 9px;
            border-radius: 4px;
            border: 1px solid rgba(160, 60, 220, 0.25);
            font-weight: 600;
            letter-spacing: 0.05em;
            text-transform: uppercase;
        }

        .close-btn {
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--text-primary);
            padding: 8px 18px;
            border-radius: 99px;
            font-size: 0.85rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.25s cubic-bezier(0.2, 0.8, 0.2, 1);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .close-btn:hover {
            background: rgba(255, 118, 117, 0.15);
            border-color: rgba(255, 118, 117, 0.4);
            color: #ff7675;
            transform: translateY(-1px);
        }

        /* Loading / Error States */
        .loader-container, .error-viewport {
            position: absolute;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 100;
            background: radial-gradient(circle at center, var(--gradient-start) 0%, var(--bg-color) 100%);
        }

        .spinner {
            width: 45px;
            height: 45px;
            border: 3px solid rgba(255, 255, 255, 0.08);
            border-top: 3px solid var(--accent-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-bottom: 20px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .loading-text {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 0.82rem;
            color: var(--text-secondary);
            letter-spacing: 0.15em;
            text-transform: uppercase;
        }

        /* Main Viewport */
        .book-viewport {
            position: relative;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1;
            padding: 85px 50px 95px 50px;
            opacity: 0; /* Animated in via JS on load */
        }

        .flipbook-wrapper {
            position: relative;
            transition: transform 0.5s ease-in-out;
        }

        .flipbook-container {
            position: relative;
            border-radius: 4px;
            transform-origin: center center;
            transition: transform 300ms ease;
        }

        .flipbook-container.zoomed {
            cursor: grab;
        }

        .flipbook-container.dragging {
            cursor: grabbing;
        }

        .flipbook {
            margin: 0 auto;
        }

        /* Turn.js page elements styling */
        .flipbook .page {
            background-color: #fcfcfc;
            width: 100%;
            height: 100%;
            overflow: hidden;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.15) inset;
        }

        /* Shadow gradient along page edges for realism */
        .flipbook .page::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, rgba(0,0,0,0.06) 0%, rgba(0,0,0,0) 3%, rgba(0,0,0,0) 97%, rgba(0,0,0,0.06) 100%);
            pointer-events: none;
            z-index: 5;
        }

        .flipbook .hard {
            background-color: #12141c;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.4);
        }

        .flipbook .hard::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.04) 0%, rgba(255, 255, 255, 0) 50%);
            pointer-events: none;
            z-index: 5;
        }

        .flipbook img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            display: block;
            pointer-events: none;
            user-select: none;
            -webkit-user-drag: none;
        }

        /* Make book and pages unselectable to prevent click-drag copy
           while preserving pointer events for turn.js flip interactions */
        .flipbook, .flipbook-container, .flipbook .page, .flipbook .hard {
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            -webkit-touch-callout: none;
        }

        /* ground shadow removed — no decorative box-shadow used */

        /* Navigation Arrows on Sides */
        .nav-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 55px;
            height: 55px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            color: rgba(255, 255, 255, 0.65);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.2, 0.8, 0.2, 1);
            z-index: 10;
        }

        .nav-btn:hover {
            background: rgba(160, 60, 220, 0.18);
            border-color: rgba(160, 60, 220, 0.45);
            color: var(--text-primary);
            box-shadow: 0 0 15px rgba(160, 60, 220, 0.25);
        }

        .nav-btn-prev {
            left: 30px;
        }

        .nav-btn-prev:hover {
            transform: translateY(-50%) translateX(-4px);
        }

        .nav-btn-next {
            right: 30px;
        }

        .nav-btn-next:hover {
            transform: translateY(-50%) translateX(4px);
        }

        .nav-btn svg {
            width: 22px;
            height: 22px;
        }

        /* Footer & Controls bar */
        .reader-footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 18px 30px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 12px;
            z-index: 10;
            background: linear-gradient(to top, rgba(6, 7, 10, 0.9) 0%, rgba(6, 7, 10, 0) 100%);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            /* border removed for cleaner UI */
        }

        .footer-controls {
            display: flex;
            align-items: center;
            gap: 20px;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            padding: 6px 20px;
            border-radius: 99px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
        }

        .control-btn {
            background: none;
            border: none;
            color: rgba(255, 255, 255, 0.65);
            cursor: pointer;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }

        .control-btn:hover {
            background: rgba(255, 255, 255, 0.1);
            color: var(--text-primary);
        }

        .control-btn svg {
            width: 16px;
            height: 16px;
        }

        .zoom-display {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 0.78rem;
            font-weight: 600;
            width: 45px;
            text-align: center;
            color: rgba(255, 255, 255, 0.85);
        }

        .page-indicator {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 0.82rem;
            color: rgba(255, 255, 255, 0.55);
            letter-spacing: 0.05em;
        }

        .keyboard-hint {
            font-size: 0.7rem;
            color: rgba(255, 255, 255, 0.3);
            font-family: 'IBM Plex Mono', monospace;
            letter-spacing: 0.02em;
        }

        /* Error Screen card layout */
        .alert-screen {
            max-width: 480px;
            text-align: center;
            padding: 40px;
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 16px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.55);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
            z-index: 101;
        }

        .alert-icon {
            font-size: 2.8rem;
            line-height: 1;
        }

        .alert-title {
            font-size: 1.4rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        .alert-msg {
            color: var(--text-secondary);
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .alert-btn {
            background: linear-gradient(135deg, var(--accent-color) 0%, #7622aa 100%);
            border: none;
            color: var(--text-primary);
            padding: 12px 28px;
            border-radius: 99px;
            font-size: 0.88rem;
            font-weight: 600;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(160, 60, 220, 0.3);
            transition: all 0.25s ease;
            font-family: 'Outfit', sans-serif;
        }

        .alert-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(160, 60, 220, 0.55);
        }

        /* Layout selection toolbar */
        .layout-btn-group {
            display: flex;
            background: rgba(255, 255, 255, 0.04);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 99px;
            padding: 2px;
            margin: 0 4px;
        }

        .layout-btn {
            background: none;
            border: none;
            color: rgba(255, 255, 255, 0.5);
            cursor: pointer;
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }

        .layout-btn:hover {
            color: var(--text-primary);
            background: rgba(255, 255, 255, 0.05);
        }

        .layout-btn.active {
            color: var(--text-primary);
            background: var(--accent-color);
            box-shadow: 0 0 10px rgba(160, 60, 220, 0.4);
        }

        .layout-btn svg {
            width: 15px;
            height: 15px;
        }

        /* Prevent native dragging of images, links, or other elements */
        a, img, [draggable] {
            -webkit-user-drag: none;
            -khtml-user-drag: none;
            -moz-user-drag: none;
            -o-user-drag: none;
            user-drag: none;
        }
    </style>
</head>
<body>

    <div class="ambient-glow"></div>

    <?php if ($error): ?>
        <div class="error-viewport">
            <div class="alert-screen">
                <div class="alert-icon">⚠️</div>
                <div class="alert-title">Something went wrong</div>
                <div class="alert-msg"><?php echo htmlspecialchars($error); ?></div>
                <button class="alert-btn" onclick="window.close()">Close Window</button>
            </div>
        </div>
    <?php else: ?>
        <!-- Loader during page asset caching -->
        <div class="loader-container">
            <div class="spinner"></div>
            <div class="loading-text">Preloading Comic Pages...</div>
        </div>

        <!-- Top Header Bar -->
        <header class="reader-header">
            <div class="header-brand">
                <span class="brand-logo">YAN</span>
                <span class="brand-badge">Comic Reader</span>
            </div>
            <button class="close-btn" id="reader-close-btn">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                Close Reader
            </button>
        </header>

        <!-- Navigation Buttons -->
        <button class="nav-btn nav-btn-prev" aria-label="Previous Page">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"></polyline></svg>
        </button>
        <button class="nav-btn nav-btn-next" aria-label="Next Page">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
        </button>

        <!-- Main Viewport -->
        <main class="book-viewport">
            <div class="flipbook-wrapper">
                <div class="flipbook-container">
                    <div class="flipbook" id="flipbook">
                        <?php foreach ($pages as $index => $path): ?>
                            <?php 
                                $isBackCover = ($index === count($pages) - 1);
                                $isCover = ($index === 0 || ($isBackCover && $hasBackCover));
                                $class = $isCover ? 'hard' : 'page';
                            ?>
                            <div class="<?php echo $class; ?>">
                                <img src="<?php echo htmlspecialchars($path); ?>" alt="Page <?php echo $index + 1; ?>" draggable="false" ondragstart="return false;">
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Vertical Scroll Container -->
            <div id="scroll-container" style="display: none; width: 100%; height: 100%; overflow-y: auto; overflow-x: hidden; padding: 20px 0; -webkit-overflow-scrolling: touch; position: relative; z-index: 2;">
                <div class="scroll-images" style="display: flex; flex-direction: column; align-items: center; gap: 24px; width: 100%;">
                    <?php foreach ($pages as $index => $path): ?>
                        <img class="scroll-page-img" src="<?php echo htmlspecialchars($path); ?>" alt="Page <?php echo $index + 1; ?>" style="max-width: 800px; width: 90%; height: auto; box-shadow: 0 15px 45px rgba(0,0,0,0.6); border-radius: 6px; transition: max-width 0.25s cubic-bezier(0.2, 0.8, 0.2, 1);">
                    <?php endforeach; ?>
                </div>
            </div>
        </main>

        <!-- Footer Info & Toolbar Controls -->
        <footer class="reader-footer">
            <div class="footer-controls">
                <button class="control-btn control-btn-zoom-out" title="Zoom Out">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line><line x1="8" y1="11" x2="14" y2="11"></line></svg>
                </button>
                <div class="zoom-display">100%</div>
                <button class="control-btn control-btn-zoom-in" title="Zoom In">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line><line x1="11" y1="8" x2="11" y2="14"></line><line x1="8" y1="11" x2="14" y2="11"></line></svg>
                </button>
                <div style="width: 1px; height: 16px; background: rgba(255, 255, 255, 0.15); margin: 0 4px;"></div>
                <button class="control-btn control-btn-zoom-reset" title="Reset Zoom" style="font-family: 'IBM Plex Mono', monospace; font-size: 0.72rem; font-weight: bold; width: auto; padding: 0 6px; border-radius: 4px;">
                    RESET
                </button>
                
                <div style="width: 1px; height: 16px; background: rgba(255, 255, 255, 0.15); margin: 0 4px;"></div>
                
                <!-- Layout Mode Buttons -->
                <div class="layout-btn-group">
                    <button class="layout-btn active" data-layout="flipbook" title="Flipbook Mode (Double Page)">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"></path><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"></path></svg>
                    </button>
                    <button class="layout-btn" data-layout="single" title="Single Page Mode">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
                    </button>
                    <button class="layout-btn" data-layout="scroll" title="Continuous Scroll Mode">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="7 13 12 18 17 13"></polyline><polyline points="7 6 12 11 17 6"></polyline></svg>
                    </button>
                </div>
            </div>
            
            <div class="page-indicator">Cover of <?php echo count($pages); ?></div>
            <div class="keyboard-hint">Use Keyboard Arrows (← / →) or drag corners to flip pages. Hold the scroll wheel and drag to pan across the page. Press ESC to close.</div>
        </footer>

        <!-- Scripts -->
        <script src="js/jquery.min.js"></script>
        <script src="js/turn.js"></script>
        <script>
            $(document).ready(function() {
                // Prevent dragging of all links, images, and elements to copy/paste the link
                document.addEventListener('dragstart', function(e) {
                    e.preventDefault();
                });

                var book = $('#flipbook');
                var pagesCount = <?php echo count($pages); ?>;
                var hasBackCover = <?php echo $hasBackCover ? 'true' : 'false'; ?>;
                var zoomFactor = 1.0;
                var targetRatio = 1.414; // Default double A4 layout aspect ratio
                var dir = '<?php echo $direction; ?>'; // ltr or rtl
                var currentLayout = 'flipbook'; // flipbook (double), single, scroll
                var singlePageAspect = 0.707; // Default aspect ratio (A4 width/height)
                var isInitialized = false;

                // --- Web Audio API Page Flip Audio Player ---
                class FlipbookAudio {
                    constructor() {
                        this.ctx = null;
                        this.buffers = [];
                        this.isLoading = false;
                    }

                    init() {
                        if (this.ctx) return;
                        const AudioContext = window.AudioContext || window.webkitAudioContext;
                        if (AudioContext) {
                            this.ctx = new AudioContext();
                            this.loadAudio();
                        }
                    }

                    async loadAudio() {
                        if (this.buffers.length > 0 || this.isLoading) return;
                        this.isLoading = true;
                        
                        const files = [
                            'audio/page-turn-1.wav',
                            'audio/page-turn-2.wav'
                        ];

                        try {
                            const promises = files.map(async (file) => {
                                const response = await fetch(file);
                                const arrayBuffer = await response.arrayBuffer();
                                return this.ctx.decodeAudioData(arrayBuffer);
                            });
                            this.buffers = await Promise.all(promises);
                        } catch (e) {
                            console.error('Failed to load page flip audio files:', e);
                        } finally {
                            this.isLoading = false;
                        }
                    }

                    playFlip() {
                        this.init();
                        if (!this.ctx) return;

                        // Resume context if suspended (browser autoplay policy requirement)
                        if (this.ctx.state === 'suspended') {
                            this.ctx.resume();
                        }

                        if (this.buffers.length === 0) return;

                        const now = this.ctx.currentTime;
                        
                        // Select one of the loaded buffers randomly
                        const bufferIndex = Math.floor(Math.random() * this.buffers.length);
                        const selectedBuffer = this.buffers[bufferIndex];

                        const source = this.ctx.createBufferSource();
                        source.buffer = selectedBuffer;

                        // Add subtle variation to playbackRate (detune/pitch variation)
                        source.playbackRate.setValueAtTime(0.90 + Math.random() * 0.20, now);

                        if (source.detune) {
                            // Detune variation in cents (-120 to +120 cents)
                            source.detune.setValueAtTime((Math.random() * 240) - 120, now);
                        }

                        const gainNode = this.ctx.createGain();
                        const volume = 0.82 + Math.random() * 0.18;
                        gainNode.gain.setValueAtTime(volume, now);

                        source.connect(gainNode);
                        gainNode.connect(this.ctx.destination);

                        source.start(now);
                    }
                }

                const flipbookAudio = new FlipbookAudio();

                // Unlock audio context on user interaction inside iframe
                $(document).on('click touchstart keydown', function() {
                    flipbookAudio.init();
                });

                if (pagesCount === 0) return;

                function exitReader() {
                    if (window.parent && typeof window.parent.closeFlipbook === 'function') {
                        window.parent.closeFlipbook();
                    } else {
                        window.close();
                    }
                }

                // Close button click
                $('#reader-close-btn').click(function() {
                    exitReader();
                });

                // Alert page button click
                $('.alert-btn').click(function() {
                    exitReader();
                });

                // 1. Initialize turn.js
                book.turn({
                    width: 1000,
                    height: 600,
                    direction: dir, // Apply reading direction (LTR or RTL)
                    autoCenter: false, // Custom transition-based centering is smoother and shadows move with pages
                    acceleration: true,
                    gradients: true,
                    elevation: 50,
                    when: {
                        turning: function(event, page, view) {
                            if (isInitialized && page !== book.turn('page')) {
                                flipbookAudio.playFlip();
                            }
                            updatePageIndicator(page);
                            updateCentering(page);
                        },
                        turned: function(event, page, view) {
                            isInitialized = true;
                            updatePageIndicator(page);
                            updateCentering(page);
                        }
                    }
                });

                // 2. Keyboard listener
                $(document).keydown(function(e) {
                    var isRtl = (dir === 'rtl');
                    
                    if (currentLayout === 'scroll') {
                        var container = $('#scroll-container');
                        var scrollAmount = 180;
                        if (e.keyCode === 38 || e.keyCode === 87) { // Up arrow or W
                            container.scrollTop(container.scrollTop() - scrollAmount);
                        } else if (e.keyCode === 40 || e.keyCode === 83) { // Down arrow or S
                            container.scrollTop(container.scrollTop() + scrollAmount);
                        } else if (e.keyCode === 27) { // Escape
                            exitReader();
                        }
                        return;
                    }

                    if (e.keyCode === 37 || e.keyCode === 65) { // Left arrow or A
                        // In RTL, left arrow goes to next page, in LTR it goes to previous
                        if (isRtl) {
                            book.turn('next');
                        } else {
                            book.turn('previous');
                        }
                    } else if (e.keyCode === 39 || e.keyCode === 68) { // Right arrow or D
                        // In RTL, right arrow goes to previous page, in LTR it goes to next
                        if (isRtl) {
                            book.turn('previous');
                        } else {
                            book.turn('next');
                        }
                    } else if (e.keyCode === 27) { // Escape
                        exitReader();
                    }
                });

                // 3. Responsive Resize Handler
                function resizeBook() {
                    var viewport = $('.book-viewport');
                    var maxW = viewport.width();
                    var maxH = viewport.height();

                    // Calculate layout width and height according to targetRatio
                    var w = maxW;
                    var h = maxW / targetRatio;

                    if (h > maxH) {
                        h = maxH;
                        w = maxH * targetRatio;
                    }

                    // Apply padding space inside viewport
                    w = Math.floor(w * 0.90);
                    h = Math.floor(h * 0.90);

                    // Resize turn.js instance
                    if (book.turn('is')) {
                        book.turn('size', w, h);
                    } else {
                        book.css({ width: w, height: h });
                    }
                }

                // Bind Window Resize
                $(window).resize(function() {
                    resizeBook();
                });

                // 4. Preload and determine aspect ratio of pages dynamically
                var firstImg = book.find('img').first();
                if (firstImg.length) {
                    var img = new Image();
                    img.onload = function() {
                        var aspect = this.width / this.height;
                        singlePageAspect = aspect;
                        // Spread is 2 times width of single page
                        targetRatio = aspect * 2;
                        resizeBook();
                        
                        // Fade out spinner, fade in viewport
                        $('.loader-container').fadeOut(300, function() {
                            $('.book-viewport').css('opacity', '1');
                        });
                    };
                    img.src = firstImg.attr('src');
                } else {
                    resizeBook();
                    $('.loader-container').fadeOut(300, function() {
                        $('.book-viewport').css('opacity', '1');
                    });
                }

                // 5. Navigation Arrow click handlers
                $('.nav-btn-prev').click(function() {
                    // Left navigation button (.nav-btn-prev) goes 'next' in RTL, 'previous' in LTR
                    if (dir === 'rtl') {
                        book.turn('next');
                    } else {
                        book.turn('previous');
                    }
                });
                $('.nav-btn-next').click(function() {
                    // Right navigation button (.nav-btn-next) goes 'previous' in RTL, 'next' in LTR
                    if (dir === 'rtl') {
                        book.turn('previous');
                    } else {
                        book.turn('next');
                    }
                });

                // 6. CSS Scaling Zoom controls + panning when zoomed in

                // Pan state
                var panX = 0, panY = 0;
                var isPanning = false;
                var panStartX = 0, panStartY = 0;
                var panOriginX = 0, panOriginY = 0;

                function applyZoom() {
                    if (currentLayout === 'scroll') {
                        var baseWidth = 800; // Default max-width for scroll images
                        var newWidth = Math.floor(baseWidth * zoomFactor);
                        $('.scroll-page-img').css('max-width', 'min(95%, ' + newWidth + 'px)');
                        $('.zoom-display').text(Math.round(zoomFactor * 100) + '%');
                    } else {
                        // Apply both pan (translate) and scale on the container.
                        // translate is applied before scale so we keep consistent behavior.
                        $('.flipbook-container').css({
                            'transform': 'translate(' + panX + 'px, ' + panY + 'px) scale(' + zoomFactor + ')',
                            'transition': 'transform 0.25s cubic-bezier(0.2, 0.8, 0.2, 1)'
                        });
                        // Toggle a class for cursor affordance
                        if (zoomFactor > 1.0) {
                            $('.flipbook-container').addClass('zoomed');
                        } else {
                            $('.flipbook-container').removeClass('zoomed');
                            panX = 0; panY = 0; // reset pan when unzoomed
                            $('.flipbook-container').css('transform', 'scale(' + zoomFactor + ')');
                        }
                        $('.zoom-display').text(Math.round(zoomFactor * 100) + '%');
                    }
                }

                $('.control-btn-zoom-in').click(function() {
                    zoomFactor = Math.min(3.0, zoomFactor + 0.2);
                    applyZoom();
                });

                $('.control-btn-zoom-out').click(function() {
                    zoomFactor = Math.max(0.6, zoomFactor - 0.2);
                    // clamp pan to reasonable bounds after zoom change
                    applyZoom();
                });

                $('.control-btn-zoom-reset').click(function() {
                    zoomFactor = 1.0;
                    panX = 0; panY = 0;
                    applyZoom();
                });

                // Prevent image/context menu copy on right-click inside the flipbook
                $(document).on('contextmenu', function(e) {
                    if ($(e.target).closest('.flipbook').length) {
                        e.preventDefault();
                    }
                });
                $('.flipbook').on('contextmenu', 'img', function(e){ e.preventDefault(); });

                // Mouse-based panning (middle mouse button) when zoomed in
                $('.flipbook-container').on('mousedown', function(e) {
                    if (zoomFactor <= 1) return; // only pan when zoomed
                    if (e.button !== 1) return; // middle mouse only to avoid interfering with flip gestures
                    isPanning = true;
                    panStartX = e.pageX;
                    panStartY = e.pageY;
                    panOriginX = panX;
                    panOriginY = panY;
                    $('.flipbook-container').addClass('dragging');
                    e.preventDefault();
                });

                $(document).on('mousemove', function(e) {
                    if (!isPanning) return;
                    var dx = e.pageX - panStartX;
                    var dy = e.pageY - panStartY;
                    // account for scale so movement feels natural
                    panX = panOriginX + dx / zoomFactor;
                    panY = panOriginY + dy / zoomFactor;
                    applyZoom();
                }).on('mouseup', function(e) {
                    if (isPanning) {
                        isPanning = false;
                        $('.flipbook-container').removeClass('dragging');
                    }
                });

                // Touch-based panning with two fingers
                $('.flipbook-container').on('touchstart', function(e) {
                    if (zoomFactor <= 1) return;
                    if (!e.touches || e.touches.length !== 2) return;
                    isPanning = true;
                    var t0 = e.touches[0];
                    var t1 = e.touches[1];
                    panStartX = (t0.clientX + t1.clientX) / 2;
                    panStartY = (t0.clientY + t1.clientY) / 2;
                    panOriginX = panX; panOriginY = panY;
                    e.preventDefault();
                });
                $('.flipbook-container').on('touchmove', function(e) {
                    if (!isPanning) return;
                    if (!e.touches || e.touches.length !== 2) return;
                    var t0 = e.touches[0];
                    var t1 = e.touches[1];
                    var cx = (t0.clientX + t1.clientX) / 2;
                    var cy = (t0.clientY + t1.clientY) / 2;
                    var dx = cx - panStartX;
                    var dy = cy - panStartY;
                    panX = panOriginX + dx / zoomFactor;
                    panY = panOriginY + dy / zoomFactor;
                    applyZoom();
                });
                $('.flipbook-container').on('touchend touchcancel', function(e) {
                    isPanning = false;
                });

                // Layout switching handler
                $('.layout-btn').click(function() {
                    var newLayout = $(this).data('layout');
                    if (newLayout === currentLayout) return;

                    $('.layout-btn').removeClass('active');
                    $(this).addClass('active');
                    
                    // Reset zoom state on layout switch to prevent layout breaks
                    zoomFactor = 1.0;
                    panX = 0; panY = 0;

                    // Deactivate scroll mode if active
                    if (currentLayout === 'scroll') {
                        $('#scroll-container').hide();
                        $('.flipbook-wrapper').show();
                        $('.nav-btn').show();
                    }

                    currentLayout = newLayout;

                    if (currentLayout === 'scroll') {
                        $('.flipbook-wrapper').hide();
                        $('.nav-btn').hide();
                        $('#scroll-container').show().scrollTop(0);
                        applyZoom();
                        updatePageIndicator(1);
                    } else if (currentLayout === 'single') {
                        book.turn('display', 'single');
                        targetRatio = singlePageAspect;
                        resizeBook();
                        applyZoom();
                        updateCentering(book.turn('page'));
                        updatePageIndicator(book.turn('page'));
                    } else if (currentLayout === 'flipbook') {
                        book.turn('display', 'double');
                        targetRatio = singlePageAspect * 2;
                        resizeBook();
                        applyZoom();
                        updateCentering(book.turn('page'));
                        updatePageIndicator(book.turn('page'));
                    }
                });

                // Scroll container page indicator monitoring
                $('#scroll-container').scroll(function() {
                    if (currentLayout !== 'scroll') return;
                    var containerTop = $(this).scrollTop();
                    var containerHeight = $(this).height();
                    var images = $('.scroll-page-img');
                    var activeIndex = 0;
                    
                    images.each(function(index, img) {
                        var imgTop = $(img).position().top;
                        if (imgTop < containerHeight / 2) {
                            activeIndex = index;
                        }
                    });
                    
                    $('.page-indicator').text('Page ' + (activeIndex + 1) + ' of ' + pagesCount);
                });

                // 7. Page indicator mapping
                function updatePageIndicator(page) {
                    if (currentLayout === 'scroll') {
                        $('.page-indicator').text('Page 1 of ' + pagesCount);
                        return;
                    }
                    var total = book.turn('pages');
                    var label = '';
                    if (page === 1) {
                        label = 'Cover';
                    } else if (page === total && hasBackCover) {
                        label = 'Back Cover';
                    } else {
                        var view = book.turn('view', page);
                        if (view[0] && view[1]) {
                            label = 'Pages ' + view[0] + '–' + view[1];
                        } else if (view[0]) {
                            label = 'Page ' + view[0];
                        } else {
                            label = 'Page ' + view[1];
                        }
                    }
                    $('.page-indicator').text(label + ' of ' + total);
                    
                    // Hide/show navigation buttons near boundaries
                    var leftBtn = $('.nav-btn-prev');
                    var rightBtn = $('.nav-btn-next');
                    
                    if (dir === 'rtl') {
                        // At page 1 (cover), the right navigation button goes backward (so disable it)
                        if (page === 1) {
                            rightBtn.css('opacity', '0.2').css('pointer-events', 'none');
                        } else {
                            rightBtn.css('opacity', '1').css('pointer-events', 'all');
                        }
                        // At page total (back cover), the left navigation button goes forward (so disable it)
                        if (page === total) {
                            leftBtn.css('opacity', '0.2').css('pointer-events', 'none');
                        } else {
                            leftBtn.css('opacity', '1').css('pointer-events', 'all');
                        }
                    } else {
                        // LTR
                        if (page === 1) {
                            leftBtn.css('opacity', '0.2').css('pointer-events', 'none');
                        } else {
                            leftBtn.css('opacity', '1').css('pointer-events', 'all');
                        }
                        if (page === total) {
                            rightBtn.css('opacity', '0.2').css('pointer-events', 'none');
                        } else {
                            rightBtn.css('opacity', '1').css('pointer-events', 'all');
                        }
                    }
                }

                function updateCentering(page) {
                    if (currentLayout === 'single') {
                        $('.flipbook-wrapper').css('transform', 'translateX(0)');
                        return;
                    }
                    var total = book.turn('pages');
                    var wrapper = $('.flipbook-wrapper');

                    if (total > 1) {
                        if (page === 1) {
                            // In RTL, the cover is on the left half of the spread, so shift right (+25%)
                            // In LTR, the cover is on the right half of the spread, so shift left (-25%)
                            var shift = (dir === 'rtl') ? '25%' : '-25%';
                            wrapper.css('transform', 'translateX(' + shift + ')');
                        } else if (page === total && hasBackCover) {
                            // In RTL, the back cover is on the right half, so shift left (-25%)
                            // In LTR, the back cover is on the left half, so shift right (+25%)
                            var shift = (dir === 'rtl') ? '-25%' : '25%';
                            wrapper.css('transform', 'translateX(' + shift + ')');
                        } else {
                            wrapper.css('transform', 'translateX(0)');
                        }
                    } else {
                        wrapper.css('transform', 'translateX(0)');
                    }
                }
                
                // Initialize indicator bounds & centering
                updatePageIndicator(1);
                updateCentering(1);
                flipbookAudio.init();
            });
        </script>
    <?php endif; ?>
</body>
</html>
