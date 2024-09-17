<?php
class Shell {
    protected $jenis_bensin;
    protected $harga_per_liter;

    public function __construct($jenis_bensin, $harga_per_liter) {
        $this->jenis_bensin = $jenis_bensin;
        $this->harga_per_liter = $harga_per_liter;
    }

    public function getJenisBensin() {
        return $this->jenis_bensin;
    }

    public function getHargaPerLiter() {
        return $this->harga_per_liter;
    }
}

class Beli extends Shell {
    protected $jumlah_bensin;

    public function __construct($jenis_bensin, $harga_per_liter, $jumlah_bensin) {
        parent::__construct($jenis_bensin, $harga_per_liter);
        $this->jumlah_bensin = $jumlah_bensin;
    }

    public function getTotalHarga() {
        return $this->getHargaPerLiter() * $this->jumlah_bensin;
    }

    public function strukPembelian() {
        echo "<div style='width: 500px; margin: 20px auto; padding: 20px; border: 1px solid #ccc; border-radius: 10px; background-color: #fff; box-shadow: 0 4px 8px rgba(0,0,0,0.1);'>";
        echo "<p style='border-bottom: 1px solid #000; padding-bottom: 10px; text-align: center;'>------------------------------------------------------------------------------------------------</p>";
        echo "<p style='font-size: 16px; font-weight: bold; text-align: center;'>Anda Membeli Bahan Bakar Minyak Tipe " . ucfirst(str_replace('_', ' ', $this->getJenisBensin())) . "</p>";
        echo "<p style='font-size: 14px; text-align: center;'>Dengan Jumlah: " . $this->jumlah_bensin . " Liter</p>";
        echo "<p style='font-size: 14px; text-align: center;'><strong>Total Yang Anda Harus Bayar: Rp " . number_format($this->getTotalHarga(), 0, ',', '.') . "</strong></p>";
        echo "<p style='font-size: 14px; text-align: center;'>Harga per liter: Rp " . number_format($this->getHargaPerLiter(), 0, ',', '.') . "</p>";
        echo "<p style='font-size: 14px; text-align: center;'>Total PPN 10%: Rp " . number_format($this->getTotalHarga() * 0.10, 0, ',', '.') . "</p>";
        echo "<p style='border-bottom: 1px solid #000; padding-bottom: 10px; text-align: center;'>------------------------------------------------------------------------------------------------</p>";
        echo "</div>";
    }
    
    
}

$harga_bensin = array(
    "Shell_Super" => 15420 + 15420 * 0.10,
    "Shell_V_Power" => 16130 + 16130 * 0.10,
    "Shell_V_Power_Diesel" => 18130 + 18130 * 0.10,
    "Shell_V_Power_Nitro" => 16510 + 16510 * 0.10
);

if (isset($_POST['submit'])) {
    $jenis_bensin = $_POST['jenis_bensin'];
    $jumlah_bensin = $_POST['jumlah_bensin'];

    $harga_per_liter = $harga_bensin[$jenis_bensin];

    $pembelian = new Beli($jenis_bensin, $harga_per_liter, $jumlah_bensin);

    $pembelian->strukPembelian();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pom Bensin</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="box">
    <h2>Pom Bensin</h2>
    <form method="post" action="" class="Form">
        <label for="jumlah_bensin">Jumlah (Liter):</label>
        <input type="number" name="jumlah_bensin" id="jumlah_bensin" min="1" required>
        <br><br>
        <label for="jenis_bensin">Jenis Bensin:</label>
        <select name="jenis_bensin" id="jenis_bensin">
            <?php foreach($harga_bensin as $jenis => $harga) { ?>
                <option value="<?php echo $jenis; ?>"><?php echo ucfirst(str_replace('_', ' ', $jenis)); ?></option>
            <?php } ?>
        </select>
        <input type="submit" name="submit" value="Beli">
        <input type="button" name="print" onclick="window.print(); return false; "value="print">
    </form>
    </div>
</body>
</html>
