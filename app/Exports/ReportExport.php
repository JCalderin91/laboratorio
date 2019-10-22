<?php

namespace App\Exports;

use App\Order;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ReportExport implements FromCollection, WithMapping, WithHeadings, ShouldAutoSize
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
}
