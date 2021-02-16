<?php
    class breadcrumbs
    {
        private array $breadcrumbList;

        public function __construct(array $breadcrumbList) {
            $this->breadcrumbList = $breadcrumbList;
        }
        public function render()
        {
            echo "
            <nav class='breadcrumbs'>
                <ul>";
                foreach($this->breadcrumbList as $breadcrumb){
                    echo "<li class='breadcrumbs__breadcrumb'><a href='$breadcrumb->url'>$breadcrumb->text</a></li>";
                }
            echo "
                </ul>
            </nav>
            ";
        }
    }
    
?>
