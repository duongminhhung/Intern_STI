<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Imports\UsersImport;
use Illuminate\Support\Facades\Session;

use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

class Admin extends Component
{
    use WithFileUploads;
    
    public $export,$import,$name_file,$save,$photo;
    public function render()
    {

         foreach (Session::get('username') as $item){
            $id = $item->id;
            break;
         }
        //  dd($id);
        $user = User::paginate(10);
        $role_name = DB::table('user_roles')
        ->join('users', 'users.id', '=', 'user_roles.id_user')
        ->join('roles', 'roles.id', '=', 'user_roles.id_role')
        ->where('users.id', '=', $id)
        ->get();

        // dd($user->links());
    
        // dd($role_name);
        return view('livewire.admin',compact('user','role_name'));
    }
    // public function export(){
    //     return Excel::download(new UsersExport,'user-data.xlsx');
    // }

    
    /**
     *This function loads the customer data from the database then converts it
     * into an Array that will be exported to Excel
     */
    function export(){
        $data = DB::table('users')->get();

        $data_array [] = array("name");
 
        foreach($data as $data_item)
        {
            $data_array[] = array(
                'name' =>$data_item->name,
            );
 
        }
        // dd($data_array);
 
        $this->ExportExcel($data_array);
    }
    public function ExportExcel($customer_data){
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');
 
        try {
            $spreadSheet = new Spreadsheet();
 
            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(20);
            $spreadSheet->getActiveSheet()->getStyle('A')
            ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);
            $spreadSheet->getActiveSheet()->getStyle('A')
            ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_RED);
            $spreadSheet->getActiveSheet()->fromArray($customer_data);
            $Excel_writer = new Xls($spreadSheet);
 
 
            header('Content-Type: application/vnd.ms-excel');
 
            header('Content-Disposition: attachment;filename="Customer_ExportedData.xls"');
 
            header('Cache-Control: max-age=0');
 
            ob_end_clean();
            // dd(1);
            $Excel_writer->save('php://output');
            // dd(1);
            exit();
 
        } catch (Exception $e) {
            return;
        }
 
 
    }
    public function import(){
        return Excel::import(new UsersImport,$this->name_file);
    }
   
}
