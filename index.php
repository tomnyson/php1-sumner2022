<?php
$hovaTen = "Lê Hồng Sơn";
$tuoi = 29;
$soThuc = 10.5;
$gioiTinh = true; // true: nam, false: nữ
$rong = null;
$mang = [1, 2, 3, 4, 5];

// echo $hovaTen;
// print $tuoi;
// print $soThuc;
// nuối chuổi

echo "<h1>tên là:" . $hovaTen . "</h1></br>";
echo "<h1>tuoi:" . $tuoi . "</h1></br>";

// toản tử 
// só học: + / *  %

$a = 2;
$b = 4;
$cong = $a + $b;
$tru = $a - $b;
$chia = $b / $a;
$nhan = $a * $b;
$chiaLayDu = $b % $a;

echo "phép cộng:" . $a . " + " . $b . "=" . $cong . "<br/>";
echo "phép trừ: " . $tru . "<br/>";

// toán tử gán += -= *= /= %=
$b += $a;
echo $b . "<br/>";
$b -= $a;
echo $b . "<br/>";
$b *= $a;
echo $b . "<br/>";
$b /= $a;
echo $b . "<br/>";
$b %= $a;
echo $b . "<br/>";

// so sánh
$soThu1 = 1;
$soThu2 = 2;
$soThu3 = 3;
// logic and: && or: || not !
var_dump(($soThu3 > $soThu1 && !($soThu3 < $soThu2)));

echo $soThu1 == $soThu2;
echo $soThu1 === $soThu2 ? "true" : "false";
// echo ">=" . $soThu1 >= $soThu2;
// echo "<=" . $soThu1 <= $soThu2;
// echo ">" . $soThu1 > $soThu2;
// echo "<" . $soThu1 < $soThu2;

//câu điều kiện
// if else
echo "<h1>bài tập if else</h1>";
$tuoi_b1 = 16;
if ($tuoi_b1 >= 18) {
  echo "được thi bằng lái";
  //dung
} else {
  //sai
  echo "chưa đủ tuổi";
}


// Bài 3: giải phương trình bật 1 ax + b = 0
$a = 2;
$b = 8;
if ($a == 0) {
  echo "Phương trình có a = 0 nên vô nghiệm";
} else {
  echo "Phương trình có nghiệm là : " . (-$b / $a);
}

$a = 10;
$kiemtra = false;
if ($a % 2 == 0) {

  echo "so chan";
  $kiemtra = true;
} else {
  echo "so le";
}
if ($kiemtra == true && $a >= 10) {
  echo "so chan va lon hon 10";
}
// if  tính điểm tb và đưa ra xếp loại
$diemTb = 8.0;

if ($diemTb >= 9) {
  echo "<h1>xếp loại xuất sắc</h1>";
} else if ($diemTb >= 8) {
  echo "<h1>xếp loại giỏi</h1>";
} else if ($diemTb >= 6.5) {
  echo "<h1>xếp loại khá</h1>";
} else if ($diemTb >= 5) {
  echo "<h1>xếp loại tb</h1>";
} else {
  echo "<h1>xếp loại yếu</h1>";
}
// số thứ tự
/**
 * o: cn
 * 1: th
 * 2: t3
 * 3: t4
 * 4: t5
 * 5: t6
 * 6: t7
 */
$ngayHomNay = -1;

switch ($ngayHomNay) {
  case 0:
    echo "CN";
    break;
  case 1:
    echo "T2";
    break;
  case 2:
    echo "T3";
    break;
  case 3:
    echo "T4";
    break;
  case 4:
    echo "T5";
    break;
  case 5:
    echo "T6";
    break;
  case 6:
    echo "T7";
    break;
  default:
    echo "Ngày không hợp lệ";
    break;
}

//vong lặp
/**
 * for (init counter; test counter; increment counter) {
 */
/**
 * 0->100
 *  chỉ in ra giá trí chẵn
 *  tính tổng của các giá trị chẳn
 */
for ($i = 0; $i <= 100; $i++) {
  if ($i % 2 == 0) {
    echo "<span style='color: red'>" . $i . "</span> ";
  } else {
    echo "<span style='color: green'>" . $i . "</span> ";
  }
}
echo "<hr/>";
$i = 0;
/**
 * * in ra các số chia hết cho 3 và 5
 * tinh trung bình cộng 3 và 5
 * tạo bảng cửu chương 1->9
 * 
 */
while ($i <= 100) {
  echo "<span>" . $i . "</span> ";
  $i++;
}
