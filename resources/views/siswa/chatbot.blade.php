@extends('layouts.siswa')

@section('title', 'AI Chatbot')

@section('content')

<style>

/* =============================================
   BASE
============================================= */

.cb-page {
    display: flex;
    height: calc(100vh - 94px);
    margin: -22px;
    overflow: hidden;
    background: #f4f6f8;
    font-family: 'Inter', sans-serif;
}

/* =============================================
   SIDEBAR
============================================= */

.cb-sidebar {
    width: 260px;
    flex-shrink: 0;
    background: #fff;
    border-right: 1px solid #edf1f5;
    display: flex;
    flex-direction: column;
    padding: 22px 16px;
    overflow-y: auto;
    transition: width .3s ease, padding .3s ease, opacity .3s ease;
}

.cb-sidebar::-webkit-scrollbar { width: 4px; }
.cb-sidebar::-webkit-scrollbar-thumb { background: #e5e7eb; border-radius: 99px; }

.sidebar-brand {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 16px;
}

.brand-icon {
    width: 44px;
    height: 44px;
    border-radius: 14px;
    background: linear-gradient(135deg, #14532d, #16a34a);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    flex-shrink: 0;
    box-shadow: 0 4px 12px rgba(22,163,74,.25);
}

.brand-name {
    font-size: 15px;
    font-weight: 700;
    color: #111827;
    margin: 0;
}

.brand-sub {
    font-size: 11px;
    color: #9ca3af;
    margin: 0;
}

.sidebar-status {
    display: flex;
    align-items: center;
    gap: 7px;
    font-size: 12px;
    color: #6b7280;
    margin-bottom: 16px;
}

.s-dot {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: #22c55e;
    flex-shrink: 0;
    animation: sDotPulse 2s infinite;
}

@keyframes sDotPulse {
    0%,100% { opacity: 1; }
    50%      { opacity: .4; }
}

.sidebar-divider {
    height: 1px;
    background: #f3f4f6;
    margin: 12px 0;
}

.sidebar-label {
    font-size: 11px;
    font-weight: 600;
    color: #9ca3af;
    text-transform: uppercase;
    letter-spacing: .06em;
    margin: 0 0 10px 4px;
}

.topic-list {
    display: flex;
    flex-direction: column;
    gap: 4px;
}

.topic-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 12px;
    border-radius: 12px;
    border: none;
    background: transparent;
    text-align: left;
    font-size: 13px;
    color: #374151;
    cursor: pointer;
    transition: .2s;
    width: 100%;
}

.topic-item:hover {
    background: #f0fdf4;
    color: #16a34a;
}

.topic-item:hover .bi-chevron-right { transform: translateX(3px); }
.topic-icon { font-size: 16px; flex-shrink: 0; }
.topic-item span:nth-child(2) { flex: 1; }
.topic-item .bi-chevron-right {
    font-size: 11px;
    color: #d1d5db;
    transition: .2s;
}

.sidebar-info {
    display: flex;
    flex-direction: column;
    gap: 8px;
    margin-top: 4px;
}

.info-row {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 12px;
    color: #6b7280;
}

.info-row i {
    font-size: 13px;
    color: #16a34a;
    width: 16px;
}

/* Sidebar tersembunyi (desktop collapse) */
.cb-sidebar.hidden {
    width: 0;
    padding: 0;
    overflow: hidden;
    border: none;
    opacity: 0;
}

/* =============================================
   SIDEBAR OVERLAY (mobile/tablet)
============================================= */

.cb-sidebar-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,.4);
    z-index: 500;
}

.cb-sidebar-overlay.show { display: block; }

/* Sidebar mobile — slide dari kiri */
@media(max-width:1024px){
    .cb-sidebar {
        position: fixed;
        top: 70px;
        left: -280px;
        bottom: 0;
        width: 260px;
        z-index: 600;
        box-shadow: 4px 0 24px rgba(0,0,0,.12);
        transition: left .3s ease;
    }

    .cb-sidebar.mobile-show {
        left: 0;
    }

    /* Nonaktifkan toggle hidden di mobile */
    .cb-sidebar.hidden {
        width: 260px;
        padding: 22px 16px;
        opacity: 1;
        overflow-y: auto;
        border-right: 1px solid #edf1f5;
    }
}

/* =============================================
   MAIN
============================================= */

.cb-main {
    flex: 1;
    display: flex;
    flex-direction: column;
    overflow: hidden;
    min-width: 0;
}

/* TOPBAR */
.cb-topbar {
    flex-shrink: 0;
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 20px;
    background: #fff;
    border-bottom: 1px solid #edf1f5;
    box-shadow: 0 1px 4px rgba(15,23,42,.04);
}

.sidebar-toggle, .clear-btn {
    width: 38px;
    height: 38px;
    border-radius: 11px;
    border: 1px solid #e5e7eb;
    background: #f9fafb;
    color: #6b7280;
    font-size: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: .2s;
    flex-shrink: 0;
}

.sidebar-toggle:hover, .clear-btn:hover {
    background: #f3f4f6;
    color: #374151;
}

.topbar-center {
    flex: 1;
    display: flex;
    align-items: center;
    gap: 10px;
    min-width: 0;
}

.topbar-avatar {
    position: relative;
    width: 38px;
    height: 38px;
    border-radius: 12px;
    background: linear-gradient(135deg, #14532d, #22c55e);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 17px;
    flex-shrink: 0;
}

.topbar-pulse {
    position: absolute;
    top: -2px; right: -2px;
    width: 10px; height: 10px;
    border-radius: 50%;
    background: #22c55e;
    border: 2px solid white;
    animation: sDotPulse 2s infinite;
}

.topbar-name {
    font-size: 14px;
    font-weight: 700;
    color: #111827;
    margin: 0 0 2px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.topbar-status {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 11px;
    color: #9ca3af;
    margin: 0;
}

.t-dot {
    width: 6px; height: 6px;
    border-radius: 50%;
    background: #22c55e;
    flex-shrink: 0;
}

/* =============================================
   CHAT AREA — bisa scroll
============================================= */

.cb-chat {
    flex: 1;
    overflow-y: auto;   /* ← kunci scroll */
    overflow-x: hidden;
    padding: 24px 28px 16px;
    display: flex;
    flex-direction: column;
    gap: 6px;
    scroll-behavior: smooth;
    background: #f4f6f8;
}

.cb-chat::-webkit-scrollbar { width: 5px; }
.cb-chat::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 99px; }

/* =============================================
   WELCOME
============================================= */

.welcome-card {
    background: #fff;
    border: 1px solid #edf1f5;
    border-radius: 22px;
    padding: 32px 28px;
    text-align: center;
    margin: auto;
    max-width: 460px;
    width: 100%;
    box-shadow: 0 4px 20px rgba(15,23,42,.05);
}

.welcome-icon {
    width: 64px;
    height: 64px;
    border-radius: 20px;
    background: linear-gradient(135deg, #14532d, #16a34a);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 28px;
    margin: 0 auto 16px;
    box-shadow: 0 8px 24px rgba(22,163,74,.25);
}

.welcome-title {
    font-size: 18px;
    font-weight: 700;
    color: #111827;
    margin: 0 0 10px;
}

.welcome-desc {
    font-size: 13px;
    color: #6b7280;
    line-height: 1.7;
    margin: 0 0 20px;
}

.welcome-chips {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    justify-content: center;
}

.w-chip {
    background: #f0fdf4;
    border: 1px solid #bbf7d0;
    color: #15803d;
    padding: 8px 14px;
    border-radius: 30px;
    font-size: 12px;
    font-weight: 500;
    cursor: pointer;
    transition: .2s;
}

.w-chip:hover {
    background: #16a34a;
    color: white;
    border-color: #16a34a;
    transform: translateY(-1px);
}

/* =============================================
   CHAT ROW
============================================= */

.chat-row {
    display: flex;
    gap: 10px;
    align-items: flex-end;
    animation: rowIn .2s ease both;
    margin-bottom: 14px;
}

.chat-row.user { flex-direction: row-reverse; }

@keyframes rowIn {
    from { opacity: 0; transform: translateY(8px); }
    to   { opacity: 1; transform: translateY(0); }
}

.row-avatar {
    width: 30px;
    height: 30px;
    border-radius: 9px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 13px;
    flex-shrink: 0;
}

.row-avatar.bot {
    background: linear-gradient(135deg, #14532d, #16a34a);
    color: white;
}

.row-avatar.user {
    background: #f3f4f6;
    color: #6b7280;
}

.row-content {
    display: flex;
    flex-direction: column;
    gap: 3px;
    max-width: 72%;
}

.chat-row.user .row-content { align-items: flex-end; }

.bubble {
    padding: 12px 16px;
    border-radius: 18px;
    font-size: 13.5px;
    line-height: 1.75;
    word-break: break-word;
}

.bubble.bot {
    background: #fff;
    border: 1px solid #edf1f5;
    color: #1f2937;
    border-bottom-left-radius: 6px;
    box-shadow: 0 2px 8px rgba(15,23,42,.05);
}

.bubble.user {
    background: linear-gradient(135deg, #14532d, #16a34a);
    color: white;
    border-bottom-right-radius: 6px;
    box-shadow: 0 4px 14px rgba(22,163,74,.2);
}

.msg-time {
    font-size: 10.5px;
    color: #9ca3af;
    padding: 0 2px;
}

/* =============================================
   TYPING
============================================= */

.typing-dots {
    display: flex;
    gap: 5px;
    padding: 2px 0;
    align-items: center;
}

.typing-dots span {
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: #d1d5db;
    animation: tBounce 1.2s infinite;
}

.typing-dots span:nth-child(2) { animation-delay: .18s; }
.typing-dots span:nth-child(3) { animation-delay: .36s; }

@keyframes tBounce {
    0%,80%,100% { transform: translateY(0); background: #d1d5db; }
    40%          { transform: translateY(-5px); background: #16a34a; }
}

/* =============================================
   INPUT
============================================= */

.cb-input-wrap {
    flex-shrink: 0;
    padding: 14px 20px 10px;
    background: #fff;
    border-top: 1px solid #edf1f5;
}

.cb-input-box {
    display: flex;
    align-items: flex-end;
    gap: 10px;
    background: #f9fafb;
    border: 1.5px solid #e5e7eb;
    border-radius: 18px;
    padding: 10px 10px 10px 18px;
    transition: .2s;
}

.cb-input-box:focus-within {
    border-color: #16a34a;
    background: white;
    box-shadow: 0 0 0 3px rgba(22,163,74,.08);
}

.cb-textarea {
    flex: 1;
    border: none;
    background: transparent;
    outline: none;
    font-size: 14px;
    color: #1f2937;
    resize: none;
    max-height: 120px;
    line-height: 1.6;
    font-family: inherit;
    padding: 2px 0;
    overflow-y: auto;
}

.cb-textarea::placeholder { color: #9ca3af; }

.cb-send {
    width: 38px;
    height: 38px;
    border-radius: 12px;
    border: none;
    background: linear-gradient(135deg, #14532d, #16a34a);
    color: white;
    font-size: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: .2s;
    flex-shrink: 0;
    box-shadow: 0 3px 10px rgba(22,163,74,.3);
}

.cb-send:hover { transform: scale(1.07); box-shadow: 0 6px 16px rgba(22,163,74,.35); }
.cb-send:disabled { opacity: .45; transform: none; cursor: not-allowed; }

.cb-hint {
    font-size: 11px;
    color: #9ca3af;
    text-align: center;
    margin: 8px 0 0;
}

/* =============================================
   RESPONSIVE — TABLET (769px – 1024px)
============================================= */

@media(min-width:769px) and (max-width:1024px){

    .cb-page { margin: -16px; height: calc(100vh - 86px); }

    /* Sidebar tersembunyi di tablet, buka via toggle */
    .cb-chat { padding: 18px 20px 12px; }
    .row-content { max-width: 80%; }
    .bubble { font-size: 13px; }
    .welcome-card { padding: 26px 20px; max-width: 400px; }
    .welcome-title { font-size: 16px; }
    .cb-topbar { padding: 10px 16px; }

}

/* =============================================
   RESPONSIVE — MOBILE (≤ 768px)
============================================= */

@media(max-width:768px){

    .cb-page {
        margin: -14px;
        height: calc(100vh - 84px);
        flex-direction: column;
    }

    /* Topbar lebih compact */
    .cb-topbar { padding: 10px 14px; gap: 8px; }
    .topbar-name { font-size: 13px; }
    .topbar-status { font-size: 10px; }
    .topbar-avatar { width: 34px; height: 34px; font-size: 15px; border-radius: 10px; }
    .topbar-pulse { width: 8px; height: 8px; }

    /* Chat area */
    .cb-chat { padding: 14px 12px 10px; }
    .row-content { max-width: 86%; }
    .bubble { font-size: 13px; padding: 10px 13px; }

    /* Welcome */
    .welcome-card { padding: 22px 16px; border-radius: 16px; }
    .welcome-icon { width: 52px; height: 52px; font-size: 22px; }
    .welcome-title { font-size: 15px; }
    .welcome-desc { font-size: 12px; }
    .w-chip { font-size: 11px; padding: 7px 12px; }

    /* Input */
    .cb-input-wrap { padding: 10px 12px 8px; }
    .cb-input-box { padding: 8px 8px 8px 14px; border-radius: 14px; }
    .cb-textarea { font-size: 13px; }
    .cb-send { width: 34px; height: 34px; font-size: 14px; border-radius: 10px; }
    .cb-hint { display: none; }

}

/* =============================================
   RESPONSIVE — SMALL MOBILE (≤ 400px)
============================================= */

@media(max-width:400px){

    .cb-page { margin: -10px; height: calc(100vh - 80px); }
    .cb-chat { padding: 10px 10px 8px; }
    .row-content { max-width: 90%; }
    .bubble { font-size: 12.5px; padding: 9px 12px; }
    .topbar-name { font-size: 12px; }

}

</style>

<!-- OVERLAY untuk sidebar mobile/tablet -->
<div class="cb-sidebar-overlay" id="cbOverlay" onclick="closeSidebarMobile()"></div>

<div class="cb-page">

    {{-- SIDEBAR --}}
    <aside class="cb-sidebar" id="cbSidebar">

        <div class="sidebar-brand">
            <div class="brand-icon"><i class="bi bi-robot"></i></div>
            <div>
                <p class="brand-name">SIPENSA</p>
                <p class="brand-sub">AI Assistant</p>
            </div>
        </div>

        <div class="sidebar-status">
            <span class="s-dot"></span>
            <span>Online & siap membantu</span>
        </div>

        <div class="sidebar-divider"></div>

        <p class="sidebar-label">Topik populer</p>

        <div class="topic-list">
            <button class="topic-item" onclick="quickAsk('Bagaimana cara membuat laporan pengaduan?')">
                <span class="topic-icon">📝</span>
                <span>Cara membuat laporan</span>
                <i class="bi bi-chevron-right"></i>
            </button>
            <button class="topic-item" onclick="quickAsk('Bagaimana cara cek status laporan saya?')">
                <span class="topic-icon">🔍</span>
                <span>Cek status laporan</span>
                <i class="bi bi-chevron-right"></i>
            </button>
            <button class="topic-item" onclick="quickAsk('Saya mengalami bullying, apa yang harus saya lakukan?')">
                <span class="topic-icon">🛡️</span>
                <span>Mengalami bullying</span>
                <i class="bi bi-chevron-right"></i>
            </button>
            <button class="topic-item" onclick="quickAsk('Bagaimana cara konseling dengan Guru BK?')">
                <span class="topic-icon">💬</span>
                <span>Konseling BK</span>
                <i class="bi bi-chevron-right"></i>
            </button>
            <button class="topic-item" onclick="quickAsk('Saya lupa password, bagaimana cara reset?')">
                <span class="topic-icon">🔑</span>
                <span>Lupa password</span>
                <i class="bi bi-chevron-right"></i>
            </button>
        </div>

        <div class="sidebar-divider"></div>

        <div class="sidebar-info">
            <div class="info-row"><i class="bi bi-stars"></i><span>Groq LLaMA 3.3 70B</span></div>
            <div class="info-row"><i class="bi bi-shield-lock"></i><span>Percakapan aman & privat</span></div>
            <div class="info-row"><i class="bi bi-lightning-charge"></i><span>Respons cepat & akurat</span></div>
        </div>

    </aside>

    {{-- MAIN CHAT --}}
    <div class="cb-main">

        {{-- TOPBAR --}}
        <div class="cb-topbar">
            <button class="sidebar-toggle" id="sidebarToggle" onclick="toggleSidebar()" title="Buka/tutup menu">
                <i class="bi bi-layout-sidebar-reverse"></i>
            </button>
            <div class="topbar-center">
                <div class="topbar-avatar">
                    <i class="bi bi-robot"></i>
                    <span class="topbar-pulse"></span>
                </div>
                <div style="min-width:0">
                    <p class="topbar-name">AI Assistant SIPENSA</p>
                    <p class="topbar-status">
                        <span class="t-dot"></span>
                        Online · Powered by Groq AI
                    </p>
                </div>
            </div>
            <button class="clear-btn" onclick="clearChat()" title="Hapus percakapan">
                <i class="bi bi-arrow-counterclockwise"></i>
            </button>
        </div>

        {{-- CHAT AREA --}}
        <div class="cb-chat" id="chatBox">
            <div class="welcome-card" id="welcomeCard">
                <div class="welcome-icon"><i class="bi bi-robot"></i></div>
                <h4 class="welcome-title">Halo! Saya AI Assistant SIPENSA 👋</h4>
                <p class="welcome-desc">
                    Tanyakan apa saja seputar sistem pengaduan sekolah, bullying, konseling BK, atau informasi lainnya.
                </p>
                <div class="welcome-chips">
                    <button class="w-chip" onclick="quickAsk('Apa itu SIPENSA dan bagaimana cara menggunakannya?')">Apa itu SIPENSA?</button>
                    <button class="w-chip" onclick="quickAsk('Bagaimana cara membuat laporan pengaduan?')">Cara buat laporan</button>
                    <button class="w-chip" onclick="quickAsk('Berapa lama laporan saya akan diproses?')">Lama proses laporan</button>
                </div>
            </div>
        </div>

        {{-- INPUT --}}
        <div class="cb-input-wrap">
            <div class="cb-input-box">
                <textarea
                    id="userInput"
                    class="cb-textarea"
                    placeholder="Tanyakan sesuatu kepada AI..."
                    rows="1"
                ></textarea>
                <button class="cb-send" id="sendBtn" onclick="kirim()">
                    <i class="bi bi-arrow-up"></i>
                </button>
            </div>
            <p class="cb-hint">Enter untuk kirim &nbsp;·&nbsp; Shift+Enter untuk baris baru</p>
        </div>

    </div>

</div>

<script>

const CSRF    = document.querySelector('meta[name="csrf-token"]')?.content || '';
let chatHistory   = [];
let desktopSidebarVisible = true;
let isMobileOrTablet = () => window.innerWidth <= 1024;

/* =============================================
   SIDEBAR TOGGLE
============================================= */

function toggleSidebar(){
    if(isMobileOrTablet()){
        openSidebarMobile();
    } else {
        toggleSidebarDesktop();
    }
}

function toggleSidebarDesktop(){
    const sb = document.getElementById('cbSidebar');
    desktopSidebarVisible = !desktopSidebarVisible;
    sb.classList.toggle('hidden', !desktopSidebarVisible);
}

function openSidebarMobile(){
    document.getElementById('cbSidebar').classList.add('mobile-show');
    document.getElementById('cbOverlay').classList.add('show');
}

function closeSidebarMobile(){
    document.getElementById('cbSidebar').classList.remove('mobile-show');
    document.getElementById('cbOverlay').classList.remove('show');
}

/* Tutup sidebar mobile saat klik topic */
document.querySelectorAll('.topic-item').forEach(btn => {
    btn.addEventListener('click', () => {
        if(isMobileOrTablet()) closeSidebarMobile();
    });
});

/* Reset saat resize */
window.addEventListener('resize', () => {
    if(!isMobileOrTablet()){
        closeSidebarMobile();
    }
});

/* =============================================
   CLEAR CHAT
============================================= */

function clearChat(){
    if(!confirm('Hapus semua percakapan?')) return;
    chatHistory = [];
    const box = document.getElementById('chatBox');
    box.innerHTML = `
        <div class="welcome-card" id="welcomeCard">
            <div class="welcome-icon"><i class="bi bi-robot"></i></div>
            <h4 class="welcome-title">Halo! Saya AI Assistant SIPENSA 👋</h4>
            <p class="welcome-desc">Tanyakan apa saja seputar sistem pengaduan sekolah, bullying, konseling BK, atau informasi lainnya.</p>
            <div class="welcome-chips">
                <button class="w-chip" onclick="quickAsk('Apa itu SIPENSA dan bagaimana cara menggunakannya?')">Apa itu SIPENSA?</button>
                <button class="w-chip" onclick="quickAsk('Bagaimana cara membuat laporan pengaduan?')">Cara buat laporan</button>
                <button class="w-chip" onclick="quickAsk('Berapa lama laporan saya akan diproses?')">Lama proses laporan</button>
            </div>
        </div>`;
}

/* =============================================
   HELPERS
============================================= */

function getTime(){
    return new Date().toLocaleTimeString('id-ID', { hour:'2-digit', minute:'2-digit' });
}

function scrollBottom(){
    const box = document.getElementById('chatBox');
    box.scrollTo({ top: box.scrollHeight, behavior: 'smooth' });
}

function quickAsk(text){
    document.getElementById('userInput').value = text;
    kirim();
}

function escapeHtml(t){
    return t.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;').replace(/\n/g,'<br>');
}

function formatAI(t){
    return t
        .replace(/\*\*(.*?)\*\*/g,'<strong>$1</strong>')
        .replace(/\*(.*?)\*/g,'<em>$1</em>')
        .replace(/\n/g,'<br>');
}

/* =============================================
   ADD BUBBLE
============================================= */

function addBubble(role, content, time){
    const box = document.getElementById('chatBox');
    document.getElementById('welcomeCard')?.remove();

    const isUser = role === 'user';
    box.insertAdjacentHTML('beforeend', `
        <div class="chat-row ${isUser ? 'user' : 'bot'}">
            <div class="row-avatar ${isUser ? 'user' : 'bot'}">
                <i class="bi bi-${isUser ? 'person-fill' : 'robot'}"></i>
            </div>
            <div class="row-content">
                <div class="bubble ${isUser ? 'user' : 'bot'}">${isUser ? escapeHtml(content) : formatAI(content)}</div>
                <span class="msg-time">${time}</span>
            </div>
        </div>
    `);
    scrollBottom();
}

/* =============================================
   TYPING INDICATOR
============================================= */

function showTyping(){
    document.getElementById('chatBox').insertAdjacentHTML('beforeend', `
        <div class="chat-row bot" id="typingRow">
            <div class="row-avatar bot"><i class="bi bi-robot"></i></div>
            <div class="row-content">
                <div class="bubble bot">
                    <div class="typing-dots"><span></span><span></span><span></span></div>
                </div>
            </div>
        </div>
    `);
    scrollBottom();
}

function hideTyping(){ document.getElementById('typingRow')?.remove(); }

/* =============================================
   TEXTAREA AUTO-RESIZE
============================================= */

const ta = document.getElementById('userInput');
ta.addEventListener('input', () => {
    ta.style.height = 'auto';
    ta.style.height = Math.min(ta.scrollHeight, 120) + 'px';
});
ta.addEventListener('keydown', e => {
    if(e.key === 'Enter' && !e.shiftKey){ e.preventDefault(); kirim(); }
});

/* =============================================
   KIRIM PESAN
============================================= */

async function kirim(){
    const input   = document.getElementById('userInput');
    const sendBtn = document.getElementById('sendBtn');
    const text    = input.value.trim();
    if(!text) return;

    const time = getTime();
    addBubble('user', text, time);
    input.value = '';
    input.style.height = 'auto';

    chatHistory.push({ role: 'user', parts: [{ text }] });

    sendBtn.disabled = true;
    showTyping();

    try {
        const res = await fetch('/chatbot/chat', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': CSRF,
                'Accept': 'application/json',
            },
            body: JSON.stringify({ message: text, history: chatHistory }),
        });

        const data = await res.json();
        hideTyping();

        const reply = data.reply || 'Maaf, terjadi kesalahan. Silakan coba lagi. 🙏';
        chatHistory.push({ role: 'model', parts: [{ text: reply }] });
        addBubble('bot', reply, getTime());

    } catch(err){
        hideTyping();
        addBubble('bot', 'Koneksi bermasalah. Coba lagi ya 📶', getTime());
    }

    sendBtn.disabled = false;
    input.focus();
}

window.addEventListener('load', () => document.getElementById('userInput').focus());

</script>

@endsection