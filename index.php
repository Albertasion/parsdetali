<?php
include_once 'functions.php';
require 'phpQuery.php';
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


//отримуємо всі головні посилання
$request = requests('https://detali.org.ua/uk/');
$output = phpQuery::newDocument($request);
$menu = $output->find('.cbp-vertical-on-top li a');
foreach ($menu as $key => $value){
  $pq = pq($value);
  $src_menu[] = $pq->attr("href");
}
//перевіряемо уникальність посилань
$src_menu_formated = array_diff($src_menu, array('', NULL, false));

echo "Табиця заполнена";
format($src_menu_formated);
//отримуємо головні сабменю
foreach ($src_menu_formated as $value) {
  // if ($value == 'https://detali.org.ua/uk/102-zapchasti-dlya-betonomeschalki') {
  //   break;
  // }
  $request_menus = requests($value);
  $output = phpQuery::newDocument($request_menus);
  $submenu = $output->find('.subcategory-image a');
  foreach ($submenu as $key =>$value){
  $pq = pq($value);
  $href = $pq->attr("href");
  $src_submenu[] = $href;
    echo $src_menu[$key]. '<br>';
}
}
$src_menu_unique = array_unique($src_submenu);
format($src_menu_unique);
echo count($src_submenu);
echo count($src_menu_unique);



// //отримуємо сабменю3
// foreach ($src_submenu as $value) {
  // if ($value == 'https://detali.org.ua/uk/84-zapchasti-dlya-benzopil') {
  //   break;
  // }
//   $request_menus1 = requests($value);
//   $output1 = phpQuery::newDocument($request_menus1);
//   $submenu1 = $output1->find('.subcategory-image a');
//   foreach ($submenu1 as $key =>$value){
//   $pq = pq($value);
//   $src_submenu_category[] = $pq->attr("href");
// }
// }
// echo "Сабменю заповнено";



// //отримуємо сабменю4
// foreach ($src_submenu_category as $value) {
// $request_menus2 = requests($value);
// $output2 = phpQuery::newDocument($request_menus2);
// $submenu2 = $output2->find('.product-name-container a');
//   foreach ($submenu2 as $key =>$value){
//   $pq = pq($value);
//   $src_submenu_category_last[] = $pq->attr("href");
// }
// }
// echo "Сабменю последнее заповнено";





// $spreadsheet = new Spreadsheet();
// $sheet = $spreadsheet->getActiveSheet();
// foreach ($src_menu_formated as $key => $value) {
//   $sheet->setCellValue('A'. $key, $value);
//   }
// foreach ($src_submenu as $key => $value) {
// $sheet->setCellValue('B'. $key, $value);
// }

// foreach ($src_submenu_category as $key => $value) {
//   $sheet->setCellValue('C'. $key, $value);
//   }

//   foreach ($src_submenu_category_last as $key => $value) {
//     $sheet->setCellValue('D'. $key, $value);
//     }


// $writer = new Xlsx($spreadsheet);
// $writer->save('Links.xlsx');
