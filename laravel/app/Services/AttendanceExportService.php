<?php

namespace App\Services;

use App\Models\Attendance;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Response;

class AttendanceExportService
{
    public function exportAttendance()
    {
        // 1. Ambil Data
        $attendances = Attendance::with('employee')->get();

        // 2. Inisialisasi Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // 3. Tambahkan Header
        $headers = [
            'ID',
            'Nama Pegawai',
            'Tanggal',
            'Check In',
            'Check Out',
            'Status'
        ];
        $sheet->fromArray($headers, null, 'A1');

        // 4. Tambahkan Data
        $dataRows = [];
        foreach ($attendances as $attendance) {
            $dataRows[] = [
                $attendance->id,
                $attendance->employee->fullname ?? 'Pegawai Dihapus',
                $attendance->date,
                $attendance->check_in ?? '-',
                $attendance->check_out ?? '-',
                ucfirst($attendance->status)
            ];
        }

        // Mulai menulis data dari baris ke-2 (setelah header)
        $sheet->fromArray($dataRows, null, 'A2');

        // 5. Siapkan Response Download
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Laporan_Kehadiran_' . now()->format('Ymd_His') . '.xlsx';

        // Simpan output ke buffer
        $tempFile = tempnam(sys_get_temp_dir(), $fileName);
        $writer->save($tempFile);

        // Buat Response Unduhan
        return Response::download($tempFile, $fileName, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Length' => filesize($tempFile)
        ])->deleteFileAfterSend(true);
    }
}
