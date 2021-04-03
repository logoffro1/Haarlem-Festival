<?php
class eventCards
{
    private string $eventType;
    private string $intro;
    private string $title;
    private string $url;

    public function __construct(string $eventType, string $intro, string $title, string $url) {
        $this->eventType = $eventType;
        $this->intro = $intro;
        $this->title = $title;
        $this->url = $url;
    }

    public function render()
    {
        echo "
        <article class='card--events card--events--$this->eventType'>
            <p class='card--events__intro'>
                $this->intro
            </p>
            <h4 class='card--events__title'>
                $this->title
            </h4>
            <a href='$this->url' class='card--events__arrow' >
                <img src='../assets/images/svg/icons/arrow_forward-24px.svg' alt='' srcset=''>
            </a>
        </article>
        ";
    }
}

?>
