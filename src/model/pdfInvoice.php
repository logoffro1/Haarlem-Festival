<?php
    include '../classes/autoloader.php';
    require __DIR__ . '/../vendor/autoload.php';

    //  Made by Cosmin Ilie
    // This class generates an PDF invoice for the customer
    class pdfInvoice {
        private string $id;
        private array $cartItems;
        private string $customerName;
        private string $discount;

        public function __construct(string $id, cart $cart = null, string $customerName)
        {
            $this->id = $id;
            $this->cartItems = $cart->__get('cartItems');
            $this->customerName = $customerName;
            $this->discount = $cart->getDiscount();
            
        }

        public function __get($property) {
            if (property_exists($this, $property)) {
                return $this->$property;
            }
        }

        public function generateInvoice(){
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
                        <td><h1>INVOICE<strong> #'.$this->id.'</strong></h1></td>
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
                        <strong>'.$this->customerName.'</strong>
                        <br/>
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
            $discount = 0;
                foreach($this->cartItems as $item){

                    $each_item = $item->__get('title');
                    $each_price = $item->__get('price');
                    $each_quantity = $item->__get('count');
                    $each_total = $each_price*$each_quantity;

                        if($item->__get('itemType') != cartItemType::Cuisine)
                            $total += $each_quantity * $each_price;
                        else
                            $total += $each_price;

                    $cuisineColor = $this->getCuisineColor($item->__get('itemType'));

                   
                    

                    $html .= '
                    <tr>
                        <td  colspan = "2" style="border-bottom: 1px solid #222;border-left:6px solid '.$cuisineColor.'">'.$each_item.'<br>'
                            .$item->__get('address').'<br><strong>'
                            
                            .$item->__get('day').' - '.$item->__get('date').' | '.$item->__get('time').'</strong><br>'.
                            '<span style = "color:#737373">'.$item->__get('additionalInfo').'</span>
                        </td>
                        
                        <td style="border-bottom: 1px solid #222">$'.$each_total.'</td>
                        <td style="border-bottom: 1px solid #222">'.$each_quantity.'</td>
                        <td style="border-bottom: 1px solid #222">$'.$each_total.'</td>
                    </tr>
                    ';
                }
                $discount = $total/10;
                $totalWDiscount = $total-$discount;
            $html .='
            <tr align="right">
            <td colspan="5"><strong>Discount: $'.$discount.'</strong></td>
        </tr>
                    <tr align="right">
                        <td colspan="5"><strong>Grand total: $'.$totalWDiscount.'</strong></td>
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
            return $pdf->Output('Haarlem_Festival_Invoice.pdf','S');
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