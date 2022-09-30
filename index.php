<!DOCTYPE html>

<?php
$now_month = date('n', time());
$db_con = new PDO("mysql:host=localhost;dbname=safety_box_transactions;charset=UTF8", "root", "");
$query = $db_con->prepare("SELECT * FROM tablo1 WHERE MONTH(add_date) = $now_month");
$query->execute();
$tablo1 = $query->fetchAll(PDO::FETCH_OBJ);
$query2 = $db_con->prepare("SELECT SUM(debt) as last_month_debt, SUM(receivable) as last_month_receivable FROM tablo1 WHERE MONTH(add_date) != $now_month");
$query2->execute();
$last_month = $query2->fetch(PDO::FETCH_OBJ);

if ($_POST) {
    $first_date = $_POST["first_date"] . " 00:00";
    $last_date = $_POST["last_date"] . " 23:59";
    $query = $db_con->prepare("SELECT * FROM tablo1 WHERE add_date > '$first_date' AND add_date < '$last_date'");
    $query->execute();
    $tablo1 = $query->fetchAll(PDO::FETCH_OBJ);
    $query2 = $db_con->prepare("SELECT SUM(debt) as last_month_debt, SUM(receivable) as last_month_receivable FROM tablo1 WHERE add_date < '$first_date'");
    $query2->execute();
    $last_month = $query2->fetch(PDO::FETCH_OBJ);
}

$total_debt = 0;
$total_receivable = 0;
$last_month_total = $last_month->last_month_receivable - $last_month->last_month_debt;

?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="post">
        Rapor Başlangıç Tarihi
        <input type="date" name="first_date" id="first_date" value="<?php echo @$_POST["first_date"] ?>">
        <br />
        Rapor Bitiş Tarihi
        <input type="date" name="last_date" id="last_date" value="<?php echo @$_POST["last_date"] ?>">
        <br />
        <input type="submit" value="Gönder">
    </form>
    <br />
    <table style="border:5px solid black; border-collapse:collapse; width:75%; margin:0 auto; text-align:center">
        <tr style="border:5px solid black; padding:10px; font-weight:bold">
            <td style="border:5px solid black; padding:10px;">id</td>
            <td style="border:5px solid black; padding:10px;">Müşteri adı</td>
            <td style="border:5px solid black; padding:10px; color:#f00">Borç</td>
            <td style="border:5px solid black; padding:10px; color:#4CAF50">Alacak</td>
            <td style="border:5px solid black; padding:10px;">Kalan</td>
            <td style="border:5px solid black; padding:10px;">Eklenme Tarihi</td>
        </tr>
        <tr style="border:5px solid black; padding:10px; font-weight:bold">
            <td style="border:5px solid black; padding:10px;" colspan="2">Bir önceki aydan devir : </td>
            <td style="border:5px solid black; padding:10px; color:#f00"><?php echo ($last_month_total < 0) ? $last_month_total : " "; ?></td>
            <td style="border:5px solid black; padding:10px; color:#4CAF50"><?php echo ($last_month_total > 0) ? $last_month_total : " "; ?></td>
            <td style="border:5px solid black; padding:10px;"><?php echo $last_month_total ?></td>
            <td>&nbsp;</td>
        </tr>
        <?php
        $customer_remainder_total = $last_month_total;
        foreach ($tablo1 as $list) {
            $customer_total = $list->receivable - $list->debt;
            $customer_remainder_total += $customer_total;
            $total_debt += $list->debt;
            $total_receivable += $list->receivable;
        ?>
            <tr style="border:5px solid black; padding:10px; font-weight: bold;">
                <td style="border:5px solid black; padding:10px;"><?php echo $list->id; ?></td>
                <td style="border:5px solid black; padding:10px;"><?php echo $list->customer_name; ?></td>
                <td style="border:5px solid black; padding:10px; color:#f00"><?php echo ($customer_total < 0) ? $customer_total : " "; ?></td>
                <td style="border:5px solid black; padding:10px; color:#4CAF50"><?php echo ($customer_total > 0) ? $customer_total : " "; ?></td>
                <td style="border:5px solid black; padding:10px;"><?php echo $customer_remainder_total ?></td>
                <td><?php echo $list->add_date; ?></td>
            </tr>
        <?php
        }
        $total = ($total_receivable + $last_month->last_month_receivable) - ($total_debt + $last_month->last_month_debt);
        ?>

        <tr style="border:5px solid black; padding:10px;">
            <td style="border:5px solid black; padding:10px; font-weight:bold" colspan="2">Toplam : </td>
            <td style="border:5px solid black; padding:10px; color:#f00; font-weight:bold"><?php echo ($total < 0) ? $total : " "; ?></td>
            <td style="border:5px solid black; padding:10px; color:#4CAF50; font-weight:bold"><?php echo ($total > 0) ? $total : " "; ?></td>
            <td style="border:5px solid black; padding:10px; font-weight:bold"><?php echo $total; ?></td>
        </tr>
    </table>
</body>

</html>