<?php 
require 'db.php';
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Get MAIL
$stmt = $conn->prepare("SELECT `id`, `asal`, `type`, `email`, `type_id`, `link` FROM `data`");
$stmt->execute();
while($row = $stmt->fetch()){
       try{
              if($row['type_id']==1){
                     $type_id = 'Ekstrakulikuler ';
              } else {
                     $type_id = '';
              }

       $mail = new PHPMailer;
       $mail->isSMTP();                                             //Send using SMTP
       $mail->Host       = 'smtp.example.com';                      //Set the SMTP server to send through
       $mail->SMTPAuth   = true;                                    //Enable SMTP authentication
       $mail->Username   = 'example@gmail.com';                     //SMTP username
       $mail->Password   = 'example';                               //SMTP password
       $mail->SMTPSecure = 'ssl';                                   //Enable implicit TLS encryption
       $mail->Port       = 465;                                     //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
       
       //Recipients
       $mail->setFrom('example@gmail.com', 'WJF 2022 - Youth Press Revolution');
       $mail->addAddress($row['email']);         
       
       //Attachments
       $mail->addAttachment($row['link']);    
       
       //Content
       $mail->isHTML(true);                            
       $mail->Subject = 'Undangan Webinar WJF 2022 (Youth Revolution Press)';
       $mail->Body    = '<p dir="ltr"><span>Yth. '.$row['type'].'</span></p>
       <p dir="ltr"><span>'.$row['asal'].'</span></p></p>
       <p dir="ltr"><span>di tempat&nbsp;</span></p>
       <p dir="ltr"><span>Dengan hormat,</span></p>
       <p dir="ltr"><span>Halo, selamat malam. Perkenalkan saya Tri Yatna, perwakilan dari LPM sEntra dari Universitas Widyatama Bandung berikut panitia Widyatama </span><em>Journalism Festival</em><span> (WJF) 2022, ingin menyampaikan surat undangan webinar yang bertemakan &ldquo;</span><em>Youth Revolution Press</em><span>&rdquo; yang akan diselenggarakan pada:</span></p>
       <p dir="ltr"><span>Hari</span><span>: Sabtu</span></p>
       <p dir="ltr"><span>Tanggal</span><span>: 21 Mei 2022</span></p>
       <p dir="ltr"><span>Waktu</span><span>: 09.00 WIB s.d. 14.00 WIB&nbsp;</span></p>
       <p dir="ltr"><span>Tempat</span><span>: </span><span>Online</span><span> via </span><span>Zoom Meeting</span><span> (link menyusul)&nbsp;</span></p>
       <p dir="ltr"><span>Untuk itu, saya selaku panitia mengundang '.$type_id.$row['asal'].' untuk ikut berpartisipasi dalam webinar tersebut (link untuk pendaftaran terdapat di dalam surat).</span></p>
       <p dir="ltr"><span>Demikian surat undangan ini saya sampaikan, atas perhatian dan segala partisipasinya saya ucapkan terimakasih.</span></p>
       <p dir="ltr"><span>Hormat saya,</span></p>
       <p dir="ltr"><span>Tri Yatna</span></p>
       <p dir="ltr"><span>(Perwakilan Panitia Acara WJF 2022)</span></p>
       <p><span>&nbsp;</span></p>';
       // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
       
       $mail->send();

echo $row['email'];
echo '<br>';
echo $type_id;
echo '<br>';
echo $row['asal'];
echo '<br>';
echo '<br>';
} catch (Exception $e) {
       echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
   }
}

?>