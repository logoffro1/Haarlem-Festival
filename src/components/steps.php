<?php
    class steps
    {
        private int $activeStep;

        public function __construct(int $activeStep) {
            $this->activeStep = $activeStep;
        }

        public function render()
        {
            echo "
            <section>
                <ul class='steps'>
                    <li class='step " . $this->getActiveStep(1) . "'>
                        <a href='#'><span>Your Cart</span></a>
                    </li>
                    <li class='step " . $this->getActiveStep(2) . "'>
                        <a href='#'><span>Personal Details</span></a>
                    </li>
                    <li class='step " . $this->getActiveStep(3) . "'>
                        <a href='#'><span>Payment</span></a>
                    </li>
                    <li class='step " . $this->getActiveStep(4) . "'>
                        <a href='#'><span>Confirmation</span></a>
                    </li>
                </ul>
            </section>
            ";
        }

        private function getActiveStep(int $step) : string {
            return $step === $this->activeStep ? "step--active" : "";
        }
    }
    
?>