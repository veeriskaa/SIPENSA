<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatbotController extends Controller
{
    private string $systemInstruction = <<<PROMPT
Kamu adalah AI Assistant dari aplikasi SIPENSA, sistem informasi pengaduan sekolah.
Bantu siswa dengan ramah dan jelas dalam Bahasa Indonesia.
Fokus pada topik: cara membuat laporan pengaduan, status laporan, bullying, konseling Guru BK, akun/login, dan info aplikasi SIPENSA.
Jika ditanya di luar topik tersebut, arahkan kembali ke topik yang relevan dengan sopan.
Berikan jawaban singkat, jelas, dan helpful. Gunakan emoji secukupnya agar ramah.
PROMPT;

    public function index()
    {
        return view('siswa.chatbot');
    }

    public function chat(Request $request)
    {
        $request->validate([
            'message'         => 'required|string|max:1000',
            'history'         => 'nullable|array',
            'history.*.role'  => 'in:user,model',
            'history.*.parts' => 'array',
        ]);

        $apiKey = config('services.groq.key');

        if (empty($apiKey)) {
            return response()->json([
                'error' => 'Layanan AI belum dikonfigurasi.'
            ], 503);
        }

        // Susun history dalam format OpenAI-compatible
        $messages = collect($request->history ?? [])
            ->map(fn($item) => [
                'role'    => $item['role'] === 'model' ? 'assistant' : $item['role'],
                'content' => $item['parts'][0]['text'] ?? '',
            ])
            ->push([
                'role'    => 'user',
                'content' => $request->message,
            ])
            ->values()
            ->toArray();

        // System message di awal
        array_unshift($messages, [
            'role'    => 'system',
            'content' => $this->systemInstruction,
        ]);

        $response = Http::timeout(15)
            ->withHeaders([
                'Authorization' => "Bearer {$apiKey}",
                'Content-Type'  => 'application/json',
            ])
            ->post('https://api.groq.com/openai/v1/chat/completions', [
                'model'       => 'llama-3.3-70b-versatile',
                'messages'    => $messages,
                'max_tokens'  => 1000,
                'temperature' => 0.7,
            ]);

        if ($response->failed()) {
            return response()->json([
                'error' => 'Gagal menghubungi layanan AI. Coba lagi.'
            ], 502);
        }

        $reply = $response->json('choices.0.message.content')
            ?? 'Maaf, saya tidak dapat memproses pertanyaan tersebut.';

        return response()->json(['reply' => $reply]);
    }
}