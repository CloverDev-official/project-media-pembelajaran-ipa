<?php

namespace App\Exports;

use App\Models\Latihan;
use App\Models\Ulangan;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\{FromArray, WithHeadings, WithStyles, WithEvents, ShouldAutoSize};
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

class RekapNilaiExport implements FromArray, WithHeadings, WithStyles, WithEvents, ShouldAutoSize
{
    protected $kelas;
    protected $latihan;
    protected $ulangan;

    protected $cachedHeadings = null;
    protected $cachedRows = null;

    public function __construct($kelas)
    {
        $this->kelas = $kelas;

        $this->latihan = Latihan::with('bab')->get();
        $this->ulangan = Ulangan::all();
    }

    public function headings(): array
    {
        // Cache supaya tidak dihitung berulang di styles/registerEvents
        if ($this->cachedHeadings !== null) {
            return $this->cachedHeadings;
        }

        $head = ['No', 'Nama Siswa'];

        foreach ($this->latihan as $l) {
            $head[] = "{$l->bab->judul_bab} (Latihan)";
        }

        foreach ($this->ulangan as $u) {
            $head[] = "{$u->judul} (Ulangan)";
        }

        $head[] = 'Total Nilai';
        $head[] = 'Rata-rata';

        return $this->cachedHeadings = $head;
    }

    public function array(): array
    {
        // Cache supaya tidak dihitung berulang di styles/registerEvents
        if ($this->cachedRows !== null) {
            return $this->cachedRows;
        }

        $rows = [];

        foreach ($this->kelas->murid as $index => $murid) {
            $row = [$index + 1, $murid->nama];

            $total = 0;
            $jumlahMapel = 0;

            foreach ($this->latihan as $l) {
                $nilai = $murid->nilaiLatihan->firstWhere('latihan_id', $l->id)->nilai ?? '-';
                $row[] = $nilai;

                if ($nilai !== '-') {
                    $total += $nilai;
                    $jumlahMapel++;
                }
            }

            foreach ($this->ulangan as $u) {
                $nilai = $murid->nilaiUlangan->firstWhere('ulangan_id', $u->id)->nilai ?? '-';
                $row[] = $nilai;

                if ($nilai !== '-') {
                    $total += $nilai;
                    $jumlahMapel++;
                }
            }

            $row[] = $jumlahMapel ? $total : '-';
            $row[] = $jumlahMapel ? round($total / $jumlahMapel) : '-';

            $rows[] = $row;
        }

        return $this->cachedRows = $rows;
    }

    public function styles(Worksheet $sheet)
    {
        $headings = $this->headings();
        $rows = $this->array();

        $colCount = count($headings);
        $rowCount = count($rows) + 1; // +1 header
        $lastColumn = $sheet->getCellByColumnAndRow($colCount, 1)->getColumn();

        // HEADER STYLE – biar pop
        $sheet->getStyle("A1:{$lastColumn}1")->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 11,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'alignment' => [
                'horizontal' => 'center',
                'vertical' => 'center',
                'wrapText' => true,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => ['rgb' => '4F81BD'], // biru soft
            ],
        ]);

        // Tinggi header
        $sheet->getRowDimension(1)->setRowHeight(28);

        // BORDER semua sel
        $sheet->getStyle("A1:{$lastColumn}{$rowCount}")->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['argb' => 'FFB0B0B0'],
                ],
            ],
            'alignment' => [
                'vertical' => 'center',
            ],
        ]);

        // ZEBRA ROW untuk data (mulai baris 2)
        for ($r = 2; $r <= $rowCount; $r++) {
            if ($r % 2 === 0) {
                $sheet
                    ->getStyle("A{$r}:{$lastColumn}{$r}")
                    ->getFill()
                    ->setFillType(Fill::FILL_SOLID)
                    ->getStartColor()
                    ->setRGB('F7F7F7');
            }
        }

        // BOLD kolom Total & Rata-rata di semua baris
        $totalColIndex = $colCount - 1;
        $rataRataColIndex = $colCount;

        $totalColLetter = $sheet->getCellByColumnAndRow($totalColIndex, 1)->getColumn();
        $rataRataColLetter = $sheet->getCellByColumnAndRow($rataRataColIndex, 1)->getColumn();

        $sheet
            ->getStyle("{$totalColLetter}1:{$rataRataColLetter}{$rowCount}")
            ->getFont()
            ->setBold(true);

        // Format number untuk nilai, total, rata-rata (asumsi kolom C dst itu angka)
        if ($colCount >= 3 && $rowCount >= 2) {
            $angkaStartCol = $sheet->getCellByColumnAndRow(3, 1)->getColumn();
            $sheet
                ->getStyle("{$angkaStartCol}2:{$lastColumn}{$rowCount}")
                ->getNumberFormat()
                ->setFormatCode('0');
        }

        // Horizontal center semua
        $sheet
            ->getStyle("A1:{$lastColumn}{$rowCount}")
            ->getAlignment()
            ->setHorizontal('center');

        // Kolom nama siswa left align
        $sheet
            ->getStyle("B2:B{$rowCount}")
            ->getAlignment()
            ->setHorizontal('left');
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $headings = $this->headings();
                $rows = $this->array();

                $colCount = count($headings);
                $rowCount = count($rows) + 1;
                $lastColumn = $sheet->getCellByColumnAndRow($colCount, 1)->getColumn();

                // Freeze header
                $sheet->freezePane('A2');

                // AutoFilter di header
                $sheet->setAutoFilter("A1:{$lastColumn}1");

                // Sedikit indent biar nggak terlalu dempet
                for ($c = 1; $c <= $colCount; $c++) {
                    $colLetter = $sheet->getCellByColumnAndRow($c, 1)->getColumn();
                    $sheet
                        ->getStyle("{$colLetter}1:{$colLetter}{$rowCount}")
                        ->getAlignment()
                        ->setIndent(1);
                }
            },
        ];
    }
}
