<?php
$totalBelanja = 600000;

if ($totalBelanja >= 100000){
    $diskon = 15;
}else if ($totalBelanja >= 300000){
    $diskon = 20;
}else if ($totalBelanja >= 500000){
    $diskon = 30;
}else {
    $diskon = 0;
}

$potonganHarga = $totalBelanja * $diskon / 100;
$setelahDiskon = $totalBelanja - $potonganHarga;

echo "Total Belanja Sebelum Diskon : Rp. $totalBelanja \n";
echo "Diskon : $diskon % \n";
echo "Harga Setelah Diskon : Rp. $setelahDiskon \n";
?>

//===== TEMA 2 =====

<?php
$mahasiswa = [
    "Ammar" => 100,
    "Bintang " => 90,
    "Habib " => 80,
    "Zidane " => 70,
    "Budi " =>60,
    "Cece "=> 20
];

foreach ($mahasiswa as $nama => $nilai){
    echo "Nama : $nama, Nilai : $nilai \n";

    if ($nilai >= 100){
        echo "Grade : A \n";
    }else if ($nilai >= 90){
        echo "Grade : B \n";
    }else if ($nilai >= 80){
        echo "Grade : C \n";
    }else if ($nilai >= 70){
        echo "Grade : D \n";
    }else {
        echo "Grade : E \n";
}
}
?>


