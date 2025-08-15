<?php
function formatUang($number) {
    return 'Rp ' . number_format($number, 2, ',', '.');
}