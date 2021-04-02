<?php
    include '../classes/autoloader.php';
    require __DIR__ . '/../../vendor/autoload.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //  Made by Cosmin Ilie
    // This class generates an PDF invoice and emails it to the customer
    class pdfInvoice {
        private string $sendToMail;
        private string $sendFromMail;
        private array $cartItems;

        public function __construct(cart $cart = null, string $sendToMail)
        {
            $this->sendToMail = $sendToMail;
            $this->sendFromMail = "thehaarlemfestival@gmail.com";
            $this->cartItems = $cart->__get('cartItems');

            $this->sendInvoiceByMail();
        }

        public function __get($property) {
            if (property_exists($this, $property)) {
                return $this->$property;
            }
        }

        private function generateInvoice(){
            //content
            $html = '
            <style>
            table, tr, td {
            padding: 15px;
            }
            </style>
            <table style="background-color: #222222; color: #fff">
                <tbody>
                    <tr>
                        <td><h1>INVOICE<strong> #'.rand().'</strong></h1></td>
                        <td align="right"><img src="../assets/images/svg/logo-white.svg" height="50px"/><br/>

                        Netherlands, Haarlem	<br/>
                        <strong>thehaarlemfestival@gmail.com</strong>
                        </td>
                    </tr>
                </tbody>
            </table>
            ';
            $html .= '
            <table>
                <tbody>
                    <tr>
                        <td>Invoice to<br/>
                        <strong>'.$customer.'</strong>
                        <br/>
                        '.$address.'
                        </td>
                        <td align="right"> 
                        Invoice Date: '.date('d-m-Y').'
                        </td>
                    </tr>
                </tbody>
            </table>
            ';
            $html .= '
            <table>
                <thead>
                    <tr style="font-weight:bold;">
                        <th  colspan = "2" >Item name</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
            <tbody>';
            $total = 0;
                foreach($this->cartItems as $item){
                    $each_item = $item->__get('title');
                    $each_price = $item->__get('price');
                    $each_quantity = $item->__get('count');
                    $each_total = $each_price*$each_quantity;
                    $total+=$each_total;
                    $cuisineColor = $this->getCuisineColor($item->__get('itemType'));

                    $html .= '
                    <tr>
                        <td  colspan = "2" style="border-bottom: 1px solid #222;border-left:6px solid '.$cuisineColor.'">'.$each_item.'<br>'
                            .$item->__get('address').'<br><strong>'
                            
                            .$item->__get('day').' - '.$item->__get('date').' | '.$item->__get('time').'</strong><br>'.
                            '<span style = "color:#737373">'.$item->__get('additionalInfo').'</span>
                        </td>
                        
                        <td style="border-bottom: 1px solid #222">$'.$each_price.'</td>
                        <td style="border-bottom: 1px solid #222">'.$each_quantity.'</td>
                        <td style="border-bottom: 1px solid #222">$'.$each_total.'</td>
                    </tr>
                    ';
                }
                
            $html .='
                    <tr align="right">
                        <td colspan="5"><strong>Grand total: $'.$total.'</strong></td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <h2>Thank you for your business.</h2><br/>
                        </td>
                    </tr>
                </tbody>
            </table>
            ';
            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $pdf->SetMargins(-1, 0, -1);
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);
            $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
            // set image scale factor
            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
            // set default font subsetting mode
            $pdf->setFontSubsetting(true);
            $pdf->AddPage();
            $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 0, 0, true, '', true);
            return $pdf->Output('invoice.pdf','S');
        }

        private function sendInvoiceByMail(){
            $pdf  = $this->generateInvoice();
            try{
                $mail = new PHPMailer();
                $mail->IsSMTP();  // telling the class to use SMTP
                $mail->SMTPSecure = 'tls';  
                $mail->Mailer = "smtp";
                $mail->Host = "smtp.gmail.com";
                $mail->Port = 587;
                $mail->SMTPAuth = true; // turn on SMTP authentication
                $mail->Username = $this->sendFromMail; // SMTP username
                $mail->Password = "Thehaarlemfestival123"; // SMTP password
                $Mail->Priority = 1;  
                $mail->AddAddress($this->sendToMail,"Customer");
                $mail->SetFrom($this->sendFromMail, "The Haarlem Festival");
                $mail->Subject  = "Your Haarlem Festival Invoice";
                $mail->AddStringAttachment($pdf,'invoice.pdf','base64','application/pdf');
                $mail->Body     = "This is your generated invoice.";
                $mail->WordWrap = 50;
        
                if(!$mail->Send()){
                    echo "<script> alert('Error sending the email');</script>";
                }
            } catch(Exception $e){
                echo $e->getMessage();
            }
        }

        //returns the specified cuisine color
        private function getCuisineColor(int $cuisineType){
            if($cuisineType == 0) //jazz
                return "#F1185C";
            else if($cuisineType == 1) //dance
                return "#A336FF";
            else if($cuisineType == 1) // history
                return "#01DAC5";
            else return "#FFAA01"; //cuisine
        }
    }
?>