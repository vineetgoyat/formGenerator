@extends('layouts.admin')

@section('content')

{{-- Google Fonts --}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">

<div class="fb-root" id="formBuilderRoot">

    {{-- ═══════════════════════════════════════════════
         HEADER BAR
    ═══════════════════════════════════════════════ --}}
    <header class="fb-header">
        <div class="fb-header__left">
            <div class="fb-logo">
                <svg width="28" height="28" viewBox="0 0 28 28" fill="none">
                    <rect width="28" height="28" rx="8" fill="#2563eb"/>
                    <rect x="7" y="8" width="14" height="2.5" rx="1.25" fill="white"/>
                    <rect x="7" y="12.75" width="10" height="2.5" rx="1.25" fill="white" opacity=".7"/>
                    <rect x="7" y="17.5" width="7" height="2.5" rx="1.25" fill="white" opacity=".4"/>
                </svg>
                <span class="fb-logo__text">FormCraft</span>
            </div>
            <div class="fb-breadcrumb">
                <span class="fb-breadcrumb__item">Forms</span>
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M5 3l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                <span class="fb-breadcrumb__item fb-breadcrumb__item--active">New Form</span>
            </div>
        </div>
        <div class="fb-header__right">
            <button class="fb-btn fb-btn--ghost" id="darkToggleBtn" title="Toggle dark mode">
                <svg id="sunIcon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="5"/><line x1="12" y1="1" x2="12" y2="3"/><line x1="12" y1="21" x2="12" y2="23"/><line x1="4.22" y1="4.22" x2="5.64" y2="5.64"/><line x1="18.36" y1="18.36" x2="19.78" y2="19.78"/><line x1="1" y1="12" x2="3" y2="12"/><line x1="21" y1="12" x2="23" y2="12"/><line x1="4.22" y1="19.78" x2="5.64" y2="18.36"/><line x1="18.36" y1="5.64" x2="19.78" y2="4.22"/></svg>
                <svg id="moonIcon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:none"><path d="M21 12.79A9 9 0 1111.21 3 7 7 0 0021 12.79z"/></svg>
            </button>
            <button class="fb-btn fb-btn--ghost" id="previewBtn">Preview</button>
            <button class="fb-btn fb-btn--primary" id="nextBtn">
                Export Schema
                <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M2 7h10M8 3l4 4-4 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </button>
        </div>
    </header>

    {{-- ═══════════════════════════════════════════════
         TITLE BAR
    ═══════════════════════════════════════════════ --}}
    <div class="fb-titlebar">
        <div class="fb-titlebar__inner">
            <div class="fb-titlebar__field">
                <input
                    type="text"
                    id="formTitle"
                    maxlength="200"
                    class="fb-title-input"
                    placeholder="Untitled Form">
                <div class="fb-titlebar__meta">
                    <span class="fb-field-count" id="fieldCountLabel">0 fields</span>
                    <span class="fb-separator">·</span>
                    <span id="titleCount" class="fb-char-count">0</span><span class="fb-char-count">/200</span>
                </div>
            </div>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════
         MAIN WORKSPACE
    ═══════════════════════════════════════════════ --}}
    <div class="fb-workspace">

        {{-- LEFT: Drop Canvas --}}
        <div class="fb-canvas-col">
            <div id="dropCanvas" class="fb-canvas">
                <div id="emptyState" class="fb-empty">
                    <div class="fb-empty__icon">
                        <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                            <rect x="6" y="10" width="36" height="5" rx="2.5" fill="#2563eb" opacity=".15"/>
                            <rect x="6" y="20" width="28" height="4" rx="2" fill="#2563eb" opacity=".1"/>
                            <rect x="6" y="29" width="22" height="4" rx="2" fill="#2563eb" opacity=".07"/>
                            <rect x="6" y="38" width="16" height="4" rx="2" fill="#2563eb" opacity=".05"/>
                            <circle cx="38" cy="34" r="10" fill="#2563eb" opacity=".12"/>
                            <path d="M34 34h8M38 30v8" stroke="#2563eb" stroke-width="2" stroke-linecap="round"/>
                        </svg>
                    </div>
                    <h3 class="fb-empty__title">Start building your form</h3>
                    <p class="fb-empty__sub">Drag a field from the panel on the right, or click any field tile to add it instantly.</p>
                    <div class="fb-empty__hint">
                        <kbd>Drag</kbd> to add &nbsp;·&nbsp; <kbd>↑↓</kbd> to reorder &nbsp;·&nbsp; <kbd>✏</kbd> to configure
                    </div>
                </div>
            </div>
        </div>

        {{-- RIGHT: Builder Panel --}}
        <div class="fb-panel-col">
            <div class="fb-panel">

                {{-- Panel Tabs --}}
                <div class="fb-panel__tabs">
                    <button id="addFieldsTab" class="fb-tab fb-tab--active" type="button">Fields</button>
                    <button id="fieldOptionsTab" class="fb-tab" type="button">Configure</button>
                </div>

                {{-- ADD FIELDS PANEL --}}
                <div id="addFieldsPanel" class="fb-panel__body">
                    <div class="fb-field-group">
                        <div class="fb-field-group__label">Basic Inputs</div>
                        <div class="fb-tiles">
                            <div class="fb-tile" draggable="true" data-type="text">
                                <div class="fb-tile__icon fb-tile__icon--blue">
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><rect x="1" y="3" width="12" height="8" rx="2" stroke="currentColor" stroke-width="1.4"/><path d="M4 7h6M4 9.5h4" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/></svg>
                                </div>
                                <span>Text</span>
                            </div>
                            <div class="fb-tile" draggable="true" data-type="textarea">
                                <div class="fb-tile__icon fb-tile__icon--blue">
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><rect x="1" y="2" width="12" height="10" rx="2" stroke="currentColor" stroke-width="1.4"/><path d="M3.5 5h7M3.5 7.5h7M3.5 10h4" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/></svg>
                                </div>
                                <span>Textarea</span>
                            </div>
                            <div class="fb-tile" draggable="true" data-type="number">
                                <div class="fb-tile__icon fb-tile__icon--blue">
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><rect x="1" y="3" width="12" height="8" rx="2" stroke="currentColor" stroke-width="1.4"/><path d="M5 9V5l-1.5 1M7.5 5h1.5c.6 0 1 .4 1 1s-.4 1-1 1H8l1.5 2" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </div>
                                <span>Number</span>
                            </div>
                            <div class="fb-tile" draggable="true" data-type="email">
                                <div class="fb-tile__icon fb-tile__icon--blue">
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><rect x="1" y="3" width="12" height="8" rx="2" stroke="currentColor" stroke-width="1.4"/><path d="M1 4.5l6 3.5 6-3.5" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/></svg>
                                </div>
                                <span>Email</span>
                            </div>
                            <div class="fb-tile" draggable="true" data-type="phone">
                                <div class="fb-tile__icon fb-tile__icon--blue">
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><rect x="3" y="1" width="8" height="12" rx="2" stroke="currentColor" stroke-width="1.4"/><circle cx="7" cy="10.5" r=".75" fill="currentColor"/></svg>
                                </div>
                                <span>Phone</span>
                            </div>
                            <div class="fb-tile" draggable="true" data-type="date">
                                <div class="fb-tile__icon fb-tile__icon--blue">
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><rect x="1" y="3" width="12" height="10" rx="2" stroke="currentColor" stroke-width="1.4"/><path d="M1 6.5h12M4.5 1v3M9.5 1v3" stroke="currentColor" stroke-width="1.2" stroke-linecap="round"/></svg>
                                </div>
                                <span>Date</span>
                            </div>
                            <div class="fb-tile" draggable="true" data-type="file">
                                <div class="fb-tile__icon fb-tile__icon--blue">
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><rect x="2" y="1" width="10" height="12" rx="2" stroke="currentColor" stroke-width="1.4"/><path d="M7 9V5M5 7l2-2 2 2" stroke="currentColor" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </div>
                                <span>File</span>
                            </div>
                        </div>
                    </div>

                    <div class="fb-field-group">
                        <div class="fb-field-group__label">Choice Fields</div>
                        <div class="fb-tiles">
                            <div class="fb-tile" draggable="true" data-type="dropdown">
                                <div class="fb-tile__icon fb-tile__icon--indigo">
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><rect x="1" y="3" width="12" height="8" rx="2" stroke="currentColor" stroke-width="1.4"/><path d="M9.5 6.5L7 9 4.5 6.5" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </div>
                                <span>Dropdown</span>
                            </div>
                            <div class="fb-tile" draggable="true" data-type="radio">
                                <div class="fb-tile__icon fb-tile__icon--indigo">
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><circle cx="7" cy="7" r="5.5" stroke="currentColor" stroke-width="1.4"/><circle cx="7" cy="7" r="2.5" fill="currentColor"/></svg>
                                </div>
                                <span>Radio</span>
                            </div>
                            <div class="fb-tile" draggable="true" data-type="checkbox">
                                <div class="fb-tile__icon fb-tile__icon--indigo">
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><rect x="1.5" y="1.5" width="11" height="11" rx="2.5" stroke="currentColor" stroke-width="1.4"/><path d="M4 7l2.5 2.5L10 4.5" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </div>
                                <span>Checkbox</span>
                            </div>
                        </div>
                    </div>

                    <div class="fb-field-group">
                        <div class="fb-field-group__label">Location</div>
                        <div class="fb-tiles">
                            <div class="fb-tile" draggable="true" data-type="state">
                                <div class="fb-tile__icon fb-tile__icon--teal">
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M7 1.5C4.5 1.5 2.5 3.5 2.5 6c0 3.5 4.5 6.5 4.5 6.5S11.5 9.5 11.5 6c0-2.5-2-4.5-4.5-4.5z" stroke="currentColor" stroke-width="1.4"/><circle cx="7" cy="6" r="1.5" fill="currentColor"/></svg>
                                </div>
                                <span>State</span>
                            </div>
                            <div class="fb-tile" draggable="true" data-type="city">
                                <div class="fb-tile__icon fb-tile__icon--teal">
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><rect x="3" y="5" width="3.5" height="7" stroke="currentColor" stroke-width="1.3"/><rect x="7.5" y="3" width="3.5" height="9" stroke="currentColor" stroke-width="1.3"/><path d="M1 12h12" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/></svg>
                                </div>
                                <span>City</span>
                            </div>
                            <div class="fb-tile" draggable="true" data-type="statecity">
                                <div class="fb-tile__icon fb-tile__icon--teal">
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><rect x="1" y="5" width="5" height="7" rx="1" stroke="currentColor" stroke-width="1.3"/><rect x="8" y="3" width="5" height="9" rx="1" stroke="currentColor" stroke-width="1.3"/></svg>
                                </div>
                                <span>State & City</span>
                            </div>
                        </div>
                    </div>

                    <div class="fb-field-group">
                        <div class="fb-field-group__label">Layout</div>
                        <div class="fb-tiles">
                            <div class="fb-tile" draggable="true" data-type="title">
                                <div class="fb-tile__icon fb-tile__icon--slate">
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M2 4h10M2 7h7M2 10h5" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
                                </div>
                                <span>Title</span>
                            </div>
                            <div class="fb-tile" draggable="true" data-type="description">
                                <div class="fb-tile__icon fb-tile__icon--slate">
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M2 4h10M2 6.5h10M2 9h8M2 11.5h5" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/></svg>
                                </div>
                                <span>Description</span>
                            </div>
                            <div class="fb-tile" draggable="true" data-type="newline">
                                <div class="fb-tile__icon fb-tile__icon--slate">
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M2 7h8M8 4.5L10.5 7 8 9.5" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </div>
                                <span>New Line</span>
                            </div>
                            <div class="fb-tile" draggable="true" data-type="pagebreak">
                                <div class="fb-tile__icon fb-tile__icon--slate">
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M1 7h3M5.5 7h3M10 7h3" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
                                </div>
                                <span>Page Break</span>
                            </div>
                            <div class="fb-tile" draggable="true" data-type="hidden">
                                <div class="fb-tile__icon fb-tile__icon--slate">
                                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M1 7s2.5-4 6-4 6 4 6 4-2.5 4-6 4-6-4-6-4z" stroke="currentColor" stroke-width="1.3"/><line x1="2" y1="2" x2="12" y2="12" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/></svg>
                                </div>
                                <span>Hidden</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- FIELD OPTIONS PANEL --}}
                <div id="fieldOptionsPanel" class="fb-panel__body d-none">
                    <div class="fb-config-section">
                        <label class="fb-label">Label</label>
                        <input type="text" id="optionLabel" class="fb-input" placeholder="Field label">
                    </div>
                    <div class="fb-config-section">
                        <label class="fb-label">Placeholder</label>
                        <input type="text" id="optionPlaceholder" class="fb-input" placeholder="Hint text">
                    </div>
                    <div class="fb-config-section">
                        <label class="fb-label">CSS Class</label>
                        <input type="text" id="optionClass" class="fb-input" placeholder="e.g. col-md-6">
                    </div>
                    <div class="fb-config-section" id="textConfigWrapper">
                        <label class="fb-label">Min / Max Characters</label>
                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px;">
                            <input type="number" id="optionMin" class="fb-input" placeholder="Min">
                            <input type="number" id="optionMax" class="fb-input" placeholder="Max">
                        </div>
                    </div>
                    <div class="fb-config-section">
                        <label class="fb-label">Default Value</label>
                        <input type="text" id="optionDefault" class="fb-input" placeholder="Pre-filled value">
                    </div>
                    <div class="fb-config-section">
                        <label class="fb-toggle-row">
                            <input type="checkbox" id="optionRequired" class="fb-toggle-input">
                            <span class="fb-toggle-track">
                                <span class="fb-toggle-thumb"></span>
                            </span>
                            <span class="fb-toggle-label">Required field</span>
                        </label>
                    </div>
                    <div id="optionsWrapper" class="fb-config-section d-none">
                        <label class="fb-label">Options</label>
                        <div id="optionsList" class="fb-options-list"></div>
                        <button type="button" class="fb-add-option-btn" onclick="addOption()">
                            <svg width="12" height="12" viewBox="0 0 12 12" fill="none"><path d="M6 1v10M1 6h10" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>
                            Add option
                        </button>
                    </div>
                    <div class="fb-config-section">
                        <button class="fb-btn fb-btn--danger w-full" onclick="deleteField(selectedFieldId)">
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none"><path d="M2 4h10l-1 8H3L2 4zM5.5 4V2.5h3V4M1 4h12" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            Remove field
                        </button>
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

{{-- ═══════════════════════════════════════════════
     JSON EXPORT MODAL
═══════════════════════════════════════════════ --}}
<div class="fb-modal-overlay" id="jsonModalOverlay">
    <div class="fb-modal">
        <div class="fb-modal__header">
            <div>
                <div class="fb-modal__eyebrow">Export</div>
                <h2 class="fb-modal__title">Form JSON Schema</h2>
            </div>
            <button class="fb-modal__close" id="closeModal">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M3 3l10 10M13 3L3 13" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
            </button>
        </div>
        <div class="fb-modal__body">
            <div class="fb-code-toolbar">
                <span class="fb-code-lang">JSON</span>
                <button class="fb-copy-btn" id="copyJsonBtn">
                    <svg width="13" height="13" viewBox="0 0 14 14" fill="none"><rect x="4" y="4" width="8" height="8" rx="2" stroke="currentColor" stroke-width="1.4"/><path d="M4 4V3a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1h-1" stroke="currentColor" stroke-width="1.3"/></svg>
                    Copy
                </button>
            </div>
            <pre id="jsonOutput" class="fb-code-block"></pre>
        </div>
    </div>
</div>

{{-- ═══════════════════════════════════════════════
     STYLES
═══════════════════════════════════════════════ --}}
<style>
/* ── TOKENS ─────────────────────────────────── */
:root {
    --blue:       #2563eb;
    --blue-light: #3b82f6;
    --blue-faint: #eff6ff;
    --indigo:     #4f46e5;
    --teal:       #0d9488;

    --bg:         #f1f5f9;
    --surface:    #ffffff;
    --surface2:   #f8fafc;
    --border:     #e2e8f0;
    --border2:    #cbd5e1;

    --text:       #0f172a;
    --text-2:     #475569;
    --text-3:     #94a3b8;

    --radius-sm:  8px;
    --radius-md:  12px;
    --radius-lg:  18px;
    --radius-xl:  24px;

    --shadow-sm:  0 1px 3px rgba(15,23,42,.07), 0 1px 2px rgba(15,23,42,.05);
    --shadow-md:  0 4px 16px rgba(15,23,42,.08), 0 2px 4px rgba(15,23,42,.05);
    --shadow-lg:  0 12px 32px rgba(15,23,42,.10), 0 4px 8px rgba(15,23,42,.06);

    --font-display: 'DM Sans', sans-serif;
    --font-ui:      'Inter', sans-serif;
    --font-mono:    'JetBrains Mono', monospace;

    --header-h: 56px;
    --titlebar-h: 64px;
}

.fb-root.dark {
    --bg:       #0f172a;
    --surface:  #1e293b;
    --surface2: #273449;
    --border:   #2d3f55;
    --border2:  #3a506b;
    --text:     #f1f5f9;
    --text-2:   #94a3b8;
    --text-3:   #64748b;
    --blue-faint: rgba(37,99,235,.12);
}

/* ── RESET ───────────────────────────────────── */
.fb-root *, .fb-root *::before, .fb-root *::after { box-sizing: border-box; margin: 0; padding: 0; }
.fb-root { font-family: var(--font-ui); color: var(--text); background: var(--bg); min-height: 100vh; }

/* ── HEADER ──────────────────────────────────── */
.fb-header {
    height: var(--header-h);
    background: var(--surface);
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 24px;
    position: sticky;
    top: 0;
    z-index: 100;
    backdrop-filter: blur(12px);
}

.fb-header__left,
.fb-header__right { display: flex; align-items: center; gap: 16px; }

.fb-logo { display: flex; align-items: center; gap: 10px; }
.fb-logo__text { font-family: var(--font-display); font-weight: 700; font-size: 17px; color: var(--text); letter-spacing: -.3px; }

.fb-breadcrumb { display: flex; align-items: center; gap: 6px; color: var(--text-3); font-size: 13px; }
.fb-breadcrumb svg { opacity: .5; }
.fb-breadcrumb__item--active { color: var(--text-2); font-weight: 500; }

/* ── TITLE BAR ───────────────────────────────── */
.fb-titlebar {
    height: var(--titlebar-h);
    background: var(--surface);
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    padding: 0 24px;
}

.fb-titlebar__inner { width: 100%; }
.fb-titlebar__field { display: flex; align-items: center; gap: 16px; }

.fb-title-input {
    border: none;
    outline: none;
    background: transparent;
    font-family: var(--font-display);
    font-size: 20px;
    font-weight: 600;
    color: var(--text);
    flex: 1;
    min-width: 0;
    letter-spacing: -.3px;
}

.fb-title-input::placeholder { color: var(--text-3); }

.fb-titlebar__meta { display: flex; align-items: center; gap: 8px; white-space: nowrap; }
.fb-separator { color: var(--text-3); }
.fb-char-count, .fb-field-count { font-size: 12px; color: var(--text-3); font-family: var(--font-ui); }

/* ── WORKSPACE ───────────────────────────────── */
.fb-workspace {
    display: grid;
    grid-template-columns: 1fr 320px;
    gap: 0;
    height: calc(100vh - var(--header-h) - var(--titlebar-h));
    overflow: hidden;
}

.fb-canvas-col {
    padding: 28px;
    overflow-y: auto;
    background: var(--bg);
}

.fb-panel-col {
    border-left: 1px solid var(--border);
    background: var(--surface);
    overflow-y: auto;
}

/* ── DROP CANVAS ─────────────────────────────── */
.fb-canvas {
    min-height: 100%;
    border-radius: var(--radius-xl);
    background: var(--surface);
    border: 2px dashed var(--border);
    padding: 28px;
    transition: border-color .2s, background .2s;
}

.fb-canvas.drag-over {
    border-color: var(--blue);
    background: var(--blue-faint);
    box-shadow: inset 0 0 0 1px var(--blue), 0 0 0 4px rgba(37,99,235,.06);
}

/* ── EMPTY STATE ─────────────────────────────── */
.fb-empty {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 80px 24px;
    text-align: center;
    min-height: 400px;
}

.fb-empty__icon {
    width: 80px;
    height: 80px;
    background: var(--blue-faint);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 24px;
}

.fb-empty__title {
    font-family: var(--font-display);
    font-size: 20px;
    font-weight: 600;
    color: var(--text);
    margin-bottom: 8px;
}

.fb-empty__sub {
    font-size: 14px;
    color: var(--text-2);
    max-width: 320px;
    line-height: 1.6;
    margin-bottom: 20px;
}

.fb-empty__hint {
    display: flex;
    align-items: center;
    gap: 4px;
    font-size: 12px;
    color: var(--text-3);
}

kbd {
    background: var(--surface2);
    border: 1px solid var(--border);
    border-radius: 4px;
    padding: 2px 6px;
    font-family: var(--font-mono);
    font-size: 11px;
    color: var(--text-2);
}

/* ── FIELD CARDS ─────────────────────────────── */
.fb-field-card {
    background: var(--surface);
    border: 1px solid var(--border);
    border-radius: var(--radius-lg);
    padding: 20px;
    margin-bottom: 14px;
    position: relative;
    transition: transform .2s, box-shadow .2s;
    /* Signature element: left accent bar, color-coded by category */
    border-left-width: 4px;
}

.fb-field-card:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

.fb-field-card--input  { border-left-color: var(--blue); }
.fb-field-card--choice { border-left-color: var(--indigo); }
.fb-field-card--location { border-left-color: var(--teal); }
.fb-field-card--layout { border-left-color: var(--border2); }

.fb-field-card--new {
    animation: cardSlideIn .25s ease-out;
}

@keyframes cardSlideIn {
    from { opacity: 0; transform: translateY(10px); }
    to   { opacity: 1; transform: translateY(0); }
}

.fb-card-header {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 12px;
    margin-bottom: 14px;
}

.fb-card-meta { flex: 1; min-width: 0; }

.fb-card-type {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: .6px;
    text-transform: uppercase;
    color: var(--text-3);
    margin-bottom: 4px;
}

.fb-card-label {
    font-family: var(--font-display);
    font-size: 16px;
    font-weight: 600;
    color: var(--text);
    margin-bottom: 2px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.fb-card-sub {
    font-size: 12px;
    color: var(--text-3);
}

.fb-required-dot {
    display: inline-block;
    width: 6px;
    height: 6px;
    background: #ef4444;
    border-radius: 50%;
    margin-left: 4px;
    vertical-align: middle;
}

.fb-card-actions {
    display: flex;
    gap: 4px;
    flex-shrink: 0;
}

.fb-action-btn {
    width: 32px;
    height: 32px;
    border: none;
    background: var(--surface2);
    color: var(--text-2);
    border-radius: var(--radius-sm);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: .18s;
}

.fb-action-btn:hover {
    background: var(--blue);
    color: white;
}

.fb-action-btn--delete:hover {
    background: #ef4444;
    color: white;
}

.fb-card-preview {
    margin-top: 4px;
}

/* ── PREVIEW INPUTS ──────────────────────────── */
.fb-preview-input {
    width: 100%;
    border: 1px solid var(--border);
    border-radius: var(--radius-sm);
    padding: 9px 13px;
    font-size: 13px;
    background: var(--surface2);
    color: var(--text-3);
    pointer-events: none;
    font-family: var(--font-ui);
}

.fb-preview-textarea {
    width: 100%;
    min-height: 72px;
    resize: none;
    border: 1px solid var(--border);
    border-radius: var(--radius-sm);
    padding: 9px 13px;
    font-size: 13px;
    background: var(--surface2);
    color: var(--text-3);
    pointer-events: none;
    font-family: var(--font-ui);
}

.fb-preview-select {
    width: 100%;
    border: 1px solid var(--border);
    border-radius: var(--radius-sm);
    padding: 9px 13px;
    font-size: 13px;
    background: var(--surface2);
    color: var(--text-3);
    pointer-events: none;
}

.fb-preview-choices { display: flex; flex-wrap: wrap; gap: 8px; }
.fb-preview-choice {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    color: var(--text-2);
}

.fb-preview-title { font-family: var(--font-display); font-size: 18px; font-weight: 700; color: var(--text); }
.fb-preview-description { font-size: 14px; color: var(--text-2); line-height: 1.5; }
.fb-preview-hr { border: none; border-top: 2px dashed var(--border2); margin: 4px 0; }
.fb-preview-newline { height: 12px; }
.fb-preview-hidden {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 12px;
    color: var(--text-3);
    background: var(--surface2);
    border: 1px dashed var(--border);
    border-radius: var(--radius-sm);
    padding: 8px 12px;
}

/* ── PANEL ───────────────────────────────────── */
.fb-panel { height: 100%; display: flex; flex-direction: column; }

.fb-panel__tabs {
    display: flex;
    border-bottom: 1px solid var(--border);
    padding: 0 16px;
    flex-shrink: 0;
}

.fb-tab {
    border: none;
    background: transparent;
    padding: 16px 12px;
    font-size: 13px;
    font-weight: 500;
    color: var(--text-3);
    cursor: pointer;
    border-bottom: 2px solid transparent;
    margin-bottom: -1px;
    transition: .18s;
    font-family: var(--font-ui);
}

.fb-tab--active {
    color: var(--blue);
    border-bottom-color: var(--blue);
    font-weight: 600;
}

.fb-tab:hover:not(.fb-tab--active) { color: var(--text-2); }

.fb-panel__body { padding: 16px; overflow-y: auto; flex: 1; }

/* ── FIELD GROUPS ────────────────────────────── */
.fb-field-group { margin-bottom: 20px; }

.fb-field-group__label {
    font-size: 10px;
    font-weight: 700;
    letter-spacing: .8px;
    text-transform: uppercase;
    color: var(--text-3);
    margin-bottom: 8px;
}

.fb-tiles {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 6px;
}

.fb-tile {
    display: flex;
    align-items: center;
    gap: 8px;
    background: var(--surface2);
    border: 1px solid var(--border);
    border-radius: var(--radius-sm);
    padding: 9px 10px;
    cursor: grab;
    font-size: 12px;
    font-weight: 500;
    color: var(--text-2);
    transition: .18s;
    user-select: none;
}

.fb-tile:hover {
    background: var(--blue-faint);
    border-color: var(--blue);
    color: var(--blue);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(37,99,235,.12);
}

.fb-tile:hover .fb-tile__icon--blue,
.fb-tile:hover .fb-tile__icon--indigo,
.fb-tile:hover .fb-tile__icon--teal,
.fb-tile:hover .fb-tile__icon--slate { background: var(--blue); color: white; }

.fb-tile__icon {
    width: 26px;
    height: 26px;
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    transition: .18s;
}

.fb-tile__icon--blue   { background: #dbeafe; color: var(--blue); }
.fb-tile__icon--indigo { background: #e0e7ff; color: var(--indigo); }
.fb-tile__icon--teal   { background: #ccfbf1; color: var(--teal); }
.fb-tile__icon--slate  { background: var(--surface2); border: 1px solid var(--border); color: var(--text-3); }

/* ── CONFIG SECTION ──────────────────────────── */
.fb-config-section { margin-bottom: 16px; }
.fb-label { display: block; font-size: 12px; font-weight: 600; color: var(--text-2); margin-bottom: 6px; letter-spacing: .2px; }

.fb-input {
    width: 100%;
    border: 1px solid var(--border);
    border-radius: var(--radius-sm);
    padding: 9px 12px;
    font-size: 13px;
    font-family: var(--font-ui);
    background: var(--surface2);
    color: var(--text);
    transition: .18s;
    outline: none;
}

.fb-input:focus {
    border-color: var(--blue);
    background: var(--surface);
    box-shadow: 0 0 0 3px rgba(37,99,235,.12);
}

.fb-input::placeholder { color: var(--text-3); }

/* Toggle switch */
.fb-toggle-row { display: flex; align-items: center; gap: 10px; cursor: pointer; }
.fb-toggle-input { display: none; }

.fb-toggle-track {
    width: 36px;
    height: 20px;
    background: var(--border2);
    border-radius: 999px;
    position: relative;
    transition: .2s;
    flex-shrink: 0;
}

.fb-toggle-input:checked + .fb-toggle-track { background: var(--blue); }

.fb-toggle-thumb {
    position: absolute;
    top: 3px; left: 3px;
    width: 14px; height: 14px;
    background: white;
    border-radius: 50%;
    transition: .2s;
    box-shadow: 0 1px 3px rgba(0,0,0,.2);
}

.fb-toggle-input:checked + .fb-toggle-track .fb-toggle-thumb { transform: translateX(16px); }
.fb-toggle-label { font-size: 13px; font-weight: 500; color: var(--text-2); }

/* Options list */
.fb-options-list { display: flex; flex-direction: column; gap: 6px; margin-bottom: 8px; }

.fb-option-row {
    display: flex;
    gap: 6px;
}

.fb-option-row .fb-input { flex: 1; }

.fb-option-remove {
    width: 32px;
    height: 32px;
    border: 1px solid var(--border);
    background: var(--surface2);
    border-radius: var(--radius-sm);
    color: var(--text-3);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    transition: .18s;
    align-self: center;
}

.fb-option-remove:hover { background: #fee2e2; border-color: #fca5a5; color: #ef4444; }

.fb-add-option-btn {
    display: flex;
    align-items: center;
    gap: 6px;
    border: 1px dashed var(--border2);
    background: transparent;
    color: var(--text-2);
    border-radius: var(--radius-sm);
    padding: 7px 12px;
    font-size: 12px;
    font-weight: 500;
    cursor: pointer;
    transition: .18s;
    font-family: var(--font-ui);
    width: 100%;
}

.fb-add-option-btn:hover { border-color: var(--blue); color: var(--blue); background: var(--blue-faint); }

/* ── BUTTONS ─────────────────────────────────── */
.fb-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    border: none;
    border-radius: var(--radius-sm);
    padding: 8px 16px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: .18s;
    font-family: var(--font-ui);
    white-space: nowrap;
}

.fb-btn--primary {
    background: var(--blue);
    color: white;
}

.fb-btn--primary:hover { background: #1d4ed8; }

.fb-btn--ghost {
    background: transparent;
    color: var(--text-2);
    border: 1px solid var(--border);
}

.fb-btn--ghost:hover { background: var(--surface2); color: var(--text); }

.fb-btn--danger {
    background: #fee2e2;
    color: #dc2626;
}

.fb-btn--danger:hover { background: #dc2626; color: white; }

.w-full { width: 100%; justify-content: center; }

/* ── MODAL ───────────────────────────────────── */
.fb-modal-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(15,23,42,.6);
    backdrop-filter: blur(4px);
    z-index: 1000;
    align-items: center;
    justify-content: center;
    padding: 24px;
}

.fb-modal-overlay.open { display: flex; }

.fb-modal {
    background: var(--surface);
    border-radius: var(--radius-xl);
    width: 100%;
    max-width: 680px;
    max-height: 85vh;
    display: flex;
    flex-direction: column;
    box-shadow: var(--shadow-lg);
    overflow: hidden;
    animation: modalIn .22s ease-out;
}

@keyframes modalIn {
    from { opacity: 0; transform: scale(.96) translateY(8px); }
    to   { opacity: 1; transform: scale(1) translateY(0); }
}

.fb-modal__header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 24px 28px 20px;
    border-bottom: 1px solid var(--border);
}

.fb-modal__eyebrow {
    font-size: 11px;
    font-weight: 700;
    letter-spacing: .8px;
    text-transform: uppercase;
    color: var(--blue);
    margin-bottom: 4px;
}

.fb-modal__title {
    font-family: var(--font-display);
    font-size: 20px;
    font-weight: 700;
    color: var(--text);
}

.fb-modal__close {
    width: 32px;
    height: 32px;
    border: 1px solid var(--border);
    background: var(--surface2);
    border-radius: var(--radius-sm);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    color: var(--text-2);
    transition: .18s;
}

.fb-modal__close:hover { background: var(--text); color: var(--surface); }

.fb-modal__body {
    flex: 1;
    overflow-y: auto;
    padding: 20px 28px 28px;
}

.fb-code-toolbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    background: #1e293b;
    border-radius: var(--radius-sm) var(--radius-sm) 0 0;
    padding: 8px 16px;
}

.fb-code-lang {
    font-family: var(--font-mono);
    font-size: 11px;
    font-weight: 600;
    color: #64748b;
    text-transform: uppercase;
    letter-spacing: .6px;
}

.fb-copy-btn {
    display: flex;
    align-items: center;
    gap: 5px;
    border: 1px solid #334155;
    background: transparent;
    color: #94a3b8;
    border-radius: 5px;
    padding: 4px 10px;
    font-size: 11px;
    font-weight: 500;
    cursor: pointer;
    transition: .18s;
    font-family: var(--font-ui);
}

.fb-copy-btn:hover { background: #334155; color: #e2e8f0; }
.fb-copy-btn--copied { color: #34d399 !important; border-color: #34d399 !important; }

.fb-code-block {
    margin: 0;
    background: #0f172a;
    border-radius: 0 0 var(--radius-sm) var(--radius-sm);
    padding: 20px;
    font-family: var(--font-mono);
    font-size: 12.5px;
    line-height: 1.7;
    overflow-x: auto;
    color: #94a3b8;
    white-space: pre;
}

/* Syntax highlight tokens */
.json-key     { color: #7dd3fc; }
.json-string  { color: #86efac; }
.json-number  { color: #fdba74; }
.json-bool    { color: #c084fc; }
.json-null    { color: #f87171; }
.json-bracket { color: #94a3b8; }

/* Utility */
.d-none { display: none !important; }
</style>

{{-- ═══════════════════════════════════════════════
     JAVASCRIPT
═══════════════════════════════════════════════ --}}
<script>
/* ── STATE ───────────────────────────────────── */
let draggedFieldType = null;
let formFields = JSON.parse(localStorage.getItem('formFields_v2')) || [];
let selectedFieldId = null;

const FIELD_CATEGORY = {
    text: 'input', textarea: 'input', number: 'input',
    email: 'input', phone: 'input', date: 'input', file: 'input',
    dropdown: 'choice', radio: 'choice', checkbox: 'choice',
    state: 'location', city: 'location', statecity: 'location',
    title: 'layout', description: 'layout', newline: 'layout',
    pagebreak: 'layout', hidden: 'layout'
};

const FIELD_LABELS = {
    text: 'Text Input', textarea: 'Text Area', number: 'Number Input',
    email: 'Email Input', phone: 'Phone Input', dropdown: 'Dropdown',
    radio: 'Radio Buttons', checkbox: 'Checkboxes', date: 'Date Picker',
    file: 'File Upload', title: 'Title', description: 'Description',
    newline: 'New Line', pagebreak: 'Page Break', hidden: 'Hidden Field',
    state: 'State', city: 'City', statecity: 'State & City'
};

/* ── PERSISTENCE ─────────────────────────────── */
function save() {
    localStorage.setItem('formFields_v2', JSON.stringify(formFields));
}

/* ── FIELD COUNT LABEL ───────────────────────── */
function updateFieldCount() {
    const n = formFields.filter(f => !['newline','pagebreak'].includes(f.type)).length;
    document.getElementById('fieldCountLabel').textContent = `${n} field${n !== 1 ? 's' : ''}`;
}

/* ── TITLE CHARACTER COUNT ───────────────────── */
document.getElementById('formTitle').addEventListener('input', function () {
    const n = this.value.length;
    const el = document.getElementById('titleCount');
    el.textContent = n;
    el.style.color = n > 180 ? '#ef4444' : n > 120 ? '#f59e0b' : 'var(--text-3)';
});

/* ── DRAG & DROP ─────────────────────────────── */
document.querySelectorAll('.fb-tile').forEach(tile => {
    tile.addEventListener('dragstart', () => { draggedFieldType = tile.dataset.type; });
    tile.addEventListener('click', () => { addField(tile.dataset.type); });
});

const dropCanvas = document.getElementById('dropCanvas');

dropCanvas.addEventListener('dragover', e => {
    e.preventDefault();
    dropCanvas.classList.add('drag-over');
});

dropCanvas.addEventListener('dragleave', () => dropCanvas.classList.remove('drag-over'));

dropCanvas.addEventListener('drop', e => {
    e.preventDefault();
    dropCanvas.classList.remove('drag-over');
    if (!draggedFieldType) return;
    addField(draggedFieldType);
    draggedFieldType = null;
});

function addField(type) {
    const field = {
        id: Date.now(),
        type,
        label: FIELD_LABELS[type],
        placeholder: '',
        cssClass: '',
        required: false,
        options: ['Option A', 'Option B', 'Option C'],
        min: '', max: '', defaultValue: '',
        _new: true
    };
    formFields.push(field);
    renderFields();
    // Auto-open config for interactive fields
    if (!['newline','pagebreak','title','description'].includes(type)) {
        setTimeout(() => editField(field.id), 80);
    }
}

/* ── RENDER FIELDS ───────────────────────────── */
function renderFields() {
    save();
    updateFieldCount();

    if (formFields.length === 0) {
        dropCanvas.innerHTML = `
            <div class="fb-empty">
                <div class="fb-empty__icon">
                    <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                        <rect x="6" y="10" width="36" height="5" rx="2.5" fill="#2563eb" opacity=".15"/>
                        <rect x="6" y="20" width="28" height="4" rx="2" fill="#2563eb" opacity=".1"/>
                        <rect x="6" y="29" width="22" height="4" rx="2" fill="#2563eb" opacity=".07"/>
                        <rect x="6" y="38" width="16" height="4" rx="2" fill="#2563eb" opacity=".05"/>
                        <circle cx="38" cy="34" r="10" fill="#2563eb" opacity=".12"/>
                        <path d="M34 34h8M38 30v8" stroke="#2563eb" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </div>
                <h3 class="fb-empty__title">Start building your form</h3>
                <p class="fb-empty__sub">Drag a field from the panel on the right, or click any field tile to add it instantly.</p>
                <div class="fb-empty__hint">
                    <kbd>Drag</kbd> to add &nbsp;·&nbsp; <kbd>↑↓</kbd> to reorder &nbsp;·&nbsp; <kbd>✏</kbd> to configure
                </div>
            </div>`;
        return;
    }

    dropCanvas.innerHTML = '';

    formFields.forEach(field => {
        const cat = FIELD_CATEGORY[field.type] || 'input';
        const card = document.createElement('div');
        card.className = `fb-field-card fb-field-card--${cat}${field._new ? ' fb-field-card--new' : ''}`;
        card.dataset.id = field.id;
        delete field._new;

        card.innerHTML = `
            <div class="fb-card-header">
                <div class="fb-card-meta">
                    <div class="fb-card-type">${field.type.toUpperCase()}</div>
                    <div class="fb-card-label">
                        ${field.label}
                        ${field.required ? '<span class="fb-required-dot"></span>' : ''}
                    </div>
                    <div class="fb-card-sub">${field.placeholder || 'No placeholder set'}</div>
                </div>
                <div class="fb-card-actions">
                    <button type="button" class="fb-action-btn" onclick="moveUp(${field.id})" title="Move up">
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none"><path d="M2 8l4-4 4 4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </button>
                    <button type="button" class="fb-action-btn" onclick="moveDown(${field.id})" title="Move down">
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none"><path d="M2 4l4 4 4-4" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </button>
                    <button type="button" class="fb-action-btn" onclick="editField(${field.id})" title="Configure">
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none"><path d="M8.5 1.5l2 2L3 11H1V9L8.5 1.5z" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </button>
                    <button type="button" class="fb-action-btn" onclick="duplicateField(${field.id})" title="Duplicate">
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none"><rect x="3.5" y="3.5" width="6" height="6" rx="1.5" stroke="currentColor" stroke-width="1.4"/><path d="M2.5 8V2.5H8" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/></svg>
                    </button>
                    <button type="button" class="fb-action-btn fb-action-btn--delete" onclick="deleteField(${field.id})" title="Delete">
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none"><path d="M1.5 3.5h9l-.75 6.5H3.25L2.5 3.5zM4.5 3.5V2h3v1.5M.5 3.5h11" stroke="currentColor" stroke-width="1.3" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    </button>
                </div>
            </div>
            <div class="fb-card-preview">${getFieldPreview(field)}</div>`;

        dropCanvas.appendChild(card);
    });
}

/* ── FIELD PREVIEW ───────────────────────────── */
function getFieldPreview(field) {
    const p = field.placeholder || 'Enter value…';

    if (field.type === 'textarea')
        return `<textarea class="fb-preview-textarea" placeholder="${p}" disabled></textarea>`;

    if (field.type === 'dropdown')
        return `<select class="fb-preview-select" disabled>${field.options.map(o => `<option>${o}</option>`).join('')}</select>`;

    if (field.type === 'radio')
        return `<div class="fb-preview-choices">${field.options.map(o => `<label class="fb-preview-choice"><input type="radio" disabled> ${o}</label>`).join('')}</div>`;

    if (field.type === 'checkbox')
        return `<div class="fb-preview-choices">${field.options.map(o => `<label class="fb-preview-choice"><input type="checkbox" disabled> ${o}</label>`).join('')}</div>`;

    if (field.type === 'date')
        return `<input type="date" class="fb-preview-input" disabled>`;

    if (field.type === 'file')
        return `<input type="file" class="fb-preview-input" disabled>`;

    if (field.type === 'title')
        return `<div class="fb-preview-title">${field.defaultValue || field.label}</div>`;

    if (field.type === 'description')
        return `<div class="fb-preview-description">${field.defaultValue || 'Description text goes here…'}</div>`;

    if (field.type === 'newline')
        return `<div class="fb-preview-newline"></div>`;

    if (field.type === 'pagebreak')
        return `<hr class="fb-preview-hr">`;

    if (field.type === 'hidden')
        return `<div class="fb-preview-hidden"><svg width="12" height="12" viewBox="0 0 14 14" fill="none"><path d="M1 7s2.5-4 6-4 6 4 6 4-2.5 4-6 4-6-4-6-4z" stroke="currentColor" stroke-width="1.3"/><line x1="2" y1="2" x2="12" y2="12" stroke="currentColor" stroke-width="1.3" stroke-linecap="round"/></svg>Hidden · value: ${field.defaultValue || '(empty)'}</div>`;

    if (field.type === 'state')
        return `<select class="fb-preview-select" disabled><option>Select State…</option><option>Gujarat</option><option>Maharashtra</option><option>Punjab</option></select>`;

    if (field.type === 'city')
        return `<select class="fb-preview-select" disabled><option>Select City…</option><option>Ahmedabad</option><option>Rajkot</option><option>Ludhiana</option></select>`;

    if (field.type === 'statecity')
        return `<div style="display:grid;grid-template-columns:1fr 1fr;gap:8px">
            <select class="fb-preview-select" disabled><option>State</option></select>
            <select class="fb-preview-select" disabled><option>City</option></select>
        </div>`;

    return `<input type="text" class="fb-preview-input" placeholder="${p}" disabled>`;
}

/* ── OPTIONS LIST ────────────────────────────── */
function renderOptionsList(field) {
    const list = document.getElementById('optionsList');
    list.innerHTML = '';
    field.options.forEach((opt, i) => {
        const row = document.createElement('div');
        row.className = 'fb-option-row';
        row.innerHTML = `
            <input type="text" class="fb-input" value="${opt}" oninput="updateOption(${i}, this.value)" placeholder="Option ${i+1}">
            <button type="button" class="fb-option-remove" onclick="removeOption(${i})">
                <svg width="10" height="10" viewBox="0 0 10 10" fill="none"><path d="M2 2l6 6M8 2L2 8" stroke="currentColor" stroke-width="1.6" stroke-linecap="round"/></svg>
            </button>`;
        list.appendChild(row);
    });
}

function updateOption(index, value) {
    const f = formFields.find(f => f.id === selectedFieldId);
    if (f) { f.options[index] = value; renderFields(); }
}

function addOption() {
    const f = formFields.find(f => f.id === selectedFieldId);
    if (!f) return;
    f.options.push(`Option ${f.options.length + 1}`);
    renderOptionsList(f);
    renderFields();
}

function removeOption(index) {
    const f = formFields.find(f => f.id === selectedFieldId);
    if (!f) return;
    f.options.splice(index, 1);
    renderOptionsList(f);
    renderFields();
}

/* ── EDIT / CONFIG ───────────────────────────── */
function editField(id) {
    selectedFieldId = id;
    const field = formFields.find(f => f.id === id);
    if (!field) return;

    const isOption = ['dropdown','radio','checkbox'].includes(field.type);
    const isText   = ['text','textarea','number','email','phone'].includes(field.type);

    showConfigPanel();

    document.getElementById('optionLabel').value       = field.label;
    document.getElementById('optionPlaceholder').value = field.placeholder || '';
    document.getElementById('optionClass').value       = field.cssClass || '';
    document.getElementById('optionRequired').checked  = field.required || false;
    document.getElementById('optionMin').value         = field.min || '';
    document.getElementById('optionMax').value         = field.max || '';
    document.getElementById('optionDefault').value     = field.defaultValue || '';

    document.getElementById('textConfigWrapper').style.display = isText ? '' : 'none';
    document.getElementById('optionsWrapper').classList.toggle('d-none', !isOption);

    if (isOption) renderOptionsList(field);
}

function updateSelectedField() {
    const field = formFields.find(f => f.id === selectedFieldId);
    if (!field) return;
    field.label        = document.getElementById('optionLabel').value;
    field.placeholder  = document.getElementById('optionPlaceholder').value;
    field.cssClass     = document.getElementById('optionClass').value;
    field.required     = document.getElementById('optionRequired').checked;
    field.min          = document.getElementById('optionMin').value;
    field.max          = document.getElementById('optionMax').value;
    field.defaultValue = document.getElementById('optionDefault').value;
    renderFields();
}

['optionLabel','optionPlaceholder','optionClass','optionMin','optionMax','optionDefault']
    .forEach(id => document.getElementById(id).addEventListener('input', updateSelectedField));
document.getElementById('optionRequired').addEventListener('change', updateSelectedField);

/* ── PANEL SWITCHING ─────────────────────────── */
document.getElementById('addFieldsTab').addEventListener('click', showAddPanel);
document.getElementById('fieldOptionsTab').addEventListener('click', () => {
    if (selectedFieldId) showConfigPanel();
});

function showAddPanel() {
    document.getElementById('addFieldsPanel').classList.remove('d-none');
    document.getElementById('fieldOptionsPanel').classList.add('d-none');
    document.getElementById('addFieldsTab').classList.add('fb-tab--active');
    document.getElementById('fieldOptionsTab').classList.remove('fb-tab--active');
}

function showConfigPanel() {
    document.getElementById('addFieldsPanel').classList.add('d-none');
    document.getElementById('fieldOptionsPanel').classList.remove('d-none');
    document.getElementById('addFieldsTab').classList.remove('fb-tab--active');
    document.getElementById('fieldOptionsTab').classList.add('fb-tab--active');
}

/* ── FIELD OPERATIONS ────────────────────────── */
function duplicateField(id) {
    const idx = formFields.findIndex(f => f.id === id);
    if (idx === -1) return;
    formFields.splice(idx + 1, 0, { ...formFields[idx], id: Date.now(), _new: true });
    renderFields();
}

function deleteField(id) {
    formFields = formFields.filter(f => f.id !== id);
    if (selectedFieldId === id) { selectedFieldId = null; showAddPanel(); }
    renderFields();
}

function moveUp(id) {
    const i = formFields.findIndex(f => f.id === id);
    if (i <= 0) return;
    [formFields[i], formFields[i-1]] = [formFields[i-1], formFields[i]];
    renderFields();
}

function moveDown(id) {
    const i = formFields.findIndex(f => f.id === id);
    if (i === -1 || i === formFields.length - 1) return;
    [formFields[i], formFields[i+1]] = [formFields[i+1], formFields[i]];
    renderFields();
}

/* ── DARK MODE ───────────────────────────────── */
const root    = document.getElementById('formBuilderRoot');
const sunIcon = document.getElementById('sunIcon');
const moonIcon = document.getElementById('moonIcon');

let dark = localStorage.getItem('fb_dark') === '1';
if (dark) applyDark();

document.getElementById('darkToggleBtn').addEventListener('click', () => {
    dark = !dark;
    localStorage.setItem('fb_dark', dark ? '1' : '0');
    applyDark();
});

function applyDark() {
    root.classList.toggle('dark', dark);
    sunIcon.style.display  = dark ? 'none' : '';
    moonIcon.style.display = dark ? '' : 'none';
}

/* ── JSON MODAL ──────────────────────────────── */
document.getElementById('nextBtn').addEventListener('click', () => {
    const schema = {
        title: document.getElementById('formTitle').value || 'Untitled Form',
        created_at: new Date().toISOString(),
        fields: formFields.map(({ _new, ...f }) => f)
    };
    document.getElementById('jsonOutput').innerHTML = syntaxHighlight(JSON.stringify(schema, null, 2));
    document.getElementById('jsonModalOverlay').classList.add('open');
});

document.getElementById('closeModal').addEventListener('click', () => {
    document.getElementById('jsonModalOverlay').classList.remove('open');
});

document.getElementById('jsonModalOverlay').addEventListener('click', e => {
    if (e.target === document.getElementById('jsonModalOverlay'))
        document.getElementById('jsonModalOverlay').classList.remove('open');
});

document.getElementById('copyJsonBtn').addEventListener('click', function () {
    const schema = {
        title: document.getElementById('formTitle').value || 'Untitled Form',
        fields: formFields
    };
    navigator.clipboard.writeText(JSON.stringify(schema, null, 2));
    this.textContent = '✓ Copied!';
    this.classList.add('fb-copy-btn--copied');
    setTimeout(() => {
        this.innerHTML = `<svg width="13" height="13" viewBox="0 0 14 14" fill="none"><rect x="4" y="4" width="8" height="8" rx="2" stroke="currentColor" stroke-width="1.4"/><path d="M4 4V3a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1h-1" stroke="currentColor" stroke-width="1.3"/></svg> Copy`;
        this.classList.remove('fb-copy-btn--copied');
    }, 2000);
});

/* ── SYNTAX HIGHLIGHT ────────────────────────── */
function syntaxHighlight(json) {
    return json
        .replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;')
        .replace(/("(\\u[a-zA-Z0-9]{4}|\\[^u]|[^\\"])*"(\s*:)?|\b(true|false|null)\b|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?)/g, match => {
            if (/^"/.test(match)) {
                return /:$/.test(match)
                    ? `<span class="json-key">${match}</span>`
                    : `<span class="json-string">${match}</span>`;
            }
            if (/true|false/.test(match)) return `<span class="json-bool">${match}</span>`;
            if (/null/.test(match))       return `<span class="json-null">${match}</span>`;
            return `<span class="json-number">${match}</span>`;
        });
}

/* ── PREVIEW BUTTON ──────────────────────────── */
document.getElementById('previewBtn').addEventListener('click', () => {
    alert('Preview mode — connect this to your form renderer!');
});

/* ── INIT ────────────────────────────────────── */
renderFields();
</script>

@endsection