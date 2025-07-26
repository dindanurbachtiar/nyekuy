<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'current_date' => now()->locale('id')->translatedFormat('j F Y'),
            'modules' => [
                [
                    'title' => 'Pemesanan',
                    'icon' => 'fas fa-cash-register',
                    'route' => 'orders.index',
                    'color' => 'blue'
                ],
                [
                    'title' => 'Kelola Stok',
                    'icon' => 'fas fa-boxes',
                    'route' => 'materials.index',
                    'color' => 'orange'
                ],
                [
                    'title' => 'Laporan Pendapatan',
                    'icon' => 'fas fa-chart-bar',
                    'route' => 'reports.index',
                    'color' => 'green'
                ]
            ]
        ];

        return view('dashboard.index', $data);
    }
}