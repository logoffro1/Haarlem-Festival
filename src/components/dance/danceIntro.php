<?php
    class danceIntro
    {
        private string $title;
        private string $subtitle;
        private string $body;
        private string $artistSectionTitle;
        private string $bookMoreSaveMoreTitle;
        private string $bookMoreSaveMoreContent;

        public function __construct(string $title, string $subtitle, string $body, string $artistSectionTitle, string $bookMoreSaveMoreTitle, string $bookMoreSaveMoreContent)
        {
            $this->title = $title;
            $this->subtitle = $subtitle;
            $this->body = $body;
            $this->artistSectionTitle = $artistSectionTitle;
            $this->bookMoreSaveMoreTitle = $bookMoreSaveMoreTitle;
            $this->bookMoreSaveMoreContent = $bookMoreSaveMoreContent;
        }

        public function __get($property) {
            if (property_exists($this, $property)) {
                return $this->$property;
            }
        }
    public function render()
    {
        echo "
        <section class='container-fluid section' style='padding-top: 0px;'>
        <article class='row align-items-left'>
            <header class='col-12'>
                <span>
               <img class='section--background' src='../assets/images/dance/header.png' alt='' style='position:absolute; width: 100%; height:350px;'>
                <section class='hero text-top-left' style='position:relative;'>
                    <h1 style='color: white; margin-top: 60px; margin-left: 60px;'class='title title--page dance'>$this->title</h1>
                </section>
               </span>
               </header>
           </article>
       </section>

           <section class='container-fluid section'>
           <article class='row align-items-left'>
               <header class='col-6' style='border-color: white;'>
                   <section class='hero text-top-left' style='position:relative;'>
                       <span style='margin-left: 60px;'><h1 style='color: black;'class='title title--page dance'>$this->subtitle</h1>
                       <button style='border-radius: 10px; width:300px;' type='button'>Check out the artists</button></span>
                   </section>
                  </header>
                  <header class='col-4' style='border-color: white; border-top-right-radius: 50%;'>
                    <section class='hero text-top-left' style='position:relative;'>
                        <p>$this->body</p>
                    </section>
                   </header>
              </article>
       </section>

       <section class='container-fluid section' style='padding-top: 0px;'>
           <article class='row align-items-left'>
               <header class='col-12'>
                   <span>
                  <img class='section--background' src='../assets/images/dance/Below_header_2.jpg' alt='' style='position:absolute; width: 100%; height:350px;'>
                   <section class='hero text-top-left' style='position:relative;'>
                       <h1 style='color: white; margin-top: 60px; margin-left: 60px;'class='title title--page dance'>$this->artistSectionTitle</h1>
                   </section>
                  </span>
                  </header>
              </article>
          </section>

          <section class='container-fluid section'>
           <article class='row align-items-left'>
               <header class='col-6' style='border-color: white;'>
                   <section class='hero text-top-left' style='position:relative;'>
                       <span style='margin-left: 60px;'><h1 style='color: black;'class='title title--page dance'>$this->bookMoreSaveMoreTitle</h1>
                       <a href='../views/bookmoresavemore.php'>
                       <button style='border-radius: 10px; width:300px;' type='button'>Find out more</button></span>
                       </a>
                   </section>
                  </header>
                  <header class='col-4'>
                    <section class='hero text-top-left' style='position:relative;'>
                        <p>$this->bookMoreSaveMoreContent
                           </p>
                    </section>
                   </header>
              </article>
       </section>
        ";
    }
}
?>