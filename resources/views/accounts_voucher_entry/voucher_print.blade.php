<div id="root" style="margin:2cm 0cm 0cm 0cm; padding:5px;">

    <div style="">
        <img src="{{ asset('assets/images/print/voucher_print.jpg') }}" alt="" width="100%;">
    </div><br>
    <div class="container" style="margin-top:15px;">
        <div class="col">
            <b style="font-size: 18px; margin-left:15px;">Voucher No :</b>
            <b>{{ !empty($voucher->transaction_no) ? $voucher->transaction_no : '' }}</b>
        </div>
        <div class="col">
            <b style="font-size: 22px; border: 1px solid black; padding:10px;">Voucher</b>
        </div>
        <div class="col">
            <b style="font-size: 18px;">Branch :</b>
            <b
                style="margin-right:15px; border-bottom: 1px solid black;">{{ !empty($voucher->transaction_no) ? $voucher->branch_name : '' }}</b><br>
            <b style="font-size: 18px;">Date &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</b>
            <b
                style="margin:10px 15px 0px 0px; border-bottom: 1px solid black;">{{ !empty($voucher->voucher_date) ? date('d-m-Y', strtotime($voucher->voucher_date)) : '' }}</b>
        </div>
    </div>

    <div style="margin-top:10px; padding:0px 14px 0px 14px;">
        <?php
        $paid_to = '';
        if (isset($voucher) && !empty($voucher->amount)) {
            $amount = $voucher->amount;
        }
        ?>
        <?php
        $name = '';
        if (isset($voucher->transaction_type)) {
            if ($voucher->transaction_type == 1) {
                $name = 'Receipt For : ';
            } else {
                $name = 'Paid To : ';
            }
        }
        ?>
        <p> <?php echo $name; ?></p>
        <p class="description">{{ !empty($voucher->sub_ledger) ? $voucher->sub_ledger : '' }}
            <hr>
        </p>
        <p>Being / towards</p><br><br>
        <b>{{ !empty($voucher->narration) ? $voucher->narration : '' }}</b>
        <hr><br>
        <hr style="">
    </div><br>
    <?php
    $number = !empty($voucher->amount) ? $voucher->amount : 0;
    function convertAmountToWords($number)
    {
        $no = round($number);
        $point = round($number - $no, 2) * 100;
        $hundred = null;
        $digits_1 = strlen($no);
        $i = 0;
        $str = [];
        $words = ['0' => '', '1' => 'one', '2' => 'two', '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six', '7' => 'seven', '8' => 'eight', '9' => 'nine', '10' => 'ten', '11' => 'eleven', '12' => 'twelve', '13' => 'thirteen', '14' => 'fourteen', '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen', '18' => 'eighteen', '19' => 'nineteen', '20' => 'twenty', '30' => 'thirty', '40' => 'forty', '50' => 'fifty', '60' => 'sixty', '70' => 'seventy', '80' => 'eighty', '90' => 'ninety'];
        $digits = ['', 'hundred', 'thousand', 'lakh', 'crore'];
    
        while ($i < $digits_1) {
            $divider = $i == 2 ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += $divider == 10 ? 1 : 2;
    
            if ($number) {
                $plural = ($counter = count($str)) && $number > 9 ? 's' : null;
                $hundred = $counter == 1 && $str[0] ? ' and ' : null;
                $str[] = $number < 21 ? $words[$number] . ' ' . $digits[$counter] . $plural . ' ' . $hundred : $words[floor($number / 10) * 10] . ' ' . $words[$number % 10] . ' ' . $digits[$counter] . $plural . ' ' . $hundred;
            } else {
                $str[] = null;
            }
        }
    
        $str = array_reverse($str);
        $result = implode('', $str);
    
        $points = $point ? '' . $words[$point / 10] . ' ' . $words[($point = $point % 10)] : '';
    
        if ($points != '') {
            return ucwords($result) . ' Rupees ' . $points . ' Paise Only';
        } else {
            return ucwords($result) . ' Rupees Only';
        }
    }
    ?>
    <div style="padding:0px 14px 0px 14px;">
        <p>Sum of Rupees :</p>
        <p class="description"> <?php echo convertAmountToWords($number); ?>
            <hr>
        </p>
    </div><br>

    <div class="container" style="padding:0px 14px 0px 14px; margin-bottom:10px;">
        <div class="col" style="padding:8px; border: 1px solid black;">
            <?php
            $amount = 0;
            if (isset($voucher) && !empty($voucher->amount)) {
                $amount = $voucher->amount;
            }
            ?>
            <b style="font-size: 22px;">Rs. </b> <b style="border-bottom: 1px solid black;"><?php echo $amount; ?>.00/-</b>
        </div>
        <div class="col" style="padding:15px 0px 0px 0px;">
            <b style="font-size: 18px;">Posted By :</b><b style="font-size: 18px;">
                {{ !empty($voucher->transaction_no) ? $voucher->branch_name : '' }}</b>
        </div>
        <div class="col">
            <hr>
            <b style="font-size: 18px;">Receiver's Signature</b><br>
        </div>
    </div>
</div>
<style>
    #root {
        border: 1px solid black;
    }

    .container {
        display: flex;
        justify-content: space-between;
        /* align-items: center; */
    }

    p {
        font-size: 18px;
        /* margin-left: 15px; */
        width: 20%;
        font-weight: bold;
        display: inline;
    }

    p.description {
        width: 80%;
        font-weight: bold;
        /* border-bottom: 1px solid black; */
        display: inline;
    }

    hr {
        border: 1px solid rgb(143, 127, 127);
    }
</style>
