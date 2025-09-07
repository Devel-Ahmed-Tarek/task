<?php
namespace App\Contracts;

use Illuminate\Database\Eloquent\Collection;

interface ExportServiceInterface
{
    public function exportToCsv(Collection $employees): \Symfony\Component\HttpFoundation\StreamedResponse;
    public function exportToPdf(Collection $employees): \Symfony\Component\HttpFoundation\Response;
    public function export(string $format, Collection $employees);
}
