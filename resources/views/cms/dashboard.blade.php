<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CMS Dashboard | Yan</title>
    
    <!-- Fonts -->
    <link href="https://fonts.cdnfonts.com/css/ibm-plex-mono-3" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}?v={{ time() }}">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    
    <style>
        :root {
            --bg-color: #0b0f19;
            --card-bg: rgba(17, 24, 39, 0.5);
            --border-color: rgba(255, 255, 255, 0.08);
            --text-color: #f3f4f6;
            --text-muted: #9ca3af;
            --accent-color: #fb7185;
            --accent-hover: #f43f5e;
            --font-mono: 'IBM Plex Mono', monospace;
            --font-sans: 'Inter', sans-serif;
            --success-color: #10b981;
        }

        body.light-theme {
            --bg-color: #f8fafc;
            --card-bg: rgba(255, 255, 255, 0.65);
            --border-color: rgba(0, 0, 0, 0.08);
            --text-color: #0f172a;
            --text-muted: #64748b;
            --accent-color: #e11d48;
            --accent-hover: #be123c;
            --success-color: #059669;
        }

         body {
            margin: 0;
            padding: 0;
            background-color: var(--bg-color);
            color: var(--text-color);
            font-family: var(--font-sans);
            min-height: 100vh;
        }

        /* Custom Scrollbar for CMS Dashboard */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--bg-color);
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, var(--accent-color), #a29bfe);
            border-radius: 4px;
        }

        body.light-theme ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, var(--accent-color), #7c3aed);
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, var(--accent-hover), #8b5cf6);
        }

        body.light-theme ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, var(--accent-hover), #6d28d9);
        }

        /* Support for Firefox scrollbar color */
        * {
            scrollbar-width: thin;
            scrollbar-color: var(--accent-color) var(--bg-color);
        }

        h1, h2, h3, h4, h5, h6 {
            color: var(--text-color) !important;
        }

        .dashboard-layout {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
        }

        .dashboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 2rem;
            border-bottom: 1px solid var(--border-color);
            margin-bottom: 2rem;
        }

        .header-left h1 {
            font-family: var(--font-mono);
            font-size: 2rem;
            font-weight: 800;
            margin: 0;
            letter-spacing: -0.02em;
        }

        .header-left span {
            display: block;
            font-family: var(--font-mono);
            font-size: 0.8rem;
            color: var(--accent-color);
            text-transform: uppercase;
            letter-spacing: 0.15em;
            margin-bottom: 0.25rem;
        }

        #btn-logout {
            color: var(--accent-color);
            border-color: rgba(251, 113, 133, 0.2);
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 0.6rem 1.2rem;
            border-radius: 8px;
            font-family: var(--font-mono);
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .btn-primary {
            background-color: var(--accent-color);
            color: #fff;
            border: none;
        }

        .btn-primary:hover {
            background-color: var(--accent-hover);
            transform: translateY(-1px);
        }

        .btn-secondary {
            background-color: transparent;
            color: var(--text-color);
            border: 1px solid var(--border-color);
        }

        .btn-secondary:hover {
            background-color: rgba(255, 255, 255, 0.05);
        }
        
        body.light-theme .btn-secondary:hover {
            background-color: rgba(0, 0, 0, 0.05);
        }

        .btn-danger {
            background-color: rgba(239, 68, 68, 0.15);
            color: #f87171;
            border: 1px solid rgba(239, 68, 68, 0.3);
        }

        .btn-danger:hover {
            background-color: rgba(239, 68, 68, 0.25);
            color: #ef4444;
        }

        /* Stats Cards */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            backdrop-filter: blur(8px);
        }

        .stat-title {
            font-family: var(--font-mono);
            font-size: 0.75rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .stat-value {
            font-size: 2.25rem;
            font-weight: 800;
            margin: 0;
            color: var(--accent-color);
        }

        /* Tabs Navigation */
        .tabs-nav {
            display: flex;
            gap: 1rem;
            border-bottom: 1px solid var(--border-color);
            margin-bottom: 1.5rem;
        }

        .tab-btn {
            background: none;
            border: none;
            color: var(--text-muted);
            font-family: var(--font-mono);
            font-size: 0.85rem;
            font-weight: 600;
            padding: 1rem 0.5rem;
            cursor: pointer;
            position: relative;
            transition: color 0.2s ease;
        }

        .tab-btn:hover {
            color: var(--text-color);
        }

        .tab-btn.active {
            color: var(--accent-color);
        }

        .tab-btn.active::after {
            content: '';
            position: absolute;
            bottom: -1px;
            left: 0;
            right: 0;
            height: 2px;
            background-color: var(--accent-color);
        }

        /* Success Alert */
        .alert-success {
            background-color: rgba(16, 185, 129, 0.15);
            border: 1px solid rgba(16, 185, 129, 0.3);
            color: var(--success-color);
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            font-family: var(--font-mono);
            font-size: 0.85rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Danger Alert */
        .alert-danger {
            background-color: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #f87171;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            font-family: var(--font-mono);
            font-size: 0.85rem;
        }
        .alert-danger ul {
            margin: 0;
            padding-left: 1.25rem;
        }
        .alert-danger li {
            margin-bottom: 0.25rem;
        }
        .alert-danger li:last-child {
            margin-bottom: 0;
        }

        /* Table & Items List */
        .items-section {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 1.5rem;
            backdrop-filter: blur(8px);
        }

        .section-header-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .search-input {
            padding: 0.6rem 1rem;
            background: rgba(0, 0, 0, 0.2);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            color: var(--text-color);
            font-size: 0.85rem;
            width: 100%;
            max-width: 300px;
        }
        
        body.light-theme .search-input {
            background: rgba(255, 255, 255, 0.6);
        }

        .search-input:focus {
            outline: none;
            border-color: var(--accent-color);
        }

        .items-table-wrapper {
            overflow-x: auto;
        }

        table.items-table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        table.items-table th {
            font-family: var(--font-mono);
            font-size: 0.75rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 1rem;
            border-bottom: 1px solid var(--border-color);
        }

        table.items-table td {
            padding: 1rem;
            border-bottom: 1px solid var(--border-color);
            vertical-align: middle;
            font-size: 0.9rem;
        }

        table.items-table tr:last-child td {
            border-bottom: none;
        }

        .img-preview {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            object-fit: cover;
            border: 1px solid var(--border-color);
            background-color: rgba(0, 0, 0, 0.2);
        }

        .badge {
            display: inline-block;
            font-family: var(--font-mono);
            font-size: 0.7rem;
            font-weight: 600;
            padding: 0.25rem 0.5rem;
            border-radius: 4px;
            text-transform: uppercase;
        }

        .badge-info {
            background-color: rgba(59, 130, 246, 0.15);
            color: #93c5fd;
            border: 1px solid rgba(59, 130, 246, 0.3);
        }

        .badge-warning {
            background-color: rgba(245, 158, 11, 0.15);
            color: #fde68a;
            border: 1px solid rgba(245, 158, 11, 0.3);
        }

        .badge-success {
            background-color: rgba(16, 185, 129, 0.15);
            color: #a7f3d0;
            border: 1px solid rgba(16, 185, 129, 0.3);
        }

        .actions-cell {
            display: flex;
            gap: 0.5rem;
        }

        /* Modals */
        .modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(8px);
            z-index: 100;
            display: flex;
            justify-content: center;
            align-items: center;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }

        .modal.active {
            opacity: 1;
            pointer-events: auto;
        }

        .modal-content {
            background: var(--bg-color);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            width: 100%;
            max-width: 550px;
            max-height: 90vh;
            overflow-y: auto;
            padding: 2rem;
            box-shadow: 0 25px 50px -12px rgba(0,0,0,0.5);
            transform: scale(0.95);
            transition: transform 0.3s ease;
        }

        .modal.active .modal-content {
            transform: scale(1);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .modal-title {
            font-size: 1.25rem;
            font-weight: 800;
            margin: 0;
        }

        .modal-close {
            background: none;
            border: none;
            color: var(--text-muted);
            font-size: 1.5rem;
            cursor: pointer;
        }

        .modal-close:hover {
            color: var(--text-color);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            display: block;
            font-family: var(--font-mono);
            font-size: 0.75rem;
            color: var(--text-muted);
            margin-bottom: 0.5rem;
            text-transform: uppercase;
        }

        .form-input, .form-select {
            width: 100%;
            padding: 0.7rem 0.85rem;
            box-sizing: border-box;
            background: rgba(0, 0, 0, 0.2);
            border: 1px solid var(--border-color);
            border-radius: 6px;
            color: var(--text-color);
            font-family: var(--font-sans);
            font-size: 0.9rem;
        }
        
        body.light-theme .form-input, body.light-theme .form-select {
            background: rgba(255, 255, 255, 0.6);
        }

        .form-input:focus, .form-select:focus {
            outline: none;
            border-color: var(--accent-color);
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
            margin-top: 1.5rem;
        }

        .upload-placeholder {
            border: 2px dashed var(--border-color);
            border-radius: 8px;
            padding: 1.5rem;
            text-align: center;
            cursor: pointer;
            transition: border-color 0.2s ease, background-color 0.2s ease, transform 0.2s ease, box-shadow 0.2s ease;
        }

        .upload-placeholder:hover, .upload-placeholder.dragover {
            border-color: var(--accent-color);
        }

        .upload-placeholder.dragover {
            background-color: rgba(251, 113, 133, 0.08);
            transform: scale(1.02);
            box-shadow: 0 4px 12px rgba(251, 113, 133, 0.15);
        }

        body.light-theme .upload-placeholder.dragover {
            background-color: rgba(225, 29, 72, 0.05);
        }

        .upload-placeholder p {
            margin: 0;
            font-size: 0.8rem;
            color: var(--text-muted);
        }

        .upload-preview-container {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-top: 0.5rem;
        }

        .upload-preview-img {
            width: 80px;
            height: 80px;
            border-radius: 6px;
            object-fit: cover;
            border: 1px solid var(--border-color);
        }

        .direction-toggle-btn {
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: 99px;
            padding: 4px 12px;
            font-size: 0.72rem;
            font-weight: 600;
            cursor: pointer;
            font-family: var(--font-mono);
            transition: all 0.25s ease;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        .direction-toggle-btn.ltr-active {
            background: rgba(160, 60, 220, 0.1);
            color: #a03cdc;
            border-color: rgba(160, 60, 220, 0.25);
        }
        .direction-toggle-btn.rtl-active {
            background: rgba(46, 204, 113, 0.1);
            color: #2ecc71;
            border-color: rgba(46, 204, 113, 0.25);
        }
        body.light-theme .direction-toggle-btn.ltr-active {
            background: rgba(124, 58, 237, 0.1);
            color: #6d28d9;
            border-color: rgba(124, 58, 237, 0.2);
        }
        body.light-theme .direction-toggle-btn.rtl-active {
            background: rgba(5, 150, 105, 0.1);
            color: #047857;
            border-color: rgba(5, 150, 105, 0.2);
        }
        .direction-toggle-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        /* About Editor Styles */
        .about-editor-container {
            display: flex;
            gap: 2.5rem;
            align-items: flex-start;
            flex-wrap: wrap;
            margin-top: 1rem;
        }

        .about-preview-column {
            flex: 0 0 320px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1rem;
        }

        .about-form-column {
            flex: 1;
            min-width: 320px;
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        /* Replica of welcome page about card for true preview */
        .about-card-preview-frame {
            position: relative;
            width: 290px;
            height: 550px;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
            border: 6px solid transparent;
            background: linear-gradient(#1d1d1d, #1d1d1d) padding-box,
                linear-gradient(45deg, var(--accent-1, #ff7675), var(--accent-2, #74b9ff), var(--accent-3, #a29bfe), var(--accent-1, #ff7675)) border-box;
            background-size: 100% 100%, 400% 400%;
            animation: neonGlow 6s linear infinite;
        }

        .about-card-preview-image {
            position: relative;
            height: 100%;
            width: 100%;
            overflow: hidden;
            background-color: #121214;
        }

        .about-card-preview-image img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transform-origin: center;
            cursor: grab;
            user-select: none;
            -webkit-user-drag: none;
        }

        .about-card-preview-image img:active {
            cursor: grabbing;
        }

        .about-card-preview-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, rgba(29, 29, 29, 0) 60%, #1d1d1d 100%);
            pointer-events: none;
            z-index: 2;
        }

        /* Rich Text Editor Styling */
        .rich-editor-box {
            border: 1px solid var(--border-color);
            border-radius: 12px;
            background: rgba(0, 0, 0, 0.2);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            backdrop-filter: blur(8px);
        }

        body.light-theme .rich-editor-box {
            background: rgba(255, 255, 255, 0.6);
        }

        .rich-editor-toolbar {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            padding: 8px 12px;
            border-bottom: 1px solid var(--border-color);
            background: rgba(0, 0, 0, 0.15);
            align-items: center;
        }

        body.light-theme .rich-editor-toolbar {
            background: rgba(0, 0, 0, 0.03);
        }

        .toolbar-btn {
            background: none;
            border: 1px solid transparent;
            color: var(--text-color);
            width: 32px;
            height: 32px;
            border-radius: 6px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            transition: all 0.2s ease;
        }

        .toolbar-btn:hover {
            background: rgba(255, 255, 255, 0.1);
            border-color: var(--border-color);
        }

        body.light-theme .toolbar-btn:hover {
            background: rgba(0, 0, 0, 0.05);
        }

        .toolbar-btn.active {
            background: var(--accent-color);
            color: #fff;
        }

        .toolbar-select {
            background: rgba(0, 0, 0, 0.3);
            border: 1px solid var(--border-color);
            color: var(--text-color);
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 0.8rem;
            font-family: var(--font-sans);
            cursor: pointer;
            outline: none;
            transition: border-color 0.2s;
        }

        body.light-theme .toolbar-select {
            background: rgba(255, 255, 255, 0.8);
        }

        .toolbar-select:focus {
            border-color: var(--accent-color);
        }

        .rich-editor-content {
            min-height: 250px;
            max-height: 450px;
            overflow-y: auto;
            padding: 1.5rem;
            outline: none;
            color: var(--text-color);
            font-family: 'IBM Plex Serif', 'Georgia', serif !important;
            font-size: 1.05rem;
            line-height: 1.8;
        }

        /* WYSIWYG matching welcome page styles */
        .rich-editor-content p {
            margin-bottom: 1.2rem;
        }
        
        .rich-editor-content p:last-child {
            margin-bottom: 0;
        }

        .rich-editor-content strong {
            font-weight: 700;
            color: var(--accent-color);
        }
        
        body.light-theme .rich-editor-content strong {
            color: var(--accent-color);
        }

        /* Preview Helper Info */
        .preview-instruction-tag {
            background: rgba(251, 113, 133, 0.1);
            color: var(--accent-color);
            padding: 4px 10px;
            border-radius: 99px;
            font-size: 0.72rem;
            font-family: var(--font-mono);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            display: inline-block;
            margin-bottom: 0.5rem;
        }

        /* Analytics Tab Styles */
        .analytics-grid-metrics {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .metric-card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 1.25rem 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
            backdrop-filter: blur(8px);
        }

        .metric-title {
            font-family: var(--font-mono);
            font-size: 0.72rem;
            color: var(--text-muted);
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .metric-value {
            font-size: 2rem;
            font-weight: 800;
            margin: 0;
            color: var(--accent-color);
        }

        .metric-subtitle {
            font-size: 0.75rem;
            color: var(--text-muted);
        }

        .charts-row {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        @media (max-width: 992px) {
            .charts-row {
                grid-template-columns: 1fr;
            }
        }

        .chart-card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 1.5rem;
            backdrop-filter: blur(8px);
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .chart-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .chart-card-title {
            font-family: var(--font-mono);
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--text-color);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin: 0;
        }

        .chart-container {
            position: relative;
            width: 100%;
            height: 320px;
        }

        .tables-row {
            display: grid;
            grid-template-columns: 1fr 1.5fr;
            gap: 1.5rem;
        }

        @media (max-width: 992px) {
            .tables-row {
                grid-template-columns: 1fr;
            }
        }

        .table-card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 1.5rem;
            backdrop-filter: blur(8px);
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .progress-bar-container {
            width: 100%;
            height: 6px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 3px;
            overflow: hidden;
            margin-top: 4px;
        }

        body.light-theme .progress-bar-container {
            background: rgba(0, 0, 0, 0.05);
        }

        .progress-bar-fill {
            height: 100%;
            background: var(--accent-color);
            border-radius: 3px;
        }

        .referer-link {
            max-width: 250px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            display: inline-block;
            font-size: 0.8rem;
            color: var(--accent-color);
        }

        .referer-link:hover {
            text-decoration: underline;
        }

        /* Switch/Toggle Toggle Styles */
        .switch-container {
            position: relative;
            display: inline-block;
            width: 48px;
            height: 26px;
            flex-shrink: 0;
        }

        .switch-container input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .switch-slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid var(--border-color);
            transition: .3s;
            border-radius: 34px;
        }

        body.light-theme .switch-slider {
            background-color: rgba(0, 0, 0, 0.05);
        }

        .switch-slider:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 3px;
            bottom: 3px;
            background-color: #fff;
            transition: .3s;
            border-radius: 50%;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        }
        
        body.light-theme .switch-slider:before {
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .switch-container input:checked + .switch-slider {
            background-color: var(--accent-color);
            border-color: transparent;
        }

        .switch-container input:checked + .switch-slider:before {
            transform: translateX(22px);
        }

        /* Item Card Preview (Modal) Styles */
        .item-card-preview-frame {
            position: relative;
            width: 100%;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            border: 3px solid transparent;
            background: linear-gradient(#1d1d1d, #1d1d1d) padding-box,
                linear-gradient(45deg, var(--accent-1, #ff7675), var(--accent-2, #74b9ff), var(--accent-3, #a29bfe), var(--accent-1, #ff7675)) border-box;
            background-size: 100% 100%, 400% 400%;
            animation: neonGlow 6s linear infinite;
            margin: 0 auto;
            transition: all 0.3s ease;
        }
        
        .item-card-preview-frame.aspect-portrait {
            height: 380px;
            max-width: 285px; /* 3:4 aspect ratio */
        }
        
        .item-card-preview-frame.aspect-landscape {
            height: 280px;
            max-width: 370px; /* 4:3 aspect ratio */
        }

        .item-card-preview-image {
            position: relative;
            height: 100%;
            width: 100%;
            overflow: hidden;
            background-color: #121214;
        }

        .item-card-preview-image img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transform-origin: center;
            cursor: grab;
            user-select: none;
            -webkit-user-drag: none;
        }

        .item-card-preview-image img:active {
            cursor: grabbing;
        }

        /* Drag & Drop Reordering Styles */
        .portfolio-item-row.dragging {
            opacity: 0.4;
            background-color: rgba(251, 113, 133, 0.1) !important;
        }
        .portfolio-item-row.drag-over-above {
            border-top: 3px solid var(--accent-color) !important;
        }
        .portfolio-item-row.drag-over-below {
            border-bottom: 3px solid var(--accent-color) !important;
        }
        .drag-handle {
            cursor: grab;
            user-select: none;
            color: var(--text-muted);
            padding: 0.5rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            transition: color 0.2s ease;
            touch-action: none;
        }
        .drag-handle:hover {
            color: var(--accent-color);
        }
        .drag-handle:active {
            cursor: grabbing;
        }
        .drag-notice {
            font-family: var(--font-mono);
            font-size: 0.78rem;
            color: var(--text-muted);
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .illustration-subtab-btn.active {
            background-color: var(--accent-color) !important;
            color: #fff !important;
            border-color: var(--accent-color) !important;
        }
    </style>
</head>
<body>
    <div class="dashboard-layout">
        <!-- Header -->
        <div class="dashboard-header">
            <div class="header-left">
                <span>CMS Manager</span>
                <h1>PORTFOLIO SYSTEM</h1>
            </div>
            <div class="header-right">
                <a href="{{ url('/') }}" class="btn btn-secondary" id="btn-view-site" target="_blank">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path><polyline points="15 3 21 3 21 9"></polyline><line x1="10" y1="14" x2="21" y2="3"></line></svg>
                    Public Site
                </a>
                <button class="btn btn-secondary" id="btn-theme-toggle" onclick="toggleTheme()">
                    Theme Mode
                </button>
                <form action="{{ route('logout') }}" method="POST" id="logout-form" style="margin: 0;">
                    @csrf
                    <button type="submit" class="btn btn-secondary" id="btn-logout">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                        Log Out
                    </button>
                </form>
            </div>
        </div>

        <!-- Notification Banner -->
        @if(session('success'))
            <div class="alert-success" id="success-banner">
                <span>{{ session('success') }}</span>
                <button style="background: none; border: none; color: inherit; cursor: pointer; font-size: 1rem;" onclick="this.parentElement.remove()">×</button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert-danger" id="error-banner">
                <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button style="background: none; border: none; color: inherit; cursor: pointer; font-size: 1rem; line-height: 1;" onclick="this.parentElement.parentElement.remove()">×</button>
                </div>
            </div>
        @endif

        <!-- Stats Overview -->
        <div class="stats-grid">
            <div class="stat-card" id="card-stat-illustrations">
                <span class="stat-title">Illustrations</span>
                <p class="stat-value">{{ $illustrations->count() }}</p>
            </div>
            <div class="stat-card" id="card-stat-comics">
                <span class="stat-title">Comics & Manga</span>
                <p class="stat-value">{{ $comics->count() }}</p>
            </div>
            <div class="stat-card" id="card-stat-concepts">
                <span class="stat-title">Works Gallery</span>
                <p class="stat-value">{{ $concepts->count() }}</p>
            </div>
        </div>

        <!-- Section Navigation Tabs -->
        <div class="tabs-nav">
            <button class="tab-btn active" id="tab-btn-illustrations" onclick="switchTab('illustrations')">ILLUSTRATIONS</button>
            <button class="tab-btn" id="tab-btn-comics" onclick="switchTab('comics')">COMICS & MANGA</button>
            <button class="tab-btn" id="tab-btn-concepts" onclick="switchTab('concepts')">WORKS GALLERY</button>
            <button class="tab-btn" id="tab-btn-commissions" onclick="switchTab('commissions')">COMMISSIONS</button>
            <button class="tab-btn" id="tab-btn-about" onclick="switchTab('about')">ABOUT SECTION</button>
            <button class="tab-btn" id="tab-btn-analytics" onclick="switchTab('analytics')">ANALYTICS</button>
            <button class="tab-btn" id="tab-btn-socials" onclick="switchTab('socials')">SOCIALS</button>
            <button class="tab-btn" id="tab-btn-settings" onclick="switchTab('settings')">SETTINGS</button>
        </div>

        <!-- Items Table Section -->
        <div class="items-section">
            <div class="section-header-row">
                <input type="text" class="search-input" id="items-search" placeholder="Search title or category..." oninput="handleSearch()">
                <button class="btn btn-primary" id="btn-add-item" onclick="openAddModal()">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    Add Portfolio Item
                </button>
            </div>

            <!-- ILLUSTRATIONS TAB CONTENT -->
            <div class="tab-content active" id="content-illustrations">
                <div style="display: flex; gap: 0.75rem; margin-bottom: 1.25rem;">
                    <button class="btn btn-secondary illustration-subtab-btn active" data-subtab="original" onclick="switchIllustrationSubTab('original')">Original</button>
                    <button class="btn btn-secondary illustration-subtab-btn" data-subtab="fanart" onclick="switchIllustrationSubTab('fanart')">Fanart</button>
                    <button class="btn btn-secondary illustration-subtab-btn" data-subtab="spicy" onclick="switchIllustrationSubTab('spicy')">🌶️ Spicy</button>
                </div>

                <div class="drag-notice" id="drag-instructions">
                    💡 <span>Drag and drop rows using the <b>☰</b> handle to rearrange the order of appearance. (Sorting is disabled while search is active)</span>
                </div>

                <!-- Original Table Wrapper -->
                <div class="items-table-wrapper illustration-subtab-content" id="subtab-content-original">
                    <table class="items-table" id="table-illustrations-original">
                        <thead>
                            <tr>
                                <th style="width: 40px; text-align: center;">Sort</th>
                                <th style="width: 80px;">Preview</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Gallery Type</th>
                                <th>Uploaded At</th>
                                <th style="width: 150px; text-align: right;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($illustrations->where('type', 'original') as $item)
                                <tr class="portfolio-item-row" data-id="{{ $item->id }}" data-search="{{ strtolower($item->title . ' ' . $item->category) }}">
                                    <td style="text-align: center; vertical-align: middle;">
                                        <span class="drag-handle" title="Drag to reorder">☰</span>
                                    </td>
                                    <td>
                                        <img src="{{ str_starts_with($item->image_path, 'http') ? $item->image_path : asset('storage/' . $item->image_path) }}" alt="Preview" class="img-preview">
                                    </td>
                                    <td style="font-weight: 600;">{{ $item->title }}</td>
                                    <td>{{ $item->category }}</td>
                                    <td><span class="badge badge-info">Original</span></td>
                                    <td style="font-family: var(--font-mono); font-size: 0.8rem; color: var(--text-muted);">{{ $item->created_at->format('Y-m-d H:i') }}</td>
                                    <td>
                                        <div class="actions-cell">
                                            <button class="btn btn-secondary" onclick="openEditModal({{ json_encode($item) }})">Edit</button>
                                            <form action="{{ route('cms.items.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?')" style="margin:0;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" style="text-align: center; color: var(--text-muted); font-family: var(--font-mono); padding: 3rem;">No original illustrations found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Fanart Table Wrapper -->
                <div class="items-table-wrapper illustration-subtab-content" id="subtab-content-fanart" style="display: none;">
                    <table class="items-table" id="table-illustrations-fanart">
                        <thead>
                            <tr>
                                <th style="width: 40px; text-align: center;">Sort</th>
                                <th style="width: 80px;">Preview</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Gallery Type</th>
                                <th>Uploaded At</th>
                                <th style="width: 150px; text-align: right;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($illustrations->where('type', 'fanart') as $item)
                                <tr class="portfolio-item-row" data-id="{{ $item->id }}" data-search="{{ strtolower($item->title . ' ' . $item->category) }}">
                                    <td style="text-align: center; vertical-align: middle;">
                                        <span class="drag-handle" title="Drag to reorder">☰</span>
                                    </td>
                                    <td>
                                        <img src="{{ str_starts_with($item->image_path, 'http') ? $item->image_path : asset('storage/' . $item->image_path) }}" alt="Preview" class="img-preview">
                                    </td>
                                    <td style="font-weight: 600;">{{ $item->title }}</td>
                                    <td>{{ $item->category }}</td>
                                    <td><span class="badge badge-success">Fanart</span></td>
                                    <td style="font-family: var(--font-mono); font-size: 0.8rem; color: var(--text-muted);">{{ $item->created_at->format('Y-m-d H:i') }}</td>
                                    <td>
                                        <div class="actions-cell">
                                            <button class="btn btn-secondary" onclick="openEditModal({{ json_encode($item) }})">Edit</button>
                                            <form action="{{ route('cms.items.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?')" style="margin:0;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" style="text-align: center; color: var(--text-muted); font-family: var(--font-mono); padding: 3rem;">No fanart illustrations found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Spicy Table Wrapper -->
                <div class="items-table-wrapper illustration-subtab-content" id="subtab-content-spicy" style="display: none;">
                    <table class="items-table" id="table-illustrations-spicy">
                        <thead>
                            <tr>
                                <th style="width: 40px; text-align: center;">Sort</th>
                                <th style="width: 80px;">Preview</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Gallery Type</th>
                                <th>Uploaded At</th>
                                <th style="width: 150px; text-align: right;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($illustrations->where('type', 'spicy') as $item)
                                <tr class="portfolio-item-row" data-id="{{ $item->id }}" data-search="{{ strtolower($item->title . ' ' . $item->category) }}">
                                    <td style="text-align: center; vertical-align: middle;">
                                        <span class="drag-handle" title="Drag to reorder">☰</span>
                                    </td>
                                    <td>
                                        <img src="{{ str_starts_with($item->image_path, 'http') ? $item->image_path : asset('storage/' . $item->image_path) }}" alt="Preview" class="img-preview">
                                    </td>
                                    <td style="font-weight: 600;">{{ $item->title }}</td>
                                    <td>{{ $item->category }}</td>
                                    <td><span class="badge badge-warning">🌶️ Spicy</span></td>
                                    <td style="font-family: var(--font-mono); font-size: 0.8rem; color: var(--text-muted);">{{ $item->created_at->format('Y-m-d H:i') }}</td>
                                    <td>
                                        <div class="actions-cell">
                                            <button class="btn btn-secondary" onclick="openEditModal({{ json_encode($item) }})">Edit</button>
                                            <form action="{{ route('cms.items.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?')" style="margin:0;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" style="text-align: center; color: var(--text-muted); font-family: var(--font-mono); padding: 3rem;">No spicy illustrations found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- COMICS TAB CONTENT -->
            <div class="tab-content" id="content-comics" style="display: none;">
                <div class="items-table-wrapper">
                    <table class="items-table" id="table-comics">
                        <thead>
                            <tr>
                                <th style="width: 80px;">Preview</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Reading Direction</th>
                                <th>Uploaded At</th>
                                <th style="width: 150px; text-align: right;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($comics as $item)
                                <tr class="portfolio-item-row" data-search="{{ strtolower($item->title . ' ' . $item->category) }}">
                                    <td>
                                        <img src="{{ str_starts_with($item->image_path, 'http') ? $item->image_path : asset('storage/' . $item->image_path) }}" alt="Preview" class="img-preview">
                                    </td>
                                    <td style="font-weight: 600;">{{ $item->title }}</td>
                                    <td>{{ $item->category }}</td>
                                    <td>
                                        <button type="button" class="direction-toggle-btn {{ $item->reading_direction === 'rtl' ? 'rtl-active' : 'ltr-active' }}" onclick="toggleDirection({{ $item->id }}, this)">
                                            {{ $item->reading_direction === 'rtl' ? 'RTL' : 'LTR' }}
                                        </button>
                                    </td>
                                    <td style="font-family: var(--font-mono); font-size: 0.8rem; color: var(--text-muted);">{{ $item->created_at->format('Y-m-d H:i') }}</td>
                                    <td>
                                        <div class="actions-cell">
                                            <button class="btn btn-secondary" onclick="openEditModal({{ json_encode($item) }})">Edit</button>
                                            <form action="{{ route('cms.items.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?')" style="margin:0;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" style="text-align: center; color: var(--text-muted); font-family: var(--font-mono); padding: 3rem;">No comics found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- CONCEPTS TAB CONTENT -->
            <div class="tab-content" id="content-concepts" style="display: none;">
                <div class="items-table-wrapper">
                    <table class="items-table" id="table-concepts">
                        <thead>
                            <tr>
                                <th style="width: 80px;">Preview</th>
                                <th>Title</th>
                                <th>Category</th>
                                <th>Uploaded At</th>
                                <th style="width: 150px; text-align: right;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($concepts as $item)
                                <tr class="portfolio-item-row" data-search="{{ strtolower($item->title . ' ' . $item->category) }}">
                                    <td>
                                        <img src="{{ str_starts_with($item->image_path, 'http') ? $item->image_path : asset('storage/' . $item->image_path) }}" alt="Preview" class="img-preview">
                                    </td>
                                    <td style="font-weight: 600;">{{ $item->title }}</td>
                                    <td>{{ $item->category }}</td>
                                    <td style="font-family: var(--font-mono); font-size: 0.8rem; color: var(--text-muted);">{{ $item->created_at->format('Y-m-d H:i') }}</td>
                                    <td>
                                        <div class="actions-cell">
                                            <button class="btn btn-secondary" onclick="openEditModal({{ json_encode($item) }})">Edit</button>
                                            <form action="{{ route('cms.items.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?')" style="margin:0;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Delete</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" style="text-align: center; color: var(--text-muted); font-family: var(--font-mono); padding: 3rem;">No works found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- ABOUT SECTION TAB CONTENT -->
            <div class="tab-content" id="content-about" style="display: none;">
                <div class="about-editor-container">
                    
                    <!-- Left Column: Visual Draggable/Scalable Preview -->
                    <div class="about-preview-column">
                        <span class="preview-instruction-tag">Live Card Preview</span>
                        
                        <div class="about-card-preview-frame">
                            <div class="about-card-preview-image" id="draggable-preview-container">
                                @php
                                    $isDefaultImage = $about->image_path === 'images/IMG_4171 2.png';
                                    $imgUrl = str_starts_with($about->image_path, 'http') ? $about->image_path : ($isDefaultImage ? asset($about->image_path) : asset('storage/' . $about->image_path));
                                @endphp
                                <img src="{{ $imgUrl }}" id="about-preview-image" alt="Profile image" style="transform: scale({{ $about->image_scale }}); object-position: calc(50% + {{ $about->image_offset_x }}px) calc(50% + {{ $about->image_offset_y }}px);">
                                <div class="about-card-preview-overlay"></div>
                            </div>
                        </div>
                        
                        <div style="font-size: 0.75rem; color: var(--text-muted); font-family: var(--font-mono); text-align: center; margin-top: 0.5rem; max-width: 290px;">
                            💡 Click and drag the image to pan. Use the slider below to zoom.
                        </div>
                    </div>
                    
                    <!-- Right Column: Settings & Rich Text Form -->
                    <div class="about-form-column">
                        <form action="{{ route('cms.about.update') }}" method="POST" enctype="multipart/form-data" id="about-form">
                            @csrf
                            
                            <!-- Hidden inputs for coordinates and scale -->
                            <input type="hidden" name="image_scale" id="about-image-scale" value="{{ $about->image_scale }}">
                            <input type="hidden" name="image_offset_x" id="about-image-offset-x" value="{{ $about->image_offset_x }}">
                            <input type="hidden" name="image_offset_y" id="about-image-offset-y" value="{{ $about->image_offset_y }}">
                            <input type="hidden" name="text_content" id="about-text-content" value="{{ $about->text_content }}">

                            <!-- Image upload input -->
                            <div class="form-group">
                                <label class="form-label">Replace Profile Image</label>
                                <div class="upload-placeholder" onclick="document.getElementById('about-image-input').click()">
                                    <p id="about-image-instruction">Click to select new image file (Max 5MB)</p>
                                    <input type="file" id="about-image-input" name="about_image" style="display: none;" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp" onchange="loadNewAboutImage(event)">
                                </div>
                            </div>

                            <div style="text-align: center; margin: 0.5rem 0; font-family: var(--font-mono); font-size: 0.8rem; color: var(--text-muted);">— OR —</div>

                            <div class="form-group">
                                <label for="about-image-url" class="form-label">External Image URL / Google Drive Link</label>
                                <input type="url" id="about-image-url" name="about_image_url" class="form-input" placeholder="https://drive.google.com/... or direct image link" oninput="handleAboutImageUrlInput(this.value)" value="{{ !str_starts_with($about->image_path, 'images/') && str_starts_with($about->image_path, 'http') ? $about->image_path : '' }}">
                            </div>

                            <!-- Scale slider -->
                            <div class="form-group">
                                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                                    <label class="form-label" style="margin-bottom: 0;">Zoom Level</label>
                                    <span id="zoom-value-display" style="font-size: 0.8rem; font-family: var(--font-mono); color: var(--accent-color);">{{ number_format($about->image_scale, 2) }}x</span>
                                </div>
                                <input type="range" id="about-zoom-slider" min="1.0" max="4.0" step="0.01" value="{{ $about->image_scale }}" style="width: 100%; accent-color: var(--accent-color); cursor: pointer;" oninput="handleZoomChange(this.value)">
                            </div>

                            <!-- Rich Text Box -->
                            <div class="form-group">
                                <label class="form-label">About Biography Text</label>
                                <div class="rich-editor-box">
                                    <!-- Toolbar -->
                                    <div class="rich-editor-toolbar">
                                        <!-- Weight dropdown -->
                                        <select class="toolbar-select" id="editor-weight-select" onchange="editorApplyWeight(this.value); this.selectedIndex=0;">
                                            <option value="" disabled selected>Font Weight</option>
                                            <option value="300">Light (300)</option>
                                            <option value="400">Regular (400)</option>
                                            <option value="500">Medium (500)</option>
                                            <option value="600">Semi-Bold (600)</option>
                                            <option value="700">Bold (700)</option>
                                        </select>

                                        <div style="width: 1px; height: 20px; background: var(--border-color); margin: 0 4px;"></div>

                                        <!-- Alignments -->
                                        <button type="button" class="toolbar-btn" onclick="editorAlign('left')" title="Align Left">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="17" y1="10" x2="3" y2="10"></line><line x1="21" y1="6" x2="3" y2="6"></line><line x1="21" y1="14" x2="3" y2="14"></line><line x1="17" y1="18" x2="3" y2="18"></line></svg>
                                        </button>
                                        <button type="button" class="toolbar-btn" onclick="editorAlign('center')" title="Align Center">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="10" x2="6" y2="10"></line><line x1="21" y1="6" x2="3" y2="6"></line><line x1="21" y1="14" x2="3" y2="14"></line><line x1="18" y1="18" x2="6" y2="18"></line></svg>
                                        </button>
                                        <button type="button" class="toolbar-btn" onclick="editorAlign('right')" title="Align Right">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="21" y1="10" x2="7" y2="10"></line><line x1="21" y1="6" x2="3" y2="6"></line><line x1="21" y1="14" x2="3" y2="14"></line><line x1="21" y1="18" x2="7" y2="18"></line></svg>
                                        </button>
                                        <button type="button" class="toolbar-btn" onclick="editorAlign('justify')" title="Justify">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="21" y1="10" x2="3" y2="10"></line><line x1="21" y1="6" x2="3" y2="6"></line><line x1="21" y1="14" x2="3" y2="14"></line><line x1="21" y1="18" x2="3" y2="18"></line></svg>
                                        </button>

                                        <div style="width: 1px; height: 20px; background: var(--border-color); margin: 0 4px;"></div>

                                        <!-- Bold, Italic, Underline -->
                                        <button type="button" class="toolbar-btn" onclick="editorFormat('bold')" title="Bold (Ctrl+B)"><b>B</b></button>
                                        <button type="button" class="toolbar-btn" onclick="editorFormat('italic')" title="Italic (Ctrl+I)"><i>I</i></button>
                                        <button type="button" class="toolbar-btn" onclick="editorFormat('underline')" title="Underline (Ctrl+U)"><u>U</u></button>
                                        <button type="button" class="toolbar-btn" onclick="editorFormat('removeFormat')" title="Clear Formatting">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                        </button>
                                    </div>
                                    <!-- Editor contenteditable content -->
                                    <div class="rich-editor-content" id="about-rich-editor" contenteditable="true" oninput="syncEditorHtml()">
                                        {!! $about->text_content !!}
                                    </div>
                                </div>
                            </div>

                            <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                                <button type="submit" class="btn btn-primary" style="flex: 1; justify-content: center;">Save About Content</button>
                            </div>
                        </form>

                        <form action="{{ route('cms.about.reset') }}" method="POST" onsubmit="return confirm('Are you sure you want to reset the About section to default text and image? This cannot be undone.')">
                            @csrf
                            <button type="submit" class="btn btn-secondary" style="width: 100%; justify-content: center; color: #f87171; border-color: rgba(239, 68, 68, 0.2); margin-top: 0.75rem;">
                                ↺ Reset to Default Settings
                            </button>
                        </form>
                    </div>

                </div>
            </div>

            <!-- ANALYTICS TAB CONTENT -->
            <div class="tab-content" id="content-analytics" style="display: none;">
                <!-- Summary Metrics Grid -->
                <div class="analytics-grid-metrics">
                    <div class="metric-card">
                        <span class="metric-title">Total Views</span>
                        <p class="metric-value">{{ number_format($analytics['total_views']) }}</p>
                        <span class="metric-subtitle">Lifetime page hits</span>
                    </div>
                    <div class="metric-card">
                        <span class="metric-title">Unique Visitors</span>
                        <p class="metric-value">{{ number_format($analytics['unique_visitors']) }}</p>
                        <span class="metric-subtitle">Unique IP addresses</span>
                    </div>
                    <div class="metric-card">
                        <span class="metric-title">Views Today</span>
                        <p class="metric-value">{{ number_format($analytics['views_today']) }}</p>
                        <span class="metric-subtitle">From {{ $analytics['unique_today'] }} unique visitor(s)</span>
                    </div>
                    <div class="metric-card">
                        <span class="metric-title">Device Split</span>
                        @php
                            $totalDevices = $analytics['mobile_count'] + $analytics['desktop_count'];
                            $desktopPct = $totalDevices > 0 ? round(($analytics['desktop_count'] / $totalDevices) * 100) : 100;
                            $mobilePct = $totalDevices > 0 ? round(($analytics['mobile_count'] / $totalDevices) * 100) : 0;
                        @endphp
                        <p class="metric-value" style="font-size: 1.5rem; line-height: 2.7rem;">
                            🖥️ {{ $desktopPct }}% / 📱 {{ $mobilePct }}%
                        </p>
                        <span class="metric-subtitle">Desktop vs Mobile views</span>
                    </div>
                </div>

                <!-- Charts Section -->
                <div class="charts-row">
                    <!-- Line Chart Card -->
                    <div class="chart-card">
                        <div class="chart-card-header">
                            <h3 class="chart-card-title">14-Day View Traffic</h3>
                        </div>
                        <div class="chart-container">
                            <canvas id="trafficLineChart"></canvas>
                        </div>
                    </div>
                    <!-- Doughnut Chart Card -->
                    <div class="chart-card">
                        <div class="chart-card-header">
                            <h3 class="chart-card-title">Device Type Distribution</h3>
                        </div>
                        <div class="chart-container">
                            <canvas id="deviceDoughnutChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Tables Section -->
                <div class="tables-row">
                    <!-- Top Pages Table -->
                    <div class="table-card">
                        <h3 class="chart-card-title">Top Visited Pages</h3>
                        <div class="items-table-wrapper" style="margin-top: 0.5rem;">
                            <table class="items-table">
                                <thead>
                                    <tr>
                                        <th>Path / Page</th>
                                        <th style="text-align: right; width: 80px;">Hits</th>
                                        <th style="width: 140px;">Percentage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($analytics['top_pages'] as $page)
                                        <tr>
                                            <td style="font-family: var(--font-mono); font-size: 0.82rem; font-weight: 600;">
                                                {{ $page->path }}
                                            </td>
                                            <td style="text-align: right; font-weight: 700; font-family: var(--font-mono);">
                                                {{ $page->hits }}
                                            </td>
                                            <td>
                                                <div style="display: flex; align-items: center; gap: 8px;">
                                                    <div class="progress-bar-container" style="flex: 1;">
                                                        <div class="progress-bar-fill" style="width: {{ $page->percentage }}%;"></div>
                                                    </div>
                                                    <span style="font-size: 0.75rem; font-family: var(--font-mono); width: 35px; text-align: right;">{{ $page->percentage }}%</span>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" style="text-align: center; color: var(--text-muted); font-family: var(--font-mono); padding: 2rem;">No data logged.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Recent Visited Logs Table -->
                    <div class="table-card">
                        <h3 class="chart-card-title">Recent Page Visits</h3>
                        <div class="items-table-wrapper" style="margin-top: 0.5rem;">
                            <table class="items-table">
                                <thead>
                                    <tr>
                                        <th style="width: 130px;">Time</th>
                                        <th>Page</th>
                                        <th>IP Address</th>
                                        <th>Browser/OS</th>
                                        <th>Referer</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($analytics['recent_visits'] as $visit)
                                        @php
                                            // Simple agent string parsing to extract browser and platform
                                            $ua = $visit->user_agent ?? 'Unknown';
                                            $browser = 'Other';
                                            if (stripos($ua, 'firefox') !== false) $browser = 'Firefox';
                                            elseif (stripos($ua, 'chrome') !== false) $browser = 'Chrome';
                                            elseif (stripos($ua, 'safari') !== false) $browser = 'Safari';
                                            elseif (stripos($ua, 'edge') !== false) $browser = 'Edge';
                                            elseif (stripos($ua, 'opera') !== false) $browser = 'Opera';
                                            
                                            $platform = 'Unknown';
                                            if (stripos($ua, 'windows') !== false) $platform = 'Windows';
                                            elseif (stripos($ua, 'macintosh') !== false || stripos($ua, 'mac os x') !== false) $platform = 'Mac';
                                            elseif (stripos($ua, 'linux') !== false) $platform = 'Linux';
                                            elseif (stripos($ua, 'iphone') !== false || stripos($ua, 'ipad') !== false) $platform = 'iOS';
                                            elseif (stripos($ua, 'android') !== false) $platform = 'Android';
                                        @endphp
                                        <tr>
                                            <td style="font-family: var(--font-mono); font-size: 0.78rem; color: var(--text-muted);">
                                                {{ \Carbon\Carbon::parse($visit->created_at)->diffForHumans() }}
                                            </td>
                                            <td style="font-family: var(--font-mono); font-size: 0.8rem; font-weight: 600; color: var(--accent-color);">
                                                {{ $visit->path }}
                                            </td>
                                            <td style="font-family: var(--font-mono); font-size: 0.8rem;">
                                                {{ $visit->ip_address ?? 'Hidden' }}
                                            </td>
                                            <td style="font-size: 0.82rem;">
                                                {{ $browser }} ({{ $platform }})
                                            </td>
                                            <td>
                                                @if($visit->referer)
                                                    <a href="{{ $visit->referer }}" class="referer-link" target="_blank" title="{{ $visit->referer }}">
                                                        {{ parse_url($visit->referer, PHP_URL_HOST) ?: 'Referer' }}
                                                    </a>
                                                @else
                                                    <span style="color: var(--text-muted); font-size: 0.8rem;">Direct</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" style="text-align: center; color: var(--text-muted); font-family: var(--font-mono); padding: 2rem;">No visits logged.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- COMMISSIONS TAB CONTENT -->
            <div class="tab-content" id="content-commissions" style="display: none;">
                <div style="margin-bottom: 1.5rem; display: flex; justify-content: space-between; align-items: flex-end; gap: 1rem; flex-wrap: wrap;">
                    <div>
                        <h3 style="font-family: var(--font-mono); font-size: 1.25rem; font-weight: 800; margin-bottom: 0.5rem; text-transform: uppercase;">
                            Commission Pricing & Sheet Manager
                        </h3>
                        <p style="font-size: 0.85rem; color: var(--text-muted); margin: 0;">Configure base prices, specifications, included features, multipliers, and upload artwork samples.</p>
                    </div>
                </div>

                <!-- Global Multipliers Settings -->
                <div style="background: var(--card-bg); border: 1px solid var(--border-color); border-radius: 12px; padding: 1.5rem; margin-bottom: 2rem;">
                    <h4 style="font-family: var(--font-mono); font-size: 0.95rem; font-weight: 800; margin-bottom: 1rem; text-transform: uppercase; color: var(--accent-color);">
                        Commission Multipliers & Base Rates
                    </h4>
                    <form action="{{ route('cms.commissions.settings.update') }}" method="POST" style="display: flex; gap: 1.25rem; align-items: flex-end; flex-wrap: wrap;">
                        @csrf
                        <div class="form-group" style="margin: 0; flex: 1; min-width: 140px;">
                            <label class="form-label" style="font-size: 0.7rem;">Detailed Background (+%)</label>
                            <input type="number" name="multiplier_detailed_bg" value="{{ $commissionSettings['multiplier_detailed_bg'] ?? 50 }}" class="form-input" required min="0">
                        </div>
                        <div class="form-group" style="margin: 0; flex: 1; min-width: 140px;">
                            <label class="form-label" style="font-size: 0.7rem;">Source File (+%)</label>
                            <input type="number" name="multiplier_source_file" value="{{ $commissionSettings['multiplier_source_file'] ?? 20 }}" class="form-input" required min="0">
                        </div>
                        <div class="form-group" style="margin: 0; flex: 1; min-width: 140px;">
                            <label class="form-label" style="font-size: 0.7rem;">Urgent Delivery (+%)</label>
                            <input type="number" name="multiplier_urgent" value="{{ $commissionSettings['multiplier_urgent'] ?? 30 }}" class="form-input" required min="0">
                        </div>
                        <div class="form-group" style="margin: 0; flex: 1; min-width: 140px;">
                            <label class="form-label" style="font-size: 0.7rem;">Commercial License (+%)</label>
                            <input type="number" name="multiplier_commercial" value="{{ $commissionSettings['multiplier_commercial'] ?? 30 }}" class="form-input" required min="0">
                        </div>
                        <div class="form-group" style="margin: 0; flex: 1; min-width: 140px;">
                            <label class="form-label" style="font-size: 0.7rem;">Additional Character (+%)</label>
                            <input type="number" name="multiplier_additional_character" value="{{ $commissionSettings['multiplier_additional_character'] ?? 70 }}" class="form-input" required min="0">
                        </div>
                        <div class="form-group" style="margin: 0; flex: 1; min-width: 140px;">
                            <label class="form-label" style="font-size: 0.7rem;">With Graphic (+%)</label>
                            <input type="number" name="multiplier_with_graphic" value="{{ $commissionSettings['multiplier_with_graphic'] ?? 20 }}" class="form-input" required min="0">
                        </div>
                        <div class="form-group" style="margin: 0; flex: 1; min-width: 140px;">
                            <label class="form-label" style="font-size: 0.7rem;">NSFW Flat Price ($)</label>
                            <input type="number" name="price_nsfw" value="{{ $commissionSettings['price_nsfw'] ?? 50 }}" class="form-input" required min="0">
                        </div>
                        <div class="form-group" style="margin: 0; flex: 1; min-width: 150px;">
                            <label class="form-label" style="font-size: 0.7rem;">Char Sheet Base (Sketch) ($)</label>
                            <input type="number" name="price_char_sheet_sketch" value="{{ $commissionSettings['price_char_sheet_sketch'] ?? 80 }}" class="form-input" required min="0">
                        </div>
                        <div class="form-group" style="margin: 0; flex: 1; min-width: 150px;">
                            <label class="form-label" style="font-size: 0.7rem;">Char Sheet Base (Flat) ($)</label>
                            <input type="number" name="price_char_sheet_flat_color" value="{{ $commissionSettings['price_char_sheet_flat_color'] ?? 140 }}" class="form-input" required min="0">
                        </div>
                        <div class="form-group" style="margin: 0; flex: 1; min-width: 150px;">
                            <label class="form-label" style="font-size: 0.7rem;">Char Sheet Base (Rendered) ($)</label>
                            <input type="number" name="price_char_sheet_fully_rendered" value="{{ $commissionSettings['price_char_sheet_fully_rendered'] ?? 220 }}" class="form-input" required min="0">
                        </div>
                        <button type="submit" class="btn btn-primary" style="justify-content: center; height: 38px; padding: 0 1.25rem; font-size: 0.8rem; flex-shrink: 0;">Save Multipliers & Rates</button>
                    </form>
                </div>

                <!-- Commissions List Table -->
                <div class="items-table-wrapper">
                    <table class="items-table" id="table-commissions">
                        <thead>
                            <tr>
                                <th style="width: 80px;">Preview</th>
                                <th>Quality Tier</th>
                                <th>Coverage Type</th>
                                <th>Base Price</th>
                                <th>Delivery Time</th>
                                <th>Specs (Res/DPI/Tools)</th>
                                <th>Included Features</th>
                                  <th style="width: 120px; text-align: right;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($commissions as $tier)
                                <tr class="portfolio-item-row" data-search="{{ strtolower($tier->render_quality . ' ' . $tier->coverage_type) }}">
                                    <td>
                                        @if($tier->image_path)
                                            <img src="{{ str_starts_with($tier->image_path, 'http') ? $tier->image_path : asset('storage/' . $tier->image_path) }}" alt="Preview" class="img-preview">
                                        @else
                                            <div style="width: 60px; height: 60px; border-radius: 8px; border: 1px dashed var(--border-color); background: rgba(0,0,0,0.1); display: flex; align-items: center; justify-content: center; font-size: 0.7rem; color: var(--text-muted); font-family: var(--font-mono);">No Art</div>
                                        @endif
                                    </td>
                                    <td style="font-weight: 700; text-transform: capitalize;">
                                        {{ str_replace('_', ' ', $tier->render_quality) }}
                                    </td>
                                    <td style="text-transform: capitalize;">
                                        {{ str_replace('_', '-', $tier->coverage_type) }}
                                    </td>
                                    <td style="font-family: var(--font-mono); font-weight: 700; color: var(--accent-color);">
                                        ${{ $tier->price }}
                                    </td>
                                    <td>{{ $tier->delivery_time }}</td>
                                    <td style="font-size: 0.8rem; font-family: var(--font-mono); line-height: 1.4;">
                                        <div>{{ $tier->resolution }}</div>
                                        <div style="color: var(--text-muted);">{{ $tier->dpi }} DPI | {{ $tier->tools }}</div>
                                    </td>
                                    <td style="font-size: 0.78rem; line-height: 1.4;">
                                        <span class="badge {{ $tier->feature_high_res ? 'badge-success' : 'badge-warning' }}" style="margin: 2px;">HQ Image</span>
                                        <span class="badge {{ $tier->feature_revisions ? 'badge-success' : 'badge-warning' }}" style="margin: 2px;">Revisions</span>
                                        <span class="badge {{ $tier->feature_background ? 'badge-success' : 'badge-warning' }}" style="margin: 2px;">BG</span>
                                        <span class="badge {{ $tier->feature_commercial ? 'badge-success' : 'badge-warning' }}" style="margin: 2px;">Commercial</span>
                                        <span class="badge {{ $tier->feature_source_file ? 'badge-success' : 'badge-warning' }}" style="margin: 2px;">PSD</span>
                                        <span class="badge {{ $tier->feature_urgent ? 'badge-success' : 'badge-warning' }}" style="margin: 2px;">Urgent</span>
                                    </td>
                                    <td style="text-align: right;">
                                        <button type="button" class="btn btn-secondary" onclick="openCommissionEditModal({{ json_encode($tier) }})">Edit</button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" style="text-align: center; color: var(--text-muted); font-family: var(--font-mono); padding: 3rem;">No commission configurations found. Seed database to configure.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- SOCIALS TAB CONTENT -->
            <div class="tab-content" id="content-socials" style="display: none;">
                <div style="padding: 1rem 0;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                        <h3 style="font-family: var(--font-mono); font-size: 1.25rem; font-weight: 800; text-transform: uppercase; margin: 0;">
                            Manage Social Links
                        </h3>
                        <p style="font-size: 0.8rem; color: var(--text-muted); font-family: var(--font-mono); margin: 0;" id="socials-drag-instructions">
                            ↕️ Drag handle on left to reorder
                        </p>
                    </div>

                    <div style="background: rgba(255, 255, 255, 0.02); border: 1px solid var(--border-color); border-radius: 12px; overflow: hidden;">
                        <table class="items-table" id="table-socials">
                            <thead>
                                <tr>
                                    <th style="width: 50px;">Order</th>
                                    <th>Platform Name</th>
                                    <th>Link URL</th>
                                    <th style="width: 120px; text-align: center;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($socialLinks as $link)
                                    <tr class="portfolio-item-row" data-id="{{ $link->id }}" style="cursor: default;">
                                        <td>
                                            <div class="drag-handle" style="cursor: grab; display: flex; align-items: center; justify-content: center; width: 30px; height: 30px; background: rgba(255, 255, 255, 0.04); border-radius: 6px; border: 1px solid rgba(255,255,255,0.08); transition: background 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.08)'" onmouseout="this.style.background='rgba(255,255,255,0.04)'">
                                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="opacity: 0.7;"><line x1="8" y1="9" x2="16" y2="9"></line><line x1="8" y1="15" x2="16" y2="15"></line><line x1="3" y1="9" x2="3" y2="9.01"></line><line x1="3" y1="15" x2="3" y2="15.01"></line><line x1="21" y1="9" x2="21" y2="9.01"></line><line x1="21" y1="15" x2="21" y2="15.01"></line></svg>
                                            </div>
                                        </td>
                                        <td>
                                            <span style="font-weight: 700; color: var(--text-main);">{{ $link->name }}</span>
                                        </td>
                                        <td>
                                            <a href="{{ url($link->url) }}" target="_blank" style="color: var(--accent-1); text-decoration: none; font-family: var(--font-mono); font-size: 0.85rem; word-break: break-all;">
                                                {{ $link->url }}
                                            </a>
                                        </td>
                                        <td style="text-align: center;">
                                            <button class="btn btn-secondary" onclick="openEditSocialModal({{ $link->id }}, '{{ addslashes($link->name) }}', '{{ addslashes($link->url) }}')" style="padding: 6px 12px; font-size: 0.8rem; border-radius: 6px;">
                                                Edit
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" style="text-align: center; color: var(--text-muted); font-family: var(--font-mono); padding: 3rem;">No social links found. Seed database to configure.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- SETTINGS TAB CONTENT -->
            <div class="tab-content" id="content-settings" style="display: none;">
                <div style="max-width: 600px; margin: 0 auto; padding: 1rem 0;">
                    <h3 style="font-family: var(--font-mono); font-size: 1.25rem; font-weight: 800; margin-bottom: 1.5rem; text-transform: uppercase;">
                        System Settings
                    </h3>
                    
                    <form action="{{ route('cms.settings.update') }}" method="POST" style="display: flex; flex-direction: column; gap: 2rem;">
                        @csrf
                        
                        <div style="background: rgba(255, 255, 255, 0.02); border: 1px solid var(--border-color); border-radius: 12px; padding: 1.5rem; display: flex; flex-direction: column; gap: 1.5rem;">
                            
                            <!-- Illustration Maintenance -->
                            <div style="display: flex; justify-content: space-between; align-items: center; gap: 1rem;">
                                <div>
                                    <h4 style="font-family: var(--font-sans); font-size: 0.95rem; font-weight: 600; margin: 0 0 0.25rem 0;">Illustration Maintenance Mode</h4>
                                    <p style="font-size: 0.8rem; color: var(--text-muted); margin: 0;">Hide the illustrations section on the public site and show "Coming Soon".</p>
                                </div>
                                <label class="switch-container">
                                    <input type="checkbox" name="maintenance_illustration" value="1" {{ ($settings['maintenance_illustration'] ?? '0') === '1' ? 'checked' : '' }} class="settings-checkbox">
                                    <span class="switch-slider"></span>
                                </label>
                            </div>

                            <div style="height: 1px; background: var(--border-color);"></div>

                            <!-- Comics Maintenance -->
                            <div style="display: flex; justify-content: space-between; align-items: center; gap: 1rem;">
                                <div>
                                    <h4 style="font-family: var(--font-sans); font-size: 0.95rem; font-weight: 600; margin: 0 0 0.25rem 0;">Comics & Manga Maintenance Mode</h4>
                                    <p style="font-size: 0.8rem; color: var(--text-muted); margin: 0;">Hide the comics/manga section on the public site and show "Coming Soon".</p>
                                </div>
                                <label class="switch-container">
                                    <input type="checkbox" name="maintenance_comic" value="1" {{ ($settings['maintenance_comic'] ?? '0') === '1' ? 'checked' : '' }} class="settings-checkbox">
                                    <span class="switch-slider"></span>
                                </label>
                            </div>

                            <div style="height: 1px; background: var(--border-color);"></div>

                            <!-- Concepts Maintenance -->
                            <div style="display: flex; justify-content: space-between; align-items: center; gap: 1rem;">
                                <div>
                                    <h4 style="font-family: var(--font-sans); font-size: 0.95rem; font-weight: 600; margin: 0 0 0.25rem 0;">Works Gallery Maintenance Mode</h4>
                                    <p style="font-size: 0.8rem; color: var(--text-muted); margin: 0;">Hide the works gallery section on the public site and show "Coming Soon".</p>
                                </div>
                                <label class="switch-container">
                                    <input type="checkbox" name="maintenance_concept" value="1" {{ ($settings['maintenance_concept'] ?? '0') === '1' ? 'checked' : '' }} class="settings-checkbox">
                                    <span class="switch-slider"></span>
                                </label>
                            </div>

                        </div>

                        <div style="display: flex; gap: 1rem;">
                            <button type="submit" class="btn btn-primary" style="flex: 1; justify-content: center; font-size: 0.9rem; padding: 0.8rem 1.5rem;">
                                Save Settings
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- EDIT COMMISSION MODAL -->
    <div class="modal" id="commission-modal">
        <div class="modal-content" style="max-width: 600px;">
            <div class="modal-header">
                <h3 class="modal-title" id="commission-modal-title">Edit Commission Tier</h3>
                <button class="modal-close" onclick="closeCommissionModal()">×</button>
            </div>
            <form id="commission-form" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Render Quality</label>
                        <input type="text" id="comm-render-quality" class="form-input" disabled style="text-transform: capitalize; opacity: 0.6; background: rgba(0,0,0,0.1);">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Coverage Type</label>
                        <input type="text" id="comm-coverage-type" class="form-input" disabled style="text-transform: capitalize; opacity: 0.6; background: rgba(0,0,0,0.1);">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="comm-price" class="form-label">Base Price ($)</label>
                        <input type="number" id="comm-price" name="price" class="form-input" required min="0">
                    </div>
                    <div class="form-group">
                        <label for="comm-delivery" class="form-label">Estimated Delivery</label>
                        <input type="text" id="comm-delivery" name="delivery_time" class="form-input" required placeholder="e.g. 2-3 Weeks">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="comm-resolution" class="form-label">Resolution</label>
                        <input type="text" id="comm-resolution" name="resolution" class="form-input" required placeholder="e.g. 4000 x 6000 px">
                    </div>
                    <div class="form-group">
                        <label for="comm-dpi" class="form-label">DPI</label>
                        <input type="number" id="comm-dpi" name="dpi" class="form-input" required min="72">
                    </div>
                </div>

                <div class="form-group">
                    <label for="comm-tools" class="form-label">Software/Tools Used</label>
                    <input type="text" id="comm-tools" name="tools" class="form-input" required placeholder="e.g. Clip Studio Paint, Photoshop">
                </div>

                <!-- Features Checklist Selection -->
                <div class="form-group">
                    <label class="form-label">Included Features / Deliverables</label>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; background: rgba(0,0,0,0.1); border: 1px solid var(--border-color); border-radius: 8px; padding: 15px;">
                        <label style="display: inline-flex; align-items: center; gap: 8px; font-size: 0.85rem; cursor: pointer; color: var(--text-color);">
                            <input type="checkbox" name="feature_high_res" id="comm-feat-high-res" value="1" style="accent-color: var(--accent-color);">
                            High-Res PNG & JPEG
                        </label>
                        <label style="display: inline-flex; align-items: center; gap: 8px; font-size: 0.85rem; cursor: pointer; color: var(--text-color);">
                            <input type="checkbox" name="feature_revisions" id="comm-feat-revisions" value="1" style="accent-color: var(--accent-color);">
                            3 Major Revisions
                        </label>
                        <label style="display: inline-flex; align-items: center; gap: 8px; font-size: 0.85rem; cursor: pointer; color: var(--text-color);">
                            <input type="checkbox" name="feature_background" id="comm-feat-background" value="1" style="accent-color: var(--accent-color);">
                            Simple Background
                        </label>
                        <label style="display: inline-flex; align-items: center; gap: 8px; font-size: 0.85rem; cursor: pointer; color: var(--text-color);">
                            <input type="checkbox" name="feature_commercial" id="comm-feat-commercial" value="1" style="accent-color: var(--accent-color);">
                            Commercial License
                        </label>
                        <label style="display: inline-flex; align-items: center; gap: 8px; font-size: 0.85rem; cursor: pointer; color: var(--text-color);">
                            <input type="checkbox" name="feature_source_file" id="comm-feat-source-file" value="1" style="accent-color: var(--accent-color);">
                            Source File (.PSD)
                        </label>
                        <label style="display: inline-flex; align-items: center; gap: 8px; font-size: 0.85rem; cursor: pointer; color: var(--text-color);">
                            <input type="checkbox" name="feature_urgent" id="comm-feat-urgent" value="1" style="accent-color: var(--accent-color);">
                            Urgent Delivery
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">Preview Sample Artwork</label>
                    <div class="upload-placeholder" onclick="document.getElementById('comm-image').click()">
                        <p id="comm-upload-instruction">Click to select image file (Max 5MB)</p>
                        <input type="file" id="comm-image" name="image" style="display: none;" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp" onchange="previewCommissionImage(event)">
                    </div>
                    <div id="comm-preview-container" class="upload-preview-container" style="display: none;">
                        <img id="comm-upload-preview" src="#" alt="Preview" class="upload-preview-img">
                        <span id="comm-preview-filename" style="font-size: 0.8rem; color: var(--text-muted); font-family: var(--font-mono);"></span>
                    </div>
                </div>

                <div style="text-align: center; margin: 0.5rem 0; font-family: var(--font-mono); font-size: 0.8rem; color: var(--text-muted);">— OR —</div>

                <div class="form-group">
                    <label for="comm-image-url" class="form-label">External Image URL / Google Drive Link</label>
                    <input type="url" id="comm-image-url" name="image_url" class="form-input" placeholder="https://drive.google.com/... or direct image link" oninput="handleCommissionImageUrlInput(this.value)">
                </div>

                <div class="form-actions">
                    <button type="button" class="btn btn-secondary" onclick="closeCommissionModal()">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <!-- EDIT SOCIAL LINK MODAL -->
    <div class="modal" id="social-modal">
        <div class="modal-content" style="max-width: 500px;">
            <div class="modal-header">
                <h3 class="modal-title" id="social-modal-title">Edit Social Link</h3>
                <button class="modal-close" onclick="closeSocialModal()">×</button>
            </div>
            <form id="social-form" method="POST">
                @csrf
                <div class="form-group" style="margin-bottom: 1.25rem;">
                    <label for="social-name" class="form-label">Platform Name</label>
                    <input type="text" id="social-name" name="name" class="form-input" required placeholder="e.g. Instagram">
                </div>

                <div class="form-group" style="margin-bottom: 1.25rem;">
                    <label for="social-url" class="form-label">Link URL</label>
                    <input type="text" id="social-url" name="url" class="form-input" required placeholder="e.g. https://instagram.com/yanillust">
                    <p style="font-size: 0.72rem; color: var(--text-muted); margin-top: 4px; font-family: var(--font-mono);">
                        Tip: Absolute URLs (starting with http:// or https://) or relative paths (like /commission) are allowed.
                    </p>
                </div>

                <div class="form-actions">
                    <button type="button" class="btn btn-secondary" onclick="closeSocialModal()">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ADD/EDIT ITEM MODAL -->
    <div class="modal" id="item-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modal-title">Add Portfolio Item</h3>
                <button class="modal-close" onclick="closeModal()">×</button>
            </div>
            <form id="item-form" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" id="form-method-spoof" value="POST">
                
                <div class="form-group">
                    <label for="form-title" class="form-label">Item Title</label>
                    <input type="text" id="form-title" name="title" class="form-input" required placeholder="e.g. Cyber Bloom">
                </div>
                
                <div class="form-group">
                    <label for="form-description" class="form-label">Description</label>
                    <textarea id="form-description" name="description" class="form-input" placeholder="e.g. Character design details, style specifications, or description of the artwork." style="min-height: 80px; resize: vertical; padding: 10px; font-family: inherit; font-size: 0.9rem;"></textarea>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="form-section" class="form-label">Section</label>
                        <select id="form-section" name="section" class="form-select" onchange="toggleTypeField()" required>
                            <option value="illustration">Illustration</option>
                            <option value="comic">Comic & Manga</option>
                            <option value="concept">Works Gallery</option>
                        </select>
                    </div>

                    <div class="form-group" id="type-field-wrapper">
                        <label for="form-type" class="form-label">Illustration Type</label>
                        <select id="form-type" name="type" class="form-select">
                            <option value="original">Original</option>
                            <option value="fanart">Fanart</option>
                            <option value="spicy">🌶️ Spicy</option>
                        </select>
                    </div>
                </div>

                <!-- Timelapse Toggle (only visible when section is 'illustration') -->
                <div class="form-group" id="illustration-extras-row" style="display: none; margin-bottom: 1.25rem;">
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <span class="form-label" style="margin-bottom: 0;">Include Process Timelapse Video</span>
                        <label class="switch-container">
                            <input type="checkbox" name="has_timelapse" id="form-has-timelapse" value="1" onchange="toggleTimelapseUpload()">
                            <span class="switch-slider"></span>
                        </label>
                    </div>
                </div>

                <!-- Timelapse Upload (visible when has_timelapse is checked) -->
                <div class="form-group" id="timelapse-upload-wrapper" style="display: none; margin-bottom: 1.25rem;">
                    <label class="form-label">Upload Timelapse Video (MP4, WebM, MOV - Max 30MB)</label>
                    <div class="upload-placeholder" onclick="document.getElementById('form-timelapse').click()">
                        <p id="timelapse-upload-instruction">Click to select video file (Max 30MB)</p>
                        <input type="file" id="form-timelapse" name="timelapse_video" accept="video/mp4,video/webm,video/ogg,video/quicktime" style="display: none;" onchange="previewTimelapseVideo(event)">
                    </div>
                    <div id="timelapse-preview-container" class="upload-preview-container" style="display: none; flex-direction: column; align-items: flex-start; gap: 8px;">
                        <video id="timelapse-preview-player" src="" controls style="width: 100%; max-height: 150px; border-radius: 8px; background: #000;"></video>
                        <span id="timelapse-preview-filename" style="font-size: 0.8rem; color: var(--text-muted); font-family: var(--font-mono);"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="form-category" class="form-label">Category</label>
                    <input type="text" id="form-category" name="category" class="form-input" required placeholder="e.g. Vibrant Character, Webtoon">
                </div>

                <div class="form-group">
                    <label class="form-label">Image Artwork</label>
                    <div class="upload-placeholder" onclick="document.getElementById('form-image').click()">
                        <p id="upload-instruction">Click to select image file (Max 5MB)</p>
                        <input type="file" id="form-image" name="image" style="display: none;" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp" onchange="previewImage(event)">
                    </div>
                    <div id="preview-container" class="upload-preview-container" style="display: none;">
                        <img id="upload-preview" src="#" alt="Preview" class="upload-preview-img">
                        <span id="preview-filename" style="font-size: 0.8rem; color: var(--text-muted); font-family: var(--font-mono);"></span>
                    </div>
                </div>

                <div style="text-align: center; margin: 0.5rem 0; font-family: var(--font-mono); font-size: 0.8rem; color: var(--text-muted);">— OR —</div>

                <div class="form-group">
                    <label for="form-image-url" class="form-label">External Image URL / Google Drive Link</label>
                    <input type="url" id="form-image-url" name="image_url" class="form-input" placeholder="https://drive.google.com/... or direct image link" oninput="handleImageUrlInput(this.value)">
                </div>

                <!-- Hidden inputs for scale & offsets -->
                <input type="hidden" name="image_scale" id="form-image-scale" value="1.0">
                <input type="hidden" name="image_offset_x" id="form-image-offset-x" value="0">
                <input type="hidden" name="image_offset_y" id="form-image-offset-y" value="0">

                <!-- Image Adjustment Preview (Draggable & Zoomable) -->
                <div id="item-image-adjustment-wrapper" style="display: none; margin-bottom: 1.5rem;">
                    <label class="form-label">Position & Zoom Artwork Preview</label>
                    <div class="item-card-preview-frame aspect-portrait" id="item-preview-frame">
                        <div class="item-card-preview-image" id="item-draggable-preview-container">
                            <img src="#" id="item-preview-image" alt="Artwork Preview" style="transform: scale(1.0); object-position: 50% 50%;">
                        </div>
                    </div>
                    <div style="font-size: 0.72rem; color: var(--text-muted); font-family: var(--font-mono); text-align: center; margin-top: 0.5rem;">
                        💡 Click and drag the image above to pan. Use the slider below to zoom.
                    </div>
                    
                    <!-- Zoom Slider -->
                    <div class="form-group" style="margin-top: 1rem; margin-bottom: 0;">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.25rem;">
                            <label class="form-label" style="margin-bottom: 0;">Zoom Level</label>
                            <span id="item-zoom-value-display" style="font-size: 0.75rem; font-family: var(--font-mono); color: var(--accent-color);">1.00x</span>
                        </div>
                        <input type="range" id="item-zoom-slider" min="1.0" max="4.0" step="0.01" value="1.00" style="width: 100%; accent-color: var(--accent-color); cursor: pointer;" oninput="handleItemZoomChange(this.value)">
                    </div>
                </div>

                <!-- Hidden input to store JSON array of converted WebP pages -->
                <input type="hidden" name="pages" id="form-pages-json" value="">

                <!-- PDF or Image Group Selection, only visible when section is 'comic' -->
                <div id="comic-upload-source-wrapper" style="display: none;">
                    <div class="form-group" style="margin-bottom: 0.75rem;">
                        <label class="form-label">Comic Pages Source</label>
                        <div style="display: flex; gap: 1.5rem; align-items: center; padding: 0.5rem 0.25rem;">
                            <label style="display: inline-flex; align-items: center; gap: 6px; font-size: 0.85rem; cursor: pointer; font-family: var(--font-sans); color: var(--text-color);">
                                <input type="radio" name="comic_source_type" id="radio-source-pdf" value="pdf" checked onchange="toggleComicSourceType('pdf')" style="accent-color: var(--accent-color);">
                                PDF Document
                            </label>
                            <label style="display: inline-flex; align-items: center; gap: 6px; font-size: 0.85rem; cursor: pointer; font-family: var(--font-sans); color: var(--text-color);">
                                <input type="radio" name="comic_source_type" id="radio-source-images" value="images" onchange="toggleComicSourceType('images')" style="accent-color: var(--accent-color);">
                                Group of Images
                            </label>
                        </div>
                    </div>

                    <!-- PDF upload wrapper -->
                    <div class="form-group" id="pdf-upload-wrapper">
                        <label class="form-label">PDF Flipbook File (Optional)</label>
                        <div class="upload-placeholder" onclick="document.getElementById('form-pdf').click()" id="pdf-placeholder-box">
                            <p id="pdf-upload-instruction">Click to select PDF file (Max 50MB)</p>
                            <input type="file" id="form-pdf" name="pdf_file" accept="application/pdf" style="display: none;" onchange="handlePdfUpload(event)">
                        </div>
                    </div>

                    <!-- Images upload wrapper -->
                    <div class="form-group" id="images-upload-wrapper" style="display: none;">
                        <label class="form-label">Comic Image Files (Optional, Max 10MB each)</label>
                        <div class="upload-placeholder" onclick="document.getElementById('form-images-group').click()" id="images-placeholder-box">
                            <p id="images-upload-instruction">Click to select image files (Multi-select allowed)</p>
                            <input type="file" id="form-images-group" name="image_files[]" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp" multiple style="display: none;" onchange="handleImagesUpload(event)">
                        </div>
                    </div>

                    <!-- Common Upload Progress indicator -->
                    <div id="pdf-progress-container" class="upload-preview-container" style="display: none; align-items: center; justify-content: space-between; border: 1px solid var(--border-color); border-radius: 8px; padding: 12px 18px; margin-top: 10px; width: 100%;">
                        <span id="pdf-filename" style="font-size: 0.85rem; font-weight: 600; font-family: var(--font-mono); overflow: hidden; text-overflow: ellipsis; white-space: nowrap; max-width: 65%;"></span>
                        <span id="pdf-upload-status" style="font-size: 0.8rem; font-family: var(--font-mono); font-weight: 700; color: var(--accent-color);"></span>
                    </div>
                </div>


                <div class="form-actions">
                    <button type="button" class="btn btn-secondary" onclick="closeModal()">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="btn-save-item">Save Item</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // Init Theme
        const storedTheme = localStorage.getItem('theme');
        if (storedTheme === 'light') {
            document.body.classList.add('light-theme');
        }

        function toggleTheme() {
            document.body.classList.toggle('light-theme');
            localStorage.setItem('theme', document.body.classList.contains('light-theme') ? 'light' : 'dark');
            if (currentTab === 'analytics') {
                initAnalyticsCharts();
            }
        }

        // Tab Switching
        let currentTab = 'illustrations';
        function switchTab(tab) {
            currentTab = tab;
            localStorage.setItem('activeCmsTab', tab); // Persist the active tab
            document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
            document.querySelectorAll('.tab-content').forEach(content => content.style.display = 'none');
            
            document.getElementById(`tab-btn-${tab}`).classList.add('active');
            document.getElementById(`content-${tab}`).style.display = 'block';
            
            // Hide search & add button on About, Analytics, Settings, Commissions, and Socials tabs
            const headerRow = document.querySelector('.section-header-row');
            if (headerRow) {
                headerRow.style.display = (tab === 'about' || tab === 'analytics' || tab === 'settings' || tab === 'commissions' || tab === 'socials') ? 'none' : 'flex';
            }
            
            if (tab === 'analytics') {
                setTimeout(initAnalyticsCharts, 50);
            }
            
            // clear search on switch tab
            document.getElementById('items-search').value = '';
            handleSearch();
        }

        // Initialize active tab from localStorage on load
        document.addEventListener('DOMContentLoaded', () => {
            const savedTab = localStorage.getItem('activeCmsTab');
            if (savedTab && document.getElementById(`tab-btn-${savedTab}`)) {
                switchTab(savedTab);
            } else {
                switchTab('illustrations');
            }
        });

        // Realtime Local Search
        function handleSearch() {
            const query = document.getElementById('items-search').value.toLowerCase().trim();
            const rows = document.querySelectorAll(`#content-${currentTab} .portfolio-item-row`);
            
            rows.forEach(row => {
                const searchText = row.getAttribute('data-search');
                if (searchText.includes(query)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }

        // Toggle Type Field
        function toggleTypeField() {
            const section = document.getElementById('form-section').value;
            const typeWrapper = document.getElementById('type-field-wrapper');
            const comicSourceWrapper = document.getElementById('comic-upload-source-wrapper');
            const illustrationExtras = document.getElementById('illustration-extras-row');

            if (section === 'illustration') {
                typeWrapper.style.display = 'block';
                document.getElementById('form-type').setAttribute('required', 'required');
                illustrationExtras.style.display = 'block';
            } else {
                typeWrapper.style.display = 'none';
                document.getElementById('form-type').removeAttribute('required');
                illustrationExtras.style.display = 'none';
                
                // Reset timelapse inputs when switching away from illustration
                document.getElementById('form-has-timelapse').checked = false;
                document.getElementById('timelapse-upload-wrapper').style.display = 'none';
            }

            if (section === 'comic') {
                comicSourceWrapper.style.display = 'block';
                // Ensure the active source panel is visible
                const activeSource = document.querySelector('input[name="comic_source_type"]:checked').value;
                toggleComicSourceType(activeSource);
            } else {
                comicSourceWrapper.style.display = 'none';
                resetComicUploadState();
            }

            updateItemPreviewState();
        }

        // Toggle between PDF and Image Group upload panels
        function toggleComicSourceType(type) {
            const pdfWrapper = document.getElementById('pdf-upload-wrapper');
            const imagesWrapper = document.getElementById('images-upload-wrapper');

            if (type === 'pdf') {
                pdfWrapper.style.display = 'block';
                imagesWrapper.style.display = 'none';
            } else {
                pdfWrapper.style.display = 'none';
                imagesWrapper.style.display = 'block';
            }
            // Reset progress area on source switch
            document.getElementById('pdf-progress-container').style.display = 'none';
            document.getElementById('form-pages-json').value = '';
        }

        // Reset all comic upload state
        function resetComicUploadState() {
            document.getElementById('form-pages-json').value = '';
            document.getElementById('form-pdf').value = '';
            document.getElementById('form-images-group').value = '';
            document.getElementById('pdf-progress-container').style.display = 'none';
            document.getElementById('pdf-upload-instruction').textContent = 'Click to select PDF file (Max 50MB)';
            document.getElementById('images-upload-instruction').textContent = 'Click to select image files (Multi-select allowed)';
        }

        // Convert Google Drive links to direct cookie-less CDN links
        function convertGoogleDriveLink(url) {
            if (!url) return '';
            const reg1 = /drive\.google\.com\/file\/d\/([a-zA-Z0-9_-]+)/;
            const reg2 = /drive\.google\.com\/open\?id=([a-zA-Z0-9_-]+)/;
            const reg3 = /docs\.google\.com\/file\/d\/([a-zA-Z0-9_-]+)/;
            
            let match = url.match(reg1) || url.match(reg2) || url.match(reg3);
            if (match) {
                return `https://lh3.googleusercontent.com/d/${match[1]}`;
            }
            return url;
        }

        // Preview External URL for Portfolio Item
        function handleImageUrlInput(val) {
            const url = convertGoogleDriveLink(val.trim());
            const previewContainer = document.getElementById('preview-container');
            const uploadPreview = document.getElementById('upload-preview');
            const previewFilename = document.getElementById('preview-filename');
            
            if (url) {
                // Clear file input
                document.getElementById('form-image').value = '';
                document.getElementById('upload-instruction').textContent = 'Click to select image file (Max 5MB)';
                
                uploadPreview.src = url;
                previewContainer.style.display = 'flex';
                previewFilename.textContent = "External URL";
                
                // Reset positioning for new image URL
                itemImgOffsetX = 0;
                itemImgOffsetY = 0;
                itemImgScale = 1.0;
                document.getElementById('item-zoom-slider').value = 1.0;
                document.getElementById('item-zoom-value-display').textContent = '1.00x';
                document.getElementById('form-image-scale').value = 1.0;
                document.getElementById('form-image-offset-x').value = 0;
                document.getElementById('form-image-offset-y').value = 0;
                updateItemImageTransform();
                
                updateItemPreviewState();
            } else {
                updateItemPreviewState();
            }
        }

        // Preview External URL for About Section
        function handleAboutImageUrlInput(val) {
            const url = convertGoogleDriveLink(val.trim());
            if (url) {
                // Clear file input
                document.getElementById('about-image-input').value = '';
                document.getElementById('about-image-instruction').textContent = 'Click to select new image file (Max 5MB)';
                
                aboutImg.src = url;
                
                // Reset positioning for new image URL
                imgOffsetX = 0;
                imgOffsetY = 0;
                imgScale = 1.0;
                document.getElementById('about-zoom-slider').value = 1.0;
                document.getElementById('zoom-value-display').textContent = '1.00x';
                document.getElementById('about-image-scale').value = 1.0;
                document.getElementById('about-image-offset-x').value = 0;
                document.getElementById('about-image-offset-y').value = 0;
                updateImageTransform();
            }
        }

        // Preview Image
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp'];
                const allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                const fileExtension = file.name.split('.').pop().toLowerCase();
                if (!allowedTypes.includes(file.type) && !allowedExtensions.includes(fileExtension)) {
                    alert('Invalid file format. Please upload an image (JPEG, PNG, GIF, WEBP).');
                    event.target.value = '';
                    return;
                }
                // Clear URL input if a file is selected
                document.getElementById('form-image-url').value = '';
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('upload-preview').src = e.target.result;
                    document.getElementById('preview-container').style.display = 'flex';
                    document.getElementById('preview-filename').textContent = file.name;

                    // Reset positioning for new image
                    itemImgOffsetX = 0;
                    itemImgOffsetY = 0;
                    itemImgScale = 1.0;
                    document.getElementById('item-zoom-slider').value = 1.0;
                    document.getElementById('item-zoom-value-display').textContent = '1.00x';
                    document.getElementById('form-image-scale').value = 1.0;
                    document.getElementById('form-image-offset-x').value = 0;
                    document.getElementById('form-image-offset-y').value = 0;
                    updateItemImageTransform();

                    updateItemPreviewState();
                };
                reader.readAsDataURL(file);
            }
        }

        // Preview Timelapse Video
        function previewTimelapseVideo(event) {
            const file = event.target.files[0];
            if (file) {
                const allowedTypes = ['video/mp4', 'video/webm', 'video/ogg', 'video/quicktime'];
                const allowedExtensions = ['mp4', 'webm', 'ogg', 'mov'];
                const fileExtension = file.name.split('.').pop().toLowerCase();
                if (!allowedTypes.includes(file.type) && !allowedExtensions.includes(fileExtension)) {
                    alert('Invalid file format. Please upload a video (MP4, WebM, OGG, MOV).');
                    event.target.value = '';
                    return;
                }
                const videoUrl = URL.createObjectURL(file);
                const player = document.getElementById('timelapse-preview-player');
                player.src = videoUrl;
                player.load();
                document.getElementById('timelapse-preview-container').style.display = 'flex';
                document.getElementById('timelapse-preview-filename').textContent = file.name;
                document.getElementById('timelapse-upload-instruction').textContent = 'Click to replace video file (Optional)';
            }
        }

        // Toggle Timelapse Upload display
        function toggleTimelapseUpload() {
            const isChecked = document.getElementById('form-has-timelapse').checked;
            const wrapper = document.getElementById('timelapse-upload-wrapper');
            if (isChecked) {
                wrapper.style.display = 'block';
            } else {
                wrapper.style.display = 'none';
                // Reset input and preview
                document.getElementById('form-timelapse').value = '';
                const player = document.getElementById('timelapse-preview-player');
                player.src = '';
                player.pause();
                document.getElementById('timelapse-preview-container').style.display = 'none';
                document.getElementById('timelapse-preview-filename').textContent = '';
                document.getElementById('timelapse-upload-instruction').textContent = 'Click to select video file (Max 30MB)';
            }
        }

        // --- Visual Adjustment Editor for Portfolio Items (Illustrations & Concepts) ---
        let isDraggingItemImage = false;
        let itemDragStartX = 0;
        let itemDragStartY = 0;
        let itemImgOffsetX = 0;
        let itemImgOffsetY = 0;
        let itemImgScale = 1.0;

        const itemPreviewImg = document.getElementById('item-preview-image');
        const itemDragContainer = document.getElementById('item-draggable-preview-container');

        if (itemPreviewImg && itemDragContainer) {
            // Mouse Events
            itemDragContainer.addEventListener('mousedown', (e) => {
                isDraggingItemImage = true;
                itemDragStartX = e.clientX - itemImgOffsetX;
                itemDragStartY = e.clientY - itemImgOffsetY;
                itemPreviewImg.style.cursor = 'grabbing';
                e.preventDefault();
            });

            window.addEventListener('mousemove', (e) => {
                if (!isDraggingItemImage) return;
                itemImgOffsetX = e.clientX - itemDragStartX;
                itemImgOffsetY = e.clientY - itemDragStartY;
                updateItemImageTransform();
            });

            window.addEventListener('mouseup', () => {
                if (isDraggingItemImage) {
                    isDraggingItemImage = false;
                    itemPreviewImg.style.cursor = 'grab';
                    document.getElementById('form-image-offset-x').value = Math.round(itemImgOffsetX);
                    document.getElementById('form-image-offset-y').value = Math.round(itemImgOffsetY);
                }
            });

            // Touch Events (Mobile support)
            itemDragContainer.addEventListener('touchstart', (e) => {
                if (e.touches.length === 1) {
                    isDraggingItemImage = true;
                    itemDragStartX = e.touches[0].clientX - itemImgOffsetX;
                    itemDragStartY = e.touches[0].clientY - itemImgOffsetY;
                }
            });

            window.addEventListener('touchmove', (e) => {
                if (!isDraggingItemImage || e.touches.length !== 1) return;
                itemImgOffsetX = e.touches[0].clientX - itemDragStartX;
                itemImgOffsetY = e.touches[0].clientY - itemDragStartY;
                updateItemImageTransform();
            });

            window.addEventListener('touchend', () => {
                if (isDraggingItemImage) {
                    isDraggingItemImage = false;
                    document.getElementById('form-image-offset-x').value = Math.round(itemImgOffsetX);
                    document.getElementById('form-image-offset-y').value = Math.round(itemImgOffsetY);
                }
            });
        }

        function updateItemImageTransform() {
            if (itemPreviewImg) {
                itemPreviewImg.style.transform = `scale(${itemImgScale})`;
                itemPreviewImg.style.objectPosition = `calc(50% + ${itemImgOffsetX}px) calc(50% + ${itemImgOffsetY}px)`;
            }
        }

        function handleItemZoomChange(val) {
            itemImgScale = parseFloat(val);
            document.getElementById('item-zoom-value-display').textContent = itemImgScale.toFixed(2) + 'x';
            document.getElementById('form-image-scale').value = itemImgScale;
            updateItemImageTransform();
        }

        function updateItemPreviewState() {
            const section = document.getElementById('form-section').value;
            const previewImgSrc = document.getElementById('upload-preview').getAttribute('src');
            const hasImage = previewImgSrc && previewImgSrc !== '#' && previewImgSrc !== '';
            
            const adjustmentWrapper = document.getElementById('item-image-adjustment-wrapper');
            const standardPreviewContainer = document.getElementById('preview-container');
            const previewFrame = document.getElementById('item-preview-frame');
            const itemPreviewImg = document.getElementById('item-preview-image');

            if (hasImage && (section === 'illustration' || section === 'concept')) {
                // Set the visual preview image src
                itemPreviewImg.src = previewImgSrc;
                
                // Toggle aspect ratio classes
                if (section === 'illustration') {
                    previewFrame.classList.add('aspect-portrait');
                    previewFrame.classList.remove('aspect-landscape');
                } else {
                    previewFrame.classList.add('aspect-landscape');
                    previewFrame.classList.remove('aspect-portrait');
                }
                
                adjustmentWrapper.style.display = 'block';
                standardPreviewContainer.style.display = 'none';
            } else {
                adjustmentWrapper.style.display = 'none';
                if (hasImage) {
                    standardPreviewContainer.style.display = 'flex';
                } else {
                    standardPreviewContainer.style.display = 'none';
                }
            }
        }

        // Handle PDF Flipbook Upload asynchronously
        function handlePdfUpload(event) {
            const file = event.target.files[0];
            if (!file) return;

            // Validate PDF format
            const fileExtension = file.name.split('.').pop().toLowerCase();
            if (file.type !== 'application/pdf' && fileExtension !== 'pdf') {
                alert('Invalid file format. Please upload a PDF document.');
                event.target.value = '';
                return;
            }

            const filenameEl = document.getElementById('pdf-filename');
            const statusEl = document.getElementById('pdf-upload-status');
            const progressContainer = document.getElementById('pdf-progress-container');
            const saveBtn = document.getElementById('btn-save-item');

            filenameEl.textContent = file.name;
            statusEl.textContent = 'Processing PDF...';
            statusEl.style.color = 'var(--accent-color)';
            progressContainer.style.display = 'flex';

            // Disable save button during processing
            saveBtn.disabled = true;
            saveBtn.style.opacity = '0.5';

            const formData = new FormData();
            formData.append('pdf_file', file);
            
            const token = document.querySelector('input[name="_token"]').value;

            fetch("{{ url('/upload-pdf.php') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token
                },
                body: formData
            })
            .then(response => {
                return response.text().then(text => {
                    try {
                        const data = JSON.parse(text);
                        return { ok: response.ok, data: data };
                    } catch (e) {
                        return { ok: false, isRawText: true, data: text };
                    }
                });
            })
            .then(result => {
                const data = result.data;
                if (!result.ok) {
                    if (result.isRawText) {
                        throw new Error("Server returned non-JSON response:\n" + data.substring(0, 1000));
                    } else {
                        throw new Error(data.message || "Server error.");
                    }
                }
                
                if (data.status === 'success') {
                    document.getElementById('form-pages-json').value = JSON.stringify(data.pages);
                    statusEl.textContent = `Success (${data.pages.length} pgs)`;
                    statusEl.style.color = 'var(--success-color)';
                } else {
                    statusEl.textContent = 'Failed';
                    statusEl.style.color = '#ef4444';
                    alert('PDF processing error: ' + data.message);
                    document.getElementById('form-pdf').value = '';
                }
            })
            .catch(error => {
                console.error('PDF Upload Error:', error);
                statusEl.textContent = 'Error';
                statusEl.style.color = '#ef4444';
                alert('PDF upload failed: ' + error.message);
                document.getElementById('form-pdf').value = '';
            })
            .finally(() => {
                saveBtn.disabled = false;
                saveBtn.style.opacity = '1';
            });
        }

        // Handle Image Group Upload asynchronously
        function handleImagesUpload(event) {
            const files = event.target.files;
            if (!files || files.length === 0) return;

            const filenameEl = document.getElementById('pdf-filename');
            const statusEl = document.getElementById('pdf-upload-status');
            const progressContainer = document.getElementById('pdf-progress-container');
            const saveBtn = document.getElementById('btn-save-item');
            const maxSizeBytes = 10 * 1024 * 1024; // 10MB per file

            const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp'];
            const allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

            // Client-side size & format validation
            for (let i = 0; i < files.length; i++) {
                const fileExtension = files[i].name.split('.').pop().toLowerCase();
                if (!allowedTypes.includes(files[i].type) && !allowedExtensions.includes(fileExtension)) {
                    alert(`File "${files[i].name}" is not a valid image format. Please upload JPEG, PNG, GIF, or WEBP images.`);
                    document.getElementById('form-images-group').value = '';
                    return;
                }
                if (files[i].size > maxSizeBytes) {
                    alert(`File "${files[i].name}" exceeds the 10MB size limit. Please choose a smaller file.`);
                    document.getElementById('form-images-group').value = '';
                    return;
                }
            }

            filenameEl.textContent = `${files.length} image(s) selected`;
            statusEl.textContent = 'Uploading...';
            statusEl.style.color = 'var(--accent-color)';
            progressContainer.style.display = 'flex';

            // Disable save button during upload
            saveBtn.disabled = true;
            saveBtn.style.opacity = '0.5';

            const formData = new FormData();
            for (let i = 0; i < files.length; i++) {
                formData.append('image_files[]', files[i]);
            }

            const token = document.querySelector('input[name="_token"]').value;

            fetch("{{ url('/upload-images.php') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': token
                },
                body: formData
            })
            .then(response => {
                return response.text().then(text => {
                    try {
                        const data = JSON.parse(text);
                        return { ok: response.ok, data: data };
                    } catch (e) {
                        return { ok: false, isRawText: true, data: text };
                    }
                });
            })
            .then(result => {
                const data = result.data;
                if (!result.ok) {
                    if (result.isRawText) {
                        throw new Error('Server returned non-JSON response:\n' + data.substring(0, 1000));
                    } else {
                        throw new Error(data.message || 'Server error.');
                    }
                }

                if (data.status === 'success') {
                    document.getElementById('form-pages-json').value = JSON.stringify(data.pages);
                    statusEl.textContent = `Success (${data.pages.length} pgs)`;
                    statusEl.style.color = 'var(--success-color)';
                    filenameEl.textContent = `${data.pages.length} image(s) processed`;
                } else {
                    statusEl.textContent = 'Failed';
                    statusEl.style.color = '#ef4444';
                    alert('Image upload error: ' + data.message);
                    document.getElementById('form-images-group').value = '';
                    progressContainer.style.display = 'none';
                }
            })
            .catch(error => {
                console.error('Images Upload Error:', error);
                statusEl.textContent = 'Error';
                statusEl.style.color = '#ef4444';
                alert('Image upload failed: ' + error.message);
                document.getElementById('form-images-group').value = '';
                progressContainer.style.display = 'none';
            })
            .finally(() => {
                saveBtn.disabled = false;
                saveBtn.style.opacity = '1';
            });
        }

        // Modals Management
        const modal = document.getElementById('item-modal');
        
        function openAddModal() {
            document.getElementById('modal-title').textContent = 'Add Portfolio Item';
            document.getElementById('item-form').action = "{{ route('cms.items.store') }}";
            document.getElementById('form-method-spoof').value = "POST";
            
            // Clear inputs
            document.getElementById('form-title').value = '';
            document.getElementById('form-description').value = '';
            document.getElementById('form-category').value = '';
            document.getElementById('form-section').value = 'illustration';
            document.getElementById('form-type').value = 'original';
            document.getElementById('form-image').value = '';
            document.getElementById('form-image-url').value = '';
            
            document.getElementById('preview-container').style.display = 'none';
            document.getElementById('upload-preview').src = '#';
            document.getElementById('upload-instruction').textContent = 'Click to select image file (Max 5MB)';
            
            // Reset visual preview offsets
            itemImgOffsetX = 0;
            itemImgOffsetY = 0;
            itemImgScale = 1.0;
            document.getElementById('form-image-scale').value = 1.0;
            document.getElementById('form-image-offset-x').value = 0;
            document.getElementById('form-image-offset-y').value = 0;
            document.getElementById('item-zoom-slider').value = 1.0;
            document.getElementById('item-zoom-value-display').textContent = '1.00x';
            updateItemImageTransform();

            // Clear PDF + image upload inputs
            resetComicUploadState();
            // Default to PDF source on new entry
            document.getElementById('radio-source-pdf').checked = true;
            
            // Reset timelapse fields
            document.getElementById('form-has-timelapse').checked = false;
            document.getElementById('form-timelapse').value = '';
            const timelapsePlayer = document.getElementById('timelapse-preview-player');
            timelapsePlayer.src = '';
            timelapsePlayer.pause();
            document.getElementById('timelapse-preview-container').style.display = 'none';
            document.getElementById('timelapse-preview-filename').textContent = '';
            document.getElementById('timelapse-upload-instruction').textContent = 'Click to select video file (Max 30MB)';
            document.getElementById('timelapse-upload-wrapper').style.display = 'none';
            document.getElementById('illustration-extras-row').style.display = 'none';

            toggleTypeField();
            modal.classList.add('active');
        }

        function openEditModal(item) {
            document.getElementById('modal-title').textContent = 'Edit Portfolio Item';
            
            document.getElementById('item-form').action = `{{ url('/cms/items') }}/${item.id}`;
            document.getElementById('form-method-spoof').value = "POST";
            
            document.getElementById('form-title').value = item.title;
            document.getElementById('form-description').value = item.description || '';
            document.getElementById('form-category').value = item.category;
            document.getElementById('form-section').value = item.section;
            
            if (item.section === 'illustration') {
                document.getElementById('form-type').value = item.type || 'original';
            }
            
            // Image upload is optional when editing
            document.getElementById('form-image').value = '';
            
            // Populate image URL if external link
            const imgUrl = item.image_path.startsWith('http') ? item.image_path : `{{ asset('storage') }}/${item.image_path}`;
            document.getElementById('upload-preview').src = imgUrl;
            document.getElementById('preview-container').style.display = 'flex';

            if (item.image_path.startsWith('http')) {
                document.getElementById('form-image-url').value = item.image_path;
                document.getElementById('preview-filename').textContent = "External URL";
            } else {
                document.getElementById('form-image-url').value = '';
                document.getElementById('preview-filename').textContent = "Current Image";
            }
            document.getElementById('upload-instruction').textContent = 'Click to replace image file (Optional)';
            
            // Populate adjustments from database
            itemImgScale = parseFloat(item.image_scale || 1.0);
            itemImgOffsetX = parseInt(item.image_offset_x || 0);
            itemImgOffsetY = parseInt(item.image_offset_y || 0);
            document.getElementById('form-image-scale').value = itemImgScale;
            document.getElementById('form-image-offset-x').value = itemImgOffsetX;
            document.getElementById('form-image-offset-y').value = itemImgOffsetY;
            document.getElementById('item-zoom-slider').value = itemImgScale;
            document.getElementById('item-zoom-value-display').textContent = itemImgScale.toFixed(2) + 'x';
            updateItemImageTransform();

            // Populate existing comic flipbook pages info
            resetComicUploadState();
            // Default to PDF source on edit
            document.getElementById('radio-source-pdf').checked = true;

            if (item.section === 'comic' && item.pages && Array.isArray(item.pages) && item.pages.length > 0) {
                document.getElementById('form-pages-json').value = JSON.stringify(item.pages);
                document.getElementById('pdf-filename').textContent = `Existing Flipbook (${item.pages.length} pages)`;
                document.getElementById('pdf-upload-status').textContent = 'Saved';
                document.getElementById('pdf-upload-status').style.color = 'var(--success-color)';
                document.getElementById('pdf-progress-container').style.display = 'flex';
                document.getElementById('pdf-upload-instruction').textContent = 'Click to replace PDF or upload new images (Optional)';
                document.getElementById('images-upload-instruction').textContent = 'Click to replace with images (Optional)';
            }

            // Populate existing timelapse video if any
            if (item.section === 'illustration' && item.timelapse_path) {
                document.getElementById('form-has-timelapse').checked = true;
                document.getElementById('timelapse-upload-wrapper').style.display = 'block';
                const videoUrl = item.timelapse_path.startsWith('http') ? item.timelapse_path : `{{ asset('storage') }}/${item.timelapse_path}`;
                const tPlayer = document.getElementById('timelapse-preview-player');
                tPlayer.src = videoUrl;
                tPlayer.load();
                document.getElementById('timelapse-preview-container').style.display = 'flex';
                document.getElementById('timelapse-preview-filename').textContent = "Existing Video";
                document.getElementById('timelapse-upload-instruction').textContent = 'Click to replace video file (Optional)';
            } else {
                document.getElementById('form-has-timelapse').checked = false;
                document.getElementById('timelapse-upload-wrapper').style.display = 'none';
                document.getElementById('timelapse-preview-container').style.display = 'none';
                const tPlayer = document.getElementById('timelapse-preview-player');
                tPlayer.src = '';
                tPlayer.pause();
                document.getElementById('timelapse-preview-filename').textContent = '';
                document.getElementById('timelapse-upload-instruction').textContent = 'Click to select video file (Max 25MB)';
            }
            
            toggleTypeField();
            modal.classList.add('active');
        }

        function closeModal() {
            modal.classList.remove('active');
        }



        // Toggle Direction AJAX call
        function toggleDirection(itemId, btn) {
            btn.disabled = true;
            fetch(`/cms/items/${itemId}/toggle-direction`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    if (data.direction === 'rtl') {
                        btn.className = 'direction-toggle-btn rtl-active';
                        btn.textContent = 'RTL';
                    } else {
                        btn.className = 'direction-toggle-btn ltr-active';
                        btn.textContent = 'LTR';
                    }
                }
            })
            .catch(err => {
                console.error("Error toggling direction:", err);
                alert("Failed to toggle direction. Please check console.");
            })
            .finally(() => {
                btn.disabled = false;
            });
        }

        // --- About Visual Editor Javascript ---

        let isDraggingAboutImage = false;
        let dragStartX = 0;
        let dragStartY = 0;
        let imgOffsetX = parseInt(document.getElementById('about-image-offset-x').value) || 0;
        let imgOffsetY = parseInt(document.getElementById('about-image-offset-y').value) || 0;
        let imgScale = parseFloat(document.getElementById('about-image-scale').value) || 1.0;

        const aboutImg = document.getElementById('about-preview-image');
        const dragContainer = document.getElementById('draggable-preview-container');

        if (aboutImg && dragContainer) {
            // Mouse Events
            dragContainer.addEventListener('mousedown', (e) => {
                isDraggingAboutImage = true;
                dragStartX = e.clientX - imgOffsetX;
                dragStartY = e.clientY - imgOffsetY;
                aboutImg.style.cursor = 'grabbing';
                e.preventDefault();
            });

            window.addEventListener('mousemove', (e) => {
                if (!isDraggingAboutImage) return;
                imgOffsetX = e.clientX - dragStartX;
                imgOffsetY = e.clientY - dragStartY;
                updateImageTransform();
            });

            window.addEventListener('mouseup', () => {
                if (isDraggingAboutImage) {
                    isDraggingAboutImage = false;
                    aboutImg.style.cursor = 'grab';
                    document.getElementById('about-image-offset-x').value = Math.round(imgOffsetX);
                    document.getElementById('about-image-offset-y').value = Math.round(imgOffsetY);
                }
            });

            // Touch Events (Mobile support)
            dragContainer.addEventListener('touchstart', (e) => {
                if (e.touches.length === 1) {
                    isDraggingAboutImage = true;
                    dragStartX = e.touches[0].clientX - imgOffsetX;
                    dragStartY = e.touches[0].clientY - imgOffsetY;
                }
            });

            window.addEventListener('touchmove', (e) => {
                if (!isDraggingAboutImage || e.touches.length !== 1) return;
                imgOffsetX = e.touches[0].clientX - dragStartX;
                imgOffsetY = e.touches[0].clientY - dragStartY;
                updateImageTransform();
            });

            window.addEventListener('touchend', () => {
                if (isDraggingAboutImage) {
                    isDraggingAboutImage = false;
                    document.getElementById('about-image-offset-x').value = Math.round(imgOffsetX);
                    document.getElementById('about-image-offset-y').value = Math.round(imgOffsetY);
                }
            });
        }

        function updateImageTransform() {
            if (aboutImg) {
                aboutImg.style.transform = `scale(${imgScale})`;
                aboutImg.style.objectPosition = `calc(50% + ${imgOffsetX}px) calc(50% + ${imgOffsetY}px)`;
            }
        }

        function handleZoomChange(val) {
            imgScale = parseFloat(val);
            document.getElementById('zoom-value-display').textContent = imgScale.toFixed(2) + 'x';
            document.getElementById('about-image-scale').value = imgScale;
            updateImageTransform();
        }

        function loadNewAboutImage(event) {
            const file = event.target.files[0];
            if (file) {
                const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp'];
                const allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                const fileExtension = file.name.split('.').pop().toLowerCase();
                if (!allowedTypes.includes(file.type) && !allowedExtensions.includes(fileExtension)) {
                    alert('Invalid file format. Please upload an image (JPEG, PNG, GIF, WEBP).');
                    event.target.value = '';
                    return;
                }
                // Clear URL input if a file is selected
                document.getElementById('about-image-url').value = '';
                const reader = new FileReader();
                reader.onload = function(e) {
                    aboutImg.src = e.target.result;
                    // Reset positioning for new image
                    imgOffsetX = 0;
                    imgOffsetY = 0;
                    imgScale = 1.0;
                    document.getElementById('about-zoom-slider').value = 1.0;
                    document.getElementById('zoom-value-display').textContent = '1.00x';
                    document.getElementById('about-image-scale').value = 1.0;
                    document.getElementById('about-image-offset-x').value = 0;
                    document.getElementById('about-image-offset-y').value = 0;
                    updateImageTransform();
                    document.getElementById('about-image-instruction').textContent = 'New Image Loaded: ' + file.name;
                };
                reader.readAsDataURL(file);
            }
        }

        // --- About Rich Text Editor ---
        
        function syncEditorHtml() {
            const editor = document.getElementById('about-rich-editor');
            const hiddenInput = document.getElementById('about-text-content');
            if (editor && hiddenInput) {
                hiddenInput.value = editor.innerHTML;
            }
        }

        function editorFormat(command) {
            document.execCommand(command, false, null);
            syncEditorHtml();
            document.getElementById('about-rich-editor').focus();
        }

        function editorAlign(alignment) {
            if (alignment === 'left') {
                document.execCommand('justifyLeft', false, null);
            } else if (alignment === 'center') {
                document.execCommand('justifyCenter', false, null);
            } else if (alignment === 'right') {
                document.execCommand('justifyRight', false, null);
            } else if (alignment === 'justify') {
                document.execCommand('justifyFull', false, null);
            }
            syncEditorHtml();
            document.getElementById('about-rich-editor').focus();
        }

        function editorApplyWeight(weight) {
            const editor = document.getElementById('about-rich-editor');
            editor.focus();
            
            const selection = window.getSelection();
            if (!selection.rangeCount) return;
            
            const range = selection.getRangeAt(0);
            
            if (range.collapsed) {
                // Apply to the current block/paragraph parent
                let node = selection.anchorNode;
                while (node && node !== editor) {
                    if (node.nodeType === Node.ELEMENT_NODE && (node.tagName === 'P' || node.tagName === 'DIV')) {
                        node.style.fontWeight = weight;
                        break;
                    }
                    node = node.parentNode;
                }
            } else {
                // Apply to the specific selection by wrapping with a span
                const span = document.createElement('span');
                span.style.fontWeight = weight;
                
                try {
                    // Extract contents and insert inside span
                    const contents = range.extractContents();
                    span.appendChild(contents);
                    range.insertNode(span);
                    
                    // Reselect the newly styled text
                    selection.removeAllRanges();
                    const newRange = document.createRange();
                    newRange.selectNodeContents(span);
                    selection.addRange(newRange);
                } catch(e) {
                    // Simple fallback
                    document.execCommand('insertHTML', false, `<span style="font-weight: ${weight};">${selection.toString()}</span>`);
                }
            }
            syncEditorHtml();
        }

        // Form Submission Safeguard
        const aboutForm = document.getElementById('about-form');
        if (aboutForm) {
            aboutForm.addEventListener('submit', (e) => {
                syncEditorHtml();
            });
        }

        const itemForm = document.getElementById('item-form');
        if (itemForm) {
            itemForm.addEventListener('submit', (e) => {
                const section = document.getElementById('form-section').value;
                if (section === 'illustration' || section === 'concept') {
                    const imageFile = document.getElementById('form-image').files[0];
                    const imageUrl = document.getElementById('form-image-url').value.trim();
                    const isAdd = document.getElementById('modal-title').textContent.includes('Add');
                    
                    if (isAdd && !imageFile && !imageUrl) {
                        e.preventDefault();
                        alert('Please either upload an artwork image or provide an external image URL.');
                        return false;
                    }
                }
            });
        }

        // --- Chart.js Analytics Initialization ---
        
        let trafficChart = null;
        let deviceChart = null;

        function initAnalyticsCharts() {
            const isDark = !document.body.classList.contains('light-theme');
            const gridColor = isDark ? 'rgba(255, 255, 255, 0.05)' : 'rgba(0, 0, 0, 0.05)';
            const textColor = isDark ? '#9ca3af' : '#64748b';
            
            // 1. Line Chart Config
            const lineCtx = document.getElementById('trafficLineChart');
            if (lineCtx) {
                if (trafficChart) trafficChart.destroy();
                
                trafficChart = new Chart(lineCtx.getContext('2d'), {
                    type: 'line',
                    data: {
                        labels: {!! json_encode($analytics['chart_labels']) !!},
                        datasets: [
                            {
                                label: 'Page Views',
                                data: {!! json_encode($analytics['chart_views']) !!},
                                borderColor: '#fb7185',
                                backgroundColor: 'rgba(251, 113, 133, 0.1)',
                                borderWidth: 3,
                                tension: 0.35,
                                fill: true,
                                pointBackgroundColor: '#fb7185',
                                pointHoverRadius: 7
                            },
                            {
                                label: 'Unique Visitors',
                                data: {!! json_encode($analytics['chart_uniques']) !!},
                                borderColor: '#3b82f6',
                                backgroundColor: 'rgba(59, 130, 246, 0.05)',
                                borderWidth: 2,
                                borderDash: [4, 4],
                                tension: 0.35,
                                fill: true,
                                pointBackgroundColor: '#3b82f6',
                                pointHoverRadius: 6
                            }
                        ]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                labels: {
                                    color: textColor,
                                    font: { family: 'Inter, sans-serif', size: 11, weight: 'bold' }
                                }
                            },
                            tooltip: {
                                mode: 'index',
                                intersect: false
                            }
                        },
                        scales: {
                            x: {
                                grid: { color: gridColor },
                                ticks: { color: textColor, font: { family: 'IBM Plex Mono, monospace', size: 10 } }
                            },
                            y: {
                                grid: { color: gridColor },
                                ticks: { 
                                    color: textColor, 
                                    font: { family: 'IBM Plex Mono, monospace', size: 10 },
                                    precision: 0 
                                },
                                beginAtZero: true
                            }
                        }
                    }
                });
            }

            // 2. Doughnut Chart Config
            const doughnutCtx = document.getElementById('deviceDoughnutChart');
            if (doughnutCtx) {
                if (deviceChart) deviceChart.destroy();
                
                deviceChart = new Chart(doughnutCtx.getContext('2d'), {
                    type: 'doughnut',
                    data: {
                        labels: ['Desktop / Other', 'Mobile'],
                        datasets: [{
                            data: [{{ $analytics['desktop_count'] }}, {{ $analytics['mobile_count'] }}],
                            backgroundColor: ['#3b82f6', '#fb7185'],
                            borderColor: isDark ? '#111827' : '#ffffff',
                            borderWidth: 2,
                            hoverOffset: 6
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                position: 'bottom',
                                labels: {
                                    color: textColor,
                                    font: { family: 'Inter, sans-serif', size: 11 }
                                }
                            }
                        },
                        cutout: '65%'
                    }
                });
            }
        }

        // Prevent default drag behaviors globally to avoid navigating away
        window.addEventListener('dragover', function(e) {
            e.preventDefault();
        }, false);
        window.addEventListener('drop', function(e) {
            e.preventDefault();
        }, false);

        // Reusable function to setup Drag & Drop on placeholders
        function setupDragAndDrop(inputId, allowedTypes, multiple = false) {
            const inputEl = document.getElementById(inputId);
            if (!inputEl) return;
            const placeholderEl = inputEl.closest('.upload-placeholder');
            if (!placeholderEl) return;

            ['dragenter', 'dragover'].forEach(eventName => {
                placeholderEl.addEventListener(eventName, (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    placeholderEl.classList.add('dragover');
                }, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                placeholderEl.addEventListener(eventName, (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                    placeholderEl.classList.remove('dragover');
                }, false);
            });

            placeholderEl.addEventListener('drop', (e) => {
                const dt = e.dataTransfer;
                const files = dt.files;

                if (files && files.length > 0) {
                    const validFiles = [];
                    const allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                    for (let i = 0; i < files.length; i++) {
                        const file = files[i];
                        const fileExtension = file.name.split('.').pop().toLowerCase();
                        const isImage = allowedTypes.includes(file.type) || allowedExtensions.includes(fileExtension);
                        if (isImage) {
                            validFiles.push(file);
                        }
                    }

                    if (validFiles.length === 0) {
                        alert('Only image files (JPEG, PNG, GIF, WEBP) are allowed.');
                        return;
                    }

                    const filesToAssign = multiple ? validFiles : [validFiles[0]];

                    const dataTransfer = new DataTransfer();
                    filesToAssign.forEach(file => dataTransfer.items.add(file));
                    inputEl.files = dataTransfer.files;

                    // Trigger the change event
                    const event = new Event('change', { bubbles: true });
                    inputEl.dispatchEvent(event);
                }
            }, false);
        }

        // Initialize for image inputs
        const imageAllowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp'];
        setupDragAndDrop('about-image-input', imageAllowedTypes, false);
        setupDragAndDrop('form-image', imageAllowedTypes, false);
        setupDragAndDrop('form-images-group', imageAllowedTypes, true);

        // Subtab Switcher logic for illustrations
        let currentIllustrationSubTab = 'original';
        function switchIllustrationSubTab(subtab) {
            currentIllustrationSubTab = subtab;
            
            // Toggle active subtab buttons
            document.querySelectorAll('.illustration-subtab-btn').forEach(btn => {
                if (btn.getAttribute('data-subtab') === subtab) {
                    btn.classList.add('active');
                } else {
                    btn.classList.remove('active');
                }
            });
            
            // Toggle active subtab table contents
            document.querySelectorAll('.illustration-subtab-content').forEach(content => {
                if (content.id === `subtab-content-${subtab}`) {
                    content.style.display = 'block';
                } else {
                    content.style.display = 'none';
                }
            });
            
            // Reset search input and search local table filter
            document.getElementById('items-search').value = '';
            handleSearch();
        }

        // ============================================================
        // Vanilla JS Drag & Drop for Illustration Reordering
        // No external dependencies required.
        // ============================================================
        (function() {
            let dragState = null; // { row, tbody, type, startY, rows }

            function getIllustationType(tbody) {
                const table = tbody.closest('table');
                if (!table) return null;
                const id = table.id; // e.g. 'table-illustrations-original'
                const match = id.match(/table-illustrations-(\w+)/);
                return match ? match[1] : null;
            }

            function clearDropIndicators(tbody) {
                tbody.querySelectorAll('.portfolio-item-row').forEach(r => {
                    r.classList.remove('drag-over-above', 'drag-over-below');
                });
            }

            function handlePointerDown(e) {
                // Only react to clicks on .drag-handle elements
                const handle = e.target.closest('.drag-handle');
                if (!handle) return;

                const row = handle.closest('tr.portfolio-item-row');
                if (!row) return;

                const tbody = row.closest('tbody');
                if (!tbody) return;

                // Block if search is active
                const searchVal = document.getElementById('items-search').value.trim();
                if (searchVal !== '') {
                    showToast('Please clear the search filter before reordering.', 'error');
                    return;
                }

                e.preventDefault();
                handle.setPointerCapture(e.pointerId);

                const type = getIllustationType(tbody);
                const rows = Array.from(tbody.querySelectorAll('tr.portfolio-item-row'));

                dragState = {
                    row: row,
                    tbody: tbody,
                    type: type,
                    pointerId: e.pointerId,
                    handle: handle,
                    startY: e.clientY,
                    started: false,
                    rows: rows
                };
            }

            function handlePointerMove(e) {
                if (!dragState) return;
                if (e.pointerId !== dragState.pointerId) return;

                const dy = Math.abs(e.clientY - dragState.startY);

                // Require a minimum 5px movement to start the drag
                if (!dragState.started) {
                    if (dy < 5) return;
                    dragState.started = true;
                    dragState.row.classList.add('dragging');
                }

                e.preventDefault();

                // Determine which row we are hovering over
                clearDropIndicators(dragState.tbody);

                const targetRow = getRowUnderPointer(e.clientY, dragState.tbody, dragState.row);
                if (targetRow) {
                    const rect = targetRow.getBoundingClientRect();
                    const midY = rect.top + rect.height / 2;
                    if (e.clientY < midY) {
                        targetRow.classList.add('drag-over-above');
                    } else {
                        targetRow.classList.add('drag-over-below');
                    }
                }
            }

            function handlePointerUp(e) {
                if (!dragState) return;
                if (e.pointerId !== dragState.pointerId) return;

                const { row, tbody, type, started, handle } = dragState;

                try { handle.releasePointerCapture(e.pointerId); } catch(_) {}

                if (started) {
                    row.classList.remove('dragging');

                    // Determine drop target
                    const targetRow = getRowUnderPointer(e.clientY, tbody, row);
                    if (targetRow && targetRow !== row) {
                        const rect = targetRow.getBoundingClientRect();
                        const midY = rect.top + rect.height / 2;
                        if (e.clientY < midY) {
                            tbody.insertBefore(row, targetRow);
                        } else {
                            tbody.insertBefore(row, targetRow.nextSibling);
                        }
                        saveIllustrationsOrder(type);
                    }

                    clearDropIndicators(tbody);
                }

                dragState = null;
            }

            function handlePointerCancel(e) {
                if (!dragState) return;
                if (e.pointerId !== dragState.pointerId) return;

                dragState.row.classList.remove('dragging');
                clearDropIndicators(dragState.tbody);
                try { dragState.handle.releasePointerCapture(e.pointerId); } catch(_) {}
                dragState = null;
            }

            function getRowUnderPointer(clientY, tbody, draggedRow) {
                const rows = tbody.querySelectorAll('tr.portfolio-item-row');
                for (const r of rows) {
                    if (r === draggedRow) continue;
                    const rect = r.getBoundingClientRect();
                    if (clientY >= rect.top && clientY <= rect.bottom) {
                        return r;
                    }
                }
                return null;
            }

            // Attach listeners to all three table bodies
            function initDragAndDrop() {
                const types = ['original', 'fanart', 'spicy'];
                types.forEach(type => {
                    const table = document.getElementById('table-illustrations-' + type);
                    if (!table) return;
                    const tbody = table.querySelector('tbody');
                    if (!tbody) return;

                    tbody.addEventListener('pointerdown', handlePointerDown);
                    tbody.addEventListener('pointermove', handlePointerMove);
                    tbody.addEventListener('pointerup', handlePointerUp);
                    tbody.addEventListener('pointercancel', handlePointerCancel);

                    // Prevent native drag on handles
                    tbody.addEventListener('dragstart', function(e) {
                        if (e.target.closest && e.target.closest('.drag-handle')) {
                            e.preventDefault();
                        }
                    });
                });
                console.log('[DragDrop] Vanilla drag-and-drop initialized for illustration tables.');
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initDragAndDrop);
            } else {
                initDragAndDrop();
            }
        })();

        function saveIllustrationsOrder(type) {
            const rows = document.querySelectorAll('#table-illustrations-' + type + ' tbody tr.portfolio-item-row');
            const orderIds = Array.from(rows).map(row => row.getAttribute('data-id')).filter(id => id);

            if (orderIds.length === 0) return;

            const instructions = document.getElementById('drag-instructions');
            if (instructions) {
                instructions.style.opacity = '0.5';
            }

            fetch("{{ route('cms.illustrations.reorder') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ order: orderIds })
            })
            .then(res => {
                if (!res.ok) throw new Error('Failed to save order.');
                return res.json();
            })
            .then(data => {
                if (data.success) {
                    showToast(type.charAt(0).toUpperCase() + type.slice(1) + ' order updated successfully!');
                } else {
                    showToast(data.message || 'Error updating order.', 'error');
                }
            })
            .catch(err => {
                console.error(err);
                showToast('Failed to save sorting order.', 'error');
            })
            .finally(() => {
                if (instructions) {
                    instructions.style.opacity = '1';
                }
            });
        }

        // ============================================================
        // Commission Modal Management
        // ============================================================
        const commissionModal = document.getElementById('commission-modal');
        const commissionForm = document.getElementById('commission-form');

        function openCommissionEditModal(tier) {
            document.getElementById('commission-modal-title').textContent = 'Edit Commission Tier';
            commissionForm.action = `{{ url('/cms/commissions') }}/${tier.id}`;
            
            // Populate text/number fields
            document.getElementById('comm-render-quality').value = tier.render_quality.replace('_', ' ');
            document.getElementById('comm-coverage-type').value = tier.coverage_type.replace('_', '-');
            document.getElementById('comm-price').value = tier.price;
            document.getElementById('comm-delivery').value = tier.delivery_time;
            document.getElementById('comm-resolution').value = tier.resolution;
            document.getElementById('comm-dpi').value = tier.dpi;
            document.getElementById('comm-tools').value = tier.tools;

            // Populate checkboxes
            document.getElementById('comm-feat-high-res').checked = !!tier.feature_high_res;
            document.getElementById('comm-feat-revisions').checked = !!tier.feature_revisions;
            document.getElementById('comm-feat-background').checked = !!tier.feature_background;
            document.getElementById('comm-feat-commercial').checked = !!tier.feature_commercial;
            document.getElementById('comm-feat-source-file').checked = !!tier.feature_source_file;
            document.getElementById('comm-feat-urgent').checked = !!tier.feature_urgent;

            // Image uploads / URLs
            document.getElementById('comm-image').value = '';
            document.getElementById('comm-image-url').value = '';
            
            const previewContainer = document.getElementById('comm-preview-container');
            const uploadPreview = document.getElementById('comm-upload-preview');
            const previewFilename = document.getElementById('comm-preview-filename');

            if (tier.image_path) {
                const imgUrl = tier.image_path.startsWith('http') ? tier.image_path : `{{ asset('storage') }}/${tier.image_path}`;
                uploadPreview.src = imgUrl;
                previewContainer.style.display = 'flex';
                
                if (tier.image_path.startsWith('http')) {
                    document.getElementById('comm-image-url').value = tier.image_path;
                    previewFilename.textContent = "External URL";
                } else {
                    previewFilename.textContent = "Current Image";
                }
                document.getElementById('comm-upload-instruction').textContent = 'Click to replace image file (Optional)';
            } else {
                previewContainer.style.display = 'none';
                uploadPreview.src = '#';
                previewFilename.textContent = '';
                document.getElementById('comm-upload-instruction').textContent = 'Click to select image file (Max 5MB)';
            }

            commissionModal.classList.add('active');
        }

        function closeCommissionModal() {
            commissionModal.classList.remove('active');
        }

        // Live Preview Uploaded image
        function previewCommissionImage(event) {
            const file = event.target.files[0];
            if (file) {
                const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif', 'image/webp'];
                const allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                const fileExtension = file.name.split('.').pop().toLowerCase();
                if (!allowedTypes.includes(file.type) && !allowedExtensions.includes(fileExtension)) {
                    alert('Invalid file format. Please upload an image (JPEG, PNG, GIF, WEBP).');
                    event.target.value = '';
                    return;
                }
                document.getElementById('comm-image-url').value = '';
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('comm-upload-preview').src = e.target.result;
                    document.getElementById('comm-preview-container').style.display = 'flex';
                    document.getElementById('comm-preview-filename').textContent = file.name;
                    document.getElementById('comm-upload-instruction').textContent = 'Click to replace image file (Optional)';
                };
                reader.readAsDataURL(file);
            }
        }

        // Live Preview External Image URL
        function handleCommissionImageUrlInput(val) {
            const url = convertGoogleDriveLink(val.trim());
            const previewContainer = document.getElementById('comm-preview-container');
            const uploadPreview = document.getElementById('comm-upload-preview');
            const previewFilename = document.getElementById('comm-preview-filename');
            
            if (url) {
                document.getElementById('comm-image').value = '';
                document.getElementById('comm-upload-instruction').textContent = 'Click to select image file (Max 5MB)';
                
                uploadPreview.src = url;
                previewContainer.style.display = 'flex';
                previewFilename.textContent = "External URL";
            }
        }

        // Add Drag and drop logic for commissions
        setupDragAndDrop('comm-image', imageAllowedTypes, false);

        // Toast utility
        function showToast(message, type = 'success') {
            const toast = document.getElementById('toast-notification');
            const toastMsg = document.getElementById('toast-message');
            if (!toast) return;

            toastMsg.textContent = message;
            if (type === 'success') {
                toast.style.background = 'var(--success-color)';
            } else {
                toast.style.background = '#ef4444';
            }

            toast.style.display = 'flex';
            toast.offsetHeight;
            toast.style.transform = 'translateY(0)';
            toast.style.opacity = '1';

            if (window.toastTimeout) clearTimeout(window.toastTimeout);

            window.toastTimeout = setTimeout(() => {
                toast.style.transform = 'translateY(20px)';
                toast.style.opacity = '0';
                setTimeout(() => {
                    toast.style.display = 'none';
                }, 300);
            }, 3000);
        }

        // ============================================================
        // Social Modal Management
        // ============================================================
        const socialModal = document.getElementById('social-modal');
        const socialForm = document.getElementById('social-form');
        
        function openEditSocialModal(id, name, url) {
            document.getElementById('social-name').value = name;
            document.getElementById('social-url').value = url;
            
            // Set form action dynamically
            socialForm.action = `/cms/socials/${id}`;
            
            socialModal.classList.add('active');
        }
        
        function closeSocialModal() {
            socialModal.classList.remove('active');
        }

        // ============================================================
        // Vanilla JS Drag & Drop for Socials Reordering
        // ============================================================
        (function() {
            let dragState = null; // { row, tbody, startY, rows }

            function clearDropIndicators(tbody) {
                tbody.querySelectorAll('.portfolio-item-row').forEach(r => {
                    r.classList.remove('drag-over-above', 'drag-over-below');
                });
            }

            function handlePointerDown(e) {
                // Only react to clicks on .drag-handle elements
                const handle = e.target.closest('.drag-handle');
                if (!handle) return;

                const row = handle.closest('tr.portfolio-item-row');
                if (!row) return;

                const tbody = row.closest('tbody');
                if (!tbody) return;

                e.preventDefault();
                handle.setPointerCapture(e.pointerId);

                // Collect all rows and cache their heights/offsets
                const rows = Array.from(tbody.querySelectorAll('.portfolio-item-row'));
                row.classList.add('dragging');

                dragState = {
                    row: row,
                    tbody: tbody,
                    startY: e.clientY,
                    rows: rows
                };

                // Add document pointermove/pointerup listeners
                handle.addEventListener('pointermove', handlePointerMove);
                handle.addEventListener('pointerup', handlePointerUp);
            }

            function handlePointerMove(e) {
                if (!dragState) return;

                const { row, tbody, startY, rows } = dragState;
                const clientY = e.clientY;
                const deltaY = clientY - startY;

                // Move dragging row visually
                row.style.transform = `translateY(${deltaY}px)`;

                // Highlight target drop positions
                clearDropIndicators(tbody);

                let closestRow = null;
                let position = 'above';
                let minDistance = Infinity;

                rows.forEach(r => {
                    if (r === row) return;
                    const rect = r.getBoundingClientRect();
                    const midY = rect.top + rect.height / 2;
                    const distance = Math.abs(clientY - midY);

                    if (distance < minDistance) {
                        minDistance = distance;
                        closestRow = r;
                        position = clientY < midY ? 'above' : 'below';
                    }
                });

                if (closestRow) {
                    closestRow.classList.add(position === 'above' ? 'drag-over-above' : 'drag-over-below');
                }
            }

            function handlePointerUp(e) {
                const handle = e.target;
                handle.removeEventListener('pointermove', handlePointerMove);
                handle.removeEventListener('pointerup', handlePointerUp);

                if (!dragState) return;

                const { row, tbody, rows } = dragState;
                row.classList.remove('dragging');
                row.style.transform = '';

                // Find where to insert the row
                let targetRow = null;
                let position = 'above';
                let minDistance = Infinity;
                const clientY = e.clientY;

                rows.forEach(r => {
                    if (r === row) return;
                    const rect = r.getBoundingClientRect();
                    const midY = rect.top + rect.height / 2;
                    const distance = Math.abs(clientY - midY);

                    if (distance < minDistance) {
                        minDistance = distance;
                        targetRow = r;
                        position = clientY < midY ? 'above' : 'below';
                    }
                });

                clearDropIndicators(tbody);

                if (targetRow) {
                    if (position === 'above') {
                        tbody.insertBefore(row, targetRow);
                    } else {
                        tbody.insertBefore(row, targetRow.nextSibling);
                    }
                    saveSocialsOrder();
                }

                dragState = null;
            }

            function initDragAndDrop() {
                const socialsTable = document.getElementById('table-socials');
                if (socialsTable) {
                    socialsTable.addEventListener('pointerdown', handlePointerDown);
                }
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initDragAndDrop);
            } else {
                initDragAndDrop();
            }
        })();

        function saveSocialsOrder() {
            const rows = document.querySelectorAll('#table-socials tbody tr.portfolio-item-row');
            const orderIds = Array.from(rows).map(row => row.getAttribute('data-id')).filter(id => id);

            if (orderIds.length === 0) return;

            const instructions = document.getElementById('socials-drag-instructions');
            if (instructions) {
                instructions.style.opacity = '0.5';
            }

            fetch("{{ route('cms.socials.reorder') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ order: orderIds })
            })
            .then(res => {
                if (!res.ok) throw new Error('Failed to save order.');
                return res.json();
            })
            .then(data => {
                if (data.success) {
                    showToast('Social links order updated successfully!');
                } else {
                    showToast(data.message || 'Error updating order.', 'error');
                }
            })
            .catch(err => {
                console.error(err);
                showToast('Error connection. Could not update order.', 'error');
            })
            .finally(() => {
                if (instructions) {
                    instructions.style.opacity = '1';
                }
            });
        }
    </script>

    <!-- Toast Notification -->
    <div id="toast-notification" style="position: fixed; bottom: 2rem; right: 2rem; background: var(--success-color); color: #fff; padding: 0.75rem 1.5rem; border-radius: 8px; font-family: var(--font-mono); font-size: 0.85rem; box-shadow: 0 10px 15px -3px rgba(0,0,0,0.3); display: none; z-index: 1000; align-items: center; gap: 8px; transition: all 0.3s ease; transform: translateY(20px); opacity: 0;">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>
        <span id="toast-message">Order saved successfully!</span>
    </div>
</body>
</html>
