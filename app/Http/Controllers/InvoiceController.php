<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use ZipArchive;
use Illuminate\Support\Facades\Storage;


class InvoiceController extends Controller
{
    public function export(Request $request)
    {
        $jobIds = $request->input('job_ids');
        if (count($jobIds) === 1) {
            $jobId = $jobIds[0];
            $job = Job::find($jobId);
            $data = [
                'id' => $job->id,
                'quantity' => $job->quantity,
                'price' => $job->price,
                'item' => $job->item->name,
                'invoice_to' => $job->business->business_name,
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
                    molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum
                    numquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium
                    optio, eaque rerum! Provident similique accusantium nemo autem. Veritatis
                    obcaecati tenetur iure eius earum ut molestias architecto voluptate aliquam
                    nihil, eveniet aliquid culpa officia aut! Impedit sit sunt quaerat, odit,
                    tenetur error, harum nesciunt ipsum debitis quas aliquid. Reprehenderit, ',
            ];
            $pdf = PDF::loadView('invoice.job-invoice', $data);
            return $pdf->download("invoice_{$jobId}.pdf");
        }

        $zip = new ZipArchive;
        $zipFileName = 'invoices.zip';
        $zipFilePath = storage_path($zipFileName);

        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
            foreach ($jobIds as $jobId) {

                $job = Job::find($jobId);
                $data = [
                    'id' => $job->id,
                    'quantity' => $job->quantity,
                    'price' => $job->price,
                    'item' => $job->item->name,
                    'invoice_to' => $job->business->business_name,
                    'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
                    molestiae quas vel sint commodi repudiandae consequuntur voluptatum laborum
                    numquam blanditiis harum quisquam eius sed odit fugiat iusto fuga praesentium
                    optio, eaque rerum! Provident similique accusantium nemo autem. Veritatis
                    obcaecati tenetur iure eius earum ut molestias architecto voluptate aliquam
                    nihil, eveniet aliquid culpa officia aut! Impedit sit sunt quaerat, odit,
                    tenetur error, harum nesciunt ipsum debitis quas aliquid. Reprehenderit, ',
                ];
                $pdf = PDF::loadView('invoice.job-invoice', $data);
                $pdfContent = $pdf->output();
                $zip->addFromString("invoice_{$jobId}.pdf", $pdfContent);
            }
            $zip->close();
        } else {
            return response()->json(['error' => 'Could not create zip file'], 500);
        }
        return response()->download($zipFilePath)->deleteFileAfterSend(true);
    }
}
