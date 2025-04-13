<?php
namespace App\Charts;

use ArielMejiaDev\LarapexCharts\LarapexChart;

class TransactionsDeliveryChart
{
  protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\AreaChart
    {
        return $this->chart->areaChart()
            ->addData('Pengiriman', [20, 10, 18, 25, 30, 28, 45, 35, 60, 55, 40, 50])
            ->addData('Transaksi', [25, 22, 30, 28, 40, 35, 50, 42, 65, 60, 48, 52])
            ->setColors(['#EF4444', '#FACC15'])
            ->setXAxis([
                'Sep', 'Oct', 'Nov', 'Dec', 'Jan', 'Feb',
                'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug'
            ]);
    }
}