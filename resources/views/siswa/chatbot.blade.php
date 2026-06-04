bash

cat > /mnt/user-data/outputs/chatbot.blade.php << 'ENDOFFILE'
@extends('layouts.siswa')

@section('title', 'AI Chatbot')

@section('content')

<style>

/* =========================================================
   FONTS
========================================================= */

@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');

/* =========================================================
   ROOT
========================================================= */

:root{
    --ai-green:       #0a7f2e;
    --ai-green-mid:   #16a34a;
    --ai-green-light: #22c55e;
    --ai-surface:     #ffffff;
    --ai-bg:          #f0f4f1;
    --ai-border:      #e2e8e4;
    --ai-text:        #111827;
    --ai-soft:        #6b7280;
    --ai-user-bg:     #0a7f2e;
    --ai-bot-bg:      #ffffff;
    --ai-radius:      20px;
}

/* =========================================================
   RESET SCOPE
========================================================= */

.chatbot-page *{
    box-sizing: border-box;
    font-family: 'Plus Jakarta Sans', sans-serif;
}

/* =========================================================
   PAGE
========================================================= */

.chatbot-page{
    height: calc(100vh - 94px);
    display: flex;
    gap: 0;
    padding: 0;
    margin: -22px;
    background: var(--ai-bg);
    overflow: hidden;
}

/* =========================================================
   MAIN WRAPPER
========================================================= */

.chatbot-main{
    flex: 1;
    display: flex;
    flex-direction: column;
    height: 100%;
    overflow: hidden;
}

/* =========================================================
   TOPBAR
========================================================= */

.chat-topbar{
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 16px 24px;
    background: var(--ai-surface);
    border-bottom: 1px solid var(--ai-border);
    gap: 14px;
}

.topbar-left{
    display: flex;
    align-items: center;
    gap: 14px;
}

.bot-avatar{
    width: 46px;
    height: 46px;
    border-radius: 14px;
    background: linear-gradient(135deg, var(--ai-green), var(--ai-green-light));
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    color: white;
    flex-shrink: 0;
    box-shadow: 0 4px 12px rgba(10,127,46,.25);
}

.bot-info h5{
    font-size: 15px;
    font-weight: 700;
    color: var(--ai-text);
    margin: 0 0 2px;
}

.bot-info .status{
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 12px;
    color: var(--ai-soft);
}

.status-dot{
    width: 7px;
    height: 7px;
    border-radius: 50%;
    background: #22c55e;
    animation: pulse-dot 2s infinite;
}

@keyframes pulse-dot{
    0%,100%{ opacity: 1; transform: scale(1); }
    50%{ opacity: .6; transform: scale(.8); }
}

.topbar-badge{
    display: flex;
    align-items: center;
    gap: 6px;
    background: #f0fdf4;
    border: 1px solid #bbf7d0;
    color: var(--ai-green);
    padding: 7px 14px;
    border-radius: 30px;
    font-size: 12px;
    font-weight: 600;
}

.topbar-badge i{
    font-size: 13px;
}

/* =========================================================
   CHAT AREA
========================================================= */

.chat-area{
    flex: 1;
    overflow-y: auto;
    padding: 24px 24px 8px;
    scroll-behavior: smooth;
    background: var(--ai-bg);
}

.chat-area::-webkit-scrollbar{ width: 5px; }
.chat-area::-webkit-scrollbar-thumb{
    background: #d1d5db;
    border-radius: 20px;
}

/* =========================================================
   CHAT ROW
========================================================= */

.chat-row{
    display: flex;
    gap: 10px;
    margin-bottom: 20px;
    align-items: flex-end;
    animation: msgIn .25s ease both;
}

.chat-row.user{
    flex-direction: row-reverse;
}

@keyframes msgIn{
    from{ opacity:0; transform:translateY(8px); }
    to{ opacity:1; transform:translateY(0); }
}

/* =========================================================
   MINI AVATAR
========================================================= */

.msg-avatar{
    width: 32px;
    height: 32px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    flex-shrink: 0;
}

.msg-avatar.bot{
    background: linear-gradient(135deg, var(--ai-green), var(--ai-green-light));
    color: white;
    box-shadow: 0 3px 8px rgba(10,127,46,.2);
}

.msg-avatar.user{
    background: #e5e7eb;
    color: var(--ai-soft);
}

/* =========================================================
   BUBBLE
========================================================= */

.chat-bubble{
    max-width: 78%;
    padding: 13px 16px;
    border-radius: 18px;
    font-size: 14px;
    line-height: 1.7;
    position: relative;
    word-break: break-word;
}

.chat-bubble.bot{
    background: var(--ai-bot-bg);
    border: 1px solid var(--ai-border);
    color: var(--ai-text);
    border-bottom-left-radius: 6px;
    box-shadow: 0 2px 8px rgba(0,0,0,.04);
}

.chat-bubble.user{
    background: linear-gradient(135deg, var(--ai-green), #15803d);
    color: white;
    border-bottom-right-radius: 6px;
    box-shadow: 0 4px 14px rgba(10,127,46,.25);
}

.chat-bubble ul{
    margin: 8px 0 4px 16px;
    padding: 0;
}

.chat-bubble ul li{
    margin-bottom: 4px;
}

.chat-time{
    font-size: 11px;
    color: #9ca3af;
    margin-top: 4px;
    padding: 0 4px;
}

.chat-row.user .chat-time{
    text-align: right;
}

/* =========================================================
   QUICK BUTTONS
========================================================= */

.quick-wrap{
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-top: 14px;
}

.quick-btn{
    border: 1.5px solid #bbf7d0;
    background: #f0fdf4;
    color: var(--ai-green);
    padding: 8px 14px;
    border-radius: 30px;
    font-size: 12.5px;
    font-weight: 600;
    cursor: pointer;
    transition: .2s;
}

.quick-btn:hover{
    background: var(--ai-green);
    color: white;
    border-color: var(--ai-green);
    transform: translateY(-1px);
}

/* =========================================================
   TYPING
========================================================= */

.typing-dots{
    display: flex;
    gap: 5px;
    padding: 4px 0;
}

.typing-dots span{
    width: 7px;
    height: 7px;
    background: #9ca3af;
    border-radius: 50%;
    animation: bounce 1s infinite;
}

.typing-dots span:nth-child(2){ animation-delay: .18s; }
.typing-dots span:nth-child(3){ animation-delay: .36s; }

@keyframes bounce{
    0%,80%,100%{ transform: translateY(0); }
    40%{ transform: translateY(-5px); }
}

/* =========================================================
   INPUT AREA
========================================================= */

.chat-input-area{
    flex-shrink: 0;
    padding: 14px 20px;
    background: var(--ai-surface);
    border-top: 1px solid var(--ai-border);
    display: flex;
    gap: 10px;
    align-items: flex-end;
}

.input-wrap{
    flex: 1;
    display: flex;
    align-items: center;
    background: #f9fafb;
    border: 1.5px solid var(--ai-border);
    border-radius: 16px;
    padding: 0 14px;
    transition: .2s;
    gap: 8px;
}

.input-wrap:focus-within{
    border-color: var(--ai-green);
    background: white;
    box-shadow: 0 0 0 3px rgba(10,127,46,.08);
}

.chat-input{
    flex: 1;
    border: none;
    background: transparent;
    outline: none;
    font-size: 14px;
    padding: 14px 0;
    color: var(--ai-text);
    font-family: 'Plus Jakarta Sans', sans-serif;
    resize: none;
    height: 48px;
    max-height: 120px;
    overflow-y: auto;
    line-height: 1.5;
}

.chat-input::placeholder{ color: #9ca3af; }

.input-icon{
    color: #9ca3af;
    font-size: 16px;
    flex-shrink: 0;
}

.send-btn{
    width: 48px;
    height: 48px;
    border: none;
    border-radius: 14px;
    background: linear-gradient(135deg, var(--ai-green), var(--ai-green-light));
    color: white;
    font-size: 16px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: .25s;
    box-shadow: 0 4px 12px rgba(10,127,46,.25);
    flex-shrink: 0;
}

.send-btn:hover{
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(10,127,46,.3);
}

.send-btn:disabled{
    opacity: .5;
    transform: none;
    cursor: not-allowed;
}

.input-hint{
    font-size: 11px;
    color: #9ca3af;
    text-align: center;
    padding: 4px 0 0;
}

/* =========================================================
   RESPONSIVE — MOBILE
========================================================= */

@media(max-width:768px){

    .chatbot-page{
        margin: -14px;
        height: calc(100vh - 84px);
    }

    .chat-topbar{
        padding: 12px 16px;
    }

    .bot-avatar{
        width: 38px;
        height: 38px;
        font-size: 17px;
        border-radius: 11px;
    }

    .bot-info h5{
        font-size: 14px;
    }

    .topbar-badge{
        font-size: 11px;
        padding: 6px 10px;
    }

    .chat-area{
        padding: 16px 14px 6px;
    }

    .chat-bubble{
        max-width: 88%;
        font-size: 13.5px;
        padding: 11px 14px;
    }

    .chat-input-area{
        padding: 10px 14px;
    }

    .send-btn{
        width: 44px;
        height: 44px;
    }

    .input-hint{
        display: none;
    }

}

@media(max-width:400px){

    .chatbot-page{
        margin: -10px;
    }

    .topbar-badge span{
        display: none;
    }

    .chat-bubble{
        max-width: 92%;
        font-size: 13px;
    }

}

</style>

<!-- PAGE -->
<div class="chatbot-page">

    <!-- MAIN -->
    <div class="chatbot-main">

        <!-- TOPBAR -->
        <div class="chat-topbar">

            <div class="topbar-left">

                <div class="bot-avatar">
                    <i class="bi bi-robot"></i>
                </div>

                <div class="bot-info">
                    <h5>AI Assistant eLapor</h5>
                    <div class="status">
                        <span class="status-dot"></span>
                        Didukung Claude AI · Selalu online
                    </div>
                </div>

            </div>

            <div class="topbar-badge">
                <i class="bi bi-stars"></i>
                <span>Powered by Claude AI</span>
            </div>

        </div>

        <!-- CHAT AREA -->
        <div class="chat-area" id="chatBox">

            <!-- PESAN AWAL BOT -->
            <div class="chat-row bot">
                <div class="msg-avatar bot"><i class="bi bi-robot"></i></div>
                <div>
                    <div class="chat-bubble bot">
                        Halo 👋 Saya <b>AI Assistant eLapor</b> — didukung kecerdasan buatan Claude AI.<br><br>
                        Saya dapat membantu kamu terkait pengaduan sekolah, konseling BK, atau pertanyaan apa pun seputar eLapor SMKN 2 Marabahan.<br><br>
                        Silakan tanyakan apa saja 😊

                        <div class="quick-wrap">
                            <button class="quick-btn" onclick="quickAsk('Cara membuat laporan pengaduan')">📝 Cara buat laporan</button>
                            <button class="quick-btn" onclick="quickAsk('Bagaimana cek status laporan saya')">🔍 Cek status laporan</button>
                            <button class="quick-btn" onclick="quickAsk('Saya mengalami bullying, apa yang harus saya lakukan')">🛡️ Kena bullying</button>
                            <button class="quick-btn" onclick="quickAsk('Apa itu konseling BK dan bagaimana cara mengaksesnya')">💬 Konseling BK</button>
                        </div>
                    </div>
                    <div class="chat-time">{{ now()->format('H:i') }}</div>
                </div>
            </div>

        </div>

        <!-- INPUT -->
        <div>
            <div class="chat-input-area">
                <div class="input-wrap">
                    <i class="bi bi-chat-text input-icon"></i>
                    <textarea
                        id="userInput"
                        class="chat-input"
                        placeholder="Ketik pertanyaan kamu..."
                        rows="1"
                    ></textarea>
                </div>
                <button class="send-btn" id="sendBtn" onclick="kirim()">
                    <i class="bi bi-send-fill"></i>
                </button>
            </div>
            <div class="input-hint">Tekan Enter untuk kirim · Shift+Enter untuk baris baru</div>
        </div>

    </div>

</div>

<script>

/* =========================================================
   CSRF TOKEN
========================================================= */

const CSRF = document.querySelector('meta[name="csrf-token"]')?.content || '';

/* =========================================================
   RIWAYAT PERCAKAPAN (untuk konteks AI)
========================================================= */

let chatHistory = [];

/* =========================================================
   HELPER: WAKTU
========================================================= */

function getTime(){
    return new Date().toLocaleTimeString('id-ID', {
        hour: '2-digit', minute: '2-digit'
    });
}

/* =========================================================
   HELPER: SCROLL KE BAWAH
========================================================= */

function scrollBottom(){
    const box = document.getElementById('chatBox');
    box.scrollTo({ top: box.scrollHeight, behavior: 'smooth' });
}

/* =========================================================
   QUICK ASK
========================================================= */

function quickAsk(text){
    document.getElementById('userInput').value = text;
    kirim();
}

/* =========================================================
   AUTO-RESIZE TEXTAREA
========================================================= */

const textarea = document.getElementById('userInput');

textarea.addEventListener('input', () => {
    textarea.style.height = 'auto';
    textarea.style.height = Math.min(textarea.scrollHeight, 120) + 'px';
});

textarea.addEventListener('keydown', (e) => {
    if(e.key === 'Enter' && !e.shiftKey){
        e.preventDefault();
        kirim();
    }
});

/* =========================================================
   RENDER BUBBLE
========================================================= */

function addBubble(role, html, time){
    const box = document.getElementById('chatBox');

    if(role === 'user'){
        box.innerHTML += `
            <div class="chat-row user">
                <div class="msg-avatar user"><i class="bi bi-person-fill"></i></div>
                <div>
                    <div class="chat-bubble user">${escapeHtml(html)}</div>
                    <div class="chat-time">${time}</div>
                </div>
            </div>`;
    } else {
        box.innerHTML += `
            <div class="chat-row bot">
                <div class="msg-avatar bot"><i class="bi bi-robot"></i></div>
                <div>
                    <div class="chat-bubble bot">${html}</div>
                    <div class="chat-time">${time}</div>
                </div>
            </div>`;
    }

    scrollBottom();
}

/* =========================================================
   TYPING INDICATOR
========================================================= */

function showTyping(){
    const box = document.getElementById('chatBox');
    box.innerHTML += `
        <div class="chat-row bot" id="typingRow">
            <div class="msg-avatar bot"><i class="bi bi-robot"></i></div>
            <div class="chat-bubble bot">
                <div class="typing-dots">
                    <span></span><span></span><span></span>
                </div>
            </div>
        </div>`;
    scrollBottom();
}

function hideTyping(){
    document.getElementById('typingRow')?.remove();
}

/* =========================================================
   ESCAPE HTML (user input)
========================================================= */

function escapeHtml(text){
    return text
        .replace(/&/g,'&amp;')
        .replace(/</g,'&lt;')
        .replace(/>/g,'&gt;')
        .replace(/\n/g,'<br>');
}

/* =========================================================
   FORMAT RESPONSE AI
   Ubah **bold**, \n jadi <br>, • jadi list
========================================================= */

function formatResponse(text){
    return text
        .replace(/\*\*(.*?)\*\*/g,'<b>$1</b>')
        .replace(/\*(.*?)\*/g,'<i>$1</i>')
        .replace(/\n/g,'<br>')
        .replace(/•\s/g,'• ');
}

/* =========================================================
   KIRIM PESAN → CLAUDE API via Laravel proxy
========================================================= */

async function kirim(){
    const input = document.getElementById('userInput');
    const sendBtn = document.getElementById('sendBtn');
    const text = input.value.trim();

    if(!text) return;

    const time = getTime();

    // Tampilkan pesan user
    addBubble('user', text, time);
    input.value = '';
    input.style.height = 'auto';

    // Tambah ke history
    chatHistory.push({ role: 'user', content: text });

    // Disable tombol
    sendBtn.disabled = true;
    showTyping();

    try {

        const response = await fetch('/chatbot/send', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': CSRF,
                'Accept': 'application/json',
            },
            body: JSON.stringify({
                messages: chatHistory
            })
        });

        const data = await response.json();

        hideTyping();

        if(data.reply){
            const reply = data.reply;
            chatHistory.push({ role: 'assistant', content: reply });
            addBubble('bot', formatResponse(reply), getTime());
        } else {
            addBubble('bot', 'Maaf, terjadi kesalahan. Silakan coba lagi. 🙏', getTime());
        }

    } catch(err){
        hideTyping();
        addBubble('bot', 'Koneksi bermasalah. Periksa internet kamu dan coba lagi. 📶', getTime());
    }

    sendBtn.disabled = false;
    input.focus();
}

/* Focus saat load */
window.addEventListener('load', () => {
    document.getElementById('userInput').focus();
});

</script>

@endsection
ENDOFFILE
echo "Done"
Output

Done
Done
Sekarang buat file Laravel backend (controller + route) untuk proxy ke Claude API:


Buat ChatbotController dan petunjuk route
Buat ChatbotController dan petunjuk route

Buat ChatbotController dan petunjuk route
bash

cat > /mnt/user-data/outputs/ChatbotController.php << 'ENDOFFILE'
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatbotController extends Controller
{
    public function send(Request $request)
    {
        $request->validate([
            'messages' => 'required|array|min:1',
        ]);

        $messages = $request->input('messages');

        // Batasi riwayat percakapan maksimal 20 pesan terakhir
        // agar tidak melebihi token limit
        if (count($messages) > 20) {
            $messages = array_slice($messages, -20);
        }

        try {
            $response = Http::withHeaders([
                'x-api-key'         => config('services.anthropic.key'),
                'anthropic-version' => '2023-06-01',
                'Content-Type'      => 'application/json',
            ])->post('https://api.anthropic.com/v1/messages', [
                'model'      => 'claude-haiku-4-5-20251001',
                'max_tokens' => 1024,
                'system'     => $this->systemPrompt(),
                'messages'   => $messages,
            ]);

            if ($response->successful()) {
                $data  = $response->json();
                $reply = $data['content'][0]['text'] ?? 'Maaf, saya tidak dapat memproses permintaan ini.';

                return response()->json(['reply' => $reply]);
            }

            return response()->json([
                'reply' => 'Maaf, layanan AI sedang tidak tersedia. Silakan coba beberapa saat lagi.'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'reply' => 'Terjadi kesalahan pada server. Silakan coba lagi.'
            ], 200);
        }
    }

    private function systemPrompt(): string
    {
        return <<<PROMPT
Kamu adalah AI Assistant bernama "eLapor Assistant" untuk sistem pengaduan siswa SMKN 2 Marabahan.

TUGAS UTAMA:
- Membantu siswa memahami cara menggunakan sistem eLapor
- Memberikan informasi seputar pengaduan, konseling BK, dan permasalahan sekolah
- Merespons dengan empati, ramah, dan profesional
- Menggunakan bahasa Indonesia yang santai namun sopan

KONTEKS SISTEM eLAPOR:
- Siswa dapat membuat laporan pengaduan melalui menu "Buat Laporan"
- Kategori laporan: bullying, fasilitas sekolah, akademik, kekerasan, dll
- Status laporan: Pending → Proses → Selesai
- Laporan dapat dicek di menu "Laporan Saya"
- Guru BK bertugas menangani dan merespons laporan
- Fitur konseling tersedia melalui sistem

PANDUAN RESPONS:
- Jawab dengan singkat, jelas, dan to the point
- Gunakan emoji secukupnya agar lebih ramah
- Jika ada pertanyaan di luar topik sekolah, tetap bantu semampu mungkin
- Jaga kerahasiaan dan privasi siswa
- Berikan dorongan positif kepada siswa yang bermasalah
- Jika ada indikasi darurat (kekerasan fisik, dll), sarankan segera lapor ke guru

Kamu BUKAN hanya chatbot FAQ — kamu adalah asisten AI yang cerdas dan dapat berdiskusi.
PROMPT;
    }
}
ENDOFFILE

cat > /mnt/user-data/outputs/chatbot_routes.php << 'ENDOFFILE'
<?php

// Tambahkan route ini di dalam group middleware auth di routes/web.php
// Contoh:

/*
Route::middleware(['auth'])->group(function () {
    // ... route lain ...

    // Chatbot
    Route::get('/chatbot', function () {
        return view('chatbot');
    })->name('chatbot');

    Route::post('/chatbot/send', [App\Http\Controllers\ChatbotController::class, 'send'])
        ->name('chatbot.send');
});
*/

// ==========================================================
// Tambahkan di config/services.php:
// ==========================================================

/*
'anthropic' => [
    'key' => env('ANTHROPIC_API_KEY'),
],
*/

// ==========================================================
// Tambahkan di .env:
// ==========================================================

/*
ANTHROPIC_API_KEY=sk-ant-xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
*/
ENDOFFILE

echo "Done"
Output

Done
Done
