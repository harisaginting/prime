<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

$spreadsheet 	= new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1', 'Hello World !');

$writer = new Xlsx($spreadsheet);
$writer->save('assets/tmp/temporary excel.xlsx');
 
class Hgn_Spreadsheet {
	private $CI;
	private $spreadsheet;
	private $sheet;
	private $wirter;

	private $header = array(
			'title' => 'Export to Excel'
			,'subject' => 'Export to Excel'
			,'description' => 'export to Excel'
			,'keywords' => 'Export to Excel'
			,'category' => 'Export to Excel'
			,'sheet_name' => 'Summary'
		);

	private $data = array(
			'title' => array()
			,'body' => array(
					array(1, "Lorem", "Lorem Ipsum Dolor Sit Amit")
					,array(2, "Ipsum", "Consectetur adipisicing elit Quia, distinctio")
				)			
		);


	public function __construct(){
		$this->CI = & get_instance();
		$this->spreadsheet = new Spreadsheet();
		$this->sheet 	   = $this->spreadsheet->getActiveSheet();
	}

	public function setHeader($params=array()){

		foreach ($this->header as $key => $value) {
			if(isset($params[$key])){
				$this->header[$key] = $params[$key];
			}
		}
	} 


	public function setDataTitle($data=array()){

		if(!is_array($data) || !isset($data[0]) || !isset($data[0]['name']) || !isset($data[0]['id']) || !isset($data[0]['width']))
			return;

		$this->data['title'] = $data;
	}



	public function create($filename, $data=array()){

		$this->data['body'] = $data;
		
		$this->_createHeader();	

		$this->spreadsheet->removeSheetByIndex(0);
		$this->spreadsheet->createSheet(0);

		$activeSheet = $this->spreadsheet->setActiveSheetIndex(0);

		// Add Header
		$border_style =  array(
			'font' => array('bold' => true)
	        ,'borders' => array(
	            'allborders' => array(
	                'color' => array('rgb' => '333333')
	            )
	        )
    	);

    	if(empty($this->data['title'])){
				$this->_dataTitle($data);
    		}

		$activeSheet->getStyle('A1:'.$this->_getCellHuruf(count($this->data['title'])-1).'1')->applyFromArray($border_style);
		$activeSheet->getRowDimension('1')->setRowHeight(20);
		

		foreach ($this->data['title'] as $key => $value) {
			$activeSheet->getColumnDimension($this->_getCellHuruf($key))->setWidth($value['width']);			
		}
				
		foreach ($this->data['title'] as $key => $value) {
			$cell = ''.$this->_getCellHuruf($key).'1';
			$activeSheet->setCellValue($cell, $value['name']);
		}

		foreach ($this->data['body'] as $key => $value) {
			$i = 0;
			foreach ($this->data['title'] as $key2 => $value2) {
				$isi = $value[$value2['id']];
				if(is_array($isi)) $isi = json_encode($isi);
				$activeSheet->setCellValue(''.$this->_getCellHuruf($key2).$this->_getCellAngka($key), $isi);

				$i++;
			}
		}

		foreach ($this->data['title'] as $key => $value) {
			if(isset($value['is_wrap'])){
				$activeSheet->getStyle(
					$this->_getCellHuruf($key).'1:'.$this->_getCellHuruf($key).$activeSheet->getHighestRow()
				)
				->getAlignment()->setWrapText(true); 
			}
		}

		foreach($activeSheet->getRowDimensions() as $rd) { 
		    $rd->setRowHeight(-1); 
		}
		
		$this->spreadsheet->setActiveSheetIndex(0);

		$callStartTime = microtime(true);

		$objWriter = new Xlsx($this->spreadsheet, 'Excel2007');
		
		$filename = $filename.'.xlsx';

		$path = APPPATH."/cache/report/";
		if(!is_dir($path)){
			@mkdir($path);
			@chmod($path, 0777);
		}

		$objWriter->save($path.$filename);
		$callEndTime = microtime(true);
		$callTime = $callEndTime - $callStartTime;

		// echo date('H:i:s') , " File written to " , str_replace('.php', '.xlsx', pathinfo(__FILE__, PATHINFO_BASENAME)) , EOL;
		// echo 'Call time to write Workbook was ' , sprintf('%.4f',$callTime) , " seconds" , EOL;
		// Echo memory usage
		// echo date('H:i:s') , ' Current memory usage: ' , (memory_get_usage(true) / 1024 / 1024) , " MB" , EOL;

		return $path.$filename;

		// $this->CI->load->helper('download');
		// force_download($path.$filename, NULL);

		// die();
	}

	private function _createHeader(){

		// Set document properties
		$this->spreadsheet->getProperties()->setCreator('PRIME APPS')
									 ->setLastModifiedBy('')
									 ->setTitle($this->header['title'])
									 ->setSubject($this->header['subject'])
									 ->setDescription($this->header['description'])
									 ->setKeywords($this->header['keywords'])
									 ->setCategory($this->header['category']);

		// Rename worksheet
		$this->spreadsheet->getActiveSheet()->setTitle($this->header['sheet_name']);

	}

	private function _dataTitle($data){
		$this->data['title'] = array();
		foreach ($data[0] as $key => $value) {
			$this->data['title'][] = array('name' => ucwords($key), 'id' => $key, 'width' => 30);
		}
	}

	private function _getCellHuruf($no=0){

		$alpha = array();
		foreach (range('A', 'Z') as $char) {
		    $alpha[] = $char;
		}

		$result = '';
		if($no > 25){
			$result = $alpha[floor($no/26)-1].$alpha[$no%26];
		}else{
			$result = $alpha[$no%26];
		}
		
		return $result;
	}	

	private function _getCellAngka($no=0){

		$result = $no+2;
		
		return $result;
	}


	public function read($file_path){
		$spreadsheet 	= IOFactory::load($file_path);
		$sheetData 		= $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
		return $sheetData;
	}


}
