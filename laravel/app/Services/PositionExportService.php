<?php

namespace App\Services;

use App\Models\Position;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Response;

class PositionExportService
{
    public function exportPositions()
    {
        // 1. Ambil Data
        $positions = Position::all();

        // 2. Inisialisasi Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // 3. Tambahkan Header
        $headers = [
            'ID',
            'Nama Jabatan',
            'Gaji Pokok (Rp)'
        ];
        $sheet->fromArray($headers, null, 'A1');

        // 4. Tambahkan Data
        $dataRows = [];
        foreach ($positions as $position) {
            $dataRows[] = [
                $position->id,
                $position->position_name,
                $position->base_salary
            ];
        }

        // Mulai menulis data dari baris ke-2
        $sheet->fromArray($dataRows, null, 'A2');

        // 5. Siapkan Response Download
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Laporan_Jabatan_' . now()->format('Ymd_His') . '.xlsx';

        $tempFile = tempnam(sys_get_temp_dir(), $fileName);
        $writer->save($tempFile);

        return Response::download($tempFile, $fileName, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Length' => filesize($tempFile)
        ])->deleteFileAfterSend(true);
    }
}
