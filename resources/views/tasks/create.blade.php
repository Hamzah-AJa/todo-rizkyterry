<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Tugas</title>

    {{-- Font Montserrat --}}
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-main: #1c1c1c;
            --gold: #c09753;
            --white: #ffffff;
            --row-bg: #ffffff;
            --border-color: #e0e0e0;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Montserrat', Arial, sans-serif;
            background-color: var(--bg-main);
        }

        .page-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 16px;
        }

        .card {
            width: 100%;
            max-width: 520px;
            background-color: var(--row-bg);
            border-radius: 16px;
            padding: 28px 26px 24px;
            box-shadow: 0 14px 30px rgba(0,0,0,0.35);
        }

        .title {
            text-align: center;
            font-size: 22px;
            letter-spacing: 1px;
            margin-bottom: 6px;
            color: #222222;
        }

        .subtitle {
            text-align: center;
            font-size: 13px;
            color: #777777;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 14px;
            text-align: left;
        }

        label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 6px;
            color: #333333;
        }

        input[type="text"],
        input[type="date"],
        select,
        textarea {
            width: 100%;
            padding: 9px 11px;
            border-radius: 8px;
            border: 1px solid var(--border-color);
            font-size: 13px;
            font-family: inherit;
            outline: none;
            transition: border-color 0.15s ease, box-shadow 0.15s ease;
        }

        input[type="text"]:focus,
        input[type="date"]:focus,
        select:focus,
        textarea:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 2px rgba(192,151,83,0.25);
        }

        textarea {
            resize: vertical;
            min-height: 70px;
        }

        .hint {
            font-size: 11px;
            color: #999999;
            margin-top: 3px;
        }

        .error-list {
            list-style: none;
            margin-bottom: 14px;
            padding: 10px 12px;
            border-radius: 10px;
            background-color: #ffe5e5;
            color: #a00000;
            font-size: 12px;
        }

        .actions {
            margin-top: 18px;
            display: flex;
            justify-content: flex-end;
            gap: 10px;
        }

        .btn-primary {
            padding: 9px 20px;
            border-radius: 999px;
            border: none;
            background-color: var(--gold);
            color: var(--white);
            font-size: 13px;
            font-weight: 700;
            letter-spacing: .5px;
            cursor: pointer;
        }

        .btn-secondary {
            padding: 8px 18px;
            border-radius: 999px;
            border: 1px solid #cccccc;
            background-color: #f7f7f7;
            color: #555555;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
<div class="page-wrapper">
    <div class="card">
        <h1 class="title">Tambah Tugas</h1>
        <p class="subtitle">Isi detail tugas baru untuk ditambahkan ke daftar tugas.</p>

        @if($errors->any())
            <ul class="error-list">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Nama Tugas</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                <div class="hint">Contoh: Kirim laporan harian.</div>
            </div>

            <div class="form-group">
                <label for="priority">Prioritas</label>
                <select id="priority" name="priority" required>
                    <option value="low" {{ old('priority','medium')=='low' ? 'selected' : '' }}>Rendah</option>
                    <option value="medium" {{ old('priority','medium')=='medium' ? 'selected' : '' }}>Sedang</option>
                    <option value="high" {{ old('priority','medium')=='high' ? 'selected' : '' }}>Tinggi</option>
                </select>
            </div>

            <div class="form-group">
                <label for="due_date">Tanggal</label>
                <input type="date" id="due_date" name="due_date" value="{{ old('due_date') }}">
            </div>

            <div class="form-group">
                <label for="notes">Catatan (opsional)</label>
                <textarea id="notes" name="notes">{{ old('notes') }}</textarea>
                <div class="hint">Tambahkan detail tambahan, misalnya link, poin penting, dsb.</div>
            </div>

            <div class="actions">
                <a href="{{ route('tasks.index') }}" class="btn-secondary">Batal</a>
                <button type="submit" class="btn-primary">Simpan Tugas</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
