<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf as FPDF;
use App\Models\Order;
use App\Models\User;

class PdfController extends Controller
{
    //


    public function report()
{
    // Fetch data from the database
    $orders = Order::all();
    $usersCount = User::count(); // Count the number of users

    // Calculate total revenue
    $totalRevenue = $orders->sum('total');

    // Create a new FPDF instance
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->SetFillColor(255, 255, 255);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(0, 10, 'Sales Report', 0, 1, 'C');
    $pdf->Ln(10);

    // Display total revenue
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, 'Total Revenue: Mwk ' . number_format($totalRevenue, 2) . '.00', 0, 1, 'C');
    $pdf->Ln(8);

    // Display number of users
    $pdf->Cell(0, 10, 'Number of Users: ' . $usersCount, 0, 1, 'C');
    $pdf->Ln(8);

    // Display number of sales
    $pdf->Cell(0, 10, 'Number of Sales: ' . $orders->count(), 0, 1, 'C');
    $pdf->Ln(12);

    // Generate table header
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->SetFillColor(220, 220, 220);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->Cell(30, 10, 'Order ID', 1, 0, 'C', true);
    $pdf->Cell(50, 10, 'User', 1, 0, 'C', true);
    $pdf->Cell(40, 10, 'Cost', 1, 0, 'C', true);
    $pdf->Cell(40, 10, 'Status', 1, 1, 'C', true);

    // Populate table with data
    $pdf->SetFont('Arial', '', 12);
    $fill = false;
    foreach ($orders as $order) {
        $pdf->Cell(30, 10, $order->id, 1, 0, 'C', $fill);
        $pdf->Cell(50, 10, $order->user->name, 1, 0, 'C', $fill);
        $pdf->Cell(40, 10, 'Mwk' . $order->total . '.00', 1, 0, 'C', $fill);
        $pdf->Cell(40, 10, $order->status, 1, 1, 'C', $fill);
        $fill = !$fill;
    }

    // Output PDF
    $pdf->Output('I', 'SalesReport.pdf');
    
    // Exit
    exit;
    }
}
