<?

class Review 
{
    private $database;

    public function __construct()
    {
        //Get the current instance of the DB
        $this->database = DB::getInstance();
    }

    public function InsertReview($productID, $score, $message)
    {
        //implemented with Tyler Truman

        $db = DB::getInstance();

        $data = array( 
            'rev_Score'=>$score,
            'rev_Detail' => $message, 
            'pro_ID' => $productID, 
            'cus_ID'=>'13'
         );

        $insert = $db->filter($data);
        $db->clean($insert);

        $db->insert('review', $insert);


    }

    public function PrintReview($prod_id)
    {
        $query = "select * from review inner join customer on review.cus_ID=customer.cus_ID where pro_ID=$prod_id";

        $results = $this->database->get_results($query);

        foreach($results as $review)
        {
            echo("<div class='avatar-text'>
            <div class='at-rating'>
            <h5>" . $review['cus_FirstName'] . " " . $review['cus_LastName']. "<span>Score: " .$review['rev_Score'] . "</span></h5>
            <div class='at-reply'>". $review['rev_Detail'] ."</div>
            </div><br />");
        }
    }

    public function CalculateScore($prod_id)
    {
        $average = 0;
        $query = "select ROUND(AVG(rev_Score), 1) as score from review inner join customer on customer.cus_ID = review.cus_ID where pro_ID = $prod_id";
        
        $results = $this->database->get_results($query);

        foreach($results as $result)
        {
            echo($result['score']);
        }
    
    }

}



?>