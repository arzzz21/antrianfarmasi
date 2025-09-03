<?php

namespace App\Http\Controllers\Jasper;
// namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use PHPJasper\PHPJasper;
use Illuminate\Support\Facades\Response;
use App\Models\ReportPermissions;

use Auth;

define('source_path', 'app/report/source/MyReports/src');
define('compiled_path', 'app/report/compiled');
define('output_path', 'app/report/output');

class JasperController extends Controller
{
    // static $role_name_id = 5;
    // static $permissions;

    function __construct(){
        // self::$permissions = [
        //     "report" => [
        //         'role_name_id' => self::$role_name_id,
        //         'action' => 'read',
        //         'return' => 'view',
        //         'denial_msg' => ["You are not Allowed to access Reports!"],
        //     ]
        // ];
        // $this->middleware('RolePermissions');
    }


    static $reports = ["expense"=>"expense"];
    static function read_files($path){
        $files = [];
        foreach (new \DirectoryIterator($path) as $file) {
            if ($file->isFile()) {
                $files[$file->getFilename()] = $path."/".$file->getFilename();
            }
        }
        return $files;
    }
    static function UpdateReports($file = ""){
        $path = storage_path(source_path);
        if($file != ""){
            $file .= ".jrxml";
            $file = $path."/".$file;
            if (file_exists($file)) {
                JasperController::compile($file);
                return "Build Successfully!";
            }else{
                return "Sorry! no Report file Found in ". $path;
            }
        }else{
            $reports = JasperController::read_files($path);
            foreach($reports as $key=>$report){
                JasperController::compile($report);
            }
            return "All Reports Build Successfully!";
        }
    }
    static function compile($input){
        $output = storage_path(compiled_path);
        $jasper = new PHPJasper;
        $jasper->compile($input,$output)->execute();
    }
    static function dir_check($path){
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        return $path;
    }
    static function pdf($path,$filename){
        return Response::make(file_get_contents($path), 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$filename.'"'
        ]);
    }
    static function xlsx($path,$filename){
        return Response::make(file_get_contents($path), 200, [
            'Content-Type' => 'application/vnd.ms-excel',
            'Content-Disposition' => 'inline; filename="'.$filename.'"'
        ]);
    }
    static function csv($path,$filename){
        return Response::make(file_get_contents($path), 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'inline; filename="'.$filename.'"'
        ]);
    }
    static function html($path,$filename){
        $content = file_get_contents($path);
        // return view('report.jasper.print')->with(['content' => $content]);
        // if(isset($_GET['print'])){
        //     return view("report.jasper.print")
        //     ->with('preview',$content)
        //     ->with('filter',str_replace('.html', '', $filename));
        // }else{
            return view("report.jasper.preview")
            ->with('preview',$content)
            ->with('filter',str_replace('.html', '', $filename));
        // }
    }
    // static function print($path,$filename)
    // {
    //     // Generate the PDF response
    //     $pdfContent = file_get_contents($path);
    //     $encodedContent = base64_encode($pdfContent);

    //     // Return a view with the PDF embedded and auto-printing
    //     return view('print_pdf', [
    //         'pdfContent' => $encodedContent,
    //         'filename' => $filename
    //     ]);
    // }
    static function jasper($input,$output,$options,$template,$ext){
        $jasper = new PHPJasper;
        $resp = $jasper->process(
            $input,
            $output,
            $options
        )->execute();
        $filename = $template.'.'.$ext;
        if($resp == []){
            switch ($ext){
                case "pdf":
                    return JasperController::pdf($output.'/'.$filename,$filename);
                    break;
                case "xlsx":
                    return JasperController::xlsx($output.'/'.$filename,$filename);
                    break;
                case "csv":
                    return JasperController::csv($output.'/'.$filename,$filename);
                    break;
                case "html":
                    return JasperController::html($output.'/'.$filename,$filename);
                    break;
            }
        }
    }
    static function get_reports_dropdown($ignored){
        $compiled_report_file_paths = self::read_files(storage_path(compiled_path));
        $reports =  array_values(array_filter(array_map(function($key) use($ignored) {
            $key = preg_replace('/\.jasper$/', '', $key);
            if(!isset($ignored[$key]) || $ignored[$key]){
                return $key;
            }
        }, array_keys($compiled_report_file_paths))));
        // dd($reports);
        return $reports;
    }
    public static function jasper_driver(){
        switch(env('DB_CONNECTION')){
            case "mysql":{
                return env('DB_CONNECTION');
            }break;
            case "pgsql":{
                return "postgres";
            }break;
            case "sqlsrv":{
                return env('DB_CONNECTION');
            }break;
            case "sqlite":{
                return env('DB_CONNECTION');
            }break;
        }
    }
    public static function report($report,$ext = "pdf"){

        // $permission = ReportPermissions::whereIn('role_id', auth()->user()->roles->pluck('role_id')->toArray())
        // ->where('report_name', $report)->first();
        // if(!$permission && $report != 'request') {
        //     abort(404);
        // }

        $src = storage_path(source_path);
        $reports = JasperController::read_files($src);

        if(!isset($reports[$report.".jrxml"])){
            abort(404, 'Unauthorized action.');
            return false;
        }

        // dd($reports,$template);
        $user = Auth::user(); // auth()->user()
        // $user_id = $user->id;
        $user_id = 1;
        // $client_id = $user->client_id;
        $client_id = 1;

        $input = storage_path(compiled_path).'/'.$report.'.jasper';

        $output = JasperController::dir_check(storage_path(output_path)."/client_".$client_id."/user_".$user_id);
        $options = [
            'locale' => 'en',
            'db_connection' => [
                // 'driver' => self::jasper_driver(), // env('JASPER_DRIVER')
                'driver' => env('db_pendaftaran'), // env('JASPER_DRIVER')
                'username' => env('DB_USERNAME'),
                'host' => env('DB_HOST'),
                'database' => env('DB_DATABASE_PENDAFTARAN'),
                'port' => env('DB_PORT')
            ]
        ];
        if(env('DB_PASSWORD') != null ||  env('DB_PASSWORD') != ""){
            $options["db_connection"]["password"] = env('DB_PASSWORD');
        }
        print_r($options);
        die();
        try {
            $controller = "App\Http\Controllers\Jasper\Reports\\".$report."ReportController";
            // return $controller::boot($input,$output,$options,$report,$ext,$user);
            return JasperReportsController::{$report}($input,$output,$options,$report,$ext,$user);
        } catch (\Exception $e) {
            return back()->with('error', [$e->getMessage()]);
        }
        // dd($options);
        // switch($report){
        //     case "users":{
        //         return JasperReportsController::users($input,$output,$options,$report,$ext,$user);
        //     }break;
        //     case "promotional":{
        //         return JasperReportsController::promotional($input,$output,$options,$report,$ext,$user);
        //     }break;
        //     case "all_requests":{
        //         return JasperReportsController::all_requests($input,$output,$options,$report,$ext,$user);
        //     }break;
        //     case "hello_world":{
        //         return JasperReportsController::hello_world($input,$output,$options,$report,$ext,$user);
        //     }break;
        // }

    }
}

