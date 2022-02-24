<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
class ContactController extends Controller
{
    //
    public function index(){

        return view('index');
    }

    public function sendcontact(Request $req){
        $con= new Contact();
        $con->name=$req->name;
        $con->subject=$req->subject;
        $con->message=$req->message;
        $con->save();
        if($con){
            require base_path("vendor/autoload.php");
                $mail = new PHPMailer(true);
                //$mail->SMTPDebug = 0;
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'brightevuka2017@gmail.com';//'brightevuka2017@gmail.com';
                $mail->Password = 'Myfather';
                $mail->SMTPSecure = "tls";//PHPMailer::ENCRYPTION_STARTTLS;
                $mail->port = 587;
                $mail->setFrom('brightevuka2017@gmail.com', $req->name);
                $mail->addAddress('brightevuka2017@gmail.com');
                //$mail->addAddress = env($req->memail);
                $mail->addReplyTo('brightevuka2017@gmail.com');
                $mail->isHTML(true);
                $mail->Subject = $req->subject;
                $mail->Body = $req->message;
               // $mail->Body = "You are getting this message because you trying to get in touch with N.I.B";
                $sent =$mail->send();
                if($sent){
                    return redirect()->back()->with('status','sent');
                }else{
                    return redirect()->back()->with('status','error');
                }
        }

    }
}
