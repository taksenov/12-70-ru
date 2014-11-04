<?php

    define("CONTACT_FORM", 'taksenov@gmail.com');

    function ValidateEmail($value){
        $regex = '/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i';

        if($value == '') {
            return false;
        } else {
            $string = preg_replace($regex, '', $value);
        }

        return empty($string) ? true : false;
    }

    $post = (!empty($_POST)) ? true : false;

    if($post){


        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $total = $_POST['total'];
        //$smstext = "Заказ орехи от ".$name." тел: ".$phone." сум: ".$total;
        $goods = $_POST['goods'];
        $tr = '';
        foreach ($goods as $item) {
            $tr = $tr . '<tr><td>' . $item['productNameRus'] . '</td>' .
            '<td>' . $item['productPrice'] . '</td>' .
            '<td>' . ((int)$item['amount'] + ' x ' + $item['productUnit']) . '</td>' .
            '<td>' . $item['productSum'] . '</td></tr>';
        }

//        $email = stripslashes($_POST['email']);
//
//        $htmlcode = stripslashes($_POST['htmlcode']) ;
//        $htmlcode = str_replace('<', '&lt;', $htmlcode);
//        $htmlcode = str_replace('>', '&gt;', $htmlcode);
//        $htmlcode = preg_replace("/(\n)/", "<br/>", $htmlcode);
//
//        $csscode = stripslashes($_POST['csscode']) ;
//        $csscode = preg_replace("/(\n)/", "<br/>", $csscode);


$subject = 'Заявка на комплектующие для сборки патронов';

$message = '
	<html>
		<head>
			<title>Заявка на орехи</title>
			<style>
		     td, th{
		      border: 1px solid #d4d4d4;
		      padding: 5px;
		     }
		  	</style>
		</head>
		<body>
			<h2>Заказ</h2>
			<table>
				<thead>
					<tr>
						<th>Название товара</th>
						<th>Цена (рубли)</th>
						<th>Вес (граммы)</th>
						<th>Сумма по товару</th>
					</tr>
				</thead>
				<tbody>'
				. $tr .
				'</tbody>
			</table>
			<p>Итого: ' . $total . ' руб.<p>
			<h2>Заказчик</h2>
			<table>
				<thead>
					<tr>
						<th>Имя</th>
						<th>Телефон</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>' . $name . '</td>
						<td>' . $phone . '</td>
					</tr>
				</tbody>
			</table>
		</body>
	</html>';


    $error = '';

    if(!$name)
    {
        $error .= 'Пожалуйста, введите ваше имя.<br />';
    }

    if(!$phone)
    {
        $error .= 'Пожалуйста, введите ваш телефон.<br />';
    }

    if (!ValidateEmail($email)){
        $error = 'Email введен неправильно!';
    }

    if(!$error){
        $mail = mail(
//            CONTACT_FORM,
         $email,
         $subject, $message,
             "From: Admin <root@ip34.ru>\r\n"
            ."Reply-To: ".$email."\r\n"
            ."Content-type: text/html; charset=utf-8 \r\n"
            ."X-Mailer: PHP/" . phpversion());

        if($mail){
            echo 'OK';
        }
    }else{
        echo '<div class="bg-danger">'.$error.'</div>';
    }

}
?>
