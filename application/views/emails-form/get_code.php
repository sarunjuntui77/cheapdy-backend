<html>
<head>
    <style type="text/css">
    *, ::after, ::before {
        box-sizing: border-box;
        font-size: 14px;
    }

    img {
        width: 100%;
    }

    div {
        width: 100%;
        float: left;
    }

    b {
        font-size: 1.5em;
    }

    a {
        text-decoration: none !important;
    }

    .mobile {
        display: none;
    }

    .row {
        display: block;
    }

    .container {
        width: 600px;
        margin: 0 auto;
        float: none;
        color: black;
        margin-bottom: 50px;
        height: 665px;
    }

    .title {
        font-size: 1.5em;
        height: 40px;
        padding-top: 10px;
    }

    .message {
        font-size: 1.7em;
        height: auto;
        padding-top: 20px;
    }

    .body {
    }

    .left {
        width: 40%;
        padding: 5px;
    }

    .text {
        width: 100%;
        padding-top: 10px;
        padding-bottom: 10px;
        height: 40px;
    }

    .provider {
        padding-top: 35px;
        text-align: center;
        font-size: 1.5em;
        font-weight: bold;
        background-color: #FCEE21;
        height: 110px;
    }

    .date {
        padding-top: 15px;
        font-size: 1.2em;
        background-color: #FCEE21;
        text-align: center;
        height: 55px;
        font-weight: bold;
    }

    .right {
        width: 60%;
        padding: 5px;
    }

    .code {
        padding-top: 60px;
        text-align: center;
        font-weight: bold;
        background-color: #FCEE21;
        height: 205px;
    }

    .code h1 {
        margin: 0;
        font-size: 5em;
    }

    .topic {
        height: 70px;
        padding-top: 20px;
        font-size: 2em;
        border-bottom: 3px solid #FCEE21;
        text-align: center;
    }

    .content {

    }

    .cancel-button {
        width: 150px;
    }

    @media only screen and (max-width: 480px){
        .pc {
            display: inline;
        }

        .mobile {
            display: none;
        }

        .container {
            width: 100%;
            margin: 0;
        }

        .code h1 {
            display: inline;
        }

        .code b {
            display: none;
        }
    }
</style>
</head>
<body>
    <?php
    $url = 'http://providers.cheapdy.com/scanqr?code='.$coupon['coupon_code'];
    $encrypt = $coupon['coupon_encrypt'];
    $number = $coupon['coupon_number'];
    ?>
    <img src="<?php echo base_url();?>images/headerEmail.jpg">
    <div class="container">
        <div class="head">
            <div class="title">
                เรียนคุณ <b><?php echo $coupon['coupon_name'];?></b>
            </div>
            <div class="message">
                ยินดีด้วยคุณได้รับรหัสโปรโมชั่น <b><?php echo $coupon['promotion_title'];?></b>
            </div>
        </div>
        <div class="body">
            <div class="left">
                <div class="text">
                    สามารถใช้ส่วนลดได้ที่ร้าน
                </div>
                <div class="provider">
                    <b><?php echo $coupon['provider_name'];?></b>
                </div>
                <div class="text">
                    *กรุณาใช้ส่วนลดภายในวันที่
                </div>
                <div class="date">
                    <b><?php echo $this->date_ui->get_thai_format($coupon['coupon_date']);?></b>
                </div>

            </div>
            <div class="right">
                <div class="text">
                    Your code is
                </div>
                <div class="code">
                    <h1><?php echo $coupon['coupon_code'];?></h1>
                </div>
            </div>
        </div>
        <div class="condition">
            <div class="topic">
                ขอบคุณที่ใช้บริการ โปรดอ่านข้อตกลงก่อนใช้ส่วนลด
            </div>
            <div class="content">
                <h2>ข้อตกลงการใช้ส่วนลด</h2>
                เงื่อนไขและข้อตกลงบริการของ Cheapdy<br>
                1.  กรุณาใช้รหัสส่วนลดภายในวันที่ได้รับรหัส ก่อนหมดสิทธิ์ เวลา เที่ยงคืน ในแต่ละวัน<br>
                2.  เมื่อท่านมาถึงร้าน โปรดแจ้งและโชว์รหัสส่วนลดว่าท่านได้ทำรายการจาก Cheapdy<br>
                3.  ทางร้านจะเช็ครหัสส่วนลดและยืนยันการใช้รหัสของท่าน<br>
                4.  ท่านจะได้รับอีเมล์ตอบกลับ จำนวนสะสมกับทาง Cheapdy เพื่อแลกของรางวัล<br>
                5.  ส่วนลดนี้สามารถใช้ได้กับรายการอาหารทั้งหมด ไม่รวมรายการเครื่องดื่ม (ยกเว้นอยู่ในเงื่อนไขนโยบายร้านอาหาร)<br>
                6.  ส่วนลดนี้ไม่สามารถใช้ร่วมกับโปรโมชั่นอื่นของทางร้านอาหารได้<br>
                7.  หากต้องการความช่วยเหลือ กรุณาติดต่อ Cheapdy.info@gmail.com. หรือโทรมาที่ 093-192-2649<br>
            </div>
        </div>
        <img src="https://chart.googleapis.com/chart?cht=qr&chs=300x300&chl=<?php echo $url;?>">
    </div>
</body>
</html>