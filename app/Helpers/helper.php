<?php

function idr($amount)
{
    $result = number_format($amount, 2, ',', '.');
    return 'Rp. ' . $result;
}
