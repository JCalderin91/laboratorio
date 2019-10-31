<?php

namespace App\Exports;

use App\Order;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReportExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize, WithEvents
{
    
    use Exportable;

    protected $orders;

    public function __construct($orders = null)
    {
        $this->orders = $orders;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return $this->orders;
    }

    public function map($order): array
    {
        return [
            $order->status,
            $order->arrival_date,
            $order->user->ci,
            $order->client->ci,
            $order->client->first_name . ' ' . $order->client->last_name,
            $order->device->subDevice->name,
            $order->device->brand->title,
            $order->device->model,
            $order->device->b_n,
            !$order->repair ? 'Sin revisar' : $order->repair->status,

            
        ];
    }

    public function headings(): array
    {
        return [
            'Estado Orden',
            'Fecha Recepción',
            'Técnico',
            'Cedula del cliente',
            'Nombre del cliente',
            'Dispositivo',
            'Marca',
            'Modelo',
            'Bien nacional',
            'Estado de dispositivo'
        ];
    }

    public function registerEvents(): array
    {
        $styleArray = [
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK,
                    'color' => ['argb' => 'FFFF0000'],
                ],
            ],
        ];
        
        
        return [
            AfterSheet::class    => function(AfterSheet $event) use($styleArray) {
                $cellRange = 'A1:J1'; // All headers
                $event->sheet->getDelegate()->getStyle($cellRange)
                                ->applyFromArray($styleArray);
            },
        ];
    }
}
