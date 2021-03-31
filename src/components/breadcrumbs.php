<?php
    class breadcrumbs
    {
        private array $breadcrumbList;
        private string $class;

        public function __construct(array $breadcrumbList, string $class) {
            $this->breadcrumbList = $breadcrumbList;
            $this->class = $class;
        }
        public function render()
        {
            echo "
            <nav class='breadcrumbs col-12 $this->class'>
                <ul>";
                foreach($this->breadcrumbList as $breadcrumb){
                    echo "<li class='breadcrumbs__breadcrumb'><a href='$breadcrumb[url]'>$breadcrumb[text]</a></li>";
                }
            echo "
                </ul>
            </nav>
            ";
        }
    }
    
?>
