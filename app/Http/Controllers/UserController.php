<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request as HttpRequest;

use Illuminate\Support\Facades\DB;

use PhpOffice\PhpSpreadsheet\Spreadsheet;

use PhpOffice\PhpSpreadsheet\Reader\Exception;

use PhpOffice\PhpSpreadsheet\Writer\Xls;
use Illuminate\Support\Facades\Request;
use PhpOffice\PhpSpreadsheet\Style\Fill;

use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;


use PhpOffice\PhpSpreadsheet\IOFactory;

class UserController extends Controller
{
    public function index() {

        return view('employee.index');
    }

    public function import(HttpRequest $request){
        $this->validate($request, [
            'uploaded_file' => 'required|file|mimes:xls,xlsx'
        ]);

        $the_file = $request->file('uploaded_file');
 
        try{
 
            $spreadsheet = IOFactory::load($the_file->getRealPath());
 
            $data        = $spreadsheet->getActiveSheet();
            $dataImport = $data->toArray();
            $array = array();
            $arrayall = array();
            // dd($dataImport);
            foreach ($dataImport as $key=>$value){
               if( $key >=0 && $key!=null && $value !== null){
                        $array = [
                            'name' => $value[0],
                            'email' => $value[1],
                            'password' => $value[2],
                            'role' => $value[3],
                        ];
                        
                        // dd($array);
                        array_push($arrayall, $array);
                        // print_r($array);
    
                }
            }
            // exit();
            // dd($arrayall);
           $query =  DB::table('users')->insert($arrayall);  
             
           
 
        } catch (Exception $e) {
 
            $error_code = $e->errorInfo[1];
 
 
 
 
            return back()->withErrors('There was a problem uploading the data!');
 
        }
 
        return back()->withSuccess('Great! Data has been successfully uploaded.');
    }
    public function add(){
           return view('admin.add');
    }
    public function insert(HttpRequest $request){
        // dd(1);
        // $name = Request::all();
        $name = $request->get('name');
        $email = $request->get('email');
        $password = $request->get('password');
        $add = $request->get('add');
        $read = $request->get('read');
        $update = $request->get('update');
        $delete = $request->get('delete');


        $user = User::create(
            [
                'name'=>$name,
                'email'=>$email,
                'password'=>$password
                
            ]
        );
            if($delete!=null){
                DB::table('user_roles')->insert(
                    [
                        'id_user'=>$user->id,
                        'id_role'=>$delete,
                    ]
                );
            }
            
            if($read!=null){
                DB::table('user_roles')->insert(
                    [
                        'id_user'=>$user->id,
                        'id_role'=>$read,
                    ]
                );
            }
            if($update!=null){
                DB::table('user_roles')->insert(
                    [
                        'id_user'=>$user->id,
                        'id_role'=>$update,
                    ]
                );
            }
            if($add!=null){
                DB::table('user_roles')->insert(
                    [
                        'id_user'=>$user->id,
                        'id_role'=>$add,
                    ]
                );
            }
            dd("thanh cong  ");

        // dd($name);

        // dd($name);
    }

    public function update($id){
        $user = User::find($id);
        $role_name = DB::table('user_roles')
        ->join('users', 'users.id', '=', 'user_roles.id_user')
        ->where('user_roles.id_user', '=', $id)
        ->select('user_roles.id_role')
        ->get();
        // dd();
        // dd($role_name);
        // dd($user);
        return view('admin.update',compact('user','role_name'));
    }
    function export(){
        $data = DB::table('users')->get();

        $data_array [] = array("name","email");
 
        foreach($data as $data_item)
        {
            $data_array[] = array(
                'name' =>$data_item->name,
                'email' =>$data_item->email,
            );
 
        }
 
        $this->ExportExcel($data_array);
    }
    public function ExportExcel($customer_data){
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');
        try {
            $spreadSheet = new Spreadsheet();
            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
            $spreadSheet->getActiveSheet()->getStyle('D')
            ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);
            $spreadSheet->getActiveSheet()->getStyle('D')
            ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);
           
        
            $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
            $drawing->setName('Paid');
            $drawing->setDescription('Paid');
            $drawing->setPath('images/logo.png'); // put your path and image here
            $drawing->setCoordinates('E1')->setWidth(250);
            $drawing->setOffsetX(110);
            $drawing->setRotation(25);
            $drawing->getShadow()->setVisible(true);
            $drawing->getShadow()->setDirection(45);
            $drawing->setWorksheet($spreadSheet->getActiveSheet());

            $active_sheet = $spreadSheet->getActiveSheet();
            $count =13;
            $spreadSheet    ->getActiveSheet()
            ->getStyle('D'.$count)
            ->getBorders()
            ->getOutline()
            ->setBorderStyle(Border::BORDER_THICK)
            ->setColor(new Color('FFFF0000'));
            $spreadSheet    ->getActiveSheet()
            ->getStyle('E'.$count)
            ->getBorders()
            ->getOutline()
            ->setBorderStyle(Border::BORDER_THICK)
            ->setColor(new Color('FFFF0000'));
            $active_sheet->setCellValue('D' . $count, 'Name');
            $active_sheet->setCellValue('E' . $count, 'Email');
            $fontStyle = [
                'font' => [
                    'size' => 16
                ]
            ];
            $active_sheet->setCellValue('D10', 'Danh sách nhân viên');
            
            $spreadSheet->getActiveSheet()
                ->getStyle("D10")
                ->applyFromArray($fontStyle);
            $count = 14;
            // $worksheet = $spreadSheet->getActiveSheet();
            // $worksheet->getStyle(13)->getFill()
        // ->setFillType(Fill::FILL_SOLID)
        // ->getStartColor()->setARGB('FFFF0000');

            for($i =1;$i<count($customer_data);$i++){
                $spreadSheet    ->getActiveSheet()
                ->getStyle('D'.$count)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_THICK)
                ->setColor(new Color('FFFF0000'));
                $spreadSheet    ->getActiveSheet()
                ->getStyle('E'.$count)
                ->getBorders()
                ->getOutline()
                ->setBorderStyle(Border::BORDER_THICK)
                ->setColor(new Color('FFFF0000'));
                
                $active_sheet->setCellValue('D' . $count, $customer_data[$i]['name']);
                $active_sheet->setCellValue('E' . $count, $customer_data[$i]['email']);
                $count++;
            }
      
            $Excel_writer = new Xls($spreadSheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="Customer_ExportedData.xls"');
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $Excel_writer->save('php://output');
            exit();
        } catch (Exception $e) {
            return;
        }
 
 
    }
 
}
