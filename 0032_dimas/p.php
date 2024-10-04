<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perhitungan Diskon Belanja</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
            margin: 60px;
            background: green;

        }

        .container {
            width: 400px;
            background: white;
            border-radius: 10px;
            padding: 30px 40px;
        }

        .card-header {
            height: 10vh;
            text-align: center;
        }
        

        h1 {
            font-size: 24px;
            color: #333;
        }

        label, select, input[type="text"] {
            display: block;
            margin-bottom: 10px;
            font-size: 16px;
        }

        input[type="text"], select {
            padding: 5px;
            width: 200px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .detail-belanja {
            margin-top: 20px;
            font-size: 18px;
            line-height: 1.6;
        }

        .detail-belanja p {

            margin: 5px 0;
        }


    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4>Perhitungan Diskon Belanja</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="">
                    <div class="form">
                        <label for="totalBelanja">Total Belanja (Rp):</label>
                        <input type="number" class="form-control" id="totalBelanja" name="totalBelanja" required>
                    </div>
                    <div class="form-group">
                        <label for="isMember">Apakah Member?</label>
                        <select class="form-control" id="isMember" name="isMember" required>
                            <option value="1">Ya</option>
                            <option value="0">Tidak</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Hitung</button>
                </form>

                <?php
                function hitungTotalBelanja($totalBelanja, $isMember) {
                    $diskon = 0;

                    if ($isMember) {
                        if ($totalBelanja >= 1000000) {
                            $diskon = 0.15;
                        } elseif ($totalBelanja >= 500000) {
                            $diskon = 0.10;
                        } else {
                            $diskon = 0.10;
                        }
                    } else {
                        if ($totalBelanja >= 1000000) {
                            $diskon = 0.10;
                        } elseif ($totalBelanja >= 500000) {
                            $diskon = 0.05;
                        } else {
                            $diskon = 0;
                        }
                    }

                    $potongan = $totalBelanja * $diskon;
                    $totalSetelahDiskon = $totalBelanja - $potongan;

                    return [
                        'totalBelanja' => $totalBelanja,
                        'diskon' => $diskon,
                        'potongan' => $potongan,
                        'totalSetelahDiskon' => $totalSetelahDiskon
                    ];
                }

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $totalBelanja = $_POST['totalBelanja'];
                    $isMember = $_POST['isMember'];

                    $hasil = hitungTotalBelanja($totalBelanja, $isMember);
                    echo "<div class='alert alert-success mt-3'>";
                    echo "<h5>Detail Belanja:</h5>";
                    echo "<p>Total Belanja: Rp " . number_format($hasil['totalBelanja'], 0, ',', '.') . "</p>";
                    echo "<p>Diskon: " . ($hasil['diskon'] * 100) . "%</p>";
                    echo "<p>Potongan: Rp " . number_format($hasil['potongan'], 0, ',', '.') . "</p>";
                    echo "<p>Total Setelah Diskon: Rp " . number_format($hasil['totalSetelahDiskon'], 0, ',', '.') . "</p>";
                    echo "</div>";
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>