<?php

namespace App\Services;

use App\Models\Employee;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Response;

class EmployeeExportService
{
    public function exportEmployees()
    {
        // 1. Ambil Data
        $employees = Employee::with(['department', 'position'])->get();

        // 2. Inisialisasi Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // 3. Tambahkan Header
        $headers = [
            'ID',
            'Nama Lengkap',
            'Email',
            'Departemen',
            'Jabatan',
            'Gaji Pokok',
            'Nomor Telepon',
            'Tanggal Masuk',
            'Status'
        ];
        $sheet->fromArray($headers, null, 'A1');

        // 4. Tambahkan Data
        $dataRows = [];
        foreach ($employees as $employee) {
            $dataRows[] = [
                $employee->id,
                $employee->fullname,
                $employee->email,
                $employee->department->department_name ?? 'N/A',
                $employee->position->position_name ?? 'N/A',
                $employee->position->base_salary ?? 0,
                $employee->phone_number,
                $employee->date_entry,
                ucfirst($employee->status)
            ];
        }

        // Mulai menulis data dari baris ke-2
        $sheet->fromArray($dataRows, null, 'A2');

        // 5. Siapkan Response Download
        $writer = new Xlsx($spreadsheet);
        $fileName = 'Laporan_Pegawai_' . now()->format('Ymd_His') . '.xlsx';

        $tempFile = tempnam(sys_get_temp_dir(), $fileName);
        $writer->save($tempFile);

        return Response::download($tempFile, $fileName, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Length' => filesize($tempFile)
        ])->deleteFileAfterSend(true);
    }
}
