<?php
// mảng 1 chiều
$mang = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10);
$mang2 = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10];
// truy xuất
// echo $mang[0];
// echo $mang2[1];
// for
for ($i = 0; $i < count($mang); $i++) {
  echo $mang[$i] . "</br>";
};
// foreach
foreach ($mang as $value) {
  echo $value . "</br>";
}

$mang_ass = array(
  "ten" => "Lê Hồng Sơn",
  "tuoi" => 28,
  "dtb" => 7.5
);
// echo $mang_ass["ten"];
// echo $mang_ass["tuoi"];
// echo $mang_ass["dtb"];

foreach ($mang_ass as $key => $value) {
  echo "key: " . $key . " | value: " . $value . "</br>";
}

// mang 2 chieu
// danh sach sv it
$mang2chieu = array(
  array(
    "mssv" => "sv01",
    "ten" => "Lê Hồng Sơn",
    "tuoi" => 28,
    "dtb" => 7.5
  ),
  array(
    "mssv" => "sv02",
    "ten" => "nguyen van B",
    "tuoi" => 28,
    "dtb" => 7.5
  )
);

for ($i = 0; $i < count($mang2chieu); $i++) {
  foreach ($mang2chieu[$i] as $key => $value) {
    echo "key: " . $key . " | value: " . $value . "</br>";
  }
  echo "<hr/>";
}
// sắp xếp
$mang_sx = [3, 7, 8, 2];
// tang dan
rsort($mang_sx);

for ($i = 0; $i < count($mang_sx); $i++) {
  echo $mang_sx[$i] . "</br>";
}
// 

function sum($a, $b = 4)
{
  return $a + $b;
}

echo "Tổng của 2 số:" . sum(1);

//bài tập áp dụng
$mang_thuThi = range(0, 100);
/**
 * Lab2:
 * chỉ xuất ra giá trị chẵn hoặc chia hết cho 6 trong mảng
 * chỉ in lẻ
 * tính tổng của dãy số lẻ của mảng
 * tinh trung bình công
 * in ra số nguyên tố
 * có xây dựng hàm 1đ
 */