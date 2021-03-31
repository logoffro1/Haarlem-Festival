<?php
include '../classes/autoloader.php';
class danceIntroService
{
    public function __construct()
    {
        $this->db = database::getInstance();
        $this->conn = $this->db->getConnection();
    }

	public function getPage(int $id) : ?object
	{
		try {
			$page =  $this->pageService->getPage($id);
			$content = utf8_encode($page->content);
			$encodedContent = json_decode($page->content);

			return $encodedContent;
		} catch (Exception $e){
			$this->addToErrors($e->getMessage());
		}
	}
    
    public function getHeaderInfo()
    {
        $query = "SELECT * FROM Pages WHERE page_id = 2";
        $result = $this->conn->query($query);


        if($result)
            {
                while($row = $result->fetch_assoc())
                {
                    $info = json_decode($row["content"]);
                    return new danceIntro($info->title, $info->subtitle,$info->body,$info->artistSectionTitle,$info->bookMoreSaveMoreTitle,$info->bookMoreSaveMoreContent);
                }
            }
    }
}
?>