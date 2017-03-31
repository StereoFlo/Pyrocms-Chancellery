<?php defined('BASEPATH') OR exit('No direct script access allowed');

ini_set("memory_limit", "256M");

class Admin_report extends Admin_Controller
{

    public $section = 'report';

    /**
     * Admin_report constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->load->library('excel');
        $this->load->library('form_validation');
        $this->load->model('chancellery_m');
        $this->lang->load('chancellery');
        $this->load->model('users/user_m');
        $this->lang->load('chancellery');
    }

    /**
     * Index action
     */
    public function index()
    {
        $this->data->start_day = ['' => 'Select start day'];
        foreach (range(01, 31) as $d) {
            if ($d < 10) {
                $d = '0' . $d;
            }
            $this->data->start_day[$d] = $d;
        }
        $this->data->end_day = ['' => 'Select end day'];
        foreach (range(01, 31) as $d) {
            if ($d < 10) {
                $d = '0' . $d;
            }
            $this->data->end_day[$d] = $d;
        }

        $this->data->start_month = ['' => 'Select start month'];
        foreach (range(01, 12) as $d) {
            if ($d < 10) {
                $d = '0' . $d;
            }
            $this->data->start_month[$d] = $d;
        }
        $this->data->end_month = ['' => 'Select end month'];
        foreach (range(01, 12) as $d) {
            if ($d < 10) {
                $d = '0' . $d;
            }
            $this->data->end_month[$d] = $d;
        }

        $this->data->start_year = ['' => 'Select start year'];
        foreach (range(2000, 2050) as $d) {
            $this->data->start_year[$d] = $d;
        }
        $this->data->end_year = ['' => 'Select end year'];
        foreach (range(2000, 2050) as $d) {
            $this->data->end_year[$d] = $d;
        }

        $this->data->users = $this->user_m->dropdown('id', 'username');
        $this->template->title($this->module_details['name'])->build('admin/report', $this->data);
    }

    /**
     * @param null $action
     */
    public function excel($action = null)
    {
        $user = $this->input->post('user');
        $start_day = $this->input->post('start_day');
        $end_day = $this->input->post('end_day');

        $start_month = $this->input->post('start_month');
        $end_month = $this->input->post('end_month');

        $start_year = $this->input->post('start_year');
        $end_year = $this->input->post('end_year');

        if ($action == 'user' and $user != 999999) {
            $userGOI = $this->chancellery_m->get_ordered_items($user); //$user, date('m')
            $orderedItems = $userGOI->result();
            $count = $userGOI->num_rows();
            $this->make($count, $orderedItems);

        }
        if ($action == 'period') {
            $ordered_items_result = $this->chancellery_m->get_ordered_items_period($start_day, $start_month,
                $start_year, $end_day, $end_month, $end_year);
            $orderedItems = $ordered_items_result->result();
            $count = $ordered_items_result->num_rows();
            $this->make($count, $orderedItems);
        }
        if ($action == 'all') {
            $allGOI = $this->chancellery_m->get_ordered_items('', date('m'));
            $orderedItems = $allGOI->result();
            $count = $allGOI->num_rows();
            $this->make($count, $orderedItems);
            $this->chancellery_m->set_to_no_active();
        }


        $filename = 'request' . date('YmdHis') . '.xls';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');
        $objWriter->save('php://output');
    }

    private function make($count, $orderedItems)
    {

        $this->excel->setActiveSheetIndex(0);
        $this->excel->getActiveSheet()->setTitle('Заявка ' . date('YmdHis'));
        $this->excel->getActiveSheet()->getStyle('A1:G1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('A1:G1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $this->excel->getActiveSheet()->getStyle('A1:G' . (2 + $count))->getBorders()->getAllBorders()->setBorderStyle(PHPExcel_Style_Border::BORDER_THIN);
        //$this->excel->getActiveSheet()->getStyle('A3:M4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('BDBDBD');
        $this->excel->getActiveSheet()->getStyle('A2:G2')->getFont()->setBold(true);
        $this->excel->getActiveSheet()->getColumnDimension('A')->setWidth(25);
        $this->excel->getActiveSheet()->getColumnDimension('B')->setWidth(15);
        $this->excel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
        $this->excel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
        $this->excel->getActiveSheet()->getColumnDimension('E')->setWidth(15);
        $this->excel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
        $this->excel->getActiveSheet()->getColumnDimension('G')->setWidth(30);
        $this->excel->getActiveSheet()->setAutoFilter("A1:G" . (2 + $count));


        $this->excel->getActiveSheet()->SetCellValue('A1', 'Получатель');
        $this->excel->getActiveSheet()->SetCellValue('B1', '');
        $this->excel->getActiveSheet()->SetCellValue('C1', '');
        $this->excel->getActiveSheet()->SetCellValue('D1', 'ЕИ');
        $this->excel->getActiveSheet()->SetCellValue('E1', 'Пользовательский заказ');
        $this->excel->getActiveSheet()->SetCellValue('F1', 'ФС');
        $this->excel->getActiveSheet()->SetCellValue('G1', 'Наименование');
        $this->excel->getActiveSheet()->SetCellValue('A2', 'WEMPF');
        $this->excel->getActiveSheet()->SetCellValue('B2', 'MATNR');
        $this->excel->getActiveSheet()->SetCellValue('C2', 'ERFMG');
        $this->excel->getActiveSheet()->SetCellValue('D2', 'ERFME');
        $this->excel->getActiveSheet()->SetCellValue('E2', 'AUFNR');
        $this->excel->getActiveSheet()->SetCellValue('F2', 'FKBER');
        $this->excel->getActiveSheet()->SetCellValue('G2', '');

        $i = 3;
        foreach ($orderedItems as $item) {
            $kanz = $this->chancellery_m->get_kanz_by_id($item->kanz_id);
            $code = $this->chancellery_m->get_code_by_user($item->user);
            $this->excel->getActiveSheet()->SetCellValue("A$i", user_displayname($item->user, false));
            $this->excel->getActiveSheet()->SetCellValue('B' . $i, $kanz->kod1);
            $this->excel->getActiveSheet()->SetCellValue('C' . $i, $item->kolvo);
            $this->excel->getActiveSheet()->SetCellValue('D' . $i, $kanz->ed);
            $this->excel->getActiveSheet()->SetCellValue('E' . $i, isset($code[0]->code) ? $code[0]->code : '');
            $this->excel->getActiveSheet()->SetCellValue('F' . $i, $kanz->kod2);
            $this->excel->getActiveSheet()->SetCellValue('G' . $i, $kanz->name);
            $this->excel->getActiveSheet()->SetCellValue('H' . $i, $item->date);
            $i++;
        }
    }

}