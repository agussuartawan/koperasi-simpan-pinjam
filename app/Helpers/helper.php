<?php

function idr($angka)
{
    $hasil = number_format($angka, 0, ',', '.');
    return $hasil;
}
