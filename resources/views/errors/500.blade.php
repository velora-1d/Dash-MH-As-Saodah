<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>500 — Terjadi Kesalahan</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=outfit:400,600,800" rel="stylesheet" />
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Outfit', sans-serif; min-height: 100vh; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #0f172a 100%); color: #fff; overflow: hidden; }
        .container { text-align: center; padding: 2rem; position: relative; z-index: 2; }
        .code { font-size: 8rem; font-weight: 800; background: linear-gradient(135deg, #ef4444, #b91c1c); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text; line-height: 1; }
        .title { font-size: 1.5rem; font-weight: 600; color: #e2e8f0; margin-top: 0.5rem; }
        .desc { font-size: 0.9375rem; color: #94a3b8; margin-top: 0.75rem; max-width: 400px; margin-left: auto; margin-right: auto; line-height: 1.6; }
        .btn { display: inline-flex; align-items: center; gap: 0.5rem; margin-top: 2rem; padding: 0.75rem 1.5rem; background: linear-gradient(135deg, #6366f1, #4f46e5); color: #fff; text-decoration: none; border-radius: 0.75rem; font-weight: 600; font-size: 0.875rem; transition: all 0.2s; }
        .btn:hover { transform: translateY(-2px); box-shadow: 0 10px 30px rgba(99, 102, 241, 0.3); }
        .bg-circle { position: fixed; border-radius: 50%; background: rgba(239, 68, 68, 0.08); }
        .c1 { width: 400px; height: 400px; top: -100px; right: -100px; }
        .c2 { width: 300px; height: 300px; bottom: -80px; left: -80px; }
    </style>
</head>
<body>
    <div class="bg-circle c1"></div>
    <div class="bg-circle c2"></div>
    <div class="container">
        <div class="code">500</div>
        <h1 class="title">Terjadi Kesalahan Server</h1>
        <p class="desc">Maaf, terjadi kesalahan pada server kami. Silakan coba lagi beberapa saat kemudian. Jika masalah berlanjut, hubungi administrator.</p>
        <a href="{{ url('/dashboard') }}" class="btn">
            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            Kembali ke Dashboard
        </a>
    </div>
</body>
</html>
