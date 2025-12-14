<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Tugas</title>

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --bg-main: #1c1c1c;
            --gold: #c09753;
            --white: #ffffff;
            --row-bg: #ffffff;
            --row-alt-bg: #f7f7f7;
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
            max-width: 960px;
            text-align: center;
        }

        .page-title {
            font-size: 32px;
            letter-spacing: 2px;
            margin-bottom: 24px;
            color: var(--white);
        }

        .btn-add {
            display: inline-block;
            padding: 10px 30px;
            margin-bottom: 28px;
            background-color: var(--gold);
            color: var(--white);
            border-radius: 999px;
            border: none;
            text-decoration: none;
            font-weight: 700;
            letter-spacing: 1px;
            font-size: 16px;
            cursor: pointer;
            box-shadow: 0 6px 12px rgba(0,0,0,0.25);
        }

        .table-wrapper {
            background-color: var(--row-bg);
            border-radius: 12px;
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed; /* supaya pembagian lebar konsisten */
            font-size: 14px;
        }

        thead {
            background-color: var(--gold);
            color: #ffffff;
        }

        tbody {
            color: #000000;
        }

        th,
        td {
            padding: 12px 14px;
            text-align: left;
            font-weight: 500;
            word-wrap: break-word; /* izinkan teks membungkus */
        }

        /* PROPOSI BARU (ditambah kolom Catatan) */
        th:nth-child(1),
        td:nth-child(1) { /* No */
            width: 6%;
            text-align: center;
        }

        th:nth-child(2),
        td:nth-child(2) { /* Nama Tugas */
            width: 26%;
        }

        th:nth-child(3),
        td:nth-child(3) { /* Prioritas */
            width: 11%;
        }

        th:nth-child(4),
        td:nth-child(4) { /* Tanggal */
            width: 14%;
        }

        th:nth-child(5),
        td:nth-child(5) { /* Status */
            width: 13%;
        }

        th:nth-child(6),
        td:nth-child(6) { /* Catatan */
            width: 18%;
        }

        th:nth-child(7),
        td:nth-child(7) { /* Aksi */
            width: 12%;
            text-align: center;
        }

        tbody tr:nth-child(odd) {
            background-color: var(--row-bg);
        }

        tbody tr:nth-child(even) {
            background-color: var(--row-alt-bg);
        }

        tbody tr + tr {
            border-top: 1px solid var(--border-color);
        }

        /* STATUS BADGE & TOMBOL */
        .status-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 6px 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 500;
            white-space: nowrap;
        }

        .status-completed {
            background-color: #e5f7e9;
            color: #1f7a3e;
        }

        .status-pending {
            background-color: #f0f0f0;
            color: #555555;
        }

        .status-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            margin-right: 6px;
        }

        .status-dot.completed {
            background-color: #28a745;
        }

        .status-dot.pending {
            background-color: #888888;
        }

        .actions {
            display: flex;
            justify-content: center;
            gap: 6px;      /* jarak horizontal */
            row-gap: 6px;  /* jarak vertikal antar baris tombol */
            flex-wrap: wrap;
        }

        .btn-sm {
            min-width: 70px;
            padding: 5px 8px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
            text-align: center;
        }

        .btn-edit {
            background-color: #f2f2f2;
            color: #333333;
        }

        .btn-delete {
            background-color: #ff4d4f;
            color: #ffffff;
        }

        .btn-toggle {
            background-color: #e6f4ff;
            color: #1d4ed8;
        }

        .notes-text {
            font-size: 12px;
            color: #555555;
        }
    </style>
</head>
<body>
<div class="page-wrapper">
    <div class="card">
        <h1 class="page-title">DAFTAR TUGAS</h1>

        <a href="{{ route('tasks.create') }}" class="btn-add">
            TAMBAH TUGAS
        </a>

        <div class="table-wrapper">
            <table>
                <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Tugas</th>
                    <th>Prioritas</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Catatan</th>
                    <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @forelse($tasks as $task)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $task->name }}</td>
                        <td>
                            @if($task->priority === 'low')
                                Rendah
                            @elseif($task->priority === 'medium')
                                Sedang
                            @elseif($task->priority === 'high')
                                Tinggi
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ $task->due_date?->format('d M Y') ?? '-' }}</td>
                        <td>
                            @php
                                $label = $task->status ? 'Selesai' : 'Belum';
                                $statusClass = $task->status ? 'status-completed' : 'status-pending';
                                $dotClass = $task->status ? 'completed' : 'pending';
                            @endphp
                            <span class="status-badge {{ $statusClass }}">
                                <span class="status-dot {{ $dotClass }}"></span>
                                {{ $label }}
                            </span>
                        </td>
                        <td>
                            <span class="notes-text">
                                {{ $task->notes ? $task->notes : '-' }}
                            </span>
                        </td>
                        <td>
                            <div class="actions">
                                <form action="{{ route('tasks.toggle-status', $task) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button class="btn-sm btn-toggle" type="submit">
                                        {{ $task->status ? 'Belum' : 'Selesai' }}
                                    </button>
                                </form>

                                <a href="{{ route('tasks.edit', $task) }}">
                                    <button type="button" class="btn-sm btn-edit">Edit</button>
                                </a>

                                <form action="{{ route('tasks.destroy', $task) }}" method="POST"
                                      onsubmit="return confirm('Yakin hapus tugas ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn-sm btn-delete" type="submit">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align:center; color:#555;">
                            Belum ada tugas. Klik "TAMBAH TUGAS" untuk membuat tugas baru.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
