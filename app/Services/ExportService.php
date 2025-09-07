<?php
namespace App\Services;

use App\Contracts\ExportServiceInterface;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Collection;

class ExportService implements ExportServiceInterface
{
    public function exportToCsv(Collection $employees): \Symfony\Component\HttpFoundation\StreamedResponse
    {
        $filename = 'employees_' . date('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($employees) {
            $file = fopen('php://output', 'w');

            // CSV headers
            fputcsv($file, ['Name', 'Email', 'Department', 'Salary', 'Created At']);

            // CSV data
            foreach ($employees as $employee) {
                fputcsv($file, [
                    $employee->name,
                    $employee->email,
                    $employee->department->name,
                    $employee->salary,
                    $employee->created_at->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportToPdf(Collection $employees): \Symfony\Component\HttpFoundation\Response
    {
        $filename = 'employees_' . date('Y-m-d_H-i-s') . '.pdf';

        $pdf = Pdf::loadView('employees.export-pdf', compact('employees'));

        return $pdf->download($filename);
    }

    public function export(string $format, Collection $employees)
    {
        return match ($format) {
            'csv' => $this->exportToCsv($employees),
            'pdf' => $this->exportToPdf($employees),
            default => throw new \InvalidArgumentException('Invalid export format. Supported formats: csv, pdf'),
        };
    }
}